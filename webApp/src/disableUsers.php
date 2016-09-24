<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position'])){
	if($_SESSION['position'] == "stationMaster"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('../ssi/links.html');
	include_once('../ssi/db.php');
?>
<title>User Management</title>
</head>

<body style="background-image:url(../images/4.jpg);background-repeat:no-repeat;background-size:cover;">
<div>
	<?php
        include_once('../ssi/Header.php');
    ?>
</div>
<div class="container-fluid text-capitalize" style="padding:0px;margin:0px;">
	<div>
		<?php
			include_once('../ssi/stationMasterLeftPanelUsers.php');
			$sendPos = $_GET['position'];
        ?>
    </div>
    <div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1"><u>Disable  
                <?php
                    echo $sendPos.'s';
                ?>
            </u>
            </font>
        </div>
        <div style="padding:10px;"> 
        	<?php
			if(isset($_GET['error'])){
				if(!empty($_GET['error'])){
					$error = $_GET['error'];
					if($error == "su"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control label-success" style="height:35px;">User Activated Successfully. New Password Send via An E-Mail.</label>
							</div>';
					} else if($error == "qf"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Could Not Activate The User. Please Try Again Later.</label>
							</div>';
					}
				}
			}
			?>
            <div class="form-horizontal">
            	<div style="padding-left:70px;margin-top:50px;">
            	<?php
					if($sendPos == "topupAgent"){
						$getEmp = "SELECT * FROM employee WHERE STATUS='1' AND nic IN (SELECT employee_nic FROM topup_agent)";	
						$resultGetEmp = mysqli_query($con, $getEmp);
						if(mysqli_num_rows($resultGetEmp) != 0){
							echo '<div class="form-group">
									<div class="container-fluid">
										<table style="width:100%;" class="table table-striped">
										  <tr class="text-center">
											<th>Employee ID</th>
											<th>NIC</th> 
											<th>Full Name</th>
											<th>Address</th>
											<th>Contact No</th>
											<th>E-Mail</th>
											<th>Status</th>
											<th>Settings</th>
										  </tr>
										  ';
							while($rowGetEmp = mysqli_fetch_array($resultGetEmp)){
								$contact = $rowGetEmp['contact_no'];
								$nic = $rowGetEmp['nic'];
								$EMail = $rowGetEmp['employee_email'];
								$addressId = $rowGetEmp['address_id'];
								$nameId = $rowGetEmp['name_id'];
								if($rowGetEmp['status'] == 1){
									$status = "Active";
								} else {
									$status = "Deactive";
								}
								//get EID
								$getEid = "SELECT * FROM topup_agent WHERE employee_nic='".$nic."'";
								$resultEID = mysqli_query($con, $getEid);
								if(mysqli_num_rows($resultEID) != 0){
									while($rowEid = mysqli_fetch_array($resultEID)){
										$eId = $rowEid['topup_agent_id'];
									}
								}
								//get name
								$getName = "SELECT * FROM name WHERE name_id='".$nameId."'";
								$resultName = mysqli_query($con, $getName);
								if(mysqli_num_rows($resultName) != 0){
									while($rowName = mysqli_fetch_array($resultName)){
										$fName = $rowName['first_name'];
										$sName = $rowName['second_name'];
										$lName = $rowName['last_name'];
									}
								}
								//get address
								$addressName = "SELECT * FROM address WHERE address_id='".$addressId."'";
								$resultAddress = mysqli_query($con, $addressName);
								if(mysqli_num_rows($resultAddress) != 0){
									while($rowAddress = mysqli_fetch_array($resultAddress)){
										$aNo = $rowAddress['address_no'];
										$aLane = $rowAddress['address_lane'];
										$aCity = $rowAddress['address_city'];
									}
								}
								echo '<tr>
											<td>'.$eId.'</td>
											<td>'.$nic.'</td>
											<td>'.$fName.' '.$sName.' '.$lName.'</td>
											<td>'.$aNo.', '.$aLane.', '.$aCity.'</td>
											<td>'.$contact.'</td>
											<td>'.$EMail.'</td>
											<td>'.$status.'</td>
											<td><a onclick="return confirm(\'Do You Wish to Activate User?\');return false;" href="controller/disableUsersController.php?position='.$sendPos.'&nic='.$nic.'&email='.$EMail.'"><i class="fa fa-2x fa-close" style="padding-left:5px;" aria-hidden="true"></i></a></td>
										  </tr>';
								
							}
							echo '</table>
									</div>
								</div>';
						} else{
							//if no result to show
							echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
						}
					} else {
						$getEmp = "SELECT * FROM employee WHERE STATUS='1' AND nic IN (SELECT employee_nic FROM staff WHERE employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='".$sendPos."'))";	
						$resultGetEmp = mysqli_query($con, $getEmp);
						if(mysqli_num_rows($resultGetEmp) != 0){
							echo '<div class="form-group">
									<div class="container-fluid">
										<table style="width:100%;" class="table table-striped">
										  <tr class="text-center">
											<th>Employee ID</th>
											<th>NIC</th> 
											<th>Full Name</th>
											<th>Address</th>
											<th>Contact No</th>
											<th>E-Mail</th>
											<th>Status</th>
											<th>Settings</th>
										  </tr>
										  ';
							while($rowGetEmp = mysqli_fetch_array($resultGetEmp)){
								$contact = $rowGetEmp['contact_no'];
								$nic = $rowGetEmp['nic'];
								$EMail = $rowGetEmp['employee_email'];
								$addressId = $rowGetEmp['address_id'];
								$nameId = $rowGetEmp['name_id'];
								if($rowGetEmp['status'] == 1){
									$status = "Active";
								} else {
									$status = "Deactive";
								}
								//get EID
								$getEid = "SELECT * FROM staff WHERE employee_nic='".$nic."'";
								$resultEID = mysqli_query($con, $getEid);
								if(mysqli_num_rows($resultEID) != 0){
									while($rowEid = mysqli_fetch_array($resultEID)){
										$eId = $rowEid['employee_id'];
									}
								}
								//get name
								$getName = "SELECT * FROM name WHERE name_id='".$nameId."'";
								$resultName = mysqli_query($con, $getName);
								if(mysqli_num_rows($resultName) != 0){
									while($rowName = mysqli_fetch_array($resultName)){
										$fName = $rowName['first_name'];
										$sName = $rowName['second_name'];
										$lName = $rowName['last_name'];
									}
								}
								//get address
								$addressName = "SELECT * FROM address WHERE address_id='".$addressId."'";
								$resultAddress = mysqli_query($con, $addressName);
								if(mysqli_num_rows($resultAddress) != 0){
									while($rowAddress = mysqli_fetch_array($resultAddress)){
										$aNo = $rowAddress['address_no'];
										$aLane = $rowAddress['address_lane'];
										$aCity = $rowAddress['address_city'];
									}
								}
								echo '<tr>
											<td>'.$eId.'</td>
											<td>'.$nic.'</td>
											<td>'.$fName.' '.$sName.' '.$lName.'</td>
											<td>'.$aNo.', '.$aLane.', '.$aCity.'</td>
											<td>'.$contact.'</td>
											<td>'.$EMail.'</td>
											<td>'.$status.'</td>
											<td><a onclick="return confirm(\'Do You Wish to Activate User?\');return false;" href="controller/disableUsersController.php?position='.$sendPos.'&nic='.$nic.'&email='.$EMail.'"><i class="fa fa-2x fa-close" style="padding-left:5px;" aria-hidden="true"></i></a></td>
										  </tr>';
								
							}
							echo '</table>
									</div>
								</div>';
						} else{
							//if no result to show
							echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
						}
					}
				?>
                </div>
        	</div>
        </div>
    </div>
</div>
<?php
	include_once('../ssi/footer.php');
?>
</body>
</html>
<?php
	} else {
		header('Location:../404.php');
	}
} else {
	header('Location:../404.php');
}
?>
<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position'])){
	if($_SESSION['position'] == "sysadmin"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('../ssi/links.html');
	include_once('../ssi/db.php');
?>
<title>Stations Management</title>
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
            include_once('../ssi/adminLeftPanelStations.php');
        ?>
    </div>
    <div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1">
            	<u>Add New Stations</u>
            </font>
        </div>
        <div style="padding:10px;"> 
           <?php
			if(isset($_GET['error'])){
				if(!empty($_GET['error'])){
					$error = $_GET['error'];
					if($error == "ef"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Required Fields Cannot Be Empty.</label>
							</div>';
					} else if($error == "wc"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Station Code Should Be Letters Only.</label>
							</div>';
					} else if($error == "wn"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Station Name Should Be Letters Only.</label>
							</div>';
					} else if($error == "wt"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Invalid Station Master.</label>
							</div>';
					} else if($error == "ae"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Station Code, Name Already Exists Or Station Master Has Being Already Assigned To Another Station.</label>
							</div>';
					} else if($error == "qf"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Could Not Add The Station. Please Try Again Later.</label>
							</div>';
					} else if($error == "su"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control label-success" style="height:35px;">Station Successfully Added.</label>
							</div>';
					}
				}
			}
			?>
            <form role="form" class="form-horizontal" method="post" action="controller/addStationsController.php">
            	<div class="form-group">
                    <label for="sCode" class="control-label col-md-3">Station Code <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="sCode" id="sCode" pattern="^[a-zA-Z]+$" title="Station Code Should Be Letters Only." required="required"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="sName" class="control-label col-md-3">Name of the Station <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="sName" id="sName"  pattern="^[a-zA-Z]+$" title="Name Of The Station Should Be Letters Only." required="required"/>
                	</div>
                </div> 
                <div class="form-group">
                    <label for="smName" class="control-label col-md-3">Station Master's Name <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                        <select class="form-control" name="smID" id="smID">
                        <option selected="selected" disabled="disabled">--Select The Station Master--</option>
                        <?php
                        $getTypes = "SELECT employee_nic FROM staff WHERE station_code='none' AND employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='stationMaster')";
                        $result = mysqli_query($con, $getTypes);
                        if(mysqli_num_rows($result) != 0){
                            while($row = mysqli_fetch_array($result)){
                                $nic = $row['employee_nic'];
                                $get = "SELECT * FROM NAME WHERE name_id IN (SELECT name_id FROM employee WHERE nic='".$nic."')";
                        		$resultGet = mysqli_query($con, $get);
								if(mysqli_num_rows($resultGet) != 0){
                            		while($rowGet = mysqli_fetch_array($resultGet)){
										$fname = $rowGet['first_name'];
										$sname = $rowGet['second_name'];
										$lname = $rowGet['last_name'];
                                		echo '<option value="'.$nic.'">'.$nic.' - '.$fname.' '.$sname.' '.$lname.'</option>';
									}
								}
                            }
                        } else {
                            echo '<option disabled="disabled">No Station Masters</option>';
                        }
                        ?> 
                        </select>
                	</div>
                </div> 
                <div class="form-group" style="text-align:center;">
                    <label style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
                </div>
                <div class="form-group col-md-11 text-center">
                    <input type="submit" value="Add" name="submit" id="submit" class="btn btn-success" />
                    <input type="reset" value="Clear" class="btn btn-danger" />
                </div>
            </form>
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
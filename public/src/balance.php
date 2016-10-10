<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['nic'])){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('../ssi/links.html');
	include_once('../ssi/db.php');
?>
<title>Check Balance</title>
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
			include_once('../ssi/commuterLeftPanelCards.php');
        ?>
    </div>
    <div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1">
            	<u>Check My Existing Balance</u>
            </font>
        </div>
        <div style="padding:10px;">
            <div class="form-horizontal">
            <div style="padding-left:30px;padding-top:50px;">
            <?php
            	$getCommuter = "SELECT * FROM commuter WHERE nic='".$_SESSION['nic']."'";
					$resultCommuter = mysqli_query($con, $getCommuter);
					if(mysqli_num_rows($resultCommuter) != 0){
						while($rowCommuter = mysqli_fetch_array($resultCommuter)){
							$cardNo = $rowCommuter['card_card_no'];
							$nic = $rowCommuter['nic'];
							$nameId = $rowCommuter['name_name_id'];
							$contactNo = $rowCommuter['contact_no'];
							$balance = $rowCommuter['credit'];
						}
						$getName = "SELECT * FROM NAME WHERE name_id='".$nameId."'";
						$resultName = mysqli_query($con, $getName);
						if(mysqli_num_rows($resultName) != 0){
							while($rowName = mysqli_fetch_array($resultName)){
								$fName = $rowName['first_name'];
								$sName = $rowName['second_name'];
								$lName = $rowName['last_name'];
							}
							echo '<div class="form-horizontal">
									<div class="form-group">
										<label for="CardNumber" class="control-label col-md-3">Card Number</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="CardNumber" value="'.$cardNo.'" id="CardNumber" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="employeelNIC" class="control-label col-md-3">NIC</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="nic" id="nic" value="'.$nic.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="fName" class="control-label col-md-3">Full Name</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="name" id="name" value="'.$fName.' '.$sName.' '.$lName.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="contact" class="control-label col-md-3">Contact Number</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="contact" id="contact" value="'.$contactNo.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="amount" class="control-label col-md-3">Amount</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="amount" id="amount"  value="'.$balance.'" readonly/>
										</div>
									</div>
								</div>';
						} else {
							//if no result to show
							echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
						}
					} else {
						//if no result to show
						echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
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
?>
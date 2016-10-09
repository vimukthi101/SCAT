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
<title>User Profile</title>
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
            include_once('../ssi/LeftPanelProfile.php');
        ?>
    </div>
    <div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1">
            	<u>My Profile</u>
            </font>
        </div>
        <?php
			$nic = $_SESSION['nic'];
			//get user info
			$getUser = "SELECT * FROM commuter WHERE nic='".$nic."'";
			$resultGetUser = mysqli_query($con, $getUser) or die();
			if(mysqli_num_rows($resultGetUser) != 0){
				while($rowGetUser = mysqli_fetch_array($resultGetUser)){
					$eContact = $rowGetUser['contact_no'];
					$eNameId = $rowGetUser['name_name_id'];
					$eAddressId = $rowGetUser['address_address_id'];
					$cardNo = $rowGetUser['card_card_no'];
					$regDateTime = $rowGetUser['registered_date_time'];
					//get user name
					$getName = "SELECT * FROM NAME WHERE name_id='".$eNameId."'";
					$resultGetName = mysqli_query($con, $getName) or die();
					if(mysqli_num_rows($resultGetName) != 0){
						while($rowGetName = mysqli_fetch_array($resultGetName)){
							$eFName = $rowGetName['first_name'];
							$eSName = $rowGetName['second_name'];
							$eLName = $rowGetName['last_name'];
						}
					} else {
						//redirect to login
						session_unset();
						header('../index.php?error=np');
					}
					//get address
					$getAddress = "SELECT * FROM address WHERE address_id='".$eAddressId."'";
					$resultGetAddress = mysqli_query($con, $getAddress) or die();
					if(mysqli_num_rows($resultGetAddress) != 0){
						while($rowGetAddress = mysqli_fetch_array($resultGetAddress)){
							$eAno = $rowGetAddress['address_no'];
							$eALane = $rowGetAddress['address_lane'];
							$eACity = $rowGetAddress['address_city'];
						}
					} else {
						//redirect to login
						session_unset();
						header('../index.php?error=np');
					}
				}
			} else {
				//redirect to login
				session_unset();
				header('../index.php?error=np');
			}
		?>
        <div style="padding:10px;"> 
			<form role="form" class="form-horizontal">
            	<?php
				if(isset($_GET['error'])){
					if(!empty($_GET['error'])){
						$error = $_GET['error'];
						if($error == "su"){
							echo '<div class="form-group text-center" style="padding-left:100px;">
									<label class="form-control label-success" style="height:35px;">Your Profile Updated Successfully.</label>
								</div>';
						}
					}
				}
				?>
            	<div class="form-group">
                    <label for="cardNo" class="control-label col-md-3">Card Number<span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control text-capitalize" type="text" name="cardNo" id="cardNo" readonly="readonly" value="<?php echo $cardNo; ?>" required="required"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="regDate" class="control-label col-md-3">Registered Date Time<span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control text-capitalize" type="text" name="regDate" id="regDate" readonly="readonly" value="<?php echo $regDateTime; ?>" required="required"/>
                	</div>
                </div>
                <div class="form-group text-center">
                    <label class="col-md-11">Personal Information</label> 
                </div>
                <div class="form-group">
                    <label for="employeelNIC" class="control-label col-md-3">NIC</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="nic" id="nic" readonly="readonly" value="<?php echo $nic; ?>"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeefName" class="control-label col-md-3">First Name</label>
                    <div class="col-md-8">
                    	<input class="form-control text-capitalize" type="text" name="fname" id="fname" readonly="readonly" value="<?php echo $eFName; ?>"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeemName" class="control-label col-md-3">Middle Name</label>
                    <div class="col-md-8">
                    	<input class="form-control text-capitalize" type="text" name="mname" id="mname" readonly="readonly" value="<?php echo $eSName; ?>"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeelName" class="control-label col-md-3">Last Name</label>
                    <div class="col-md-8">
                    	<input class="form-control text-capitalize" type="text" name="lname" id="lname" readonly="readonly" value="<?php echo $eLName; ?>"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="addressNo" class="control-label col-md-3">Address Number</label>
                    <div class="col-md-8">
                    	<input class="form-control text-capitalize" type="text" name="addresNo" id="addressNo" readonly="readonly" value="<?php echo $eAno; ?>"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="addressLane" class="control-label col-md-3">Lane/ Street</label>
                    <div class="col-md-8">
                    	<input class="form-control  text-capitalize" type="text" name="lane" id="lane" readonly="readonly" value="<?php echo $eALane; ?>"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="addressCity" class="control-label col-md-3">City</label>
                    <div class="col-md-8">
                    	<input class="form-control text-capitalize" type="text" name="city" id="city" readonly="readonly" value="<?php echo $eACity; ?>"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeeContact" class="control-label col-md-3">Contact Number</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="contact" id="contact" readonly="readonly" value="<?php echo $eContact; ?>"/>
                	</div>
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
?>
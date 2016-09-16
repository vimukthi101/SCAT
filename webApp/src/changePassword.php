<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position'])){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('../ssi/links.html');
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
            	<u>Change Password</u>
            </font>
        </div>
        <div style="padding:10px;"> 
			<form role="form" class="form-horizontal" action="controller/changePasswordController.php" method="post">
            	<div class="form-group">
                    <label for="pass" class="control-label col-md-3">Existing Password <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control" type="password" name="pass" id="pass" pattern="\S*" title="Password Cannot Be Empty" required="required"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="nPass" class="control-label col-md-3">New Password <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control" type="password" name="nPass" id="nPass" pattern="\S*" title="Password Cannot Be Empty" required="required"/>
                	</div>
                </div>
				<div class="form-group">
                    <label for="cnPass" class="control-label col-md-3">Confirm New Password <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control" type="password" name="cnPass" id="cnPass" pattern="\S*" title="Password Cannot Be Empty" required="required"/>
                	</div>
                </div>
               	<div class="form-group" style="text-align:center;">
                    <label style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
                </div>
                <?php
					if(isset($_GET['error'])){
						$error = $_GET['error'];
						if($error == "ns"){
							echo '<div class="form-group col-md-10 text-center" style="padding:10px;margin-left:100px;">
								<label class="form-control col-md-3">Please Submit The Form To Continue</label>
							</div>';
						} else if($error == "pe"){
							echo '<div class="form-group col-md-10 text-center" style="padding:10px;margin-left:100px;">
								<label class="form-control col-md-3">Above FIelds Cannot Be Empty.</label>
							</div>';
						} else if($error == "dm"){
							echo '<div class="form-group col-md-10 text-center" style="padding:10px;margin-left:100px;">
								<label class="form-control col-md-3">New Password And Confirm Password Does Not Match.</label>
							</div>';
						} else if($error == "tl"){
							echo '<div class="form-group col-md-10 text-center" style="padding:10px;margin-left:100px;">
								<label class="form-control col-md-3">Could Not Change Your Password. Please Try Again Later.</label>
							</div>';
						} else if($error == "wp"){
							echo '<div class="form-group col-md-10 text-center" style="padding:10px;margin-left:100px;">
								<label class="form-control col-md-3">Your Existing Password Does Not Match With What You Enter.</label>
							</div>';
						}
					}
				?>
                <div class="form-group col-md-11 text-center">
                    <input type="submit" name="submit" id="submit" value="Update" class="btn btn-success" />
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
?>
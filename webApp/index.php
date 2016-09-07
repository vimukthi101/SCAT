<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" type="image/x-icon" href="images/logo.png" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>S.C.A.T</title>
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="css/animate.css" />
</head>

<body>
<!--header start-->
    <div class="col-md-12 text-center" style="background-color:rgb(0,102,255);padding:15px;height:10vh;">
        <font size="+3" color="#FFFFFF" face="Verdana, Geneva, sans-serif">Smart Card at Travelling for Trains</font>
    </div>
<!--header end-->    
<!--body start-->
	<div class="col-md-12" style="background-image:url(images/wallpaper.jpg);background-repeat:no-repeat;background-size:cover;width:100%;height:83vh;">
        <div>
            <div style="background-color:rgba(0,153,255,0.4);padding:10px;top:20vh;left:60%;" class="col-md-4 text-center">
            	<font size="+2" face="Verdana, Geneva, sans-serif" color="#000000" style="padding:10px;">Log In</font>
            	<form role="form" class="form-group" action="src/controller/login.php" method="post">
                    <div style="padding:10px;">
                     <input type="text" pattern="^(\d){9}[v|V]$" title="Should be a valid NIC of 9 digits and 'v'" class="form-control" id="userNIC" name="userNIC" placeholder="Enter User NIC">
                    </div>
                    <div style="padding:10px;">
                     <input type="password" class="form-control" pattern="\S*" title="Password should not be empty" id="password" name="password" placeholder="Enter Password">
                    </div>
                    <?php
					if(isset($_GET['error'])){
						$error = $_GET['error'];
						if($error == 'ep'){
							echo '<div style="padding:10px;">
									<label class="form-control">User Name Or Password Cannot Be Empty.</label>
								</div>';
						} else if($error == 'na'){
							echo '<div style="padding:10px;">
									<label class="form-control">Your Account Is Deactivated. Please Meet Admin.</label>
								</div>';
						} else if($error == 'np'){
							echo '<div style="padding:10px;">
									<label class="form-control">Please Login To Continue.</label>
								</div>';
						} else if($error == 'wu'){
							echo '<div style="padding:10px;">
									<label class="form-control">Entered NIC Is Not Valid. Please Enter a Valid NIC.</label>
								</div>';
						} else if($error == 'wp'){
							echo '<div style="padding:10px;">
									<label class="form-control" style="height:55px;">Entered Password Is Mismatching. Please Enter The Correct Password.</label>
								</div>';
						} else if($error == 'da'){
							echo '<div style="padding:10px;">
									<label class="form-control" style="height:55px;">Your Account Is Deactivated Due To Three Unsuccessfull Login Attempts. Please Meet Admin.</label>
								</div>';
						} else if($error == 'lo'){
							echo '<div style="padding:10px;">
									<label class="form-control">Logout Successfully. Please Login To Continue.</label>
								</div>';
						} else if($error == 'cp'){
							echo '<div style="padding:10px;">
									<label class="form-control" style="height:55px;">Password Changed Successfully. Please Login To Continue.</label>
								</div>';
						} else if($error == 'ab'){
							echo '<div style="padding:10px;">
									<label class="form-control" style="height:70px;">Your Account Is Deactivated Due To Three Unsuccessfull Login Attempts. Please Check Your Email For New Password.</label>
								</div>';
						}
					}
					?>
                    <div class="row" style="padding:10px;">
                        <div class="center-block">
                             <input type="submit" class="btn btn-default" id="submit" name="submit" value="Log In" />
                             <input type="reset" class="btn btn-default" id="reset" name="reset" value="Clear" />
                         </div>
                    </div>
                </form>
            </div>        
        </div>
    </div>
<!--body end-->
<!--footer start-->
    <?php
		include_once('ssi/footer.php');
	?>
<!--footer end-->
</body>
</html>

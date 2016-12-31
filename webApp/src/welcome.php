<?php
if(!isset($_SESSION[''])){
	session_start();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="5" />
<?php
include_once('../ssi/links.html');
include_once('../ssi/db.php');
if(isset($_COOKIE['station']) && isset($_COOKIE['terminal'])){
	session_destroy();
?>
<title>Payment Terminal</title>
<style>
a {
	text-decoration:none;
	color:rgba(255,255,255,1);
}
a:hover {
	text-decoration:none;
	color:rgba(255,255,255,0.5);
}
a:visited {
	text-decoration:none;
	color:rgba(255,255,255,1);
}
</style>
</head>
<body style="background-image:url(../images/home.jpg);background-repeat:no-repeat;background-size:cover;width:100%;">
<!--header start-->
    <div class="col-md-12 text-center" style="background-color:rgb(0,102,255);padding:15px;height:10vh;">
        <font size="+3" color="#FFFFFF" face="Verdana, Geneva, sans-serif"><a href="../index.php">Smart Card at Travelling for Trains</a></font>
    </div>
<!--header end-->    
<!--body start-->
	<div class="col-md-12" style="padding-top:130px;">
        <div>
            <div style="background-color:rgba(0,153,255,0.4);padding:10px;top:7vh;background-position:center;left:33%;" class="col-md-4 text-center">
            	<font size="+2" face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">Welcome To The Terminal</font>
                <?php
					$get = "SELECT card_number FROM card_reading WHERE STATUS=0 AND id IN (SELECT MAX(id) FROM card_reading)";
					$result = mysqli_query($con, $get);
					if(mysqli_num_rows($result)!=0){
						while($row = mysqli_fetch_array($result)){
							$cardNo = $row['card_number'];
						}
						if(isset($cardNo)){
							if(!empty($cardNo)){
								header('Location:controller/welcomeController.php?cardNo='.$cardNo);
							}
						}
					}
				?>
            	<div class="form-group">
                    <div style="padding:10px;">
                     <font size="+1" face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">Please Touch Your S.C.A.T. Card to Proceed.</font>
                    </div>
                     <?php
						 if(isset($_GET['error']) && !empty($_GET['error'])){
							 $error = $_GET['error'];
							 if($error == "ec"){
								 echo '<div style="padding:5px;">
								 	<label style="font-size:100%" class="label label-danger">Card Number Cannot Be Empty.</label>
								   </div>';
							 } else if($error == "wf"){
								 echo '<div style="padding:5px;">
								 	<label style="font-size:100%" class="label label-danger">Invalid Card Number Format.</label>
								   </div>';
							 } else if($error == "iu"){
								 echo '<div style="padding:5px;">
								 	<label style="font-size:100%" class="label label-danger">User Does Not Exist.</label>
								   </div>';
							 } else if($error == "ub"){
								 echo '<div style="padding:5px;">
								 	<label style="font-size:100%" class="label label-danger">Please Enable Your Card To Continue.</label>
								   </div>';
							 }  else if($error == "bu"){
								 echo '<div style="padding:5px;">
								 	<label style="font-size:100%" class="label label-danger">Three Unsucessfull Login Attempts Blocked Your Account.</label>
								   </div>';
							 }  
						 }
					 ?>
                </div>
            </div>        
        </div>
    </div>
<!--body end-->
<!--footer start-->
    <?php
		include_once('../ssi/footer.php');
	?>
<!--footer end-->
</body>
<?php
} else {
	session_destroy();
	header('Location:../505.php');
}
?>
</html>
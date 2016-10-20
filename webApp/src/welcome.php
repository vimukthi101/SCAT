<?php
if(!isset($_SESSION[''])){
	session_start();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include_once('../ssi/links.html');
if(isset($_COOKIE['station']) && isset($_COOKIE['terminal'])){
	session_destroy();
?>
<title>Payment Terminal</title>
</head>
<body style="background-image:url(../images/home.jpg);background-repeat:no-repeat;background-size:cover;width:100%;">
<!--header start-->
    <div class="col-md-12 text-center" style="background-color:rgb(0,102,255);padding:15px;height:10vh;">
        <font size="+3" color="#FFFFFF" face="Verdana, Geneva, sans-serif">Smart Card at Travelling for Trains</font>
    </div>
<!--header end-->    
<!--body start-->
	<div class="col-md-12">
        <div>
            <div style="background-color:rgba(0,153,255,0.4);padding:10px;top:7vh;background-position:center;left:33%;" class="col-md-4 text-center">
            	<font size="+2" face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">Welcome To The Terminal</font>
            	<form role="form" class="form-group" action="controller/welcomeController.php" method="post">
                    <div style="padding:10px;">
                     <font size="+1" face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">Please Touch Your S.C.A.T. Card or Enter Your Card Number to Proceed.</font>
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
                    <div style="padding:10px;">
                     <input type="text" class="form-control" pattern="^\d{16}$" maxlength="16" title="Please enter a valid card number." id="cardNo" name="cardNo" placeholder="Enter Card Number" required="required">
                    </div>
                    <?php
					 include_once('keyboard.php');
					 ?>
                </form>
            </div>        
        </div>
    </div>
    <script>
	function send(value){
		old = document.getElementById('cardNo').value;
		if(old.length<16){
			document.getElementById('cardNo').value = old + value;	
		}
	}
	</script>
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
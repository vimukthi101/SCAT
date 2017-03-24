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
include_once('../ssi/db.php');
if(isset($_COOKIE['station']) && isset($_COOKIE['terminal'])){
	if(isset($_SESSION['pass']) && isset($_SESSION['credit']) && isset($_SESSION['commuter_nic']) && isset($_SESSION['attempt']) && isset($_SESSION['outStation']) && isset($_SESSION['outStationName'])){
?>
<title>Payment Terminal</title>
</head>
<body style="background-image:url(../images/home.jpg);background-repeat:no-repeat;background-size:cover;width:100%;">
<!--header start-->
    <div class="col-md-12 text-center" style="background-color:rgb(0,102,255);padding:15px;height:10vh;">
        <font size="+3" color="#FFFFFF" face="Verdana, Geneva, sans-serif">Smart Card at Travelling for Trains</font>
    </div>
    <?php 
		header("Refresh: 20; URL=welcome.php"); 
	?>
<!--header end-->    
<!--body start-->
	<div class="col-md-12">
        <div style="background-color:rgba(0,153,255,0.4);padding:10px;top:20vh;width:400px;left:460px;" class="col-md-12 text-center center-block">
            <form role="form" class="form-group" method="post">
                <div style="padding:5px;">
                 <font size="+1" face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">Please Select The Ticket Class.</font>
                </div>
                <div  class="row center-block" style="padding:10px;">
                    <div style="width:10%;padding:10px;padding-left:120px;">
                    	<input hidden type="text" id="class1" name="class1" value="1" />
                        <input type="submit" class="btn btn-default text-center" style="width:120px;height:50px;" id="submit1" name="submit1" value="1st CLASS">
                     </div>
                     <div style="width:10%;padding:10px;padding-left:120px;">
	                    <input hidden type="text" id="class2" name="class2"  value="2" />
                        <input type="submit" class="btn btn-default text-center" style="width:120px;height:50px;" id="submit2" name="submit2" value="2nd CLASS">
                     </div>
                     <div style="width:10%;padding:10px;padding-left:120px;">
                        <input hidden type="text" id="class3" name="class3"  value="3" />
                        <input type="submit" class="btn btn-default text-center" style="width:120px;height:50px;" id="submit3" name="submit3" value="3rd CLASS">
                     </div>
                     <div style="width:10%;padding:10px;padding-left:120px;">
                        <input onclick="backTo();" type="button" class="btn btn-default text-center" style="width:120px;height:50px;" id="back" name="back" value="BACK">
                     </div>
                </div>
            </form>
        </div>        
    </div>
    <?php
		if(isset($_POST['submit1']) && !empty($_POST['class1'])){
			$_SESSION['ticketClass'] = $_POST['class1'];
			header('Location:commuters.php');
		} else if(isset($_POST['submit2']) && !empty($_POST['class2'])){
			$_SESSION['ticketClass'] = $_POST['class2'];
			header('Location:commuters.php');
		} else if(isset($_POST['submit3']) && !empty($_POST['class3'])){
			$_SESSION['ticketClass'] = $_POST['class3'];
			header('Location:commuters.php');
		}
	?>
<!--body end-->
<!--footer start-->
    <?php
		include_once('../ssi/footer.php');
	?>
<!--footer end-->
	<script type="text/javascript">
		function backTo(){
			window.location.assign("destination.php");
		}
	</script>
</body>
<?php
	} else {
		session_destroy();
		header('Location:welcome.php');
	}
} else {
	session_destroy();
	header('Location:../505.php');
}
?>
</html>
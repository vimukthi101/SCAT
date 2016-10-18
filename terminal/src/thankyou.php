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
if(isset($_SESSION['station']) && isset($_SESSION['terminal'])){
?>
<title>Untitled Document</title>
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
            <div style="background-color:rgba(0,153,255,0.4);padding:10px;top:28vh;background-position:center;left:26%;" class="col-md-6 text-center">
            	<font size="+2" face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">Thank You For Using S.C.A.T.</font>
            	<div class="form-group" >
                    <div style="padding:10px;">
                     <font size="+1" face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">You will receive a SMS with the ticket information shortly. Please keep it until your journey is completed. Thank You! Please come again.</font>
                    </div> 
                    <?php
						header("Refresh: 5; URL=welcome.php");
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
	header('Location:setup.php');
}
?>
</html>
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
	include_once('links.html');
	//remove this when the login is done
	$_SESSION['position'] = "commuter";
?>
<style>
#box:hover {
	background-color: rgb(0,66,165);	
}
</style>
</head>

<body>
<!--header start-->
<div class="container-fluid navbar-fixed-top" style="background-color:rgb(0,102,255);">
	<div class="row text-center text-capitalize">
	 	<div class="col-md-3" style="padding:10px;text-align:left;"> 
            <a href="../index.php" style="text-decoration:none;color:rgb(0,0,0);">
                <font face="Verdana, Geneva, sans-serif" size="+1">SCAT COMMUTER PANEL</font>
            </a>
        </div> 
	</div>
</div>
<!--header end-->  
</body>
</html>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('../ssi/links.html');
?>
<title>Manager Home</title>
</head>

<body style="background-image:url(../images/4.jpg);background-repeat:no-repeat;background-size:cover;">
<?php
	include_once('../ssi/Header.php');
?>
<div class="container-fluid" style="padding:50px;margin:40px;">
    <div class="col-md-12 text-center">
    	<div class="col-md-1"></div>
        <div class="col-md-3" style="border:rgb(0,0,0) solid;margin:10px;padding:10px;height:205px;background-image:url(../images/users.png);background-position:center;background-size:contain;background-repeat:no-repeat;background-color:rgb(0,153,255);">
        	<div style="bottom:0;left:0;position:absolute;background-color:rgba(102,102,102,0.5);width:100%;height:50px;">
            	<a href="userRegistration.php?position=Registrar" style="text-decoration:none;color:rgb(255,255,255);">
            		<font face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;" size="+2">Staff Portal</font>
                </a>
            </div>
        </div>
        <div class="col-md-3" style="border:rgb(0,0,0) solid;margin:10px;padding:10px;height:205px;background-image:url(../images/graphs.png);background-position:center;background-size:contain;background-repeat:no-repeat;background-color:rgb(0,153,255);">
        	<div style="bottom:0;left:0;position:absolute;background-color:rgba(102,102,102,0.5);width:100%;height:50px;">
            	<a href="dailyReports.php" style="text-decoration:none;color:rgb(255,255,255);">
            		<font face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;" size="+2">Reports Portal</font>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-12 text-center">
    </div>
</div>
<?php
	include_once('../ssi/footer.php');
?>
</body>
</html>
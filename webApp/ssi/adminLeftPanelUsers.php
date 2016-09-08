<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('links.html');
?>
<style>
#side:hover {
	background-color: rgb(0,66,165);	
	width:112%;
}
</style>
</head>
<body>
<div class="col-md-2" style="padding:10px;background-color:rgb(0,153,255);height:88vh;margin-top:45px;position:fixed;z-index:1000;">
	<div class="row" style="padding:10px;">
    	<label style="color:rgb(204,204,204)">Top Managers Management</label>
    </div>
    <a href="../src/userRegistration.php?position=manager" style="text-decoration:none;">
        <div class="row" style="padding:10px;" id="side">
            <font face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">Register Managers</font>
        </div>
    </a>
    <a href="../src/viewUsers.php?position=manager" style="text-decoration:none;">
        <div class="row" style="padding:10px;" id="side">
            <font face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">View Managers</font>
        </div>
    </a>
    <a href="../src/updateUsers.php?position=manager" style="text-decoration:none;">
        <div class="row" style="padding:10px;" id="side">
            <font face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">Update Managers</font>
        </div>
    </a>
    <a href="../src/deleteUsers.php?position=manager" style="text-decoration:none;">
        <div class="row" style="padding:10px;" id="side">
            <font face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">Remove Managers</font>
        </div>
    </a>
    <div class="row" style="padding:10px;">
    	<label style="color:rgb(204,204,204)">Station Masters Management</label>
    </div>
    <a href="../src/userRegistration.php?position=stationMaster" style="text-decoration:none;">
        <div class="row" style="padding:10px;" id="side">
            <font face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">Register Station Masters</font>
        </div>
    </a>
    <a href="../src/viewUsers.php?position=stationMaster" style="text-decoration:none;">
        <div class="row" style="padding:10px;" id="side">
            <font face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">View Station Masters</font>
        </div>
    </a>
    <a href="../src/updateUsers.php?position=stationMaster" style="text-decoration:none;">
        <div class="row" style="padding:10px;" id="side">
            <font face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">Update Station Masters</font>
        </div>
    </a>
    <a href="../src/deleteUsers.php?position=stationMaster" style="text-decoration:none;">
        <div class="row" style="padding:10px;" id="side">
            <font face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">Remove Station Masters</font>
        </div>
    </a>
</div>
</body>
</html>
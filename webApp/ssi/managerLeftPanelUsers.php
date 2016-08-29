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
    	<label style="color:rgb(204,204,204)">Registrar Management</label>
    </div>
    <a href="../src/userRegistration.php?position=Registrar" style="text-decoration:none;">
        <div class="row" style="padding:10px;" id="side">
            <font face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">Register Registrars</font>
        </div>
    </a>
    <a href="../src/viewUsers.php?position=Registrar" style="text-decoration:none;">
        <div class="row" style="padding:10px;" id="side">
            <font face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">View Registrars</font>
        </div>
    </a>
    <a href="../src/updateUsers.php?position=Registrar" style="text-decoration:none;">
        <div class="row" style="padding:10px;" id="side">
            <font face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">Update Registrars</font>
        </div>
    </a>
    <a href="../src/deleteUsers.php?position=Registrar" style="text-decoration:none;">
        <div class="row" style="padding:10px;" id="side">
            <font face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">Remove Registrars</font>
        </div>
    </a>
    <div class="row" style="padding:10px;">
    	<label style="color:rgb(204,204,204)">Top-up Agent Management</label>
    </div>
    <a href="../src/userRegistration.php?position=Top-up Agent" style="text-decoration:none;">
        <div class="row" style="padding:10px;" id="side">
            <font face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">Register Top-up Agents</font>
        </div>
    </a>
    <a href="../src/viewUsers.php?position=Top-up Agent" style="text-decoration:none;">
        <div class="row" style="padding:10px;" id="side">
            <font face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">View Top-up Agents</font>
        </div>
    </a>
    <a href="../src/updateUsers.php?position=Top-up Agent" style="text-decoration:none;">
        <div class="row" style="padding:10px;" id="side">
            <font face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">Update Top-up Agents</font>
        </div>
    </a>
    <a href="../src/deleteUsers.php?position=Top-up Agent" style="text-decoration:none;">
        <div class="row" style="padding:10px;" id="side">
            <font face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">Remove Top-up Agents</font>
        </div>
    </a>
</div>
</body>
</html>
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
    	<label style="color:rgb(204,204,204)">S.C.A.T. Account Management</label>
    </div>
    <a href="../src/balance.php" style="text-decoration:none;">
        <div class="row" style="padding:10px;" id="side">
            <font face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">Check Balance</font>
        </div>
    </a>
    <a href="../src/transfer.php" style="text-decoration:none;">
        <div class="row" style="padding:10px;" id="side">
            <font face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">Credit Transfer</font>
        </div>
    </a>
    <a href="../src/disableUsers.php" style="text-decoration:none;">
        <div class="row" style="padding:10px;" id="side">
            <font face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">Deactivate Cards</font>
        </div>
    </a>
</div>
</body>
</html>
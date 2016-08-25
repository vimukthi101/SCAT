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
    	<label style="color:rgb(204,204,204)">S.C.A.T. Card Management</label>
    </div>
    <a href="../src/addCard.php" style="text-decoration:none;">
        <div class="row" style="padding:10px;" id="side">
            <font face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">Add New Cards</font>
        </div>
    </a>
    <a href="../src/viewCards.php" style="text-decoration:none;">
        <div class="row" style="padding:10px;" id="side">
            <font face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">View Cards</font>
        </div>
    </a>
    <a href="../src/updateCards.php" style="text-decoration:none;">
        <div class="row" style="padding:10px;" id="side">
            <font face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">Update Cards</font>
        </div>
    </a>
    <a href="../src/deleteCards.php" style="text-decoration:none;">
        <div class="row" style="padding:10px;" id="side">
            <font face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">Delete Cards</font>
        </div>
    </a>
    <div class="row" style="padding:10px;">
    	<label style="color:rgb(204,204,204)">Issue Cards for Requests</label>
    </div>
    <a href="../src/viewCardRequests.php" style="text-decoration:none;">
        <div class="row" style="padding:10px;" id="side">
            <font face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">View Requests</font>
        </div>
    </a>
    <a href="../src/issueCards.php" style="text-decoration:none;">
        <div class="row" style="padding:10px;" id="side">
            <font face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">Issue Cards</font>
        </div>
    </a>
    <a href="../src/viewCardsList.php" style="text-decoration:none;">
        <div class="row" style="padding:10px;" id="side">
            <font face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">View Issued/ Rejected List</font>
        </div>
    </a>
</div>
</body>
</html>
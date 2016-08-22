<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('links.html');
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
    	<div class="col-md-2" style="padding:10px;"> 
        	<font face="Verdana, Geneva, sans-serif" size="+1">SCAT ADMIN PORTAL</font>
        </div>
    	<a href="../src/userRegistration.php?position=Manager" style="text-decoration:none;color:rgb(255,255,255);">
	        <div class="col-md-2" style="padding:11px;" id="box">
    	        <font face="Verdana, Geneva, sans-serif" size="3px" data-toggle="tooltip" title="Add/ View/ Update/ Remove Users From The System" data-placement="bottom">Users Portal</font>
       		</div>
        </a>
        <a href="../src/addCard.php" style="text-decoration:none;color:rgb(255,255,255);">
	        <div class="col-md-2" style="padding:11px;" id="box">
    	        <font face="Verdana, Geneva, sans-serif" size="3px" data-toggle="tooltip" title="Add/ View/ Update/ Remove S.C.A.T cards from the system and Issue cards" data-placement="bottom">Cards Portal</font>
        	</div>
        </a>
        <a href="../src/addTrains.php" style="text-decoration:none;color:rgb(255,255,255);">
        	<div class="col-md-2" style="padding:11px;" id="box">
            	<font face="Verdana, Geneva, sans-serif" size="3px" data-toggle="tooltip" title="Add/ View/ Update/ Remove Trains and Stations from the system" data-placement="bottom">Train/ Station Portal</font>
        	</div>
        </a>
        <a href="../src/registrationFee.php" style="text-decoration:none;color:rgb(255,255,255);">
	        <div class="col-md-2" style="padding:11px;" id="box">
    	        <font face="Verdana, Geneva, sans-serif" size="3px" data-toggle="tooltip" title="Add/ Update Registration fee and Ticket fee" data-placement="bottom">Systems Portal</font>    
        	</div>
        </a>
        <div class="col-md-2 dropdown pull-right">
        	<button class="btn btn-primary dropdown-toggle pull-right" type="button" data-toggle="dropdown">
    	    	<img src="../images/Contact-icon.png" alt="profile" width="30px" height="30px"/>
                	<span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a href="../src/Profile.php">View Profile</a></li>
              <li><a href="../src/Profile.php">Edit Profile</a></li>
              <li><a href="../src/Profile.php">Change Password</a></li>
              <li><a  data-toggle="modal" data-target="#myModal">Log Out</a></li>
   		 	</ul>
       	</div>
	</div>
</div>
<!--modal start-->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog center-block" style="vertical-align:middle;width:400px;">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Log Out</h4>
        </div>
        <div class="modal-body text-capitalize">
          <p>Are You sure that you want to Log Out?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">YES</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
        </div>
      </div>
    </div>
  </div>
<!--modal end-->
<!--header end-->  
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
</body>
</html>

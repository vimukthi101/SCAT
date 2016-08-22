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
	$_SESSION['position'] = "admin";
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
    <?php
		if(isset($_SESSION['position'])){
			if($_SESSION['position'] == "admin"){
	?>
        <div class="col-md-2" style="padding:10px;text-align:left;"> 
            <a href="../src/adminHome.php" style="text-decoration:none;color:rgb(0,0,0);">
                <font face="Verdana, Geneva, sans-serif" size="+1">SCAT ADMIN PORTAL</font>
            </a>
        </div>
    <?php
			} else if ($_SESSION['position'] == "stationMaster"){
	?>
        <div class="col-md-3" style="padding:10px;text-align:left;"> 
            <a href="../src/stationMasterHome.php" style="text-decoration:none;color:rgb(0,0,0);">
                <font face="Verdana, Geneva, sans-serif" size="+1">SCAT STATION MASTER PORTAL</font>
            </a>
        </div>
    <?php
			} else if ($_SESSION['position'] == "manager"){
	?>
        <div class="col-md-3" style="padding:10px;text-align:left;"> 
            <a href="../src/managerHome.php" style="text-decoration:none;color:rgb(0,0,0);">
                <font face="Verdana, Geneva, sans-serif" size="+1">SCAT MANAGER PORTAL</font>
            </a>
        </div>
    <?php			
			} else if ($_SESSION['position'] == "registrar"){
	?>
        <div class="col-md-3" style="padding:10px;text-align:left;"> 
            <a href="../src/registrarHome.php" style="text-decoration:none;color:rgb(0,0,0);">
                <font face="Verdana, Geneva, sans-serif" size="+1">SCAT REGISTRAR PORTAL</font>
            </a>
        </div>
    <?php			
			} else if ($_SESSION['position'] == "topup"){
	?>
        <div class="col-md-3" style="padding:10px;text-align:left;"> 
            <a href="../src/topupHome.php" style="text-decoration:none;color:rgb(0,0,0);">
                <font face="Verdana, Geneva, sans-serif" size="+1">SCAT TOPUP AGENT PORTAL</font>
            </a>
        </div>
    <?php			
			} else {
				echo $_SESSION['position'];	
			}
		} else {
			echo $_SESSION['position'];	
		}
	?>
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

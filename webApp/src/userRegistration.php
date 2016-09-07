<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position'])){
	if($_SESSION['position'] == "sysadmin" || $_SESSION['position'] == "stationMaster" || $_SESSION['position'] == "manager"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('../ssi/links.html');
?>
<title>User Management</title>
</head>

<body style="background-image:url(../images/4.jpg);background-repeat:no-repeat;background-size:cover;">
<div>
	<?php
        include_once('../ssi/Header.php');
    ?>
</div>
<div class="container-fluid text-capitalize" style="padding:0px;margin:0px;">
	<div>
		<?php
            if($_SESSION['position']=="sysadmin"){
				include_once('../ssi/adminLeftPanelUsers.php');
			} else if($_SESSION['position']=="stationMaster"){
				include_once('../ssi/stationMasterLeftPanelUsers.php');
			} else if($_SESSION['position']=="manager"){
				include_once('../ssi/managerLeftPanelUsers.php');
			}  
        ?>
    </div>
    <div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1"><u>
                <?php
				if(isset($_GET['position'])){
					echo 'Register a new ' . $_GET['position'];
				} else {
					echo 'invalid';	
				}
                ?>
            </u>
            </font>
        </div>
        <div style="padding:10px;"> 
            <form role="form" class="form-horizontal" method="post" action="controller/userRegistrationController.php">
            	<div class="form-group">
                    <label for="employeeId" class="control-label col-md-3">Employee ID</label>
                    <div class="col-md-8">
                    	<input class="form-control" pattern="^\w+$" title="Should be Numbers Or Letters Only. Should Not Be Empty." type="text" name="eId" id="eId" />
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeePosition" class="control-label col-md-3">Position</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="position" id="position" value="<?php if(isset($_GET['position'])){ echo $_GET['position']; } else { echo 'invalid'; }?>" readonly="readonly"/>
                	</div>
                </div>
                <div class="form-group text-center">
                    <label class="col-md-11">Personal Information</label> 
                </div>
                <div class="form-group">
                    <label for="employeelNIC" class="control-label col-md-3">NIC</label>
                    <div class="col-md-8">
                    	<input class="form-control" pattern="^(\d){9}[v|V]$" title="Should be a valid NIC of 9 digits and 'v'" type="text" name="nic" id="nic" />
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeelNIC" class="control-label col-md-3">E-Mail</label>
                    <div class="col-md-8">
                    	<input class="form-control" pattern="[^\s]+@(gmail|yahoo|hotmail)\.(com|lk)" title="Should Be A Valid EMail Address" type="text" name="email" id="email" />
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeefName" class="control-label col-md-3">First Name</label>
                    <div class="col-md-8">
                    	<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="fname" id="fname" />
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeemName" class="control-label col-md-3">Middle Name</label>
                    <div class="col-md-8">
                    	<input class="form-control" pattern="^[a-zA-Z]*$|^$" title="Should Be Letters. Can Be Empty." type="text" name="mname" id="mname" />
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeelName" class="control-label col-md-3">Last Name</label>
                    <div class="col-md-8">
                    	<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="lname" id="lname" />
                	</div>
                </div>
                <div class="form-group">
                    <label for="addressNo" class="control-label col-md-3">Address Number</label>
                    <div class="col-md-8">
                    	<input class="form-control" pattern="^([0-9].*[\\/][a-zA-Z0-9]*)|([0-9].*)$" title="Should Be Letters, Numbers, / or \. Cannot Be Empty." type="text" name="addresNo" id="addressNo" />
                	</div>
                </div>
                <div class="form-group">
                    <label for="addressLane" class="control-label col-md-3">Lane/ Street</label>
                    <div class="col-md-8">
                    	<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="lane" id="lane" />
                	</div>
                </div>
                <div class="form-group">
                    <label for="addressCity" class="control-label col-md-3">City</label>
                    <div class="col-md-8">
                    	<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="city" id="city" />
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeeContact" class="control-label col-md-3">Contact Number</label>
                    <div class="col-md-8">
                    	<input class="form-control" pattern="^\d{10}$" title="Should Be A Valid Number With 10 Digits." type="text" name="contact" id="contact" />
                	</div>
                </div>
                <div class="form-group text-center">
                    <label class="col-md-11">Profile Information</label> 
                </div>
                <div class="form-group">
                    <label for="pass" class="control-label col-md-3">Password</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="password" name="pass" id="pass" pattern="\S*" title="Password Cannot Be Empty"/>
                	</div>
                </div>
				<div class="form-group">
                    <label for="cPass" class="control-label col-md-3">Confirm Password</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="password" name="cPass" id="cPass" pattern="\S*" title="Password Cannot Be Empty"/>
                	</div>
                </div>
                <div class="form-group col-md-11 text-center">
                    <input type="submit" value="Register" id="submit" name="submit" class="btn btn-success" />
                    <input type="reset" value="Clear" class="btn btn-danger" />
                </div>
            </form>
        </div>
    </div>
</div>
<?php
	include_once('../ssi/footer.php');
?>
</body>
</html>
<?php
	} else {
		echo 'error';	
	}
} else {
	echo 'error';
}
?>
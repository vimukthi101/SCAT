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
        	<?php
			if(isset($_GET['error'])){
				if(!empty($_GET['error'])){
					$error = $_GET['error'];
					if($error == "ns"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Please Submit The Form.</label>
							</div>';
					} else if($error == "ef"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Mandatory Fields Should Not Be Empty.</label>
							</div>';
					} else if($error == "dm"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Password And Confirm Password Does Not Match.</label>
							</div>';
					} else if($error == "ne"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Entered NIC Exists.</label>
							</div>';
					} else if($error == "ee"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Entered E-mail Exists.</label>
							</div>';
					} else if($error == "id"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Entered Employee ID Exists.</label>
							</div>';
					} else if($error == "fq"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Could Not Add To Database. Please Try Again Later.</label>
							</div>';
					} else if($error == "as"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control label-success" style="height:35px;">User Added Successfully.</label>
							</div>';
					} else if($error == "weid"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">EID Should be Numbers Or Letters Only. Should Not Be Empty.</label>
							</div>';
					} else if($error == "wnic"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Should be a valid NIC of 9 digits and \'v\'</label>
						 	</div>';
					} else if($error == "we"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Should Be A Valid EMail Address.</label>
							</div>';
					} else if($error == "wf"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">First Name Should Be Letters. Cannot Be Empty.</label>
							</div>';
					} else if($error == "wm"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Middle Name Should Be Letters.</label>
							</div>';
					} else if($error == "wl"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Last Name Should Be Letters. Cannot Be Empty.</label>
							</div>'; 
					} else if($error == "wn"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Address No Should Be Letters, Numbers, / or \. Cannot Be Empty.</label>
							</div>';
					} else if($error == "wa"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Lane Should Be Letters. Cannot Be Empty.</label>
							</div>';
					} else if($error == "wc"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">City Should Be Letters. Cannot Be Empty.</label>
							</div>';
					} else if($error == "wp"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Contact No Should Be A Valid Number With 10 Digits.</label>
							</div>';
					}
				}
			}
			?>
            <form role="form" class="form-horizontal" method="post" action="controller/userRegistrationController.php">
            	<div class="form-group">
                    <label for="employeeId" class="control-label col-md-3">Employee ID <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control" pattern="^\w+$" title="Should be Numbers Or Letters Only. Should Not Be Empty." type="text" name="eId" id="eId" required="required"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeePosition" class="control-label col-md-3">Position <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="position" id="position" value="<?php if(isset($_GET['position'])){ echo $_GET['position']; } else { echo 'invalid'; }?>" readonly="readonly" required="required"/>
                	</div>
                </div>
                <div class="form-group text-center">
                    <label class="col-md-11">Personal Information</label> 
                </div>
                <div class="form-group">
                    <label for="employeelNIC" class="control-label col-md-3">NIC <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control" pattern="^(\d){9}[v|V]$" title="Should be a valid NIC of 9 digits and 'v'" type="text" name="nic" id="nic" required="required"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeelNIC" class="control-label col-md-3">E-Mail <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control" pattern="^[0-9a-zA-Z]([-.\w]*[0-9a-zA-Z_+])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9}$" title="Should Be A Valid EMail Address" type="text" name="email" id="email" required="required"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeefName" class="control-label col-md-3">First Name <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="fname" id="fname" required="required"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeemName" class="control-label col-md-3">Middle Name</label>
                    <div class="col-md-8">
                    	<input class="form-control" pattern="^[a-zA-Z]*$|^$" title="Should Be Letters. Can Be Empty." type="text" name="mname" id="mname" />
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeelName" class="control-label col-md-3">Last Name <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="lname" id="lname" required="required"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="addressNo" class="control-label col-md-3">Address Number <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control" pattern="^([0-9].*[\\/][a-zA-Z0-9]*)|([0-9].*)$" title="Should Be Letters, Numbers, / or \. Cannot Be Empty." type="text" name="addresNo" id="addressNo" required="required"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="addressLane" class="control-label col-md-3">Lane/ Street <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="lane" id="lane" required="required"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="addressCity" class="control-label col-md-3">City <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="city" id="city" required="required"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeeContact" class="control-label col-md-3">Contact Number</label>
                    <div class="col-md-8">
                    	<input class="form-control" pattern="^\d{10}$" title="Should Be A Valid Number With 10 Digits." type="text" name="contact" id="contact" />
                	</div>
                </div>
                <div class="form-group" style="text-align:center;">
                    <label for="employeeContact" style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
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
		header('Location:../404.php');
	}
} else {
	header('Location:../404.php');
}
?>
<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position'])){
	if($_SESSION['position'] == "registrar"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('../ssi/links.html');
	include_once('../ssi/db.php');
?>
<title>Commuter Management</title>
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
        	include_once('../ssi/registrarLeftPanelUsers.php'); 
        ?>
    </div>
    <div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1">
            	<u>Register a new Commuter</u>
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
					} else if($error == "ne"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Entered NIC Exists.</label>
							</div>';
					} else if($error == "fq"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Could Not Add The Commuter. Please Try Again Later.</label>
							</div>';
					} else if($error == "as"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control label-success" style="height:35px;">Commuter Added Successfully. Will Receive A SMS With Success Message.</label>
							</div>';
					} else if($error == "weid"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Card Number Is Invalid.</label>
							</div>';
					} else if($error == "wnic"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Should be a valid NIC of 9 digits and \'v\'</label>
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
					} else if($error == "wfee"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Registartion Fee Is Not Valid.</label>
							</div>';
					} else if($error == "wp"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Contact No Should Be A Valid Number With 10 Digits.</label>
							</div>';
					}
				}
			}
		?>
            <form role="form" class="form-horizontal" method="post" action="controller/commuterRegistrationController.php">
                <div class="form-group text-center">
                    <label class="col-md-11">Personal Information</label> 
                </div>
                <div class="form-group">
                    <label for="employeelNIC" class="control-label col-md-3">NIC <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control" pattern="^(\d){9}[v|V]$" maxlength="10" title="Should be a valid NIC of 9 digits and 'v'" type="text" name="nic" id="nic" required="required"/>
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
                    	<input class="form-control" pattern="^([0-9].*[\\/][a-zA-Z0-9]*)|([0-9].*)$" title="Should Be Letters, Numbers, / or \. Cannot Be Empty." type="text" name="addressNo" id="addressNo" required="required"/>
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
                    	<input class="form-control" maxlength="10" pattern="^\d{10}$" title="Should Be A Valid Number With 10 Digits." type="text" name="contact" id="contact" />
                	</div>
                </div>
                <div class="form-group text-center">
                    <label class="col-md-11">S.C.A.T. Card Information</label> 
                </div>
                <?php
				$regFee = "SELECT reg_fee FROM commuter_regfee";
				$resultFee = mysqli_query($con, $regFee);
				if(mysqli_num_rows($resultFee) != 0){
					while($rowReg = mysqli_fetch_array($resultFee)){
						$reg_fee = $rowReg['reg_fee'];
					}
				} else {
					$reg_fee = "Commuter Reg Fee Is Not Added Yet.";
				}
				?>
                <div class="form-group">
                    <label for="regFee" class="control-label col-md-3">Registration Fee <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control" pattern="^\d+\.(\d{2})$" title="Should Be Like 100.00 Format." type="text" name="regFee" id="regFee" value="<?php echo $reg_fee; ?>" required="required" readonly="readonly"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="cardNo" class="control-label col-md-3">Card Number <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<select class="form-control" name="cardNo" id="cardNo">
                        <option selected="selected" disabled="disabled">--Select The Card Number--</option>
                        <?php
						$nic = $_SESSION['nic'];
                        $getTypes = "SELECT card_no FROM card WHERE station_station_code IN (SELECT station_code FROM staff WHERE employee_nic='".$nic."') AND issued_to_commuter='0'";
                        $result = mysqli_query($con, $getTypes);
                        if(mysqli_num_rows($result) != 0){
                            while($row = mysqli_fetch_array($result)){
                                $cardNo = $row['card_no'];
                                echo '<option value="'.$cardNo.'">'.$cardNo.'</option>';	
                            }
                        } else {
                            echo '<option disabled="disabled">No Cards Available.</option>';
                        }
                        ?> 
                        </select>
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
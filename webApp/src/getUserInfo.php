<?php
include_once('../ssi/links.html');
include_once('../ssi/db.php');
?>
<!DOCTYPE html>
<html>
<head>
<style>
a {
	color:rgba(255,0,0,0.5);
}
a:hover {
    color:rgba(255,0,0,1);
}
a:visited{
	color:rgba(255,0,0,0.5);
}
</style>
</head>
<?php
//value enter by user
$q = trim(htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST["q"])));
//operation : view/update/delete
$p = trim(htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST["p"])));
//html id
$r = trim(htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST["r"])));
//position
$s = trim(htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST["s"])));
if($s != ""){
	if($r != ""){
		if($p != ""){
			//get data for view
			if($p == "view"){
				if ($q != "") {
					//select from EID
					if($r == "eId"){
						//get employee from EID
						$getEmp = "SELECT * FROM employee WHERE nic IN (SELECT employee_nic FROM staff WHERE employee_id LIKE '".$q."%' AND employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='".$s."'))";	
						$resultGetEmp = mysqli_query($con, $getEmp);
						if(mysqli_num_rows($resultGetEmp) != 0){
							echo '<div class="form-group">
									<div class="container-fluid">
										<table style="width:100%;" class="table table-striped">
										  <tr class="text-center">
											<th>Employee ID</th>
											<th>NIC</th> 
											<th>Full Name</th>
											<th>Address</th>
											<th>Contact No</th>
											<th>E-Mail</th>
											<th>Status</th>
											<th>Settings</th>
										  </tr>
										  ';
							while($rowGetEmp = mysqli_fetch_array($resultGetEmp)){
								$contact = $rowGetEmp['contact_no'];
								$nic = $rowGetEmp['nic'];
								$EMail = $rowGetEmp['employee_email'];
								$addressId = $rowGetEmp['address_id'];
								$nameId = $rowGetEmp['name_id'];
								if($rowGetEmp['status'] == 1){
									$status = "Active";
								} else {
									$status = "Deactive";
								}
								//get EID
								$getEid = "SELECT * FROM staff WHERE employee_nic='".$nic."'";
								$resultEID = mysqli_query($con, $getEid);
								if(mysqli_num_rows($resultEID) != 0){
									while($rowEid = mysqli_fetch_array($resultEID)){
										$eId = $rowEid['employee_id'];
									}
								}
								//get name
								$getName = "SELECT * FROM name WHERE name_id='".$nameId."'";
								$resultName = mysqli_query($con, $getName);
								if(mysqli_num_rows($resultName) != 0){
									while($rowName = mysqli_fetch_array($resultName)){
										$fName = $rowName['first_name'];
										$sName = $rowName['second_name'];
										$lName = $rowName['last_name'];
									}
								}
								//get address
								$addressName = "SELECT * FROM address WHERE address_id='".$addressId."'";
								$resultAddress = mysqli_query($con, $addressName);
								if(mysqli_num_rows($resultAddress) != 0){
									while($rowAddress = mysqli_fetch_array($resultAddress)){
										$aNo = $rowAddress['address_no'];
										$aLane = $rowAddress['address_lane'];
										$aCity = $rowAddress['address_city'];
									}
								}
								echo '<tr>
											<td>'.$eId.'</td>
											<td>'.$nic.'</td>
											<td>'.$fName.' '.$sName.' '.$lName.'</td>
											<td>'.$aNo.', '.$aLane.', '.$aCity.'</td>
											<td>'.$contact.'</td>
											<td>'.$EMail.'</td>
											<td>'.$status.'</td>
											<td><a href="#"><i class="fa fa-2x fa-trash-o" style="padding-right:10px;" aria-hidden="true"></i></a><a href="#"><i class="fa fa-2x fa-cog" style="padding-left:5px;" aria-hidden="true"></i></a><a href="#"><i class="fa fa-2x fa-times" style="padding-left:5px;" aria-hidden="true"></i><a href="#"><i class="fa fa-2x fa-check" style="padding-left:5px;" aria-hidden="true"></i></a></a></td>
										  </tr>';
								
							}
							echo '</table>
									</div>
								</div>';
						} else{
							//if no result to show
							echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
						}
					//select from NIC
					} else if ($r == "NIC"){
						//get employee from NIC
						$getEmp = "SELECT * FROM staff WHERE employee_position_position_id IN ( SELECT position_id FROM employee_position WHERE POSITION='".$s."' ) AND employee_nic LIKE '".$q."%'";	
						$resultGetEmp = mysqli_query($con, $getEmp);
						if(mysqli_num_rows($resultGetEmp) != 0){
							echo '<div class="form-group">
									<div class="container-fluid">
										<table style="width:100%;" class="table table-striped">
										  <tr class="text-center">
											<th>Employee ID</th>
											<th>NIC</th> 
											<th>Full Name</th>
											<th>Address</th>
											<th>Contact No</th>
											<th>E-Mail</th>
											<th>Status</th>
											<th>Settings</th>
										  </tr>
										  ';
							while($rowGetEmp = mysqli_fetch_array($resultGetEmp)){
								$eID = $rowGetEmp['employee_id'];
								$eNic = $rowGetEmp['employee_nic'];
								//get employee
								$getEid = "SELECT * FROM employee WHERE nic='".$eNic."'";
								$resultEID = mysqli_query($con, $getEid);
								if(mysqli_num_rows($resultEID) != 0){
									while($rowEid = mysqli_fetch_array($resultEID)){
										$contact = $rowEid['contact_no'];
										$EMail = $rowEid['employee_email'];
										$addressId = $rowEid['address_id'];
										$nameId = $rowEid['name_id'];
										if($rowEid['status'] == 1){
											$status = "Active";
										} else {
											$status = "Deactive";
										}
									}
								}
								//get name
								$getName = "SELECT * FROM name WHERE name_id='".$nameId."'";
								$resultName = mysqli_query($con, $getName);
								if(mysqli_num_rows($resultName) != 0){
									while($rowName = mysqli_fetch_array($resultName)){
										$fName = $rowName['first_name'];
										$sName = $rowName['second_name'];
										$lName = $rowName['last_name'];
									}
								}
								//get address
								$addressName = "SELECT * FROM address WHERE address_id='".$addressId."'";
								$resultAddress = mysqli_query($con, $addressName);
								if(mysqli_num_rows($resultAddress) != 0){
									while($rowAddress = mysqli_fetch_array($resultAddress)){
										$aNo = $rowAddress['address_no'];
										$aLane = $rowAddress['address_lane'];
										$aCity = $rowAddress['address_city'];
									}
								}
								echo '<tr>
											<td>'.$eID.'</td>
											<td>'.$eNic.'</td>
											<td>'.$fName.' '.$sName.' '.$lName.'</td>
											<td>'.$aNo.', '.$aLane.', '.$aCity.'</td>
											<td>'.$contact.'</td>
											<td>'.$EMail.'</td>
											<td>'.$status.'</td>
											<td><a href="#"><i class="fa fa-2x fa-trash-o" style="padding-right:10px;" aria-hidden="true"></i></a><a href="#"><i class="fa fa-2x fa-cog" style="padding-left:5px;" aria-hidden="true"></i></a></td>
										  </tr>';
								
							}
							echo '</table>
									</div>
								</div>';
						} else{
							//if no result to show
							echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
						}
					//select from email
					} else if ($r == "Email"){
					    //get employee from Email
						$getEmp = "SELECT * FROM employee WHERE nic IN (SELECT employee_nic FROM staff WHERE employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='".$s."')) AND employee_email LIKE '".$q."%'";	
						$resultGetEmp = mysqli_query($con, $getEmp);
						if(mysqli_num_rows($resultGetEmp) != 0){
							echo '<div class="form-group">
									<div class="container-fluid">
										<table style="width:100%;" class="table table-striped">
										  <tr class="text-center">
											<th>Employee ID</th>
											<th>NIC</th> 
											<th>Full Name</th>
											<th>Address</th>
											<th>Contact No</th>
											<th>E-Mail</th>
											<th>Status</th>
											<th>Settings</th>
										  </tr>
										  ';
							while($rowGetEmp = mysqli_fetch_array($resultGetEmp)){
								$contact = $rowGetEmp['contact_no'];
								$eNic = $rowGetEmp['nic'];
								$EMail = $rowGetEmp['employee_email'];
								$addressId = $rowGetEmp['address_id'];
								$nameId = $rowGetEmp['name_id'];
								if($rowGetEmp['status'] == 1){
									$status = "Active";
								} else {
									$status = "Deactive";
								}
								//get employee from position
								$getEid = "SELECT employee_id FROM staff WHERE employee_nic='".$eNic."'";
								$resultEID = mysqli_query($con, $getEid);
								if(mysqli_num_rows($resultEID) != 0){
									while($rowEid = mysqli_fetch_array($resultEID)){
										$eID = $rowEid['employee_id'];
									}
								}
								//get name
								$getName = "SELECT * FROM name WHERE name_id='".$nameId."'";
								$resultName = mysqli_query($con, $getName);
								if(mysqli_num_rows($resultName) != 0){
									while($rowName = mysqli_fetch_array($resultName)){
										$fName = $rowName['first_name'];
										$sName = $rowName['second_name'];
										$lName = $rowName['last_name'];
									}
								}
								//get address
								$addressName = "SELECT * FROM address WHERE address_id='".$addressId."'";
								$resultAddress = mysqli_query($con, $addressName);
								if(mysqli_num_rows($resultAddress) != 0){
									while($rowAddress = mysqli_fetch_array($resultAddress)){
										$aNo = $rowAddress['address_no'];
										$aLane = $rowAddress['address_lane'];
										$aCity = $rowAddress['address_city'];
									}
								}
								echo '<tr>
											<td>'.$eID.'</td>
											<td>'.$eNic.'</td>
											<td>'.$fName.' '.$sName.' '.$lName.'</td>
											<td>'.$aNo.', '.$aLane.', '.$aCity.'</td>
											<td>'.$contact.'</td>
											<td>'.$EMail.'</td>
											<td>'.$status.'</td>
											<td><a href="#"><i class="fa fa-2x fa-trash-o" style="padding-right:10px;" aria-hidden="true"></i></a><a href="#"><i class="fa fa-2x fa-cog" style="padding-left:5px;" aria-hidden="true"></i></a></td>
										  </tr>';
								
							}
							echo '</table>
									</div>
								</div>';
						} else{
							//if no result to show
							echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
						}
					} else if ($r == "fname"){
						//get employee from first name
						$getEmp = "SELECT * FROM staff WHERE employee_nic IN (SELECT nic FROM employee WHERE name_id IN (SELECT name_id FROM name WHERE first_name LIKE '".$q."%')) AND employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='".$s."')";	
						$resultGetEmp = mysqli_query($con, $getEmp);
						if(mysqli_num_rows($resultGetEmp) != 0){
							echo '<div class="form-group">
									<div class="container-fluid">
										<table style="width:100%;" class="table table-striped">
										  <tr class="text-center">
											<th>Employee ID</th>
											<th>NIC</th> 
											<th>Full Name</th>
											<th>Address</th>
											<th>Contact No</th>
											<th>E-Mail</th>
											<th>Status</th>
											<th>Settings</th>
										  </tr>
										  ';
							while($rowGetEmp = mysqli_fetch_array($resultGetEmp)){
								$eID = $rowGetEmp['employee_id'];
								$eNic = $rowGetEmp['employee_nic'];
								//get employee
								$getEid = "SELECT * FROM employee WHERE nic='".$eNic."'";
								$resultEID = mysqli_query($con, $getEid);
								if(mysqli_num_rows($resultEID) != 0){
									while($rowEid = mysqli_fetch_array($resultEID)){
										$contact = $rowEid['contact_no'];
										$EMail = $rowEid['employee_email'];
										$addressId = $rowEid['address_id'];
										$nameId = $rowEid['name_id'];
										if($rowEid['status'] == 1){
											$status = "Active";
										} else {
											$status = "Deactive";
										}
									}
								}
								//get name
								$getName = "SELECT * FROM name WHERE name_id='".$nameId."'";
								$resultName = mysqli_query($con, $getName);
								if(mysqli_num_rows($resultName) != 0){
									while($rowName = mysqli_fetch_array($resultName)){
										$fName = $rowName['first_name'];
										$sName = $rowName['second_name'];
										$lName = $rowName['last_name'];
									}
								}
								//get address
								$addressName = "SELECT * FROM address WHERE address_id='".$addressId."'";
								$resultAddress = mysqli_query($con, $addressName);
								if(mysqli_num_rows($resultAddress) != 0){
									while($rowAddress = mysqli_fetch_array($resultAddress)){
										$aNo = $rowAddress['address_no'];
										$aLane = $rowAddress['address_lane'];
										$aCity = $rowAddress['address_city'];
									}
								}
								echo '<tr>
											<td>'.$eID.'</td>
											<td>'.$eNic.'</td>
											<td>'.$fName.' '.$sName.' '.$lName.'</td>
											<td>'.$aNo.', '.$aLane.', '.$aCity.'</td>
											<td>'.$contact.'</td>
											<td>'.$EMail.'</td>
											<td>'.$status.'</td>
											<td><a href="#"><i class="fa fa-2x fa-trash-o" style="padding-right:10px;" aria-hidden="true"></i></a><a href="#"><i class="fa fa-2x fa-cog" style="padding-left:5px;" aria-hidden="true"></i></a></td>
										  </tr>';
								
							}
							echo '</table>
									</div>
								</div>';
						} else{
							//if no result to show
							echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
						}
					} else if ($r == "lname"){
						//get employee from last name
						$getEmp = "SELECT * FROM staff WHERE employee_nic IN (SELECT nic FROM employee WHERE name_id IN (SELECT name_id FROM name WHERE last_name LIKE '".$q."%')) AND employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='".$s."')";	
						$resultGetEmp = mysqli_query($con, $getEmp);
						if(mysqli_num_rows($resultGetEmp) != 0){
							echo '<div class="form-group">
									<div class="container-fluid">
										<table style="width:100%;" class="table table-striped">
										  <tr class="text-center">
											<th>Employee ID</th>
											<th>NIC</th> 
											<th>Full Name</th>
											<th>Address</th>
											<th>Contact No</th>
											<th>E-Mail</th>
											<th>Status</th>
											<th>Settings</th>
										  </tr>
										  ';
							while($rowGetEmp = mysqli_fetch_array($resultGetEmp)){
								$eID = $rowGetEmp['employee_id'];
								$eNic = $rowGetEmp['employee_nic'];
								//get employee
								$getEid = "SELECT * FROM employee WHERE nic='".$eNic."'";
								$resultEID = mysqli_query($con, $getEid);
								if(mysqli_num_rows($resultEID) != 0){
									while($rowEid = mysqli_fetch_array($resultEID)){
										$contact = $rowEid['contact_no'];
										$EMail = $rowEid['employee_email'];
										$addressId = $rowEid['address_id'];
										$nameId = $rowEid['name_id'];
										if($rowEid['status'] == 1){
											$status = "Active";
										} else {
											$status = "Deactive";
										}
									}
								}
								//get name
								$getName = "SELECT * FROM name WHERE name_id='".$nameId."'";
								$resultName = mysqli_query($con, $getName);
								if(mysqli_num_rows($resultName) != 0){
									while($rowName = mysqli_fetch_array($resultName)){
										$fName = $rowName['first_name'];
										$sName = $rowName['second_name'];
										$lName = $rowName['last_name'];
									}
								}
								//get address
								$addressName = "SELECT * FROM address WHERE address_id='".$addressId."'";
								$resultAddress = mysqli_query($con, $addressName);
								if(mysqli_num_rows($resultAddress) != 0){
									while($rowAddress = mysqli_fetch_array($resultAddress)){
										$aNo = $rowAddress['address_no'];
										$aLane = $rowAddress['address_lane'];
										$aCity = $rowAddress['address_city'];
									}
								}
								echo '<tr>
											<td>'.$eID.'</td>
											<td>'.$eNic.'</td>
											<td>'.$fName.' '.$sName.' '.$lName.'</td>
											<td>'.$aNo.', '.$aLane.', '.$aCity.'</td>
											<td>'.$contact.'</td>
											<td>'.$EMail.'</td>
											<td>'.$status.'</td>
											<td><a href="#"><i class="fa fa-2x fa-trash-o" style="padding-right:10px;" aria-hidden="true"></i></a><a href="#"><i class="fa fa-2x fa-cog" style="padding-left:5px;" aria-hidden="true"></i></a></td>
										  </tr>';
								
							}
							echo '</table>
									</div>
								</div>';
						} else{
							//if no result to show
							echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
						}
					}
				} else {
					//no value entered for search
					echo '<h3 class="text-center" style="padding:50px;">Please Enter A Value To Search.</h3>';
				}
			} else if($p == "update"){
				if($q != ""){
					$hint .= '<form role="form" class="form-horizontal">
						<div class="form-group">
							<label for="employeeId" class="control-label col-md-3">Employee ID</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="eId" id="eId" />
							</div>
						</div>
						<div class="form-group">
							<label for="employeePosition" class="control-label col-md-3">Position</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="position" id="position" value="" readonly="readonly"/>
							</div>
						</div>
						<div class="form-group text-center">
							<label class="col-md-11">Personal Information</label> 
						</div>
						<div class="form-group">
							<label for="employeelNIC" class="control-label col-md-3">NIC</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="nic" id="nic" />
							</div>
						</div>
						<div class="form-group">
							<label for="employeefName" class="control-label col-md-3">First Name</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="fname" id="fname" />
							</div>
						</div>
						<div class="form-group">
							<label for="employeemName" class="control-label col-md-3">Middle Name</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="mname" id="mname" />
							</div>
						</div>
						<div class="form-group">
							<label for="employeelName" class="control-label col-md-3">Last Name</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="lname" id="lname" />
							</div>
						</div>
						<div class="form-group">
							<label for="addressNo" class="control-label col-md-3">Address Number</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="addresNo" id="addressNo" />
							</div>
						</div>
						<div class="form-group">
							<label for="addressLane" class="control-label col-md-3">Lane/ Street</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="lane" id="lane" />
							</div>
						</div>
						<div class="form-group">
							<label for="addressCity" class="control-label col-md-3">City</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="city" id="city" />
							</div>
						</div>
						<div class="form-group">
							<label for="employeeContact" class="control-label col-md-3">Contact Number</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="contact" id="contact" />
							</div>
						</div>
						<div class="form-group col-md-11 text-center">
							<input type="submit" value="Update" class="btn btn-success" />
							<input type="reset" value="Clear" class="btn btn-danger" />
						</div>
					</form>';
				}
			} else {
				if($q != ""){
					$hint .= '<form role="form" class="form-horizontal">
						<div class="form-group">
							<label for="employeeId" class="control-label col-md-3">Employee ID</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="eId" id="eId" />
							</div>
						</div>
						<div class="form-group">
							<label for="employeePosition" class="control-label col-md-3">Position</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="position" id="position" value="" readonly="readonly"/>
							</div>
						</div>
						<div class="form-group text-center">
							<label class="col-md-11">Personal Information</label> 
						</div>
						<div class="form-group">
							<label for="employeelNIC" class="control-label col-md-3">NIC</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="nic" id="nic" />
							</div>
						</div>
						<div class="form-group">
							<label for="employeefName" class="control-label col-md-3">First Name</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="fname" id="fname" />
							</div>
						</div>
						<div class="form-group">
							<label for="employeemName" class="control-label col-md-3">Middle Name</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="mname" id="mname" />
							</div>
						</div>
						<div class="form-group">
							<label for="employeelName" class="control-label col-md-3">Last Name</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="lname" id="lname" />
							</div>
						</div>
						<div class="form-group">
							<label for="addressNo" class="control-label col-md-3">Address Number</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="addresNo" id="addressNo" />
							</div>
						</div>
						<div class="form-group">
							<label for="addressLane" class="control-label col-md-3">Lane/ Street</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="lane" id="lane" />
							</div>
						</div>
						<div class="form-group">
							<label for="addressCity" class="control-label col-md-3">City</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="city" id="city" />
							</div>
						</div>
						<div class="form-group">
							<label for="employeeContact" class="control-label col-md-3">Contact Number</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="contact" id="contact" />
							</div>
						</div>
						<div class="form-group col-md-11 text-center">
							<input type="submit" value="Delete" class="btn btn-success" />
							<input type="reset" value="Clear" class="btn btn-danger" />
						</div>
					</form>';
				}
			}
		}
	}
}
//echo $hint === "" ? "no suggestion" : $hint;
?>
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
$hint = "";
if($s != ""){
	if($r != ""){
		if($p != ""){
			//get data for view
			if($p == "view"){
				if ($q != "") {
					//select from EID
					if($r == "eId"){
						if($s == "topupAgent"){
							//get employee from EID
							$getEmp = "SELECT * FROM employee WHERE nic IN (SELECT employee_nic FROM topup_agent WHERE topup_agent_id LIKE '".$q."%')";	
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
											  </tr>
											  ';
								while($rowGetEmp = mysqli_fetch_array($resultGetEmp)){
									$contact = $rowGetEmp['contact_no'];
									$nic = $rowGetEmp['nic'];
									$EMail = $rowGetEmp['employee_email'];
									$addressId = $rowGetEmp['address_id'];
									$nameId = $rowGetEmp['name_id'];
									//get EID
									$getEid = "SELECT * FROM topup_agent WHERE employee_nic='".$nic."'";
									$resultEID = mysqli_query($con, $getEid);
									if(mysqli_num_rows($resultEID) != 0){
										while($rowEid = mysqli_fetch_array($resultEID)){
											$eId = $rowEid['topup_agent_id'];
											$status = $rowEid['topup_agent_status_id'];
										}
									}
									//get status
									$getStatus = "SELECT topup_agent_status FROM topup_agent_status WHERE topup_agent_status_id='".$status."'";
									$resultGetStatus = mysqli_query($con, $getStatus);
									if(mysqli_num_rows($resultGetStatus) != 0){
										while($rowStatus = mysqli_fetch_array($resultGetStatus)){
											$statusName = $rowStatus['topup_agent_status'];
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
												<td>'.$statusName.'</td>
											  </tr>';
									
								}
								echo '</table>
										</div>
									</div>';
							} else{
								//if no result to show
								echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
							}
						} else {
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
					//select from NIC
					} else if ($r == "NIC"){
						if($s == "topupAgent"){
							//get employee from NIC
							$getEmp = "SELECT * FROM topup_agent WHERE employee_nic LIKE '".$q."%'";	
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
											  </tr>
											  ';
								while($rowGetEmp = mysqli_fetch_array($resultGetEmp)){
									$eID = $rowGetEmp['topup_agent_id'];
									$eNic = $rowGetEmp['employee_nic'];
									$sID = $rowGetEmp['topup_agent_status_id'];
									//get employee
									$getEid = "SELECT * FROM employee WHERE nic='".$eNic."'";
									$resultEID = mysqli_query($con, $getEid);
									if(mysqli_num_rows($resultEID) != 0){
										while($rowEid = mysqli_fetch_array($resultEID)){
											$contact = $rowEid['contact_no'];
											$EMail = $rowEid['employee_email'];
											$addressId = $rowEid['address_id'];
											$nameId = $rowEid['name_id'];
										}
									}
									//get status
									$getStatus = "SELECT topup_agent_status FROM topup_agent_status WHERE topup_agent_status_id='".$sID."'";
									$resultGetStatus = mysqli_query($con, $getStatus);
									if(mysqli_num_rows($resultGetStatus) != 0){
										while($rowStatus = mysqli_fetch_array($resultGetStatus)){
											$statusName = $rowStatus['topup_agent_status'];
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
												<td>'.$statusName.'</td>
											  </tr>';
									
								}
								echo '</table>
										</div>
									</div>';
							} else{
								//if no result to show
								echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
							}
						} else {
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
					//select from email
					} else if ($r == "Email"){
						if($s == "topupAgent"){
							//get employee from Email
							$getEmp = "SELECT * FROM employee WHERE employee_email LIKE '".$q."%'";	
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
											  </tr>
											  ';
								while($rowGetEmp = mysqli_fetch_array($resultGetEmp)){
									$contact = $rowGetEmp['contact_no'];
									$eNic = $rowGetEmp['nic'];
									$EMail = $rowGetEmp['employee_email'];
									$addressId = $rowGetEmp['address_id'];
									$nameId = $rowGetEmp['name_id'];
									//get employee from position
									$getEid = "SELECT * FROM topup_agent WHERE employee_nic='".$eNic."'";
									$resultEID = mysqli_query($con, $getEid);
									if(mysqli_num_rows($resultEID) != 0){
										while($rowEid = mysqli_fetch_array($resultEID)){
											$eID = $rowEid['topup_agent_id'];
											$sID = $rowEid['topup_agent_status_id'];
										}
									}
									//get status
									$getStatus = "SELECT topup_agent_status FROM topup_agent_status WHERE topup_agent_status_id='".$sID."'";
									$resultGetStatus = mysqli_query($con, $getStatus);
									if(mysqli_num_rows($resultGetStatus) != 0){
										while($rowStatus = mysqli_fetch_array($resultGetStatus)){
											$statusName = $rowStatus['topup_agent_status'];
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
												<td>'.$statusName.'</td>
											  </tr>';
									
								}
								echo '</table>
										</div>
									</div>';
							} else{
								//if no result to show
								echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
							}
						} else {
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
					} else if ($r == "fname"){
						if($s == "topupAgent"){
							//get employee from first name
							$getEmp = "SELECT * FROM topup_agent WHERE employee_nic IN (SELECT nic FROM employee WHERE name_id IN (SELECT name_id FROM name WHERE first_name LIKE '".$q."%'))";	
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
											  </tr>
											  ';
								while($rowGetEmp = mysqli_fetch_array($resultGetEmp)){
									$eID = $rowGetEmp['topup_agent_id'];
									$sID = $rowGetEmp['topup_agent_status_id'];
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
										}
									}
									//get status
									$getStatus = "SELECT topup_agent_status FROM topup_agent_status WHERE topup_agent_status_id='".$sID."'";
									$resultGetStatus = mysqli_query($con, $getStatus);
									if(mysqli_num_rows($resultGetStatus) != 0){
										while($rowStatus = mysqli_fetch_array($resultGetStatus)){
											$statusName = $rowStatus['topup_agent_status'];
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
												<td>'.$statusName.'</td>
											  </tr>';
									
								}
								echo '</table>
										</div>
									</div>';
							} else{
								//if no result to show
								echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
							}
						} else {
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
					} else if ($r == "lname"){
						if($s == "topupAgent"){
							//get employee from last name
							$getEmp = "SELECT * FROM topup_agent WHERE employee_nic IN (SELECT nic FROM employee WHERE name_id IN (SELECT name_id FROM name WHERE last_name LIKE '".$q."%'))";	
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
											  </tr>
											  ';
								while($rowGetEmp = mysqli_fetch_array($resultGetEmp)){
									$eID = $rowGetEmp['topup_agent_id'];
									$sID = $rowGetEmp['topup_agent_status_id'];
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
									//get status
									$getStatus = "SELECT topup_agent_status FROM topup_agent_status WHERE topup_agent_status_id='".$sID."'";
									$resultGetStatus = mysqli_query($con, $getStatus);
									if(mysqli_num_rows($resultGetStatus) != 0){
										while($rowStatus = mysqli_fetch_array($resultGetStatus)){
											$statusName = $rowStatus['topup_agent_status'];
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
												<td>'.$statusName.'</td>
											  </tr>';
									
								}
								echo '</table>
										</div>
									</div>';
							} else{
								//if no result to show
								echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
							}
						} else {
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
					}
				} else {
					//no value entered for search
					echo '<h3 class="text-center" style="padding:50px;">Please Enter A Value To Search.</h3>';
				}
			} else if($p == "update"){
				if($q != ""){
					if($r == "EID"){
						if($s == "topupAgent"){
							//get employee by EID
							//get employee from EID
							$getEmp = "SELECT * FROM employee WHERE nic IN (SELECT employee_nic FROM topup_agent WHERE topup_agent_id='".$q."')";	
							$resultGetEmp = mysqli_query($con, $getEmp);
							if(mysqli_num_rows($resultGetEmp) != 0){
								while($rowGetEmp = mysqli_fetch_array($resultGetEmp)){
									$contact = $rowGetEmp['contact_no'];
									$nic = $rowGetEmp['nic'];
									$EMail = $rowGetEmp['employee_email'];
									$addressId = $rowGetEmp['address_id'];
									$nameId = $rowGetEmp['name_id'];
									//get EID
									$getEid = "SELECT * FROM topup_agent WHERE employee_nic='".$nic."'";
									$resultEID = mysqli_query($con, $getEid);
									if(mysqli_num_rows($resultEID) != 0){
										while($rowEid = mysqli_fetch_array($resultEID)){
											$eId = $rowEid['topup_agent_id'];
											$status = $rowEid['topup_agent_status_id'];
											$regFeeId = $rowEid['topup_agent_regfee_id'];
										}
									}
									//get status
									$getStatus = "SELECT topup_agent_status FROM topup_agent_status WHERE topup_agent_status_id='".$status."'";
									$resultGetStatus = mysqli_query($con, $getStatus);
									if(mysqli_num_rows($resultGetStatus) != 0){
										while($rowStatus = mysqli_fetch_array($resultGetStatus)){
											$statusName = $rowStatus['topup_agent_status'];
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
									//get reg fee
									$getFee = "SELECT * FROM topup_agent_regfee";
									$resultFee = mysqli_query($con, $getFee);
									if(mysqli_num_rows($resultFee) != 0){
										while($rowFee = mysqli_fetch_array($resultFee)){
											$feeId = $rowFee['topup_agent_regfee_id'];
											$feeValue = $rowFee['topup_agent_regfee'];
											if($feeId == $regFeeId){
												$hint .= '<option selected value="'.$feeId.'">'.$feeValue.'</option>';	
											} else {
												$hint .= '<option value="'.$feeId.'">'.$feeValue.'</option>';
											}
										}
									} else {
										$hint .= '<option>No Registration Fees Added Yet.</option>';	
									}	
								echo '<form role="form" class="form-horizontal" method="post" action="controller/updateAgentsController.php">
										<div class="form-group">
											<label for="employeeId" class="control-label col-md-3">Employee ID <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^\w+$" title="Should be Numbers Or Letters Only. Should Not Be Empty." type="text" name="eId" id="eId" value="'.$q.'" required="required" readonly/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeePosition" class="control-label col-md-3">Position <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" type="text" name="nic" id="nic" value="topupAgent" required="required" readonly maxlength="10"/>
											</div>
										</div>
                                        <div class="form-group">
											<label for="employeePosition" class="control-label col-md-3">Registartion Fee <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<select class="form-control" id="regFee" name="regFee">
													<option disabled="disabled">--Select The Registartion Fee--</option>
													'.$hint.'
												</select>
											</div>
										</div>
										<div class="form-group text-center">
											<label class="col-md-11">Personal Information</label> 
										</div>
										<div class="form-group">
											<label for="employeelNIC" class="control-label col-md-3">NIC <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^(\d){9}[v|V]$" title="Should be a valid NIC of 9 digits and \'v\'" type="text" name="nic" id="nic" value="'.$nic.'" required="required" readonly maxlength="10"/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeelNIC" class="control-label col-md-3">E-Mail <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[0-9a-zA-Z]([-.\w]*[0-9a-zA-Z_+])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9}$" title="Should Be A Valid EMail Address." type="text" name="email" id="email" value="'.$EMail.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeefName" class="control-label col-md-3">First Name <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="fname" id="fname" value="'.$fName.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeemName" class="control-label col-md-3">Middle Name</label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]*$|^$" title="Should Be Letters. Can Be Empty." type="text" name="mname" id="mname" value="'.$sName.'"/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeelName" class="control-label col-md-3">Last Name <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="lname" id="lname" value="'.$lName.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="addressNo" class="control-label col-md-3">Address Number <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^([0-9].*[\\/][a-zA-Z0-9]*)|([0-9].*)$" title="Should Be Letters, Numbers, / or \. Cannot Be Empty." type="text" name="addresNo" id="addressNo" value="'.$aNo.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="addressLane" class="control-label col-md-3">Lane/ Street <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="lane" id="lane" value="'.$aLane.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="addressCity" class="control-label col-md-3">City <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="city" id="city" value="'.$aCity.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeeContact" class="control-label col-md-3">Contact Number</label>
											<div class="col-md-8">
												<input class="form-control" pattern="^\d{10}$" title="Should Be A Valid Number With 10 Digits." type="text" name="contact" id="contact" value="'.$contact.'" maxlength="10" />
											</div>
										</div>
										<div class="form-group" style="text-align:center;">
											<label style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
										</div>
										<div class="form-group col-md-11 text-center">
											<input type="submit" value="Update" id="submit" name="submit" class="btn btn-success" onclick="return confirm(\'Do You Wish to Update Details?\');return false;"/>
										</div>
									</form>';
								}
							} else {
								//if no result to show
								echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
							}
						} else {
							//get employee by EID
							$getUser = "SELECT * FROM employee WHERE nic IN (SELECT employee_nic FROM staff WHERE employee_id='".$q."' AND employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='".$s."'))";
							$resultGetUser = mysqli_query($con, $getUser);
							if(mysqli_num_rows($resultGetUser) != 0){
								while($rowGetUser = mysqli_fetch_array($resultGetUser)){
									$contact = $rowGetUser['contact_no'];
									$nic = $rowGetUser['nic'];
									$address_id = $rowGetUser['address_id'];
									$name_id = $rowGetUser['name_id'];
									$email = $rowGetUser['employee_email'];
								}
								//get name
								$getName = "SELECT * FROM name WHERE name_id='".$name_id."'";
								$resultName = mysqli_query($con, $getName);
								if(mysqli_num_rows($resultName) != 0){
									while($rowName = mysqli_fetch_array($resultName)){
										$fName = $rowName['first_name'];
										$sName = $rowName['second_name'];
										$lName = $rowName['last_name'];
									}
								}
								//get address
								$addressName = "SELECT * FROM address WHERE address_id='".$address_id."'";
								$resultAddress = mysqli_query($con, $addressName);
								if(mysqli_num_rows($resultAddress) != 0){
									while($rowAddress = mysqli_fetch_array($resultAddress)){
										$aNo = $rowAddress['address_no'];
										$aLane = $rowAddress['address_lane'];
										$aCity = $rowAddress['address_city'];
									}
								}
								//get positions
								$hint = '';
								$positions = "SELECT * FROM employee_position";
								$resultPositions = mysqli_query($con, $positions);
								if(mysqli_num_rows($resultPositions) != 0){
									while($rowPositions = mysqli_fetch_array($resultPositions)){
										$ePosition = $rowPositions['position'];
										if($ePosition == $s){
											$hint .= '<option selected>'.$ePosition.'</option>';
										} else {
											$hint .= '<option>'.$ePosition.'</option>';
										}
									}
								}
								echo '<form role="form" class="form-horizontal" method="post" action="controller/updateUsersController.php">
										<div class="form-group">
											<label for="employeeId" class="control-label col-md-3">Employee ID <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^\w+$" title="Should be Numbers Or Letters Only. Should Not Be Empty." type="text" name="eId" id="eId" value="'.$q.'" required="required" readonly/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeePosition" class="control-label col-md-3">Position <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<select name="position" id="position" class="form-control">
												'.$hint.'
												</select>
											</div>
										</div>
										<div class="form-group text-center">
											<label class="col-md-11">Personal Information</label> 
										</div>
										<div class="form-group">
											<label for="employeelNIC" class="control-label col-md-3">NIC <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^(\d){9}[v|V]$" title="Should be a valid NIC of 9 digits and \'v\'" type="text" name="nic" id="nic" value="'.$nic.'" required="required" readonly maxlength="10"/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeelNIC" class="control-label col-md-3">E-Mail <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[0-9a-zA-Z]([-.\w]*[0-9a-zA-Z_+])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9}$" title="Should Be A Valid EMail Address." type="text" name="email" id="email" value="'.$email.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeefName" class="control-label col-md-3">First Name <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="fname" id="fname" value="'.$fName.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeemName" class="control-label col-md-3">Middle Name</label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]*$|^$" title="Should Be Letters. Can Be Empty." type="text" name="mname" id="mname" value="'.$sName.'"/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeelName" class="control-label col-md-3">Last Name <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="lname" id="lname" value="'.$lName.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="addressNo" class="control-label col-md-3">Address Number <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^([0-9].*[\\/][a-zA-Z0-9]*)|([0-9].*)$" title="Should Be Letters, Numbers, / or \. Cannot Be Empty." type="text" name="addresNo" id="addressNo" value="'.$aNo.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="addressLane" class="control-label col-md-3">Lane/ Street <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="lane" id="lane" value="'.$aLane.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="addressCity" class="control-label col-md-3">City <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="city" id="city" value="'.$aCity.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeeContact" class="control-label col-md-3">Contact Number</label>
											<div class="col-md-8">
												<input class="form-control" pattern="^\d{10}$" title="Should Be A Valid Number With 10 Digits." type="text" name="contact" id="contact" value="'.$contact.'" maxlength="10" />
											</div>
										</div>
										<div class="form-group" style="text-align:center;">
											<label style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
										</div>
										<div class="form-group col-md-11 text-center">
											<input type="submit" value="Update" id="submit" name="submit" class="btn btn-success" onclick="return confirm(\'Do You Wish to Update Details?\');return false;"/>
										</div>
									</form>';
							} else{
								//if no result to show
								echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
							}
						}
					} else if($r == "nic"){
						if($s == "topupAgent"){
							//get employee from NIC
							$getEmp = "SELECT * FROM topup_agent WHERE employee_nic='".$q."'";	
							$resultGetEmp = mysqli_query($con, $getEmp);
							if(mysqli_num_rows($resultGetEmp) != 0){
								while($rowGetEmp = mysqli_fetch_array($resultGetEmp)){
									$eID = $rowGetEmp['topup_agent_id'];
									$regFeeId = $rowGetEmp['topup_agent_regfee_id'];
									$eNic = $rowGetEmp['employee_nic'];
									$sID = $rowGetEmp['topup_agent_status_id'];
									//get employee
									$getEid = "SELECT * FROM employee WHERE nic='".$eNic."'";
									$resultEID = mysqli_query($con, $getEid);
									if(mysqli_num_rows($resultEID) != 0){
										while($rowEid = mysqli_fetch_array($resultEID)){
											$contact = $rowEid['contact_no'];
											$EMail = $rowEid['employee_email'];
											$addressId = $rowEid['address_id'];
											$nameId = $rowEid['name_id'];
										}
									}
									//get status
									$getStatus = "SELECT topup_agent_status FROM topup_agent_status WHERE topup_agent_status_id='".$sID."'";
									$resultGetStatus = mysqli_query($con, $getStatus);
									if(mysqli_num_rows($resultGetStatus) != 0){
										while($rowStatus = mysqli_fetch_array($resultGetStatus)){
											$statusName = $rowStatus['topup_agent_status'];
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
									//get reg fee
									$getFee = "SELECT * FROM topup_agent_regfee";
									$resultFee = mysqli_query($con, $getFee);
									if(mysqli_num_rows($resultFee) != 0){
										while($rowFee = mysqli_fetch_array($resultFee)){
											$feeId = $rowFee['topup_agent_regfee_id'];
											$feeValue = $rowFee['topup_agent_regfee'];
											if($feeId == $regFeeId){
												$hint .= '<option selected value="'.$feeId.'">'.$feeValue.'</option>';	
											} else {
												$hint .= '<option value="'.$feeId.'">'.$feeValue.'</option>';
											}
										}
									} else {
										$hint .= '<option>No Registration Fees Added Yet.</option>';	
									}	
								}
								echo '<form role="form" class="form-horizontal" method="post" action="controller/updateAgentsController.php">
										<div class="form-group">
											<label for="employeeId" class="control-label col-md-3">Employee ID <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^\w+$" title="Should be Numbers Or Letters Only. Should Not Be Empty." type="text" name="eId" id="eId" value="'.$eID.'" required="required" readonly/>
											</div>
										</div>
										 <div class="form-group">
											<label for="employeePosition" class="control-label col-md-3">Registartion Fee <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<select class="form-control" id="regFee" name="regFee">
													<option disabled="disabled">--Select The Registartion Fee--</option>
													'.$hint.'
												</select>
											</div>
										</div>
										<div class="form-group text-center">
											<label class="col-md-11">Personal Information</label> 
										</div>
										<div class="form-group">
											<label for="employeelNIC" class="control-label col-md-3">NIC <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^(\d){9}[v|V]$" title="Should be a valid NIC of 9 digits and \'v\'" type="text" name="nic" id="nic" value="'.$eNic.'" maxlength="10" required="required" readonly/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeelNIC" class="control-label col-md-3">E-Mail <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[0-9a-zA-Z]([-.\w]*[0-9a-zA-Z_+])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9}$" title="Should Be A Valid EMail Address." type="text" name="email" id="email" value="'.$EMail.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeefName" class="control-label col-md-3">First Name <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="fname" id="fname" value="'.$fName.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeemName" class="control-label col-md-3">Middle Name</label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]*$|^$" title="Should Be Letters. Can Be Empty." type="text" name="mname" id="mname" value="'.$sName.'"/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeelName" class="control-label col-md-3">Last Name <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="lname" id="lname" value="'.$lName.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="addressNo" class="control-label col-md-3">Address Number <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^([0-9].*[\\/][a-zA-Z0-9]*)|([0-9].*)$" title="Should Be Letters, Numbers, / or \. Cannot Be Empty." type="text" name="addresNo" id="addressNo" value="'.$aNo.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="addressLane" class="control-label col-md-3">Lane/ Street <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="lane" id="lane" value="'.$aLane.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="addressCity" class="control-label col-md-3">City <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="city" id="city" value="'.$aCity.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeeContact" class="control-label col-md-3">Contact Number</label>
											<div class="col-md-8">
												<input class="form-control" pattern="^\d{10}$" title="Should Be A Valid Number With 10 Digits." type="text" name="contact" id="contact" value="'.$contact.'" maxlength="10" />
											</div>
										</div>
										<div class="form-group" style="text-align:center;">
											<label style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
										</div>
										<div class="form-group col-md-11 text-center">
											<input type="submit" value="Update" id="submit" name="submit" class="btn btn-success" onclick="return confirm(\'Do You Wish to Update Details?\');return false;"/>
										</div>
									</form>';
							} else {
								//if no result to show
								echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
							}
						} else {
							$getUser = "SELECT * FROM staff WHERE employee_nic='".$q."' AND employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='".$s."')";
							$resultGetUser = mysqli_query($con, $getUser);
							if(mysqli_num_rows($resultGetUser) != 0){
								while($rowGetUser = mysqli_fetch_array($resultGetUser)){
									$eID = $rowGetUser['employee_id'];
									$nic = $rowGetUser['employee_nic'];
								}
								//get user
								$getEmployee = "SELECT * FROM employee WHERE nic='".$nic."'";
								$resultEmployee = mysqli_query($con, $getEmployee);
								if(mysqli_num_rows($resultEmployee) != 0){
									while($rowEmployee = mysqli_fetch_array($resultEmployee)){
										$contact = $rowEmployee['contact_no'];
										$address_id = $rowEmployee['address_id'];
										$name_id = $rowEmployee['name_id'];
										$email = $rowEmployee['employee_email'];
									}
								}
								//get name
								$getName = "SELECT * FROM name WHERE name_id='".$name_id."'";
								$resultName = mysqli_query($con, $getName);
								if(mysqli_num_rows($resultName) != 0){
									while($rowName = mysqli_fetch_array($resultName)){
										$fName = $rowName['first_name'];
										$sName = $rowName['second_name'];
										$lName = $rowName['last_name'];
									}
								}
								//get address
								$addressName = "SELECT * FROM address WHERE address_id='".$address_id."'";
								$resultAddress = mysqli_query($con, $addressName);
								if(mysqli_num_rows($resultAddress) != 0){
									while($rowAddress = mysqli_fetch_array($resultAddress)){
										$aNo = $rowAddress['address_no'];
										$aLane = $rowAddress['address_lane'];
										$aCity = $rowAddress['address_city'];
									}
								}
								//get positions
								$hint = '';
								$positions = "SELECT * FROM employee_position";
								$resultPositions = mysqli_query($con, $positions);
								if(mysqli_num_rows($resultPositions) != 0){
									while($rowPositions = mysqli_fetch_array($resultPositions)){
										$ePosition = $rowPositions['position'];
										if($ePosition == $s){
											$hint .= '<option selected>'.$ePosition.'</option>';
										} else {
											$hint .= '<option>'.$ePosition.'</option>';
										};
									}
								}
								echo '<form role="form" class="form-horizontal" method="post" action="controller/updateUsersController.php">
										<div class="form-group">
											<label for="employeeId" class="control-label col-md-3">Employee ID <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^\w+$" title="Should be Numbers Or Letters Only. Should Not Be Empty." type="text" name="eId" id="eId" value="'.$eID.'" required="required" readonly/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeePosition" class="control-label col-md-3">Position <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<select name="position" id="position" class="form-control">
												'.$hint.'
												</select>
											</div>
										</div>
										<div class="form-group text-center">
											<label class="col-md-11">Personal Information</label> 
										</div>
										<div class="form-group">
											<label for="employeelNIC" class="control-label col-md-3">NIC <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^(\d){9}[v|V]$" title="Should be a valid NIC of 9 digits and \'v\'" type="text" name="nic" id="nic" value="'.$nic.'" maxlength="10" required="required" readonly/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeelNIC" class="control-label col-md-3">E-Mail <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[0-9a-zA-Z]([-.\w]*[0-9a-zA-Z_+])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9}$" title="Should Be A Valid EMail Address." type="text" name="email" id="email" value="'.$email.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeefName" class="control-label col-md-3">First Name <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="fname" id="fname" value="'.$fName.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeemName" class="control-label col-md-3">Middle Name</label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]*$|^$" title="Should Be Letters. Can Be Empty." type="text" name="mname" id="mname" value="'.$sName.'"/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeelName" class="control-label col-md-3">Last Name <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="lname" id="lname" value="'.$lName.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="addressNo" class="control-label col-md-3">Address Number <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^([0-9].*[\\/][a-zA-Z0-9]*)|([0-9].*)$" title="Should Be Letters, Numbers, / or \. Cannot Be Empty." type="text" name="addresNo" id="addressNo" value="'.$aNo.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="addressLane" class="control-label col-md-3">Lane/ Street <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="lane" id="lane" value="'.$aLane.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="addressCity" class="control-label col-md-3">City <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="city" id="city" value="'.$aCity.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeeContact" class="control-label col-md-3">Contact Number</label>
											<div class="col-md-8">
												<input class="form-control" pattern="^\d{10}$" title="Should Be A Valid Number With 10 Digits." type="text" name="contact" id="contact" value="'.$contact.'" maxlength="10" />
											</div>
										</div>
										<div class="form-group" style="text-align:center;">
											<label style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
										</div>
										<div class="form-group col-md-11 text-center">
											<input type="submit" value="Update" id="submit" name="submit" class="btn btn-success" onclick="return confirm(\'Do You Wish to Update Details?\');return false;"/>
										</div>
									</form>';
							} else {
								//if no result to show
								echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
							}
						}
					} else if($r == "EMail"){
						if($s == "topupAgent"){
							//get employee from Email
							$getEmp = "SELECT * FROM employee WHERE employee_email='".$q."'";	
							$resultGetEmp = mysqli_query($con, $getEmp);
							if(mysqli_num_rows($resultGetEmp) != 0){
								while($rowGetEmp = mysqli_fetch_array($resultGetEmp)){
									$contact = $rowGetEmp['contact_no'];
									$eNic = $rowGetEmp['nic'];
									$EMail = $rowGetEmp['employee_email'];
									$addressId = $rowGetEmp['address_id'];
									$nameId = $rowGetEmp['name_id'];
									//get employee from position
									$getEid = "SELECT * FROM topup_agent WHERE employee_nic='".$eNic."'";
									$resultEID = mysqli_query($con, $getEid);
									if(mysqli_num_rows($resultEID) != 0){
										while($rowEid = mysqli_fetch_array($resultEID)){
											$eID = $rowEid['topup_agent_id'];
											$regFeeId = $rowEid['topup_agent_regfee_id'];
											$sID = $rowEid['topup_agent_status_id'];
										}
									}
									//get status
									$getStatus = "SELECT topup_agent_status FROM topup_agent_status WHERE topup_agent_status_id='".$sID."'";
									$resultGetStatus = mysqli_query($con, $getStatus);
									if(mysqli_num_rows($resultGetStatus) != 0){
										while($rowStatus = mysqli_fetch_array($resultGetStatus)){
											$statusName = $rowStatus['topup_agent_status'];
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
									//get reg fee
									$getFee = "SELECT * FROM topup_agent_regfee";
									$resultFee = mysqli_query($con, $getFee);
									if(mysqli_num_rows($resultFee) != 0){
										while($rowFee = mysqli_fetch_array($resultFee)){
											$feeId = $rowFee['topup_agent_regfee_id'];
											$feeValue = $rowFee['topup_agent_regfee'];
											if($feeId == $regFeeId){
												$hint .= '<option selected value="'.$feeId.'">'.$feeValue.'</option>';	
											} else {
												$hint .= '<option value="'.$feeId.'">'.$feeValue.'</option>';
											}
										}
									} else {
										$hint .= '<option>No Registration Fees Added Yet.</option>';	
									}	
								}
								echo '<form role="form" class="form-horizontal" method="post" action="controller/updateAgentsController.php">
										<div class="form-group">
											<label for="employeeId" class="control-label col-md-3">Employee ID <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^\w+$" title="Should be Numbers Or Letters Only. Should Not Be Empty." type="text" name="eId" id="eId" value="'.$eID.'" required="required" readonly/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeePosition" class="control-label col-md-3">Registartion Fee <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<select class="form-control" id="regFee" name="regFee">
													<option disabled="disabled">--Select The Registartion Fee--</option>
													'.$hint.'
												</select>
											</div>
										</div>
										<div class="form-group text-center">
											<label class="col-md-11">Personal Information</label> 
										</div>
										<div class="form-group">
											<label for="employeelNIC" class="control-label col-md-3">NIC <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^(\d){9}[v|V]$" title="Should be a valid NIC of 9 digits and \'v\'" type="text" name="nic" id="nic" value="'.$eNic.'" maxlength="10" required="required" readonly/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeelNIC" class="control-label col-md-3">E-Mail <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[0-9a-zA-Z]([-.\w]*[0-9a-zA-Z_+])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9}$" title="Should Be A Valid EMail Address." type="text" name="email" id="email" value="'.$EMail.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeefName" class="control-label col-md-3">First Name <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="fname" id="fname" value="'.$fName.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeemName" class="control-label col-md-3">Middle Name</label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]*$|^$" title="Should Be Letters. Can Be Empty." type="text" name="mname" id="mname" value="'.$sName.'"/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeelName" class="control-label col-md-3">Last Name <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="lname" id="lname" value="'.$lName.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="addressNo" class="control-label col-md-3">Address Number <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^([0-9].*[\\/][a-zA-Z0-9]*)|([0-9].*)$" title="Should Be Letters, Numbers, / or \. Cannot Be Empty." type="text" name="addresNo" id="addressNo" value="'.$aNo.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="addressLane" class="control-label col-md-3">Lane/ Street <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="lane" id="lane" value="'.$aLane.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="addressCity" class="control-label col-md-3">City <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="city" id="city" value="'.$aCity.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeeContact" class="control-label col-md-3">Contact Number</label>
											<div class="col-md-8">
												<input class="form-control" pattern="^\d{10}$" title="Should Be A Valid Number With 10 Digits." type="text" name="contact" id="contact" maxlength="10" value="'.$contact.'" />
											</div>
										</div>
										<div class="form-group" style="text-align:center;">
											<label style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
										</div>
										<div class="form-group col-md-11 text-center">
											<input type="submit" value="Update" id="submit" name="submit" class="btn btn-success" onclick="return confirm(\'Do You Wish to Update Details?\');return false;"/>
										</div>
									</form>';
							} else {
								//if no result to show
								echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
							}
						} else {
							$getUser = "SELECT * FROM staff WHERE employee_nic IN (SELECT nic FROM employee WHERE employee_email='".$q."') AND employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='".$s."')";
							$resultGetUser = mysqli_query($con, $getUser);
							if(mysqli_num_rows($resultGetUser) != 0){
								while($rowGetUser = mysqli_fetch_array($resultGetUser)){
									$eID = $rowGetUser['employee_id'];
									$nic = $rowGetUser['employee_nic'];
								}
								//get user
								$getEmployee = "SELECT * FROM employee WHERE nic='".$nic."'";
								$resultEmployee = mysqli_query($con, $getEmployee);
								if(mysqli_num_rows($resultEmployee) != 0){
									while($rowEmployee = mysqli_fetch_array($resultEmployee)){
										$contact = $rowEmployee['contact_no'];
										$address_id = $rowEmployee['address_id'];
										$name_id = $rowEmployee['name_id'];
										$email = $rowEmployee['employee_email'];
									}
								}
								//get name
								$getName = "SELECT * FROM name WHERE name_id='".$name_id."'";
								$resultName = mysqli_query($con, $getName);
								if(mysqli_num_rows($resultName) != 0){
									while($rowName = mysqli_fetch_array($resultName)){
										$fName = $rowName['first_name'];
										$sName = $rowName['second_name'];
										$lName = $rowName['last_name'];
									}
								}
								//get address
								$addressName = "SELECT * FROM address WHERE address_id='".$address_id."'";
								$resultAddress = mysqli_query($con, $addressName);
								if(mysqli_num_rows($resultAddress) != 0){
									while($rowAddress = mysqli_fetch_array($resultAddress)){
										$aNo = $rowAddress['address_no'];
										$aLane = $rowAddress['address_lane'];
										$aCity = $rowAddress['address_city'];
									}
								}
								//get positions
								$hint = '';
								$positions = "SELECT * FROM employee_position";
								$resultPositions = mysqli_query($con, $positions);
								if(mysqli_num_rows($resultPositions) != 0){
									while($rowPositions = mysqli_fetch_array($resultPositions)){
										$ePosition = $rowPositions['position'];
										if($ePosition == $s){
											$hint .= '<option selected>'.$ePosition.'</option>';
										} else {
											$hint .= '<option>'.$ePosition.'</option>';
										};
									}
								}
								echo '<form role="form" class="form-horizontal" method="post" action="controller/updateUsersController.php">
										<div class="form-group">
											<label for="employeeId" class="control-label col-md-3">Employee ID <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^\w+$" title="Should be Numbers Or Letters Only. Should Not Be Empty." type="text" name="eId" id="eId" value="'.$eID.'" required="required" readonly/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeePosition" class="control-label col-md-3">Position <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<select name="position" id="position" class="form-control">
												'.$hint.'
												</select>
											</div>
										</div>
										<div class="form-group text-center">
											<label class="col-md-11">Personal Information</label> 
										</div>
										<div class="form-group">
											<label for="employeelNIC" class="control-label col-md-3">NIC <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^(\d){9}[v|V]$" title="Should be a valid NIC of 9 digits and \'v\'" type="text" name="nic" id="nic" value="'.$nic.'" maxlength="10" required="required" readonly/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeelNIC" class="control-label col-md-3">E-Mail <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[0-9a-zA-Z]([-.\w]*[0-9a-zA-Z_+])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9}$" title="Should Be A Valid EMail Address." type="text" name="email" id="email" value="'.$email.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeefName" class="control-label col-md-3">First Name <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="fname" id="fname" value="'.$fName.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeemName" class="control-label col-md-3">Middle Name</label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]*$|^$" title="Should Be Letters. Can Be Empty." type="text" name="mname" id="mname" value="'.$sName.'"/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeelName" class="control-label col-md-3">Last Name <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="lname" id="lname" value="'.$lName.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="addressNo" class="control-label col-md-3">Address Number <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^([0-9].*[\\/][a-zA-Z0-9]*)|([0-9].*)$" title="Should Be Letters, Numbers, / or \. Cannot Be Empty." type="text" name="addresNo" id="addressNo" value="'.$aNo.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="addressLane" class="control-label col-md-3">Lane/ Street <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="lane" id="lane" value="'.$aLane.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="addressCity" class="control-label col-md-3">City <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="city" id="city" value="'.$aCity.'" required="required"/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeeContact" class="control-label col-md-3">Contact Number</label>
											<div class="col-md-8">
												<input class="form-control" pattern="^\d{10}$" title="Should Be A Valid Number With 10 Digits." type="text" name="contact" id="contact" maxlength="10" value="'.$contact.'" />
											</div>
										</div>
										<div class="form-group" style="text-align:center;">
											<label style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
										</div>
										<div class="form-group col-md-11 text-center">
											<input type="submit" value="Update" id="submit" name="submit" class="btn btn-success" onclick="return confirm(\'Do You Wish to Update Details?\');return false;"/>
										</div>
									</form>';
							} else {
								//if no result to show
								echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
							}
						}
					}
				} else {
					//no value entered for search
					echo '<h3 class="text-center" style="padding:50px;">Please Enter A Value To Search.</h3>';
				}
			} else if($p == "delete") {
				if($q != ""){
					if($r == "EID"){
						//get employee by EID
						$getUser = "SELECT * FROM employee WHERE nic IN (SELECT employee_nic FROM staff WHERE employee_id='".$q."' AND employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='".$s."'))";
						$resultGetUser = mysqli_query($con, $getUser);
						if(mysqli_num_rows($resultGetUser) != 0){
							while($rowGetUser = mysqli_fetch_array($resultGetUser)){
								$contact = $rowGetUser['contact_no'];
								$nic = $rowGetUser['nic'];
								$address_id = $rowGetUser['address_id'];
								$name_id = $rowGetUser['name_id'];
								$email = $rowGetUser['employee_email'];
							}
							//get name
							$getName = "SELECT * FROM name WHERE name_id='".$name_id."'";
							$resultName = mysqli_query($con, $getName);
							if(mysqli_num_rows($resultName) != 0){
								while($rowName = mysqli_fetch_array($resultName)){
									$fName = $rowName['first_name'];
									$sName = $rowName['second_name'];
									$lName = $rowName['last_name'];
								}
							}
							//get address
							$addressName = "SELECT * FROM address WHERE address_id='".$address_id."'";
							$resultAddress = mysqli_query($con, $addressName);
							if(mysqli_num_rows($resultAddress) != 0){
								while($rowAddress = mysqli_fetch_array($resultAddress)){
									$aNo = $rowAddress['address_no'];
									$aLane = $rowAddress['address_lane'];
									$aCity = $rowAddress['address_city'];
								}
							}
							echo '<form role="form" class="form-horizontal" method="post" action="controller/deleteUsersController.php">
									<div class="form-group">
										<label for="employeeId" class="control-label col-md-3">Employee ID <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" pattern="^\w+$" title="Should be Numbers Or Letters Only. Should Not Be Empty." type="text" name="eId" id="eId" value="'.$q.'" required="required" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="employeePosition" class="control-label col-md-3">Position <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" name="position" id="position" value="'.$s.'"" readonly/>
										</div>
									</div>
									<div class="form-group text-center">
										<label class="col-md-11">Personal Information</label> 
									</div>
									<div class="form-group">
										<label for="employeelNIC" class="control-label col-md-3">NIC <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" pattern="^(\d){9}[v|V]$" title="Should be a valid NIC of 9 digits and \'v\'" type="text" name="nic" id="nic" value="'.$nic.'" required="required" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="employeelNIC" class="control-label col-md-3">E-Mail <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" pattern="^[0-9a-zA-Z]([-.\w]*[0-9a-zA-Z_+])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9}$" title="Should Be A Valid EMail Address." type="text" name="email" id="email" value="'.$email.'" required="required" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="employeefName" class="control-label col-md-3">First Name <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="fname" id="fname" value="'.$fName.'" required="required" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="employeemName" class="control-label col-md-3">Middle Name</label>
										<div class="col-md-8">
											<input class="form-control" pattern="^[a-zA-Z]*$|^$" title="Should Be Letters. Can Be Empty." type="text" name="mname" id="mname" value="'.$sName.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="employeelName" class="control-label col-md-3">Last Name <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="lname" id="lname" value="'.$lName.'" required="required" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="addressNo" class="control-label col-md-3">Address Number <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" pattern="^([0-9].*[\\/][a-zA-Z0-9]*)|([0-9].*)$" title="Should Be Letters, Numbers, / or \. Cannot Be Empty." type="text" name="addresNo" id="addressNo" value="'.$aNo.'" required="required" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="addressLane" class="control-label col-md-3">Lane/ Street <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="lane" id="lane" value="'.$aLane.'" required="required" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="addressCity" class="control-label col-md-3">City <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="city" id="city" value="'.$aCity.'" required="required" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="employeeContact" class="control-label col-md-3">Contact Number</label>
										<div class="col-md-8">
											<input class="form-control" pattern="^\d{10}$" title="Should Be A Valid Number With 10 Digits." type="text" name="contact" id="contact" value="'.$contact.'" readonly />
										</div>
									</div>
									<div class="form-group" style="text-align:center;">
										<label style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
									</div>
									<div class="form-group col-md-11 text-center">
										<input type="submit" value="Delete" id="submit" name="submit" class="btn btn-danger" onclick="return confirm(\'Do You Wish to Delete User?\');return false;"/>
									</div>
								</form>';
						} else{
							//if no result to show
							echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
						}
					} else if($r == "nic"){
						$getUser = "SELECT * FROM staff WHERE employee_nic='".$q."' AND employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='".$s."')";
						$resultGetUser = mysqli_query($con, $getUser);
						if(mysqli_num_rows($resultGetUser) != 0){
							while($rowGetUser = mysqli_fetch_array($resultGetUser)){
								$eID = $rowGetUser['employee_id'];
								$nic = $rowGetUser['employee_nic'];
							}
							//get user
							$getEmployee = "SELECT * FROM employee WHERE nic='".$nic."'";
							$resultEmployee = mysqli_query($con, $getEmployee);
							if(mysqli_num_rows($resultEmployee) != 0){
								while($rowEmployee = mysqli_fetch_array($resultEmployee)){
									$contact = $rowEmployee['contact_no'];
									$address_id = $rowEmployee['address_id'];
									$name_id = $rowEmployee['name_id'];
									$email = $rowEmployee['employee_email'];
								}
							}
							//get name
							$getName = "SELECT * FROM name WHERE name_id='".$name_id."'";
							$resultName = mysqli_query($con, $getName);
							if(mysqli_num_rows($resultName) != 0){
								while($rowName = mysqli_fetch_array($resultName)){
									$fName = $rowName['first_name'];
									$sName = $rowName['second_name'];
									$lName = $rowName['last_name'];
								}
							}
							//get address
							$addressName = "SELECT * FROM address WHERE address_id='".$address_id."'";
							$resultAddress = mysqli_query($con, $addressName);
							if(mysqli_num_rows($resultAddress) != 0){
								while($rowAddress = mysqli_fetch_array($resultAddress)){
									$aNo = $rowAddress['address_no'];
									$aLane = $rowAddress['address_lane'];
									$aCity = $rowAddress['address_city'];
								}
							}
							echo '<form role="form" class="form-horizontal" method="post" action="controller/deleteUsersController.php">
									<div class="form-group">
										<label for="employeeId" class="control-label col-md-3">Employee ID <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" pattern="^\w+$" title="Should be Numbers Or Letters Only. Should Not Be Empty." type="text" name="eId" id="eId" value="'.$eID.'" required="required" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="employeePosition" class="control-label col-md-3">Position <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" name="position" id="position" value="'.$s.'"" readonly/>
										</div>
									</div>
									<div class="form-group text-center">
										<label class="col-md-11">Personal Information</label> 
									</div>
									<div class="form-group">
										<label for="employeelNIC" class="control-label col-md-3">NIC <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" pattern="^(\d){9}[v|V]$" title="Should be a valid NIC of 9 digits and \'v\'" type="text" name="nic" id="nic" value="'.$nic.'" required="required" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="employeelNIC" class="control-label col-md-3">E-Mail <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" pattern="^[0-9a-zA-Z]([-.\w]*[0-9a-zA-Z_+])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9}$" title="Should Be A Valid EMail Address." type="text" name="email" id="email" value="'.$email.'" required="required" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="employeefName" class="control-label col-md-3">First Name <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="fname" id="fname" value="'.$fName.'" required="required" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="employeemName" class="control-label col-md-3">Middle Name</label>
										<div class="col-md-8">
											<input class="form-control" pattern="^[a-zA-Z]*$|^$" title="Should Be Letters. Can Be Empty." type="text" name="mname" id="mname" value="'.$sName.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="employeelName" class="control-label col-md-3">Last Name <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="lname" id="lname" value="'.$lName.'" required="required" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="addressNo" class="control-label col-md-3">Address Number <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" pattern="^([0-9].*[\\/][a-zA-Z0-9]*)|([0-9].*)$" title="Should Be Letters, Numbers, / or \. Cannot Be Empty." type="text" name="addresNo" id="addressNo" value="'.$aNo.'" required="required" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="addressLane" class="control-label col-md-3">Lane/ Street <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="lane" id="lane" value="'.$aLane.'" required="required" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="addressCity" class="control-label col-md-3">City <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="city" id="city" value="'.$aCity.'" required="required" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="employeeContact" class="control-label col-md-3">Contact Number</label>
										<div class="col-md-8">
											<input class="form-control" pattern="^\d{10}$" title="Should Be A Valid Number With 10 Digits." type="text" name="contact" id="contact" value="'.$contact.'" readonly/>
										</div>
									</div>
									<div class="form-group" style="text-align:center;">
										<label style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
									</div>
									<div class="form-group col-md-11 text-center">
										<input type="submit" value="Delete" id="submit" name="submit" class="btn btn-danger" onclick="return confirm(\'Do You Wish to Delete User?\');return false;"/>
									</div>
								</form>';
						} else {
							//if no result to show
							echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
						}
					} else if($r == "EMail"){
						$getUser = "SELECT * FROM staff WHERE employee_nic IN (SELECT nic FROM employee WHERE employee_email='".$q."') AND employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='".$s."')";
						$resultGetUser = mysqli_query($con, $getUser);
						if(mysqli_num_rows($resultGetUser) != 0){
							while($rowGetUser = mysqli_fetch_array($resultGetUser)){
								$eID = $rowGetUser['employee_id'];
								$nic = $rowGetUser['employee_nic'];
							}
							//get user
							$getEmployee = "SELECT * FROM employee WHERE nic='".$nic."'";
							$resultEmployee = mysqli_query($con, $getEmployee);
							if(mysqli_num_rows($resultEmployee) != 0){
								while($rowEmployee = mysqli_fetch_array($resultEmployee)){
									$contact = $rowEmployee['contact_no'];
									$address_id = $rowEmployee['address_id'];
									$name_id = $rowEmployee['name_id'];
									$email = $rowEmployee['employee_email'];
								}
							}
							//get name
							$getName = "SELECT * FROM name WHERE name_id='".$name_id."'";
							$resultName = mysqli_query($con, $getName);
							if(mysqli_num_rows($resultName) != 0){
								while($rowName = mysqli_fetch_array($resultName)){
									$fName = $rowName['first_name'];
									$sName = $rowName['second_name'];
									$lName = $rowName['last_name'];
								}
							}
							//get address
							$addressName = "SELECT * FROM address WHERE address_id='".$address_id."'";
							$resultAddress = mysqli_query($con, $addressName);
							if(mysqli_num_rows($resultAddress) != 0){
								while($rowAddress = mysqli_fetch_array($resultAddress)){
									$aNo = $rowAddress['address_no'];
									$aLane = $rowAddress['address_lane'];
									$aCity = $rowAddress['address_city'];
								}
							}
							echo '<form role="form" class="form-horizontal" method="post" action="controller/deleteUsersController.php">
									<div class="form-group">
										<label for="employeeId" class="control-label col-md-3">Employee ID <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" pattern="^\w+$" title="Should be Numbers Or Letters Only. Should Not Be Empty." type="text" name="eId" id="eId" value="'.$eID.'" required="required" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="employeePosition" class="control-label col-md-3">Position <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" name="position" id="position" value="'.$s.'"" readonly/>
										</div>
									</div>
									<div class="form-group text-center">
										<label class="col-md-11">Personal Information</label> 
									</div>
									<div class="form-group">
										<label for="employeelNIC" class="control-label col-md-3">NIC <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" pattern="^(\d){9}[v|V]$" title="Should be a valid NIC of 9 digits and \'v\'" type="text" name="nic" id="nic" value="'.$nic.'" required="required" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="employeelNIC" class="control-label col-md-3">E-Mail <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" pattern="^[0-9a-zA-Z]([-.\w]*[0-9a-zA-Z_+])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9}$" title="Should Be A Valid EMail Address." type="text" name="email" id="email" value="'.$email.'" required="required" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="employeefName" class="control-label col-md-3">First Name <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="fname" id="fname" value="'.$fName.'" required="required" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="employeemName" class="control-label col-md-3">Middle Name</label>
										<div class="col-md-8">
											<input class="form-control" pattern="^[a-zA-Z]*$|^$" title="Should Be Letters. Can Be Empty." type="text" name="mname" id="mname" value="'.$sName.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="employeelName" class="control-label col-md-3">Last Name <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="lname" id="lname" value="'.$lName.'" required="required" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="addressNo" class="control-label col-md-3">Address Number <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" pattern="^([0-9].*[\\/][a-zA-Z0-9]*)|([0-9].*)$" title="Should Be Letters, Numbers, / or \. Cannot Be Empty." type="text" name="addresNo" id="addressNo" value="'.$aNo.'" required="required" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="addressLane" class="control-label col-md-3">Lane/ Street <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="lane" id="lane" value="'.$aLane.'" required="required" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="addressCity" class="control-label col-md-3">City <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" pattern="^[a-zA-Z]+$" title="Should Be Letters. Cannot Be Empty." type="text" name="city" id="city" value="'.$aCity.'" required="required" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="employeeContact" class="control-label col-md-3">Contact Number</label>
										<div class="col-md-8">
											<input class="form-control" pattern="^\d{10}$" title="Should Be A Valid Number With 10 Digits." type="text" name="contact" id="contact" value="'.$contact.'" readonly/>
										</div>
									</div>
									<div class="form-group" style="text-align:center;">
										<label style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
									</div>
									<div class="form-group col-md-11 text-center">
										<input type="submit" value="Delete" id="submit" name="submit" class="btn btn-danger" onclick="return confirm(\'Do You Wish to Delete User?\');return false;"/>
									</div>
								</form>';
						} else {
							//if no result to show
							echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
						}
					}
				} else {
					//no value entered for search
					echo '<h3 class="text-center" style="padding:50px;">Please Enter A Value To Search.</h3>';
				}
			} else {
				//404, not view, update or delete
				header('Location:../404.php');
			}
		} else {
			//404, no operation
			header('Location:../404.php');
		}
	} else {
		//404, no html ID
		header('Location:../404.php');
	}
} else {
	//404, no position
	header('Location:../404.php');
}
?>
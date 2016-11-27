<?php
include_once('../ssi/links.html');
include_once('../ssi/db.php');
include_once("../ssi/smsSettings.php");
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
if($p != "" && $r != ""){
	if($p == "view"){
		if($q != ""){
			if($r == "CardNo"){
				$getCommuter = "SELECT * FROM commuter WHERE card_card_no LIKE '".$q."%'";
				$resultCommuter = mysqli_query($con, $getCommuter);
				if(mysqli_num_rows($resultCommuter) != 0){
					echo '<div class="form-group">
									<div class="container-fluid center-block">
										<table style="width:100%;" class="table table-striped">
										  <tr>
											<th>Card No</th>
											<th>NIC</th>
											<th>Full Name</th>
											<th>Address</th>
											<th>Contact No</th>
											<th>Status</th>
										  </tr>';
					while($rowCommuter = mysqli_fetch_array($resultCommuter)){
						$cardNo = $rowCommuter['card_card_no'];
						$nic = $rowCommuter['nic'];
						$nameId = $rowCommuter['name_name_id'];
						$addressId = $rowCommuter['address_address_id'];
						$contactNo = $rowCommuter['contact_no'];
						if($rowCommuter['status'] == 1){
							$status = "Active";	
						} else {
							$status = "Disabled";
						}
						$getName = "SELECT * FROM NAME WHERE name_id='".$nameId."'";
						$resultName = mysqli_query($con, $getName);
						if(mysqli_num_rows($resultName) != 0){
							while($rowName = mysqli_fetch_array($resultName)){
								$fName = $rowName['first_name'];
								$sName = $rowName['second_name'];
								$lName = $rowName['last_name'];
							}
						} else {
							//if no result to show
							echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
						}
						$getAddress = "SELECT * FROM address WHERE address_id='".$addressId."'";
						$resultAddress = mysqli_query($con, $getAddress);
						if(mysqli_num_rows($resultAddress) != 0){
							while($rowName = mysqli_fetch_array($resultAddress)){
								$aNo = $rowName['address_no'];
								$aLane = $rowName['address_lane'];
								$aCity = $rowName['address_city'];
							}
						} else {
							//if no result to show
							echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
						}
						echo '<tr>
								<td>'.$cardNo.'</td>
								<td>'.$nic.'</td>
								<td>'.$fName." ".$sName." ".$lName.'</td>
								<td>'.$aNo.", ".$aLane.", ".$aCity.'</td>
								<td>'.$contactNo.'</td>
								<td>'.$status.'</td>
							  </tr>';
					}
					echo '</table>
									</div>
								</div>';
				} else {
					//if no result to show
					echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
				}
			} else if($r == "nic"){
				$getCommuter = "SELECT * FROM commuter WHERE nic LIKE '".$q."%'";
				$resultCommuter = mysqli_query($con, $getCommuter);
				if(mysqli_num_rows($resultCommuter) != 0){
					echo '<div class="form-group">
									<div class="container-fluid center-block">
										<table style="width:100%;" class="table table-striped">
										  <tr>
											<th>Card No</th>
											<th>NIC</th>
											<th>Full Name</th>
											<th>Address</th>
											<th>Contact No</th>
											<th>Status</th>
										  </tr>';
					while($rowCommuter = mysqli_fetch_array($resultCommuter)){
						$cardNo = $rowCommuter['card_card_no'];
						$nic = $rowCommuter['nic'];
						$nameId = $rowCommuter['name_name_id'];
						$addressId = $rowCommuter['address_address_id'];
						$contactNo = $rowCommuter['contact_no'];
						if($rowCommuter['status'] == 1){
							$status = "Active";	
						} else {
							$status = "Disabled";
						}
						$getName = "SELECT * FROM NAME WHERE name_id='".$nameId."'";
						$resultName = mysqli_query($con, $getName);
						if(mysqli_num_rows($resultName) != 0){
							while($rowName = mysqli_fetch_array($resultName)){
								$fName = $rowName['first_name'];
								$sName = $rowName['second_name'];
								$lName = $rowName['last_name'];
							}
						} else {
							//if no result to show
							echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
						}
						$getAddress = "SELECT * FROM address WHERE address_id='".$addressId."'";
						$resultAddress = mysqli_query($con, $getAddress);
						if(mysqli_num_rows($resultAddress) != 0){
							while($rowName = mysqli_fetch_array($resultAddress)){
								$aNo = $rowName['address_no'];
								$aLane = $rowName['address_lane'];
								$aCity = $rowName['address_city'];
							}
						} else {
							//if no result to show
							echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
						}
						echo '<tr>
								<td>'.$cardNo.'</td>
								<td>'.$nic.'</td>
								<td>'.$fName." ".$sName." ".$lName.'</td>
								<td>'.$aNo.", ".$aLane.", ".$aCity.'</td>
								<td>'.$contactNo.'</td>
								<td>'.$status.'</td>
							  </tr>';
					}
					echo '</table>
									</div>
								</div>';
				} else {
					//if no result to show
					echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
				}
			} else {
				//wrong html id
				header('Location:../404.php');
			}
		} else {
			//no value entered for search
			echo '<h3 class="text-center" style="padding:50px;">Please Enter A Value To Search.</h3>';
		}
	} else if($p == "update"){
		if($q != ""){
			if($r == "CardNo"){
				$getCommuter = "SELECT * FROM commuter WHERE card_card_no='".$q."'";
				$resultCommuter = mysqli_query($con, $getCommuter);
				if(mysqli_num_rows($resultCommuter) != 0){
					while($rowCommuter = mysqli_fetch_array($resultCommuter)){
						$cardNo = $rowCommuter['card_card_no'];
						$nic = $rowCommuter['nic'];
						$nameId = $rowCommuter['name_name_id'];
						$addressId = $rowCommuter['address_address_id'];
						$contactNo = $rowCommuter['contact_no'];
						if($rowCommuter['status'] == 1){
							$status = "Active";	
						} else {
							$status = "Disabled";
						}
						$getName = "SELECT * FROM NAME WHERE name_id='".$nameId."'";
						$resultName = mysqli_query($con, $getName);
						if(mysqli_num_rows($resultName) != 0){
							while($rowName = mysqli_fetch_array($resultName)){
								$fName = $rowName['first_name'];
								$sName = $rowName['second_name'];
								$lName = $rowName['last_name'];
							}
						}
						$getAddress = "SELECT * FROM address WHERE address_id='".$addressId."'";
						$resultAddress = mysqli_query($con, $getAddress);
						if(mysqli_num_rows($resultAddress) != 0){
							while($rowName = mysqli_fetch_array($resultAddress)){
								$aNo = $rowName['address_no'];
								$aLane = $rowName['address_lane'];
								$aCity = $rowName['address_city'];
							}
						}
						echo '<form role="form" class="form-horizontal" method="post" action="controller/updateCommuterController.php">
								<div class="form-group text-center">
									<label class="col-md-11">S.C.A.T. Card Information</label> 
								</div>
								<div class="form-group">
									<label for="CardNumber" class="control-label col-md-3">Card Number <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="CardNumber" id="CardNumber" value="'.$cardNo.'" readonly/>
									</div>
								</div>
								<div class="form-group">
									<label for="status" class="control-label col-md-3">Status <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="status" id="status" value="'.$status.'" readonly/>
									</div>
								</div>
								<div class="form-group text-center">
									<label class="col-md-11">Personal Information</label> 
								</div>
								<div class="form-group">
									<label for="employeelNIC" class="control-label col-md-3">NIC <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="nic" id="nic" value="'.$nic.'" readonly/>
									</div>
								</div>
								<div class="form-group">
									<label for="employeefName" class="control-label col-md-3">First Name <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="fname" id="fname" value="'.$fName.'"/>
									</div>
								</div>
								<div class="form-group">
									<label for="employeemName" class="control-label col-md-3">Middle Name</label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="mname" id="mname" value="'.$sName.'"/>
									</div>
								</div>
								<div class="form-group">
									<label for="employeelName" class="control-label col-md-3">Last Name <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="lname" id="lname" value="'.$lName.'"/>
									</div>
								</div>
								<div class="form-group">
									<label for="addressNo" class="control-label col-md-3">Address Number <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="addresNo" id="addressNo" value="'.$aNo.'"/>
									</div>
								</div>
								<div class="form-group">
									<label for="addressLane" class="control-label col-md-3">Lane/ Street <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="lane" id="lane" value="'.$aLane.'"/>
									</div>
								</div>
								<div class="form-group">
									<label for="addressCity" class="control-label col-md-3">City <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="city" id="city" value="'.$aCity.'"/>
									</div>
								</div>
								<div class="form-group">
									<label for="employeeContact" class="control-label col-md-3">Contact Number</label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="contact" id="contact" value="'.$contactNo.'"/>
									</div>
								</div>
								<div class="form-group" style="text-align:center;">
										<label for="employeeContact" style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
								</div>
								<div class="form-group col-md-11 text-center">
									<input type="submit" name="submit" id="submit" value="Update" class="btn btn-success" onclick="return confirm(\'Do You Wish to Update Commuter?\');return false;"/>
								</div>
							</form>';
					}
				} else {
					//if no result to show
					echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
				}
			}  else if($r == "nic"){
				$getCommuter = "SELECT * FROM commuter WHERE nic='".$q."'";
				$resultCommuter = mysqli_query($con, $getCommuter);
				if(mysqli_num_rows($resultCommuter) != 0){
					while($rowCommuter = mysqli_fetch_array($resultCommuter)){
						$cardNo = $rowCommuter['card_card_no'];
						$nic = $rowCommuter['nic'];
						$nameId = $rowCommuter['name_name_id'];
						$addressId = $rowCommuter['address_address_id'];
						$contactNo = $rowCommuter['contact_no'];
						if($rowCommuter['status'] == 1){
							$status = "Active";	
						} else {
							$status = "Disabled";
						}
						$getName = "SELECT * FROM NAME WHERE name_id='".$nameId."'";
						$resultName = mysqli_query($con, $getName);
						if(mysqli_num_rows($resultName) != 0){
							while($rowName = mysqli_fetch_array($resultName)){
								$fName = $rowName['first_name'];
								$sName = $rowName['second_name'];
								$lName = $rowName['last_name'];
							}
						}
						$getAddress = "SELECT * FROM address WHERE address_id='".$addressId."'";
						$resultAddress = mysqli_query($con, $getAddress);
						if(mysqli_num_rows($resultAddress) != 0){
							while($rowName = mysqli_fetch_array($resultAddress)){
								$aNo = $rowName['address_no'];
								$aLane = $rowName['address_lane'];
								$aCity = $rowName['address_city'];
							}
						}
						echo '<form role="form" class="form-horizontal" method="post" action="controller/updateCommuterController.php">
								<div class="form-group text-center">
									<label class="col-md-11">S.C.A.T. Card Information</label> 
								</div>
								<div class="form-group">
									<label for="CardNumber" class="control-label col-md-3">Card Number <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="CardNumber" id="CardNumber" value="'.$cardNo.'" readonly/>
									</div>
								</div>
								<div class="form-group">
									<label for="status" class="control-label col-md-3">Status <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="status" id="status" value="'.$status.'" readonly/>
									</div>
								</div>
								<div class="form-group text-center">
									<label class="col-md-11">Personal Information</label> 
								</div>
								<div class="form-group">
									<label for="employeelNIC" class="control-label col-md-3">NIC <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="nic" id="nic" value="'.$nic.'" readonly/>
									</div>
								</div>
								<div class="form-group">
									<label for="employeefName" class="control-label col-md-3">First Name <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="fname" id="fname" value="'.$fName.'"/>
									</div>
								</div>
								<div class="form-group">
									<label for="employeemName" class="control-label col-md-3">Middle Name</label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="mname" id="mname" value="'.$sName.'"/>
									</div>
								</div>
								<div class="form-group">
									<label for="employeelName" class="control-label col-md-3">Last Name <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="lname" id="lname" value="'.$lName.'"/>
									</div>
								</div>
								<div class="form-group">
									<label for="addressNo" class="control-label col-md-3">Address Number <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="addresNo" id="addressNo" value="'.$aNo.'"/>
									</div>
								</div>
								<div class="form-group">
									<label for="addressLane" class="control-label col-md-3">Lane/ Street <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="lane" id="lane" value="'.$aLane.'"/>
									</div>
								</div>
								<div class="form-group">
									<label for="addressCity" class="control-label col-md-3">City <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="city" id="city" value="'.$aCity.'"/>
									</div>
								</div>
								<div class="form-group">
									<label for="employeeContact" class="control-label col-md-3">Contact Number</label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="contact" id="contact" value="'.$contactNo.'"/>
									</div>
								</div>
								<div class="form-group" style="text-align:center;">
										<label for="employeeContact" style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
								</div>
								<div class="form-group col-md-11 text-center">
									<input type="submit" name="submit" id="submit" value="Update" class="btn btn-success" onclick="return confirm(\'Do You Wish to Update Commuter?\');return false;"/>
								</div>
							</form>';
					}
				} else {
					//if no result to show
					echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
				}
			} else {
				//wrong html id
				header('Location:../404.php');
			} 
		}  else {
			//no value entered for search
			echo '<h3 class="text-center" style="padding:50px;">Please Enter A Value To Search.</h3>';
		}
	} else if($p == "topup"){
		if($q != ""){
			if($r == "CardNo"){
				if(preg_match('/^\d{16}$/',$q)){
					$getCommuter = "SELECT * FROM commuter WHERE card_card_no='".$q."'";
					$resultCommuter = mysqli_query($con, $getCommuter);
					if(mysqli_num_rows($resultCommuter) != 0){
						while($rowCommuter = mysqli_fetch_array($resultCommuter)){
							$cardNo = $rowCommuter['card_card_no'];
							$nic = $rowCommuter['nic'];
							$nameId = $rowCommuter['name_name_id'];
							$contactNo = $rowCommuter['contact_no'];
						}
						$getName = "SELECT * FROM NAME WHERE name_id='".$nameId."'";
						$resultName = mysqli_query($con, $getName);
						if(mysqli_num_rows($resultName) != 0){
							while($rowName = mysqli_fetch_array($resultName)){
								$fName = $rowName['first_name'];
								$sName = $rowName['second_name'];
								$lName = $rowName['last_name'];
							}
							echo '<form role="form" class="form-horizontal" method="post" action="controller/topupController.php">
									<div class="form-group">
										<label for="CardNumber" class="control-label col-md-3">Card Number</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="CardNumber" value="'.$cardNo.'" id="CardNumber" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="employeelNIC" class="control-label col-md-3">NIC</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="nic" id="nic" value="'.$nic.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="fName" class="control-label col-md-3">Full Name</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="name" id="name" value="'.$fName.' '.$sName.' '.$lName.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="contact" class="control-label col-md-3">Contact Number</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="contact" id="contact" value="'.$contactNo.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="amount" class="control-label col-md-3">Amount <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="amount" id="amount" required pattern="^\d+\.\d{2}$" title="Should Be The Format Of 100.00" required/>
										</div>
									</div>
									<div class="form-group" style="text-align:center;">
										<label for="employeeContact" style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
									</div>
									<div class="form-group col-md-11 text-center">
										<input type="submit" value="Top-Up" name="submit" id="submit" class="btn btn-success" onclick="return confirm(\'Do You Wish to Top-Up Card?\');return false;"/>
									</div>
								</form>';
						} else {
							//if no result to show
							echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
						}
					} else {
						//if no result to show
						echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
					}
				} else {
					echo '<h3 class="text-center" style="padding:50px;">Wrong Card Number Format.</h3>';
				}
			} else if($r == "nic"){
				if(preg_match('/^(\d){9}[v|V]$/',$q)){
					$getCommuter = "SELECT * FROM commuter WHERE nic='".$q."'";
					$resultCommuter = mysqli_query($con, $getCommuter);
					if(mysqli_num_rows($resultCommuter) != 0){
						while($rowCommuter = mysqli_fetch_array($resultCommuter)){
							$cardNo = $rowCommuter['card_card_no'];
							$nic = $rowCommuter['nic'];
							$nameId = $rowCommuter['name_name_id'];
							$contactNo = $rowCommuter['contact_no'];
						}
						$getName = "SELECT * FROM NAME WHERE name_id='".$nameId."'";
						$resultName = mysqli_query($con, $getName);
						if(mysqli_num_rows($resultName) != 0){
							while($rowName = mysqli_fetch_array($resultName)){
								$fName = $rowName['first_name'];
								$sName = $rowName['second_name'];
								$lName = $rowName['last_name'];
							}
							echo '<form role="form" class="form-horizontal" method="post" action="controller/topupController.php">
									<div class="form-group">
										<label for="CardNumber" class="control-label col-md-3">Card Number</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="CardNumber" value="'.$cardNo.'" id="CardNumber" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="employeelNIC" class="control-label col-md-3">NIC</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="nic" id="nic" value="'.$nic.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="fName" class="control-label col-md-3">Full Name</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="name" id="name" value="'.$fName.' '.$sName.' '.$lName.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="contact" class="control-label col-md-3">Contact Number</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="contact" id="contact" value="'.$contactNo.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="amount" class="control-label col-md-3">Amount <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="amount" id="amount" required pattern="^\d+\.\d{2}$" title="Should Be The Format Of 100.00" required/>
										</div>
									</div>
									<div class="form-group" style="text-align:center;">
										<label for="employeeContact" style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
									</div>
									<div class="form-group col-md-11 text-center">
										<input type="submit" value="Top-Up" name="submit" id="submit" class="btn btn-success" onclick="return confirm(\'Do You Wish to Top-Up Card?\');return false;"/>
									</div>
								</form>';
						} else {
							//if no result to show
							echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
						}
					} else {
						//if no result to show
						echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
					}
				} else {
					echo '<h3 class="text-center" style="padding:50px;">Wrong NIC Format.</h3>';
				}
			} else {
				//wrong html id
				header('Location:../404.php');
			}
		} else {
			//no value entered for search
			echo '<h3 class="text-center" style="padding:50px;">Please Enter A Value To Search.</h3>';
		}
	} else if($p == "transfer"){
		if($r == "CardNo"){
				if(preg_match('/^\d{16}$/',$q)){
					$getCommuter = "SELECT * FROM commuter WHERE card_card_no='".$q."'";
					$resultCommuter = mysqli_query($con, $getCommuter);
					if(mysqli_num_rows($resultCommuter) != 0){
						while($rowCommuter = mysqli_fetch_array($resultCommuter)){
							$cardNo = $rowCommuter['card_card_no'];
							$nic = $rowCommuter['nic'];
							$nameId = $rowCommuter['name_name_id'];
							$contactNo = $rowCommuter['contact_no'];
							$balance = $rowCommuter['credit'];
						}
						$getName = "SELECT * FROM NAME WHERE name_id='".$nameId."'";
						$resultName = mysqli_query($con, $getName);
						if(mysqli_num_rows($resultName) != 0){
							while($rowName = mysqli_fetch_array($resultName)){
								$fName = $rowName['first_name'];
								$sName = $rowName['second_name'];
								$lName = $rowName['last_name'];
							}
							//send sms with random pin
							$rand = rand(1000,9999);
							if(!empty($contactNo)){
								$newContact = "94". trim($contactNo,"0");
								$DestinationAddress = $newContact;
$Message = "Please enter the below PIN to proceed with credit transfer.

PIN : ".$rand."

Thank You!
-SCAT System-";
								try
								{
									// Send SMS through the HTTP API
									$Result = $ViaNettSMS->SendSMS($MsgSender, $DestinationAddress, $Message);
									// Check result object returned and give response to end user according to success or not.
									if ($Result->Success == true)
										$Message = "Message successfully sent!";
									else
										$Message = "Error occured while sending SMS<br />Errorcode: " . $Result->ErrorCode . "<br />Errormessage: " . $Result->ErrorMessage;
								}
								catch (Exception $e)
								{
									//Error occured while connecting to server.
									$Message = $e->getMessage();
								}
							}
							//echo data back
							if(!empty($contactNo)){
								echo '<div class="form-horizontal">
										<div class="form-group">
											<label for="CardNumber" class="control-label col-md-3">Card Number</label>
											<div class="col-md-8">
												<input class="form-control" type="text" name="CardNumber" value="'.$cardNo.'" id="CardNumber" readonly/>
											</div>
										</div>
										<div class="form-group">
											<label for="employeelNIC" class="control-label col-md-3">NIC</label>
											<div class="col-md-8">
												<input class="form-control" type="text" name="nic" id="nic" value="'.$nic.'" readonly/>
											</div>
										</div>
										<div class="form-group">
											<label for="fName" class="control-label col-md-3">Full Name</label>
											<div class="col-md-8">
												<input class="form-control" type="text" name="name" id="name" value="'.$fName.' '.$sName.' '.$lName.'" readonly/>
											</div>
										</div>
										<div class="form-group">
											<label for="contact" class="control-label col-md-3">Contact Number</label>
											<div class="col-md-8">
												<input class="form-control" type="text" name="contact" id="contact" value="'.$contactNo.'" readonly/>
											</div>
										</div>
										<div class="form-group">
											<label for="contact" class="control-label col-md-3">PIN <span style="color:rgb(255,0,0);">*</span></label>
											<div class="col-md-8">
												<input class="form-control" type="text" name="pin" id="pin" required/>
											</div>
										</div>
										<input class="form-control" type="text" name="hpin" id="hpin" value="'.$rand.'"/>
										<div class="form-group">
											<label for="CardNumber" class="control-label col-md-5 text-center"><u>To</u></label>
										</div>
										<div class="form-group">
											<label for="employeeId" class="control-label col-md-3">Search By : </label>
											<div class="col-md-8">
												<select onchange="loadAgain(this);"  class="form-control">
												  <option selected="selected" disabled="disabled">--Select the search criteria--</option>
												  <option value="cardNumber">Card Number</option>
												  <option value="commuterNic">NIC</option>      
												</select>
											</div>
										</div>
										<hr/>
									</div>';
								} else {
									//if no contact number
									echo '<h3 class="text-center" style="padding:50px;">Commuter Cannot Use This Service As Contact Number Has Not Added Yet.</h3>';
								}
						} else {
							//if no result to show
							echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
						}
					} else {
						//if no result to show
						echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
					}
				} else {
					echo '<h3 class="text-center" style="padding:50px;">Wrong Card Number Format.</h3>';
				}
			} else if($r == "nic"){
				if(preg_match('/^(\d){9}[v|V]$/',$q)){
					$getCommuter = "SELECT * FROM commuter WHERE nic='".$q."'";
					$resultCommuter = mysqli_query($con, $getCommuter);
					if(mysqli_num_rows($resultCommuter) != 0){
						while($rowCommuter = mysqli_fetch_array($resultCommuter)){
							$cardNo = $rowCommuter['card_card_no'];
							$nic = $rowCommuter['nic'];
							$nameId = $rowCommuter['name_name_id'];
							$contactNo = $rowCommuter['contact_no'];
							$balance = $rowCommuter['credit'];
						}
						$getName = "SELECT * FROM NAME WHERE name_id='".$nameId."'";
						$resultName = mysqli_query($con, $getName);
						if(mysqli_num_rows($resultName) != 0){
							while($rowName = mysqli_fetch_array($resultName)){
								$fName = $rowName['first_name'];
								$sName = $rowName['second_name'];
								$lName = $rowName['last_name'];
							}
							//send sms with random pin
							$rand = rand(1000,9999);
							if(!empty($contactNo)){
								$newContact = "94". trim($contactNo,"0");
								$DestinationAddress = $newContact;
$Message = "Please enter the below PIN to proceed with credit transfer.

PIN : ".$rand."

Thank You!
-SCAT System-";
								try
								{
									// Send SMS through the HTTP API
									$Result = $ViaNettSMS->SendSMS($MsgSender, $DestinationAddress, $Message);
									// Check result object returned and give response to end user according to success or not.
									if ($Result->Success == true)
										$Message = "Message successfully sent!";
									else
										$Message = "Error occured while sending SMS<br />Errorcode: " . $Result->ErrorCode . "<br />Errormessage: " . $Result->ErrorMessage;
								}
								catch (Exception $e)
								{
									//Error occured while connecting to server.
									$Message = $e->getMessage();
								}
							}
							//echo data back
							if(!empty($contactNo)){
								echo '<div class="form-horizontal">
									<div class="form-group">
										<label for="CardNumber" class="control-label col-md-5 text-center"><u>From</u></label>
									</div>
									<div class="form-group">
										<label for="CardNumber" class="control-label col-md-3">Card Number</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="CardNumber" value="'.$cardNo.'" id="CardNumber" readonly/>
										</div>

									</div>
									<div class="form-group">
										<label for="employeelNIC" class="control-label col-md-3">NIC</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="nic" id="nic" value="'.$nic.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="fName" class="control-label col-md-3">Full Name</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="name" id="name" value="'.$fName.' '.$sName.' '.$lName.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="contact" class="control-label col-md-3">Contact Number</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="contact" id="contact" value="'.$contactNo.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="contact" class="control-label col-md-3">PIN <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="pin" id="pin" required/>
										</div>
									</div>
									<input class="form-control" type="text" name="hpin" id="hpin" value="'.$rand.'"/>
									<div class="form-group">
										<label for="CardNumber" class="control-label col-md-5 text-center"><u>To</u></label>
									</div>
									<div class="form-group">
										<label for="employeeId" class="control-label col-md-3">Search By : </label>
										<div class="col-md-8">
											<select onchange="loadAgain(this);"  class="form-control">
											  <option selected="selected" disabled="disabled">--Select the search criteria--</option>
											  <option value="cardNumber">Card Number</option>
											  <option value="commuterNic">NIC</option>      
											</select>
										</div>
									</div>
									<hr/>
								</div>';	
							} else {
								//if no contact number
								echo '<h3 class="text-center" style="padding:50px;">Commuter Cannot Use This Service As Contact Number Has Not Added Yet.</h3>';
							}
						} else {
							//if no result to show
							echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
						}
					} else {
						//if no result to show
						echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
					}
				} else {
					echo '<h3 class="text-center" style="padding:50px;">Wrong NIC Format.</h3>';
				}
			} else {
				//wrong html id
				header('Location:../404.php');
			}
	} else if($p == "balance"){
		if($q != ""){
			if($r == "CardNo"){
				if(preg_match('/^\d{16}$/',$q)){
					$getCommuter = "SELECT * FROM commuter WHERE card_card_no='".$q."'";
					$resultCommuter = mysqli_query($con, $getCommuter);
					if(mysqli_num_rows($resultCommuter) != 0){
						while($rowCommuter = mysqli_fetch_array($resultCommuter)){
							$cardNo = $rowCommuter['card_card_no'];
							$nic = $rowCommuter['nic'];
							$nameId = $rowCommuter['name_name_id'];
							$contactNo = $rowCommuter['contact_no'];
							$balance = $rowCommuter['credit'];
						}
						$getName = "SELECT * FROM NAME WHERE name_id='".$nameId."'";
						$resultName = mysqli_query($con, $getName);
						if(mysqli_num_rows($resultName) != 0){
							while($rowName = mysqli_fetch_array($resultName)){
								$fName = $rowName['first_name'];
								$sName = $rowName['second_name'];
								$lName = $rowName['last_name'];
							}
							//send sms to commuter
							if(!empty($contactNo)){
								$newContact = "94". trim($contactNo,"0");
								$DestinationAddress = $newContact;
$Message = "Your existing balance is Rs.".$balance.".

Thank You!
-SCAT System-";
								try
								{
									// Send SMS through the HTTP API
									$Result = $ViaNettSMS->SendSMS($MsgSender, $DestinationAddress, $Message);
									// Check result object returned and give response to end user according to success or not.
									if ($Result->Success == true)
										$Message = "Message successfully sent!";
									else
										$Message = "Error occured while sending SMS<br />Errorcode: " . $Result->ErrorCode . "<br />Errormessage: " . $Result->ErrorMessage;
								}
								catch (Exception $e)
								{
									//Error occured while connecting to server.
									$Message = $e->getMessage();
								}
							}
							echo '<div class="form-horizontal">
									<div class="form-group">
										<label for="CardNumber" class="control-label col-md-3">Card Number</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="CardNumber" value="'.$cardNo.'" id="CardNumber" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="employeelNIC" class="control-label col-md-3">NIC</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="nic" id="nic" value="'.$nic.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="fName" class="control-label col-md-3">Full Name</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="name" id="name" value="'.$fName.' '.$sName.' '.$lName.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="contact" class="control-label col-md-3">Contact Number</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="contact" id="contact" value="'.$contactNo.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="amount" class="control-label col-md-3">Amount</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="amount" id="amount" value="'.$balance.'" readonly/>
										</div>
									</div>
								</div>';
						} else {
							//if no result to show
							echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
						}
					} else {
						//if no result to show
						echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
					}
				} else {
					echo '<h3 class="text-center" style="padding:50px;">Wrong Card Number Format.</h3>';
				}
			} else if($r == "nic"){
				if(preg_match('/^(\d){9}[v|V]$/',$q)){
					$getCommuter = "SELECT * FROM commuter WHERE nic='".$q."'";
					$resultCommuter = mysqli_query($con, $getCommuter);
					if(mysqli_num_rows($resultCommuter) != 0){
						while($rowCommuter = mysqli_fetch_array($resultCommuter)){
							$cardNo = $rowCommuter['card_card_no'];
							$nic = $rowCommuter['nic'];
							$nameId = $rowCommuter['name_name_id'];
							$contactNo = $rowCommuter['contact_no'];
							$balance = $rowCommuter['credit'];
						}
						$getName = "SELECT * FROM NAME WHERE name_id='".$nameId."'";
						$resultName = mysqli_query($con, $getName);
						if(mysqli_num_rows($resultName) != 0){
							while($rowName = mysqli_fetch_array($resultName)){
								$fName = $rowName['first_name'];
								$sName = $rowName['second_name'];
								$lName = $rowName['last_name'];
							}
							//send sms to commuter
							if(!empty($contactNo)){
								$newContact = "94". trim($contactNo,"0");
								$DestinationAddress = $newContact;
$Message = "Your existing balance is Rs.".$balance.".

Thank You!
-SCAT System-";
								try
								{
									// Send SMS through the HTTP API
									$Result = $ViaNettSMS->SendSMS($MsgSender, $DestinationAddress, $Message);
									// Check result object returned and give response to end user according to success or not.
									if ($Result->Success == true)
										$Message = "Message successfully sent!";
									else
										$Message = "Error occured while sending SMS<br />Errorcode: " . $Result->ErrorCode . "<br />Errormessage: " . $Result->ErrorMessage;
								}
								catch (Exception $e)
								{
									//Error occured while connecting to server.
									$Message = $e->getMessage();
								}
							}
							echo '<div class="form-horizontal">
									<div class="form-group">
										<label for="CardNumber" class="control-label col-md-3">Card Number</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="CardNumber" value="'.$cardNo.'" id="CardNumber" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="employeelNIC" class="control-label col-md-3">NIC</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="nic" id="nic" value="'.$nic.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="fName" class="control-label col-md-3">Full Name</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="name" id="name" value="'.$fName.' '.$sName.' '.$lName.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="contact" class="control-label col-md-3">Contact Number</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="contact" id="contact" value="'.$contactNo.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="amount" class="control-label col-md-3">Amount</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="amount" id="amount"  value="'.$balance.'" readonly/>
										</div>
									</div>
								</div>';
						} else {
							//if no result to show
							echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
						}
					} else {
						//if no result to show
						echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
					}
				} else {
					echo '<h3 class="text-center" style="padding:50px;">Wrong NIC Format.</h3>';
				}
			} else {
				//wrong html id
				header('Location:../404.php');
			}
		} else {
			//no value entered for search
			echo '<h3 class="text-center" style="padding:50px;">Please Enter A Value To Search.</h3>';
		}
	} else if($p == "activate"){
		if($q != ""){
			if($r == "CardNo"){
				$getCommuter = "SELECT * FROM commuter WHERE card_card_no='".$q."'";
				$resultCommuter = mysqli_query($con, $getCommuter);
				if(mysqli_num_rows($resultCommuter) != 0){
					while($rowCommuter = mysqli_fetch_array($resultCommuter)){
						$cardNo = $rowCommuter['card_card_no'];
						$nic = $rowCommuter['nic'];
						$nameId = $rowCommuter['name_name_id'];
						$addressId = $rowCommuter['address_address_id'];
						$contactNo = $rowCommuter['contact_no'];
						if($rowCommuter['status'] == 1){
							$status = "Active";	
						} else {
							$status = "Disabled";
						}
						$getName = "SELECT * FROM NAME WHERE name_id='".$nameId."'";
						$resultName = mysqli_query($con, $getName);
						if(mysqli_num_rows($resultName) != 0){
							while($rowName = mysqli_fetch_array($resultName)){
								$fName = $rowName['first_name'];
								$sName = $rowName['second_name'];
								$lName = $rowName['last_name'];
							}
						}
						$getAddress = "SELECT * FROM address WHERE address_id='".$addressId."'";
						$resultAddress = mysqli_query($con, $getAddress);
						if(mysqli_num_rows($resultAddress) != 0){
							while($rowName = mysqli_fetch_array($resultAddress)){
								$aNo = $rowName['address_no'];
								$aLane = $rowName['address_lane'];
								$aCity = $rowName['address_city'];
							}
						}
						echo '<form role="form" class="form-horizontal" method="post" action="controller/activateCommuterController.php">
								<div class="form-group text-center">
									<label class="col-md-11">S.C.A.T. Card Information</label> 
								</div>
								<div class="form-group">
									<label for="CardNumber" class="control-label col-md-3">Card Number <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="CardNumber" id="CardNumber" value="'.$cardNo.'" readonly/>
									</div>
								</div>
								<div class="form-group">
									<label for="status" class="control-label col-md-3">Status <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="status" id="status" value="'.$status.'" readonly/>
									</div>
								</div>
								<div class="form-group text-center">
									<label class="col-md-11">Personal Information</label> 
								</div>
								<div class="form-group">
									<label for="employeelNIC" class="control-label col-md-3">NIC <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="nic" id="nic" value="'.$nic.'" readonly/>
									</div>
								</div>
								<div class="form-group">
									<label for="employeefName" class="control-label col-md-3">First Name <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="fname" id="fname" value="'.$fName.'" readonly/>
									</div>
								</div>
								<div class="form-group">
									<label for="employeemName" class="control-label col-md-3">Middle Name</label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="mname" id="mname" value="'.$sName.'" readonly/>
									</div>
								</div>
								<div class="form-group">
									<label for="employeelName" class="control-label col-md-3">Last Name <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="lname" id="lname" value="'.$lName.'" readonly/>
									</div>
								</div>
								<div class="form-group">
									<label for="addressNo" class="control-label col-md-3">Address Number <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="addresNo" id="addressNo" value="'.$aNo.'" readonly/>
									</div>
								</div>
								<div class="form-group">
									<label for="addressLane" class="control-label col-md-3">Lane/ Street <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="lane" id="lane" value="'.$aLane.'" readonly/>
									</div>
								</div>
								<div class="form-group">
									<label for="addressCity" class="control-label col-md-3">City <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="city" id="city" value="'.$aCity.'" readonly/>
									</div>
								</div>
								<div class="form-group">
									<label for="employeeContact" class="control-label col-md-3">Contact Number</label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="contact" id="contact" value="'.$contactNo.'" readonly/>
									</div>
								</div>
								<div class="form-group" style="text-align:center;">
										<label for="employeeContact" style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
								</div>
								<div class="form-group col-md-11 text-center">';
								if($status == "Active"){
									echo '<input type="submit" name="submit" id="submit" value="Disable" class="btn btn-danger" onclick="return confirm(\'Do You Wish to Disable Commuter?\');return false;"/>';	
								} else {
									echo '<input type="submit" name="submit" id="submit" value="Activate" class="btn btn-success" onclick="return confirm(\'Do You Wish to Activate Commuter?\');return false;"/>';
								}
								echo	'</div>
								</form>';
					}
				} else {
					//if no result to show
					echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
				}
			}  else if($r == "nic"){
				$getCommuter = "SELECT * FROM commuter WHERE nic='".$q."'";
				$resultCommuter = mysqli_query($con, $getCommuter);
				if(mysqli_num_rows($resultCommuter) != 0){
					while($rowCommuter = mysqli_fetch_array($resultCommuter)){
						$cardNo = $rowCommuter['card_card_no'];
						$nic = $rowCommuter['nic'];
						$nameId = $rowCommuter['name_name_id'];
						$addressId = $rowCommuter['address_address_id'];
						$contactNo = $rowCommuter['contact_no'];
						if($rowCommuter['status'] == 1){
							$status = "Active";	
						} else {
							$status = "Disabled";
						}
						$getName = "SELECT * FROM NAME WHERE name_id='".$nameId."'";
						$resultName = mysqli_query($con, $getName);
						if(mysqli_num_rows($resultName) != 0){
							while($rowName = mysqli_fetch_array($resultName)){
								$fName = $rowName['first_name'];
								$sName = $rowName['second_name'];
								$lName = $rowName['last_name'];
							}
						}
						$getAddress = "SELECT * FROM address WHERE address_id='".$addressId."'";
						$resultAddress = mysqli_query($con, $getAddress);
						if(mysqli_num_rows($resultAddress) != 0){
							while($rowName = mysqli_fetch_array($resultAddress)){
								$aNo = $rowName['address_no'];
								$aLane = $rowName['address_lane'];
								$aCity = $rowName['address_city'];
							}
						}
						echo '<form role="form" class="form-horizontal" method="post" action="controller/activateCommuterController.php">
								<div class="form-group text-center">
									<label class="col-md-11">S.C.A.T. Card Information</label> 
								</div>
								<div class="form-group">
									<label for="CardNumber" class="control-label col-md-3">Card Number <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="CardNumber" id="CardNumber" value="'.$cardNo.'" readonly/>
									</div>
								</div>
								<div class="form-group">
									<label for="status" class="control-label col-md-3">Status <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="status" id="status" value="'.$status.'" readonly/>
									</div>
								</div>
								<div class="form-group text-center">
									<label class="col-md-11">Personal Information</label> 
								</div>
								<div class="form-group">
									<label for="employeelNIC" class="control-label col-md-3">NIC <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="nic" id="nic" value="'.$nic.'" readonly/>
									</div>
								</div>
								<div class="form-group">
									<label for="employeefName" class="control-label col-md-3">First Name <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="fname" id="fname" value="'.$fName.'" readonly/>
									</div>
								</div>
								<div class="form-group">
									<label for="employeemName" class="control-label col-md-3">Middle Name</label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="mname" id="mname" value="'.$sName.'" readonly/>
									</div>
								</div>
								<div class="form-group">
									<label for="employeelName" class="control-label col-md-3">Last Name <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="lname" id="lname" value="'.$lName.'" readonly/>
									</div>
								</div>
								<div class="form-group">
									<label for="addressNo" class="control-label col-md-3">Address Number <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="addresNo" id="addressNo" value="'.$aNo.'" readonly/>
									</div>
								</div>
								<div class="form-group">
									<label for="addressLane" class="control-label col-md-3">Lane/ Street <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="lane" id="lane" value="'.$aLane.'" readonly/>
									</div>
								</div>
								<div class="form-group">
									<label for="addressCity" class="control-label col-md-3">City <span style="color:rgb(255,0,0);">*</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="city" id="city" value="'.$aCity.'" readonly/>
									</div>
								</div>
								<div class="form-group">
									<label for="employeeContact" class="control-label col-md-3">Contact Number</label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="contact" id="contact" value="'.$contactNo.'" readonly/>
									</div>
								</div>
								<div class="form-group" style="text-align:center;">
										<label for="employeeContact" style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
								</div>
								<div class="form-group col-md-11 text-center">';
								if($status == "Active"){
									echo '<input type="submit" name="submit" id="submit" value="Disable" class="btn btn-danger" onclick="return confirm(\'Do You Wish to Disable Commuter?\');return false;"/>';	
								} else {
									echo '<input type="submit" name="submit" id="submit" value="Activate" class="btn btn-success" onclick="return confirm(\'Do You Wish to Activate Commuter?\');return false;"/>';
								}
								echo	'</div>
								</form>';
					}
				} else {
					//if no result to show
					echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
				}
			} else {
				//wrong html id
				header('Location:../404.php');
			} 
		}  else {
			//no value entered for search
			echo '<h3 class="text-center" style="padding:50px;">Please Enter A Value To Search.</h3>';
		}
	} else {
		//404, wrong operation
		header('Location:../404.php');	
	}
} else {
	//404, no operation or no id
	header('Location:../404.php');	
}
?>
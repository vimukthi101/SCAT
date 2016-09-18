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
$r = trim(htmlspecialchars(mysqli_real_escape_string($con, $_REQUEST["r"])));
if($p != ""){
	if($r != ""){
		if($p == "view"){
			if ($q != "") {
				if($r == "StationCode"){
					$getStation = "SELECT * FROM station WHERE station_code LIKE '".$q."%'";
					$resultStation = mysqli_query($con, $getStation);
					if(mysqli_num_rows($resultStation) != 0){
						echo '<div class="form-group">
							<div class="container-fluid center-block">
								<table style="width:100%;" class="table table-striped">
								  <tr>
									<th>Station Code</th>
									<th>Station Name</th>
									<th>Available Cards</th>
									<th>Station Master</th>
								  </tr>';
						while($rowStation = mysqli_fetch_array($resultStation)){
							$stationCode = $rowStation['station_code'];
							$stationName = $rowStation['station_name'];
							$cards = $rowStation['available_cards'];
							$stationMaster = $rowStation['employee_nic'];
							$get = "SELECT * FROM NAME WHERE name_id IN (SELECT name_id FROM employee WHERE nic='".$stationMaster."')";
							$resultGet = mysqli_query($con, $get);
							if(mysqli_num_rows($resultGet) != 0){
								while($rowGet = mysqli_fetch_array($resultGet)){
									$fname = $rowGet['first_name'];
									$sname = $rowGet['second_name'];
									$lname = $rowGet['last_name'];
								}
							}
							echo '<tr>
							<td>'.$stationCode.'</td>
							<td>'.$stationName.'</td>
							<td>'.$cards.'</td>
							<td>'.$stationMaster.' - '.$fname.' '.$sname.' '.$lname.'</td>
						  </tr>';
						}
						echo '</table>
							</div>
						</div>';
					} else {
						//if no result to show
						echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';
					}
				} else if($r == "StationName"){
					$getStation = "SELECT * FROM station WHERE station_name LIKE '".$q."%'";
					$resultStation = mysqli_query($con, $getStation);
					if(mysqli_num_rows($resultStation) != 0){
						echo '<div class="form-group">
							<div class="container-fluid center-block">
								<table style="width:100%;" class="table table-striped">
								  <tr>
									<th>Station Code</th>
									<th>Station Name</th>
									<th>Available Cards</th>
									<th>Employee NIC</th>
								  </tr>';
						while($rowStation = mysqli_fetch_array($resultStation)){
							$stationCode = $rowStation['station_code'];
							$stationName = $rowStation['station_name'];
							$cards = $rowStation['available_cards'];
							$stationMaster = $rowStation['employee_nic'];
							$get = "SELECT * FROM NAME WHERE name_id IN (SELECT name_id FROM employee WHERE nic='".$stationMaster."')";
							$resultGet = mysqli_query($con, $get);
							if(mysqli_num_rows($resultGet) != 0){
								while($rowGet = mysqli_fetch_array($resultGet)){
									$fname = $rowGet['first_name'];
									$sname = $rowGet['second_name'];
									$lname = $rowGet['last_name'];
								}
							}
							echo '<tr>
							<td>'.$stationCode.'</td>
							<td>'.$stationName.'</td>
							<td>'.$cards.'</td>
							<td>'.$stationMaster.' - '.$fname.' '.$sname.' '.$lname.'</td>
						  </tr>';
						}
						echo '</table>
							</div>
						</div>';
					} else {
						//if no result to show
						echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';
					}
				} else if ($r == "StationMaster"){
					$getStation = "SELECT * FROM station WHERE employee_nic LIKE '".$q."%'";
					$resultStation = mysqli_query($con, $getStation);
					if(mysqli_num_rows($resultStation) != 0){
						echo '<div class="form-group">
							<div class="container-fluid center-block">
								<table style="width:100%;" class="table table-striped">
								  <tr>
									<th>Station Code</th>
									<th>Station Name</th>
									<th>Available Cards</th>
									<th>Employee NIC</th>
								  </tr>';
						while($rowStation = mysqli_fetch_array($resultStation)){
							$stationCode = $rowStation['station_code'];
							$stationName = $rowStation['station_name'];
							$cards = $rowStation['available_cards'];
							$stationMaster = $rowStation['employee_nic'];
							$get = "SELECT * FROM NAME WHERE name_id IN (SELECT name_id FROM employee WHERE nic='".$stationMaster."')";
							$resultGet = mysqli_query($con, $get);
							if(mysqli_num_rows($resultGet) != 0){
								while($rowGet = mysqli_fetch_array($resultGet)){
									$fname = $rowGet['first_name'];
									$sname = $rowGet['second_name'];
									$lname = $rowGet['last_name'];
								}
							}
							echo '<tr>
							<td>'.$stationCode.'</td>
							<td>'.$stationName.'</td>
							<td>'.$cards.'</td>
							<td>'.$stationMaster.' - '.$fname.' '.$sname.' '.$lname.'</td>
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
					//404	
					header('Location:../404.php');
				}				  
			} else {
				//if empty q
				echo '<h3 class="text-center" style="padding:50px;">Please Enter A Value To Search.</h3>';
			}
		} else if($p == "update"){
			if ($q != "") {
				if($r == "StationCode"){
					$getStation = "SELECT * FROM station WHERE station_code='".$q."'";
					$resultStation = mysqli_query($con, $getStation);
					if(mysqli_num_rows($resultStation) != 0){
						while($rowStation = mysqli_fetch_array($resultStation)){
							$stationCode = $rowStation['station_code'];
							$stationName = $rowStation['station_name'];
							$cards = $rowStation['available_cards'];
							$stationMaster = $rowStation['employee_nic'];
							$get = "SELECT * FROM NAME WHERE name_id IN (SELECT name_id FROM employee WHERE nic='".$stationMaster."')";
							$resultGet = mysqli_query($con, $get);
							if(mysqli_num_rows($resultGet) != 0){
								while($rowGet = mysqli_fetch_array($resultGet)){
									$fname = $rowGet['first_name'];
									$sname = $rowGet['second_name'];
									$lname = $rowGet['last_name'];
								}
							}
							echo '<form role="form" class="form-horizontal" method="post" action="controller/updateStationsController.php">
									<div class="form-group">
										<label for="sCode" class="control-label col-md-3">Station Code <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="sCode" id="sCode" value="'.$stationCode.'" readonly/>
										</div>
									</div>
									<input class="form-control" type="hidden" name="oldNIC" id="oldNIC" value="'.$stationMaster.'"/>
									<input class="form-control" type="hidden" name="oldName" id="oldName" value="'.$stationName.'"/>
									<div class="form-group">
										<label for="sName" class="control-label col-md-3">Name of the Station <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="sName" id="sName"  pattern="^[a-zA-Z]+$" title="Name Of The Station Should Be Letters Only." required="required" value="'.$stationName.'"/>
										</div>
									</div> 
									<div class="form-group">
										<label for="smName" class="control-label col-md-3">Station Master\'s Name <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<select class="form-control" name="smID" id="smID">
											<option disabled="disabled">--Select The Station Master--</option>';
											$getTypes = "SELECT employee_nic FROM staff WHERE employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='stationMaster')";
											$result = mysqli_query($con, $getTypes);
											if(mysqli_num_rows($result) != 0){
												while($row = mysqli_fetch_array($result)){
													$nic = $row['employee_nic'];
													$get = "SELECT * FROM NAME WHERE name_id IN (SELECT name_id FROM employee WHERE nic='".$nic."')";
													$resultGet = mysqli_query($con, $get);
													if(mysqli_num_rows($resultGet) != 0){
														while($rowGet = mysqli_fetch_array($resultGet)){
															$fname = $rowGet['first_name'];
															$sname = $rowGet['second_name'];
															$lname = $rowGet['last_name'];
															if($stationMaster == $nic){
																echo '<option value="'.$nic.'" selected>'.$nic.' - '.$fname.' '.$sname.' '.$lname.'</option>';
															} else {
																echo '<option value="'.$nic.'">'.$nic.' - '.$fname.' '.$sname.' '.$lname.'</option>';
															}
														}
													}
												}
											} else {
												echo '<option>No Station Masters</option>';
											} 
										echo '</select>
									</div>
									</div> 
									<div class="form-group" style="text-align:center;">
										<label style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
									</div>
									<div class="form-group col-md-11 text-center">
										<input type="submit" value="Update" name="submit" id="submit" class="btn btn-success" onclick="return confirm(\'Do You Wish to Update Station?\');return false;"/>
									</div>
								</form>';
						}
					} else {
						//if no result to show
						echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';
					}
				} else if($r == "StationName"){
					$getStation = "SELECT * FROM station WHERE station_name='".$q."'";
					$resultStation = mysqli_query($con, $getStation);
					if(mysqli_num_rows($resultStation) != 0){
						while($rowStation = mysqli_fetch_array($resultStation)){
							$stationCode = $rowStation['station_code'];
							$stationName = $rowStation['station_name'];
							$cards = $rowStation['available_cards'];
							$stationMaster = $rowStation['employee_nic'];
							$get = "SELECT * FROM NAME WHERE name_id IN (SELECT name_id FROM employee WHERE nic='".$stationMaster."')";
							$resultGet = mysqli_query($con, $get);
							if(mysqli_num_rows($resultGet) != 0){
								while($rowGet = mysqli_fetch_array($resultGet)){
									$fname = $rowGet['first_name'];
									$sname = $rowGet['second_name'];
									$lname = $rowGet['last_name'];
								}
							}
							echo '<form role="form" class="form-horizontal" method="post" action="controller/updateStationsController.php">
									<div class="form-group">
										<label for="sCode" class="control-label col-md-3">Station Code <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="sCode" id="sCode" value="'.$stationCode.'" readonly/>
										</div>
									</div>
									<input class="form-control" type="hidden" name="oldNIC" id="oldNIC" value="'.$stationMaster.'"/>
									<input class="form-control" type="hidden" name="oldName" id="oldName" value="'.$stationName.'"/>
									<div class="form-group">
										<label for="sName" class="control-label col-md-3">Name of the Station <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="sName" id="sName"  pattern="^[a-zA-Z]+$" title="Name Of The Station Should Be Letters Only." required="required" value="'.$stationName.'"/>
										</div>
									</div> 
									<div class="form-group">
										<label for="smName" class="control-label col-md-3">Station Master\'s Name <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<select class="form-control" name="smID" id="smID">
											<option disabled="disabled">--Select The Station Master--</option>';
											$getTypes = "SELECT employee_nic FROM staff WHERE employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='stationMaster')";
											$result = mysqli_query($con, $getTypes);
											if(mysqli_num_rows($result) != 0){
												while($row = mysqli_fetch_array($result)){
													$nic = $row['employee_nic'];
													$get = "SELECT * FROM NAME WHERE name_id IN (SELECT name_id FROM employee WHERE nic='".$nic."')";
													$resultGet = mysqli_query($con, $get);
													if(mysqli_num_rows($resultGet) != 0){
														while($rowGet = mysqli_fetch_array($resultGet)){
															$fname = $rowGet['first_name'];
															$sname = $rowGet['second_name'];
															$lname = $rowGet['last_name'];
															if($stationMaster == $nic){
																echo '<option value="'.$nic.'" selected>'.$nic.' - '.$fname.' '.$sname.' '.$lname.'</option>';
															} else {
																echo '<option value="'.$nic.'">'.$nic.' - '.$fname.' '.$sname.' '.$lname.'</option>';
															}
														}
													}
												}
											} else {
												echo '<option>No Station Masters</option>';
											} 
										echo '</select>
									</div>
									</div> 
									<div class="form-group" style="text-align:center;">
										<label style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
									</div>
									<div class="form-group col-md-11 text-center">
										<input type="submit" value="Update" name="submit" id="submit" class="btn btn-success" onclick="return confirm(\'Do You Wish to Update Station?\');return false;"/>
									</div>
								</form>';
						}
					} else {
						//if no result to show
						echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';
					}
				} else if($r == "StationMaster"){
					$getStation = "SELECT * FROM station WHERE employee_nic='".$q."'";
					$resultStation = mysqli_query($con, $getStation);
					if(mysqli_num_rows($resultStation) != 0){
						while($rowStation = mysqli_fetch_array($resultStation)){
							$stationCode = $rowStation['station_code'];
							$stationName = $rowStation['station_name'];
							$cards = $rowStation['available_cards'];
							$stationMaster = $rowStation['employee_nic'];
							$get = "SELECT * FROM NAME WHERE name_id IN (SELECT name_id FROM employee WHERE nic='".$stationMaster."')";
							$resultGet = mysqli_query($con, $get);
							if(mysqli_num_rows($resultGet) != 0){
								while($rowGet = mysqli_fetch_array($resultGet)){
									$fname = $rowGet['first_name'];
									$sname = $rowGet['second_name'];
									$lname = $rowGet['last_name'];
								}
							}
							echo '<form role="form" class="form-horizontal" method="post" action="controller/updateStationsController.php">
									<div class="form-group">
										<label for="sCode" class="control-label col-md-3">Station Code <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="sCode" id="sCode" value="'.$stationCode.'" readonly/>
										</div>
									</div>
									<input class="form-control" type="hidden" name="oldNIC" id="oldNIC" value="'.$stationMaster.'"/>
									<input class="form-control" type="hidden" name="oldName" id="oldName" value="'.$stationName.'"/>
									<div class="form-group">
										<label for="sName" class="control-label col-md-3">Name of the Station <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="sName" id="sName"  pattern="^[a-zA-Z]+$" title="Name Of The Station Should Be Letters Only." required="required" value="'.$stationName.'"/>
										</div>
									</div> 
									<div class="form-group">
										<label for="smName" class="control-label col-md-3">Station Master\'s Name <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<select class="form-control" name="smID" id="smID">
											<option disabled="disabled">--Select The Station Master--</option>';
											$getTypes = "SELECT employee_nic FROM staff WHERE employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='stationMaster')";
											$result = mysqli_query($con, $getTypes);
											if(mysqli_num_rows($result) != 0){
												while($row = mysqli_fetch_array($result)){
													$nic = $row['employee_nic'];
													$get = "SELECT * FROM NAME WHERE name_id IN (SELECT name_id FROM employee WHERE nic='".$nic."')";
													$resultGet = mysqli_query($con, $get);
													if(mysqli_num_rows($resultGet) != 0){
														while($rowGet = mysqli_fetch_array($resultGet)){
															$fname = $rowGet['first_name'];
															$sname = $rowGet['second_name'];
															$lname = $rowGet['last_name'];
															if($stationMaster == $nic){
																echo '<option value="'.$nic.'" selected>'.$nic.' - '.$fname.' '.$sname.' '.$lname.'</option>';
															} else {
																echo '<option value="'.$nic.'">'.$nic.' - '.$fname.' '.$sname.' '.$lname.'</option>';
															}
														}
													}
												}
											} else {
												echo '<option>No Station Masters</option>';
											} 
										echo '</select>
									</div>
									</div> 
									<div class="form-group" style="text-align:center;">
										<label style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
									</div>
									<div class="form-group col-md-11 text-center">
										<input type="submit" value="Update" name="submit" id="submit" class="btn btn-success" onclick="return confirm(\'Do You Wish to Update Station?\');return false;"/>
									</div>
								</form>';
						}
					} else {
						//if no result to show
						echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';
					}
				} else {
					//404	
					header('Location:../404.php');
				}				  
			} else {
				//if empty q
				echo '<h3 class="text-center" style="padding:50px;">Please Enter A Value To Search.</h3>';
			}
		} else if ($p == "delete") {
			if ($q != "") {
				if($r == "StationCode"){
					
				} else if($r == "StationName"){
					
				} else if($r == "StationMaster"){
					
				} else {
					//404	
					header('Location:../404.php');
				}				  
			} else {
				//if empty q
				echo '<h3 class="text-center" style="padding:50px;">Please Enter A Value To Search.</h3>';
			}
		} else { 
			// 404 wrong operation
			header('Location:../404.php');	
		}
	} else { 
		// 404 no operation
		header('Location:../404.php');	
	}
} else { 
	// 404 no operation
	header('Location:../404.php');	
}
?>
<?php
if(!isset($_SESSION[''])){
	session_start();
}
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
$hint = "";
if($p != ""){
	if($p == "view"){
		if ($q != "") {
			$getCard = "SELECT * FROM card WHERE card_no LIKE '".$q."%' ORDER BY card_no";
			$resultGetCard = mysqli_query($con, $getCard);
			if(mysqli_num_rows($resultGetCard) != 0){
				echo '<div class="form-group">
							<div class="container-fluid center-block">
								<table style="width:100%;" class="table table-striped">
								  <tr>
									<th>Card No</th>
									<th>Pin</th>
									<th>Station Name</th>
									<th>Station Master\'s Name</th>
								  </tr>';
				while($rowCards = mysqli_fetch_array($resultGetCard)){
					$cardNo = $rowCards['card_no'];
					$pin = $rowCards['pin'];
					$station = $rowCards['station_station_code'];
					if(!is_null($station)){
						//send to station
						$getStation = "SELECT station_name, employee_nic FROM station WHERE station_code='".$station."'";
						$resultStation = mysqli_query($con, $getStation);
						if(mysqli_num_rows($resultStation) != 0){
							while($rowStation = mysqli_fetch_array($resultStation)){
								$stationName = $rowStation['station_name'];
								$employeeNic = $rowStation['employee_nic'];
								$getSM = "SELECT * FROM NAME WHERE name_id IN (SELECT name_id FROM employee WHERE nic='".$employeeNic."')";
								$resultSM = mysqli_query($con, $getSM);
								if(mysqli_num_rows($resultSM) != 0){
									while($rowSM = mysqli_fetch_array($resultSM)){
										$fName = $rowSM['first_name'];
										$sName = $rowSM['second_name'];
										$lName = $rowSM['last_name'];
										echo '<tr>
										<td>'.$cardNo.'</td>
										<td>'.$pin.'</td>
										<td>'.$stationName.'</td>
										<td>'.$fName." ".$sName." ".$lName.'</td>
									  </tr>';
									}
								} else {
									//no SM
									echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';
								}
							}
						} else {
							//no station	
							echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';
						}
					} else {
						//not send to anywhere yet
						echo '<tr>
							<td>'.$cardNo.'</td>
							<td>'.$pin.'</td>
							<td>Haven\'t Send to a Station Yet</td>
							<td>Haven\'t Send to a Station Yet</td>
						  </tr>';
					}
				}
				echo '</table>
							</div>
						</div>';
			} else {
				//if no result to show
				echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';
			}				  
		} else {
			//if empty q
			echo '<h3 class="text-center" style="padding:50px;">Please Enter A Value To Search.</h3>';
		}
	} else if($p == "update"){
		if($q != ""){
			$getCard = "SELECT * FROM card WHERE card_no='".$q."'";
			$resultGetCard = mysqli_query($con, $getCard);
			if(mysqli_num_rows($resultGetCard) != 0){
				while($rowCard = mysqli_fetch_array($resultGetCard)){
					$pin = $rowCard['pin'];
					$stationCode = $rowCard['station_station_code'];
					if(!is_null($stationCode)){
						$getStation = "SELECT station_name FROM station WHERE station_code='".$stationCode."'";
						$resultStation = mysqli_query($con, $getStation);
						if(mysqli_num_rows($resultStation) != 0){
							while($rowStation = mysqli_fetch_array($resultStation)){
								$stationName = $rowStation['station_name'];
							}
						}
						//send to station
						echo '<h3 class="text-center" style="padding:50px;">Card Has Already Been Sent To '.$stationName.' Station.</h3>';
					} else {
						//not send yet
						echo '<form role="form" class="form-horizontal" method="post" action="controller/updateCardsController.php">
						<div class="form-group">
							<label for="cNo" class="control-label col-md-3">Card No</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="cNo" id="cNo" maxlength="16" required="required" pattern="^\d{16}$" title="Should Be 16 Digits Number." value="'.$q.'"/>
							</div>
						</div>
						<input type="hidden" name="oldCNo" value="'.$q.'"/>
						<div class="form-group">
							<label for="pin" class="control-label col-md-3">Pin</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="pin" id="pin" value="'.$pin.'" maxlength="4" required="required" pattern="^\d{4}$" title="Should Be 4 Digits Number."/>
							</div>
						</div>
						<div class="form-group">
							<label for="cPin" class="control-label col-md-3">Confirm Pin</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="cPin" id="cPin" maxlength="4" required="required" pattern="^\d{4}$" title="Should Be 4 Digits Number."/>
							</div>
						</div>
						<div class="form-group col-md-11 text-center">
							<input type="submit" id="submit" name="submit" value="Update" class="btn btn-success"  onclick="return confirm(\'Do You Wish to Update Card?\');return false;"/>
							<input type="reset" value="Clear" class="btn btn-danger" />
						</div>
					</form>';
					}
				}
			} else {
				//no data	
				echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';
			}
		}  else {
			//if empty q
			echo '<h3 class="text-center" style="padding:50px;">Please Enter A Value To Search.</h3>';
		}
	} else if ($p == "delete") {
		if($q != ""){
			$getCard = "SELECT * FROM card WHERE card_no='".$q."'";
			$resultGetCard = mysqli_query($con, $getCard);
			if(mysqli_num_rows($resultGetCard) != 0){
				while($rowCard = mysqli_fetch_array($resultGetCard)){
					$pin = $rowCard['pin'];
					$stationCode = $rowCard['station_station_code'];
					if(!is_null($stationCode)){
						$getStation = "SELECT station_name FROM station WHERE station_code='".$stationCode."'";
						$resultStation = mysqli_query($con, $getStation);
						if(mysqli_num_rows($resultStation) != 0){
							while($rowStation = mysqli_fetch_array($resultStation)){
								$stationName = $rowStation['station_name'];
							}
						}
						//send to station
						echo '<h3 class="text-center" style="padding:50px;">Card Has Already Been Sent To '.$stationName.' Station.</h3>';
					} else {
						//not send yet
						echo '<form role="form" class="form-horizontal" method="post" action="controller/deleteCardsController.php">
						<div class="form-group">
							<label for="cNo" class="control-label col-md-3">Card No</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="cNo" id="cNo" value="'.$q.'" readonly/>
							</div>
						</div>
						<div class="form-group">
							<label for="pin" class="control-label col-md-3">Pin</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="pin" id="pin" value="'.$pin.'" readonly/>
							</div>
						</div>
						<div class="form-group col-md-11 text-center">
							<input type="submit" id="submit" name="submit" value="Delete" class="btn btn-danger"  onclick="return confirm(\'Do You Wish to Delete Card?\');return false;"/>
						</div>
					</form>';
					}
				}
			} else {
				//no data	
				echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';
			}
		} else {
			//if empty q
			echo '<h3 class="text-center" style="padding:50px;">Please Enter A Value To Search.</h3>';
		}
	} else if($p == "requests") {
		if($q != ""){
			$getCard = "SELECT * FROM card_request WHERE request_id='".$q."'";
			$resultCard = mysqli_query($con, $getCard);
			if(mysqli_num_rows($resultCard) != 0){
				while($rowCards = mysqli_fetch_array($resultCard)){
					$stationCode = $rowCards['station_station_code'];
					$date = $rowCards['requested_date'];
					$cards = $rowCards['no_of_cards_requested'];
				}
				$getStation = "SELECT * FROM station WHERE station_code='".$stationCode."'";
				$resultStation = mysqli_query($con, $getStation);
				if(mysqli_num_rows($resultStation) != 0){
					while($rowStation = mysqli_fetch_array($resultStation)){
						$stationName = $rowStation['station_name'];
						$nic = $rowStation['employee_nic'];
					}
					$getSM = "SELECT * FROM NAME WHERE name_id IN (SELECT name_id FROM employee WHERE nic='".$nic."')";
					$resultSM = mysqli_query($con, $getSM);
					if(mysqli_num_rows($resultSM) != 0){
						while($rowSM = mysqli_fetch_array($resultSM)){
							$fName = $rowSM['first_name'];
							$sName = $rowSM['second_name'];
							$lName = $rowSM['last_name'];
						}
					}
				}
				echo '<form role="form" class="form-horizontal" method="post" action="controller/issueCardsController.php">
					<div class="form-group">
                    <label for="station" class="control-label col-md-3">Station Name</label>
                    <div class="col-md-8">
					<input type="hidden" name="rID" id="rID" readonly="readonly" value="'.$q.'"/>
					<input type="hidden" name="nic" id="nic" readonly="readonly" value="'.$nic.'"/>
                    	<input class="form-control" type="text" name="station" id="station" readonly="readonly" value="'.$stationCode.' - '.$stationName.'"/>
                	</div>
					</div>
					<div class="form-group">
						<label for="stationMaster" class="control-label col-md-3">Station Master</label>
						<div class="col-md-8">
							<input class="form-control" type="text" name="stationMaster" id="stationMaster" readonly="readonly" value="'.$fName.' '.$sName.' '.$lName.'"/>
						</div>
					</div>
					<div class="form-group">
						<label for="nRequest" class="control-label col-md-3">Number of Cards Requested</label>
						<div class="col-md-8">
							<input class="form-control" type="text" name="nRequest" id="nRequest" readonly="readonly" value="'.$cards.'"/>
						</div>
					</div>
					<div class="form-group">
						<label for="date" class="control-label col-md-3">Requested Date</label>
						<div class="col-md-8">
							<input class="form-control" type="text" name="date" id="date" readonly="readonly" value="'.$date.'"/>
						</div>
					</div>
					<div class="form-group">
						<label for="nSend" class="control-label col-md-3">Number of Cards to Send</label>
						<div class="col-md-8">
							<input class="form-control" type="text" name="nSend" id="nSend"/>
						</div>
					</div>
					<div class="form-group col-md-11 text-center">
						<input type="submit" name="submit" id="submit" value="Issue" class="btn btn-success" onclick="return confirm(\'Do You Wish to Approve Card Request?\');return false;"/>
						<input type="submit" name="reject" id="reject" value="Reject" class="btn btn-danger" onclick="return confirm(\'Do You Wish to Reject Card Request?\');return false;"/>
					</div>
					</form>';
			} else {
				//no data	
				echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';
			}
		}  else {
			//if empty q
			echo '<h3 class="text-center" style="padding:50px;">Please Enter A Value To Search.</h3>';
		} 
	} else if($p == "list") {
		if($q != ""){
			if(isset($_SESSION['position'])){
				if($_SESSION['position'] == "sysadmin"){
					if(!empty($_REQUEST["r"])){
						$r = trim(htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST["r"])));
						if($r == "stationName"){
							$getReq = "SELECT * FROM card_request WHERE station_station_code LIKE '".$q."%' AND card_request_status_status_id IN (SELECT status_id FROM card_request_status WHERE status_type='send' OR status_type='reject' OR status_type='received') ORDER BY requested_date";
							$resultReq = mysqli_query($con, $getReq);
							if(mysqli_num_rows($resultReq) != 0){
								echo '<div class="form-group">
									<div class="container-fluid center-block">
										<table style="width:100%;" class="table table-striped">
										  <tr>
											<th>Request ID</th>
											<th>Requested Cards</th>
											<th>Send Cards</th>
											<th>Requested Date</th>
											<th>Send Date</th>
											<th>Station</th>
											<th>Status</th>
										  </tr>';
								while($rowResults = mysqli_fetch_array($resultReq)){
									$rID = $rowResults['request_id'];
									$rCards = $rowResults['no_of_cards_requested'];
									$sCards = $rowResults['no_of_cards_sent'];
									$rDate = $rowResults['requested_date'];
									$sDate = $rowResults['send_date'];
									$status = $rowResults['card_request_status_status_id'];
									$station = $rowResults['station_station_code'];
									$getStatus = "SELECT * FROM card_request_status WHERE status_id='".$status."'";
									$resultStatus = mysqli_query($con, $getStatus);
									if(mysqli_num_rows($resultStatus) != 0){
										while($rowStatus = mysqli_fetch_array($resultStatus)){
											$statusName = $rowStatus['status_type'];
											echo '<tr>
													<td>'.$rID.'</td>
													<td>'.$rCards.'</td>
													<td>'.$sCards.'</td>
													<td>'.$rDate.'</td>
													<td>'.$sDate.'</td>
													<td>'.$station.'</td>
													<td>'.$statusName.'</td>
												  </tr>';
										}
									}
								}
								echo '</table>
										</div>
									</div>';
							} else {
								//no results
								echo '<h3 class="text-center" style="padding:50px;">No Results To Display.</h3>';
							}
						} else if($r == "cardStatus"){
							if($q == "all"){
								$getReq = "SELECT * FROM card_request WHERE card_request_status_status_id IN (SELECT status_id FROM card_request_status WHERE status_type='send' OR status_type='reject' OR status_type='received')";
								$resultReq = mysqli_query($con, $getReq);
								if(mysqli_num_rows($resultReq) != 0){
									echo '<div class="form-group">
										<div class="container-fluid center-block">
											<table style="width:100%;" class="table table-striped">
											  <tr>
												<th>Request ID</th>
												<th>Requested Cards</th>
												<th>Send Cards</th>
												<th>Requested Date</th>
												<th>Send Date</th>
												<th>Station</th>
												<th>Status</th>
											  </tr>';
									while($rowResults = mysqli_fetch_array($resultReq)){
										$rID = $rowResults['request_id'];
										$rCards = $rowResults['no_of_cards_requested'];
										$sCards = $rowResults['no_of_cards_sent'];
										$rDate = $rowResults['requested_date'];
										$sDate = $rowResults['send_date'];
										$status = $rowResults['card_request_status_status_id'];
										$station = $rowResults['station_station_code'];
										$getStatus = "SELECT * FROM card_request_status WHERE status_id='".$status."'";
										$resultStatus = mysqli_query($con, $getStatus);
										if(mysqli_num_rows($resultStatus) != 0){
											while($rowStatus = mysqli_fetch_array($resultStatus)){
												$statusName = $rowStatus['status_type'];
												echo '<tr>
														<td>'.$rID.'</td>
														<td>'.$rCards.'</td>
														<td>'.$sCards.'</td>
														<td>'.$rDate.'</td>
														<td>'.$sDate.'</td>
														<td>'.$station.'</td>
														<td>'.$statusName.'</td>
													  </tr>';
											}
										}
									}
									echo '</table>
											</div>
										</div>';
								} else {
									//no results
									echo '<h3 class="text-center" style="padding:50px;">No Results To Display.</h3>';
								}
							} else if($q == "received"){
								$getReq = "SELECT * FROM card_request WHERE card_request_status_status_id IN (SELECT status_id FROM card_request_status WHERE status_type='received')";
								$resultReq = mysqli_query($con, $getReq);
								if(mysqli_num_rows($resultReq) != 0){
									echo '<div class="form-group">
										<div class="container-fluid center-block">
											<table style="width:100%;" class="table table-striped">
											  <tr>
												<th>Request ID</th>
												<th>Requested Cards</th>
												<th>Send Cards</th>
												<th>Requested Date</th>
												<th>Send Date</th>
												<th>Station</th>
												<th>Status</th>
											  </tr>';
									while($rowResults = mysqli_fetch_array($resultReq)){
										$rID = $rowResults['request_id'];
										$rCards = $rowResults['no_of_cards_requested'];
										$sCards = $rowResults['no_of_cards_sent'];
										$rDate = $rowResults['requested_date'];
										$sDate = $rowResults['send_date'];
										$status = $rowResults['card_request_status_status_id'];
										$station = $rowResults['station_station_code'];
										$getStatus = "SELECT * FROM card_request_status WHERE status_id='".$status."'";
										$resultStatus = mysqli_query($con, $getStatus);
										if(mysqli_num_rows($resultStatus) != 0){
											while($rowStatus = mysqli_fetch_array($resultStatus)){
												$statusName = $rowStatus['status_type'];
												echo '<tr>
														<td>'.$rID.'</td>
														<td>'.$rCards.'</td>
														<td>'.$sCards.'</td>
														<td>'.$rDate.'</td>
														<td>'.$sDate.'</td>
														<td>'.$station.'</td>
														<td>'.$statusName.'</td>
													  </tr>';
											}
										}
									}
									echo '</table>
											</div>
										</div>';
								} else {
									//no results
									echo '<h3 class="text-center" style="padding:50px;">No Results To Display.</h3>';
								}
							} else if($q == "rejected"){
								$getReq = "SELECT * FROM card_request WHERE card_request_status_status_id IN (SELECT status_id FROM card_request_status WHERE status_type='reject')";
								$resultReq = mysqli_query($con, $getReq);
								if(mysqli_num_rows($resultReq) != 0){
									echo '<div class="form-group">
										<div class="container-fluid center-block">
											<table style="width:100%;" class="table table-striped">
											  <tr>
												<th>Request ID</th>
												<th>Requested Cards</th>
												<th>Send Cards</th>
												<th>Requested Date</th>
												<th>Send Date</th>
												<th>Station</th>
												<th>Status</th>
											  </tr>';
									while($rowResults = mysqli_fetch_array($resultReq)){
										$rID = $rowResults['request_id'];
										$rCards = $rowResults['no_of_cards_requested'];
										$sCards = $rowResults['no_of_cards_sent'];
										$rDate = $rowResults['requested_date'];
										$sDate = $rowResults['send_date'];
										$status = $rowResults['card_request_status_status_id'];
										$station = $rowResults['station_station_code'];
										$getStatus = "SELECT * FROM card_request_status WHERE status_id='".$status."'";
										$resultStatus = mysqli_query($con, $getStatus);
										if(mysqli_num_rows($resultStatus) != 0){
											while($rowStatus = mysqli_fetch_array($resultStatus)){
												$statusName = $rowStatus['status_type'];
												echo '<tr>
														<td>'.$rID.'</td>
														<td>'.$rCards.'</td>
														<td>'.$sCards.'</td>
														<td>'.$rDate.'</td>
														<td>'.$sDate.'</td>
														<td>'.$station.'</td>
														<td>'.$statusName.'</td>
													  </tr>';
											}
										}
									}
									echo '</table>
											</div>
										</div>';
								} else {
									//no results
									echo '<h3 class="text-center" style="padding:50px;">No Results To Display.</h3>';
								}
							} else if($q == "issued"){
								$getReq = "SELECT * FROM card_request WHERE card_request_status_status_id IN (SELECT status_id FROM card_request_status WHERE status_type='send')";
								$resultReq = mysqli_query($con, $getReq);
								if(mysqli_num_rows($resultReq) != 0){
									echo '<div class="form-group">
										<div class="container-fluid center-block">
											<table style="width:100%;" class="table table-striped">
											  <tr>
												<th>Request ID</th>
												<th>Requested Cards</th>
												<th>Send Cards</th>
												<th>Requested Date</th>
												<th>Send Date</th>
												<th>Station</th>
												<th>Status</th>
											  </tr>';
									while($rowResults = mysqli_fetch_array($resultReq)){
										$rID = $rowResults['request_id'];
										$rCards = $rowResults['no_of_cards_requested'];
										$sCards = $rowResults['no_of_cards_sent'];
										$rDate = $rowResults['requested_date'];
										$sDate = $rowResults['send_date'];
										$status = $rowResults['card_request_status_status_id'];
										$station = $rowResults['station_station_code'];
										$getStatus = "SELECT * FROM card_request_status WHERE status_id='".$status."'";
										$resultStatus = mysqli_query($con, $getStatus);
										if(mysqli_num_rows($resultStatus) != 0){
											while($rowStatus = mysqli_fetch_array($resultStatus)){
												$statusName = $rowStatus['status_type'];
												echo '<tr>
														<td>'.$rID.'</td>
														<td>'.$rCards.'</td>
														<td>'.$sCards.'</td>
														<td>'.$rDate.'</td>
														<td>'.$sDate.'</td>
														<td>'.$station.'</td>
														<td>'.$statusName.'</td>
													  </tr>';
											}
										}
									}
									echo '</table>
											</div>
										</div>';
								} else {
									//no results
									echo '<h3 class="text-center" style="padding:50px;">No Results To Display.</h3>';
								}
							} else {
								// wrong html id
								echo '<h3 class="text-center" style="padding:50px;">No Results To Display.</h3>';
							}
						} else {
							// wrong html id
							echo '<h3 class="text-center" style="padding:50px;">No Results To Display.</h3>';
						}
					} else {
						// no html id
						echo '<h3 class="text-center" style="padding:50px;">No Results To Display.</h3>';
					}
				} else if($_SESSION['position'] == "stationMaster"){
					if(!empty($_REQUEST["r"])){
						$r = trim(htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST["r"])));
						if($r == "cardStatus"){
							$nic = $_SESSION['nic'];
							$getStation = "SELECT station_code FROM station WHERE employee_nic='".$nic."'";
							$resultStation = mysqli_query($con, $getStation);
							if(mysqli_num_rows($resultStation) != 0){
								while($rowS = mysqli_fetch_array($resultStation)){
									$sCode = $rowS['station_code'];
								}
								if($q == "all"){
									$getReq = "SELECT * FROM card_request WHERE card_request_status_status_id IN (SELECT status_id FROM card_request_status WHERE status_type='send' OR status_type='reject' OR status_type='received') AND station_station_code='".$sCode."'";
									$resultReq = mysqli_query($con, $getReq);
									if(mysqli_num_rows($resultReq) != 0){
										echo '<div class="form-group">
											<div class="container-fluid center-block">
												<table style="width:100%;" class="table table-striped">
												  <tr>
													<th>Request ID</th>
													<th>Requested Cards</th>
													<th>Send Cards</th>
													<th>Requested Date</th>
													<th>Send Date</th>
													<th>Station</th>
													<th>Status</th>
												  </tr>';
										while($rowResults = mysqli_fetch_array($resultReq)){
											$rID = $rowResults['request_id'];
											$rCards = $rowResults['no_of_cards_requested'];
											$sCards = $rowResults['no_of_cards_sent'];
											$rDate = $rowResults['requested_date'];
											$sDate = $rowResults['send_date'];
											$status = $rowResults['card_request_status_status_id'];
											$station = $rowResults['station_station_code'];
											$getStatus = "SELECT * FROM card_request_status WHERE status_id='".$status."'";
											$resultStatus = mysqli_query($con, $getStatus);
											if(mysqli_num_rows($resultStatus) != 0){
												while($rowStatus = mysqli_fetch_array($resultStatus)){
													$statusName = $rowStatus['status_type'];
													echo '<tr>
															<td>'.$rID.'</td>
															<td>'.$rCards.'</td>
															<td>'.$sCards.'</td>
															<td>'.$rDate.'</td>
															<td>'.$sDate.'</td>
															<td>'.$station.'</td>
															<td>'.$statusName.'</td>
														  </tr>';
												}
											}
										}
										echo '</table>
												</div>
											</div>';
									} else {
										//no results
										echo '<h3 class="text-center" style="padding:50px;">No Results To Display.</h3>';
									}
								} else if($q == "received"){
									$getReq = "SELECT * FROM card_request WHERE card_request_status_status_id IN (SELECT status_id FROM card_request_status WHERE status_type='received') AND station_station_code='".$sCode."'";
									$resultReq = mysqli_query($con, $getReq);
									if(mysqli_num_rows($resultReq) != 0){
										echo '<div class="form-group">
											<div class="container-fluid center-block">
												<table style="width:100%;" class="table table-striped">
												  <tr>
													<th>Request ID</th>
													<th>Requested Cards</th>
													<th>Send Cards</th>
													<th>Requested Date</th>
													<th>Send Date</th>
													<th>Station</th>
													<th>Status</th>
												  </tr>';
										while($rowResults = mysqli_fetch_array($resultReq)){
											$rID = $rowResults['request_id'];
											$rCards = $rowResults['no_of_cards_requested'];
											$sCards = $rowResults['no_of_cards_sent'];
											$rDate = $rowResults['requested_date'];
											$sDate = $rowResults['send_date'];
											$status = $rowResults['card_request_status_status_id'];
											$station = $rowResults['station_station_code'];
											$getStatus = "SELECT * FROM card_request_status WHERE status_id='".$status."'";
											$resultStatus = mysqli_query($con, $getStatus);
											if(mysqli_num_rows($resultStatus) != 0){
												while($rowStatus = mysqli_fetch_array($resultStatus)){
													$statusName = $rowStatus['status_type'];
													echo '<tr>
															<td>'.$rID.'</td>
															<td>'.$rCards.'</td>
															<td>'.$sCards.'</td>
															<td>'.$rDate.'</td>
															<td>'.$sDate.'</td>
															<td>'.$station.'</td>
															<td>'.$statusName.'</td>
														  </tr>';
												}
											}
										}
										echo '</table>
												</div>
											</div>';
									} else {
										//no results
										echo '<h3 class="text-center" style="padding:50px;">No Results To Display.</h3>';
									}
								} else if($q == "rejected"){
									$getReq = "SELECT * FROM card_request WHERE card_request_status_status_id IN (SELECT status_id FROM card_request_status WHERE status_type='reject') AND station_station_code='".$sCode."'";
									$resultReq = mysqli_query($con, $getReq);
									if(mysqli_num_rows($resultReq) != 0){
										echo '<div class="form-group">
											<div class="container-fluid center-block">
												<table style="width:100%;" class="table table-striped">
												  <tr>
													<th>Request ID</th>
													<th>Requested Cards</th>
													<th>Send Cards</th>
													<th>Requested Date</th>
													<th>Send Date</th>
													<th>Station</th>
													<th>Status</th>
												  </tr>';
										while($rowResults = mysqli_fetch_array($resultReq)){
											$rID = $rowResults['request_id'];
											$rCards = $rowResults['no_of_cards_requested'];
											$sCards = $rowResults['no_of_cards_sent'];
											$rDate = $rowResults['requested_date'];
											$sDate = $rowResults['send_date'];
											$status = $rowResults['card_request_status_status_id'];
											$station = $rowResults['station_station_code'];
											$getStatus = "SELECT * FROM card_request_status WHERE status_id='".$status."'";
											$resultStatus = mysqli_query($con, $getStatus);
											if(mysqli_num_rows($resultStatus) != 0){
												while($rowStatus = mysqli_fetch_array($resultStatus)){
													$statusName = $rowStatus['status_type'];
													echo '<tr>
															<td>'.$rID.'</td>
															<td>'.$rCards.'</td>
															<td>'.$sCards.'</td>
															<td>'.$rDate.'</td>
															<td>'.$sDate.'</td>
															<td>'.$station.'</td>
															<td>'.$statusName.'</td>
														  </tr>';
												}
											}
										}
										echo '</table>
												</div>
											</div>';
									} else {
										//no results
										echo '<h3 class="text-center" style="padding:50px;">No Results To Display.</h3>';
									}
								} else if($q == "issued"){
									$getReq = "SELECT * FROM card_request WHERE card_request_status_status_id IN (SELECT status_id FROM card_request_status WHERE status_type='send') AND station_station_code='".$sCode."'";
									$resultReq = mysqli_query($con, $getReq);
									if(mysqli_num_rows($resultReq) != 0){
										echo '<div class="form-group">
											<div class="container-fluid center-block">
												<table style="width:100%;" class="table table-striped">
												  <tr>
													<th>Request ID</th>
													<th>Requested Cards</th>
													<th>Send Cards</th>
													<th>Requested Date</th>
													<th>Send Date</th>
													<th>Station</th>
													<th>Status</th>
												  </tr>';
										while($rowResults = mysqli_fetch_array($resultReq)){
											$rID = $rowResults['request_id'];
											$rCards = $rowResults['no_of_cards_requested'];
											$sCards = $rowResults['no_of_cards_sent'];
											$rDate = $rowResults['requested_date'];
											$sDate = $rowResults['send_date'];
											$status = $rowResults['card_request_status_status_id'];
											$station = $rowResults['station_station_code'];
											$getStatus = "SELECT * FROM card_request_status WHERE status_id='".$status."'";
											$resultStatus = mysqli_query($con, $getStatus);
											if(mysqli_num_rows($resultStatus) != 0){
												while($rowStatus = mysqli_fetch_array($resultStatus)){
													$statusName = $rowStatus['status_type'];
													echo '<tr>
															<td>'.$rID.'</td>
															<td>'.$rCards.'</td>
															<td>'.$sCards.'</td>
															<td>'.$rDate.'</td>
															<td>'.$sDate.'</td>
															<td>'.$station.'</td>
															<td>'.$statusName.'</td>
														  </tr>';
												}
											}
										}
										echo '</table>
												</div>
											</div>';
									} else {
										//no results
										echo '<h3 class="text-center" style="padding:50px;">No Results To Display.</h3>';
									}
								} else {
									// wrong html id
									echo '<h3 class="text-center" style="padding:50px;">No Results To Display.</h3>';
								}
							} else {
								// wrong station
								echo '<h3 class="text-center" style="padding:50px;">No Results To Display.</h3>';
							}
							
						} else {
							// no html id
							echo '<h3 class="text-center" style="padding:50px;">No Results To Display.</h3>';
						}
					} else {
						// no html id
						echo '<h3 class="text-center" style="padding:50px;">No Results To Display.</h3>';	
					}  
				} else { 
					// 404 wrong operation
					header('Location:../404.php');	
				}
			} else { 
				// 404 wrong operation
				header('Location:../404.php');	
			}
		}  else {
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
?>
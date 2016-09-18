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
	} else if("") {
		if($q != ""){
			$hint .= '<div class="form-group">
							<div class="container-fluid center-block">
								<table style="width:100%;" class="table table-striped">
								  <tr>
									<th>Request ID</th>
									<th>Station Name</th>
									<th>Station Master</th>
									<th>Number of Cards Requested</th>
									<th>Number of Cards Send</th>
									<th>Status</th>
								  </tr>
								  <tr>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
								  </tr>
								  <tr>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
								  </tr>
								  <tr>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
								  </tr>
								</table>
							</div>
			 			</div>';
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
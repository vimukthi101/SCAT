<?php
include_once('../ssi/links.html');
include_once('../ssi/db.php');
?>
<!DOCTYPE html>
<html>
<head>
</head>
<?php
//user input
$q = trim(htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST["q"])));
//operation : view/update/delete
$p = trim(htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST["p"])));
//day
$r = trim(htmlspecialchars(mysqli_real_escape_string($con, $_REQUEST["r"])));
if($p != ""){
	if($r != ""){
		if($p == "view"){
			if ($q != "") {
				$get = "SELECT * FROM timetable WHERE train_date='".$r."' AND line='".$q."' ORDER BY train_time";
				$result = mysqli_query($con, $get);
				if(mysqli_num_rows($result) != 0){
					echo '<div class="form-group">
						<div class="container-fluid center-block">
							<table style="width:100%;" class="table table-striped">
							  <tr>
								<th>Time</th>
								<th>Train</th>
								<th>Type</th>
								<th>Station</th>
								<th>Added By</th>
							  </tr>';
					while($row = mysqli_fetch_array($result)){
						$time = $row['train_time'];
						$train = $row['train_train_id'];
						$nic = $row['employee_nic'];
						$station = $row['station_station_code'];
						$getTrain = "SELECT * FROM train WHERE train_id='".$train."'";
						$resultTrain = mysqli_query($con, $getTrain);
						if(mysqli_num_rows($resultTrain) != 0){
							while($rowTrain = mysqli_fetch_array($resultTrain)){
								$tName = $rowTrain['train_name'];
								$tType = $rowTrain['train_type_type_id'];
							}
						}
						$getStation = "SELECT * FROM station WHERE station_code='".$station."'";
						$resultStation = mysqli_query($con, $getStation);
						if(mysqli_num_rows($resultStation) != 0){
							while($rowStation = mysqli_fetch_array($resultStation)){
								$stName = $rowStation['station_name'];
							}
						}
						$getEmp = "SELECT * FROM NAME WHERE name_id IN (SELECT name_id FROM employee WHERE nic='".$nic."')";
						$resultEmp = mysqli_query($con, $getEmp);
						if(mysqli_num_rows($resultEmp) != 0){
							while($rowEmp = mysqli_fetch_array($resultEmp)){
								$fName = $rowEmp['first_name'];
								$sName = $rowEmp['second_name'];
								$lName = $rowEmp['last_name'];
							}
						}
						echo '<tr>
						<td>'.$time.'</td>
						<td>'.$train.' - '.$tName.'</td>
						<td>'.$tType.'</td>
						<td>'.$station.' - '.$stName.'</td>
						<td>'.$fName.' '.$sName.' '.$lName.'</td>
					  </tr>';
					}
					echo '</table>
						</div><a style="text-decoration:none;" href="timeTable.php?r='.$r.'&q='.$q.'"><input type="button" onClick="return confirm(\'Do You Wish to Go to Screen Preview?\');return false;" value="Screen View" class="btn btn-success center-block"/></a>
					</div>';
				} else {
					//if no result to show
					echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';
				}			  
			} else {
				//if empty q
				echo '<h3 class="text-center" style="padding:50px;">Please Select A Value To Search.</h3>';
			}
		} else if($p == "delete"){
			if ($q != "") {
				$get = "SELECT * FROM timetable WHERE timetable_id='".$q."'";
				$result = mysqli_query($con, $get);
				if(mysqli_num_rows($result) != 0){
					while($row = mysqli_fetch_array($result)){
						$ttId = $row['timetable_id'];
						$time = $row['train_time'];
						$l = $row['line'];
						$train = $row['train_train_id'];
						$d = $row['train_date'];
						$nic = $row['employee_nic'];
						$station = $row['station_station_code'];
						switch($l){
							case 'matara':
								$line = 'Colombo - Matara';
								break;
							case 'kandy':
								$line = 'Colombo - Kandy';
								break;
							case 'vauniya':
								$line = 'Colombo - Vauniya';
								break;
							case 'taleimannar':
								$line = 'Colombo - Taleimannar';
								break;
							case 'jaffna':
								$line = 'Colombo - Jaffna';
								break;
							default :
								break;
						}
						switch($d){
							case 'sun':
								$date = 'Sunday';
								break;
							case 'mon':
								$date = 'Monday';
								break;
							case 'tus':
								$date = 'Tuesday';
								break;
							case 'wed':
								$date = 'Wednesday';
								break;
							case 'thu':
								$date = 'Thursday';
								break;
							case 'fri':
								$date = 'Friday';
								break;
							case 'sat':
								$date = 'Saturday';
								break;
							default :
								break;
						}
						echo '<form role="form" class="form-horizontal" method="post" action="controller/deleteTimeTableController.php">
								<input class="form-control" type="hidden" name="tId" id="tId" value="'.$ttId.'" readonly/>
								<div class="form-group">
									<label for="line" class="control-label col-md-3">Line</label>
									<div class="col-md-8">
										<input type="text" class="form-control" value="'.$line.'" readonly>
									</div>
								</div>
								<div class="form-group">
									<label for="date" class="control-label col-md-3">Date</label>
									<div class="col-md-8">
										<input type="text" class="form-control" value="'.$date.'" readonly>
									</div>
								</div>
								<div class="form-group">
									<label for="time" class="control-label col-md-3">Time</label>
									<div class="col-md-8">
										<input type="text" class="form-control" value="'.$time.'" readonly>
									</div>
								</div>
								<div class="form-group">
									<label for="train" class="control-label col-md-3">Train</label>
									<div class="col-md-8">
										<input type="text" class="form-control" value="'.$train.'" readonly>
									</div>
								</div>
								<div class="form-group">
									<label for="station" class="control-label col-md-3">Station</label>
									<div class="col-md-8">
										<input type="text" class="form-control" value="'.$station.'" readonly>
									</div>
								</div>
								<div class="form-group col-md-11 text-center">
									<input type="submit" id="submit" name="submit" value="Delete" class="btn btn-danger"  onclick="return confirm(\'Do You Wish to Delete Time Table?\');return false;"/>
								</div>
							</form>';
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
				echo '<h3 class="text-center" style="padding:50px;">Please Select A Value To Search.</h3>';
			}
		} else { 
			//wrong operation
			echo '<h3 class="text-center" style="padding:50px;">Please Select A Value To Search.</h3>';
		}
	} else { 
		//if empty r
		echo '<h3 class="text-center" style="padding:50px;">Please Select A Value To Search.</h3>';
	}
} else { 
	//if empty p
	echo '<h3 class="text-center" style="padding:50px;">Please Select A Value To Search.</h3>';
}
?>
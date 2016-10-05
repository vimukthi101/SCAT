<?php
include_once('../ssi/links.html');
include_once('../ssi/db.php');
?>
<!DOCTYPE html>
<html>
<head>
</head>
<?php
//line
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
			//if empty q
			echo '<h3 class="text-center" style="padding:50px;">Please Select A Value To Search.</h3>';
		}
	} else { 
		//if empty q
		echo '<h3 class="text-center" style="padding:50px;">Please Select A Value To Search.</h3>';
	}
} else { 
	//if empty q
	echo '<h3 class="text-center" style="padding:50px;">Please Select A Value To Search.</h3>';
}
?>
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
</head>
<?php 
//value enter by user
if (!empty($_REQUEST["q"])) {
	$q = trim(htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST["q"])));
	$nic = $_SESSION['nic'];
	$getStation = "SELECT station_code FROM staff WHERE employee_nic='".$nic."'";
	$resultStation = mysqli_query($con, $getStation);
	if(mysqli_num_rows($resultStation)!=0){
		while($rowStation = mysqli_fetch_array($resultStation)){
			$inStation = $rowStation['station_code'];
		}
		$get = "SELECT station_name FROM station WHERE station_code IN (SELECT out_station_code FROM payment_terminal WHERE terminal_line='".$q."' AND in_station_code='".$inStation."')";
		$result = mysqli_query($con, $get);
		if(mysqli_num_rows($result) != 0){
			echo '<div class=col-md-12>';
			while($row = mysqli_fetch_array($result)){
				$outStation = $row['station_name'];
				echo '<div class=col-md-2>'.$outStation.'</div>';
			}
			echo '</div>';
		} else {
			//if no result to show
			echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';
		}
	} else {
		//if no result to show
		echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';
	}
} else { 
	//if no result to show
	echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';
}
?>
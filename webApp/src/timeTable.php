<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position'])){
	if($_SESSION['position'] == "updater"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('../ssi/links.html');
	include_once('../ssi/db.php');
?>
<title>Time Table Management</title>
</head>

<body style="background-image:url(../images/4.jpg);background-repeat:no-repeat;background-size:cover;">
<div>
	<?php
        include_once('../ssi/timeTableHeader.php');
    ?>
</div>
<div class="container-fluid text-capitalize" style="padding:0px;margin:0px;">
	<div>
    </div>
    <div class="col-md-11 center-block" style="padding:20px;margin:50px;">
        <div class="text-center" style="padding:10px;">
        	<?php
				if(isset($_GET['r']) && isset($_GET['q'])){
					$r = $_GET['r'];
					$q = $_GET['q'];
					$get = "SELECT * FROM timetable WHERE train_date='".$r."' AND line='".$q."' ORDER BY train_time";
					$result = mysqli_query($con, $get);
					if(mysqli_num_rows($result) != 0){
						echo '<table class="table table-responsive table-bordered table-striped text-center">
								<tr>
									<th class="text-center">TIME</th>
									<th class="text-center">DESTINATION</th>
									<th class="text-center">TRAIN</th>
									<th class="text-center">TRAIN TYPE</th>
								</tr>';
						while($row = mysqli_fetch_array($result)){
							$time = $row['train_time'];
							$train = $row['train_train_id'];
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
							echo '<tr>
									<td>'.$time.'</td>
									<td>'.$stName.'</td>
									<td>'.$train.' '.$tName.'</td>
									<td>'.$tType.'</td>
								</tr>';
						}
						echo '</table>';
					}
				}
			?>
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
<?php
	//errors will not be shown
	//error_reporting(0);
	include_once('../ssi/db.php');
	if(!empty($_POST['trainId']) && !empty($_POST['latitude']) && !empty($_POST['longitude'])){
		//get data
		$tId = trim($_POST['trainId']);
		$lat = trim($_POST['latitude']);
		$lon = trim($_POST['longitude']);
		if(preg_match('/^\d+$/',$tId)){
			if(preg_match('/^(\d)+\.(\d)+$/',$lat)){
				if(preg_match('/^(\d)+\.(\d)+$/',$lon)){
					$trainId = htmlspecialchars(mysql_real_escape_string($tId));
					$latitude = htmlspecialchars(mysql_real_escape_string($lat));
					$longitude = htmlspecialchars(mysql_real_escape_string($lon));
					$getData = "SELECT * FROM gps WHERE train_train_id='".$trainId."'";
					$resultData = mysqli_query($con, $getData);
					if(mysqli_num_rows($resultData)!=0){
						//update
						$date = date("Y-m-d H:i:s");
						$update = "UPDATE gps SET time_stamp='".$date."', lat='".$latitude."', lon='".$longitude."' WHERE train_train_id='".$trainId."'";
						if(mysqli_query($con, $update)){
							echo "SUCCESS";
						} else {
							echo "FAIL";
						}
					} else {
						//insert
						$date = date("Y-m-d H:i:s");
						$insert = "INSERT INTO gps (train_train_id, time_stamp, lat, lon) VALUES ('".$trainId."','".$date."','".$latitude."','".$longitude."')";
						if(mysqli_query($con, $insert)){
							echo "SUCCESS";
						} else {
							echo "FAIL";
						}
					}
				} else {
					//invalid longitude
					echo "LON";
				}
			} else {
				//invalid latitude
				echo "LAT";
			}
		} else {
			//invalid train id
			echo "TID";	
		}
	} else {
		//empty data
		echo "EMPTY";
	}
?>
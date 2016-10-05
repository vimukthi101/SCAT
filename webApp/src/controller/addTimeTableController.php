<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	if(isset($_SESSION['position'])){
		if($_SESSION['position'] == "updater"){
			if(isset($_POST['submit'])){
				if(!empty($_POST['day']) || !empty($_POST['line']) || !empty($_POST['tNo']) || !empty($_POST['time']) || !empty($_POST['station'])){
					$d = trim($_POST['day']);
					$l = trim($_POST['line']);
					$n = trim($_POST['tNo']);
					$t = trim($_POST['time']);
					$s = trim($_POST['station']);
					$day = htmlspecialchars(mysqli_real_escape_string($con, $d));
					$line = htmlspecialchars(mysqli_real_escape_string($con, $l));
					$train = htmlspecialchars(mysqli_real_escape_string($con, $n));
					$time = htmlspecialchars(mysqli_real_escape_string($con, $t));
					$station = htmlspecialchars(mysqli_real_escape_string($con, $s));
					$eNic = $_SESSION['nic'];
					$get = "SELECT station_code FROM staff WHERE employee_nic='".$eNic."'";
					$result = mysqli_query($con, $get);
					if(mysqli_num_rows($result) != 0){
						while($row = mysqli_fetch_array($result)){
							$eStation = $row['station_code'];
						}
						if($eStation != $station){
							$getTT = "SELECT * FROM timetable WHERE line='".$line."' AND train_time='".$time."' AND train_date='".$day."'";
							$resultTT = mysqli_query($con, $getTT);
							if(mysqli_num_rows($resultTT)==0){
								$check = "SELECT * FROM timetable WHERE train_train_id='".$train."' AND train_date='".$day."' AND train_time='".$time."'";
								$resultCheck = mysqli_query($con, $check);
								if(mysqli_num_rows($resultCheck)==0){
									$getStation = "SELECT * FROM station WHERE station_code='".$station."'";
									$resultStation = mysqli_query($con, $getStation);
									if(mysqli_num_rows($resultStation)!=0){
										$getTrain = "SELECT * FROM train WHERE train_id='".$train."'";
										$resultTrain = mysqli_query($con, $getTrain);
										if(mysqli_num_rows($resultTrain)!=0){
											$insert = "INSERT INTO timetable(train_time, train_train_id, employee_nic, station_station_code, line, train_date) VALUES('".$time."','".$train."','".$eNic."','".$station."','".$line."','".$day."')";
											if(mysqli_query($con, $insert)){
												//success
												header('Location:../addTimeTable.php?error=su');
											} else {
												//query failed
												header('Location:../addTimeTable.php?error=qf');
											}
										} else {
											//wrong Train
											header('Location:../addTimeTable.php?error=wt');
										}
									} else {
										//wrong station
										header('Location:../addTimeTable.php?error=ws');
									}
								} else {
									//train have another schedule
									header('Location:../addTimeTable.php?error=te');
								}
							} else {
								//train exist with same date time on the same line
								header('Location:../addTimeTable.php?error=ae');
							}
						} else {
							//same station
							header('Location:../addTimeTable.php?error=ss');
						}
					} else {
						//if not updater
						header('Location:../../404.php');	
					}
				} else {
					//empty fields redirect to cards
					header('Location:../addTimeTable.php?error=ef');
				}
			} else {
				//if submit button is not clicked
				header('Location:../../404.php');	
			}
		} else {
			//if not updater
			header('Location:../../404.php');	
		}
	} else {
		//if session not set
		header('Location:../../404.php');	
	}
?>
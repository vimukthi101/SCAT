<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	if(isset($_SESSION['position']) && $_SESSION['position'] == "sysadmin"){
		if(isset($_POST['submit'])){
			if(!empty($_POST['sCode']) && !empty($_POST['sName']) && !empty($_POST['smID']) && !empty($_POST['oldNIC']) && !empty($_POST['oldName'])){
				$cno = trim($_POST['sCode']);
				$p = trim($_POST['sName']);
				$cp = trim($_POST['smID']);
				$old = trim($_POST['oldNIC']);
				$n = trim($_POST['oldName']);
				$stationCode = htmlspecialchars(mysqli_real_escape_string($con, $cno));
				$stationName = htmlspecialchars(mysqli_real_escape_string($con, $p));
				$stationMaster = htmlspecialchars(mysqli_real_escape_string($con, $cp));
				$OldstationMaster = htmlspecialchars(mysqli_real_escape_string($con, $old));
				$Oldstation = htmlspecialchars(mysqli_real_escape_string($con, $n));
				if(preg_match('/^[a-zA-Z]+$/',$stationCode)){
					if(preg_match('/^[a-zA-Z]+$/',$stationName)){
						$getSM = "SELECT * FROM staff WHERE employee_nic='".$stationMaster."' AND employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='stationMaster')";
						$resultSM = mysqli_query($con, $getSM);
						if(mysqli_num_rows($resultSM) != 0){
							if($OldstationMaster == $stationMaster){
								//SM not changed
								if($Oldstation == $stationName){
									//name not changed
									//success
									header('Location:../updateStations.php?error=su');
								} else {
									//name changed
									$getStation = "SELECT * FROM station WHERE station_name='".$stationName."'";
									$resultStation = mysqli_query($con, $getStation);
									if(mysqli_num_rows($resultStation) == 0){
										$updateStation = "UPDATE station SET station_name='".$stationName."' WHERE station_code='".$stationCode."'";
										if(mysqli_query($con, $updateStation)){
											//success
											header('Location:../updateStations.php?error=su');
										} else {
											//query failed
											header('Location:../updateStations.php?error=qf');
										}
									} else {
										//already exists
										header('Location:../updateStations.php?error=aes');
									}
								}
							} else {
								//SM changed
								if($Oldstation == $stationName){
									//name not changed
									$getStation = "SELECT * FROM station WHERE employee_nic='".$stationMaster."'";
									$resultStation = mysqli_query($con, $getStation);
									if(mysqli_num_rows($resultStation) == 0){
										$updateStation = "UPDATE station SET employee_nic='".$stationMaster."' WHERE station_code='".$stationCode."'";
										if(mysqli_query($con, $updateStation)){
											//success
											header('Location:../updateStations.php?error=su');
										} else {
											//query failed
											header('Location:../updateStations.php?error=qf');
										}
									} else {
										//already exists
										header('Location:../updateStations.php?error=ae');
									}
								} else {
									//name changed
									$getStation = "SELECT * FROM station WHERE station_name='".$stationName."' OR employee_nic='".$stationMaster."'";
									$resultStation = mysqli_query($con, $getStation);
									if(mysqli_num_rows($resultStation) == 0){
										$updateStation = "UPDATE station SET station_name='".$stationName."', employee_nic='".$stationMaster."' WHERE station_code='".$stationCode."'";
										if(mysqli_query($con, $updateStation)){
											//success
											header('Location:../updateStations.php?error=su');
										} else {
											//query failed
											header('Location:../updateStations.php?error=qf');
										}
									} else {
										//already exists
										header('Location:../updateStations.php?error=aea');
									}
								}
							}
						} else {
							//SM invalid
							header('Location:../updateStations.php?error=ws');
						}
					} else {
						//wrong station Name format
						header('Location:../updateStations.php?error=wn');
					}
				} else {
					//wrong station code format
					header('Location:../updateStations.php?error=wc');
				}
			} else {
				//empty fields redirect to cards
				header('Location:../updateStations.php?error=ef');
			}
		} else {
			//redirect to form not submit 404
			header('Location:../../404.php');	
		}
	} else {
		//error page 404
		header('Location:../../404.php');
	}	
?>
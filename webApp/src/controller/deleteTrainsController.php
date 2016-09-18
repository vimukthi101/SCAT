<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	if(isset($_SESSION['position']) && $_SESSION['position'] == "sysadmin"){
		if(isset($_POST['submit'])){
			if(!empty($_POST['tCode']) && !empty($_POST['tName']) && !empty($_POST['tType'])){
				$cno = trim($_POST['tCode']);
				$p = trim($_POST['tName']);
				$cp = trim($_POST['tType']);
				$trainCode = htmlspecialchars(mysqli_real_escape_string($con, $cno));
				$trainName = htmlspecialchars(mysqli_real_escape_string($con, $p));
				$trainType = htmlspecialchars(mysqli_real_escape_string($con, $cp));
				if(preg_match('/^\d+$/',$trainCode)){
					if(preg_match('/^[a-zA-Z]+$|^$/',$trainName)){
						if(preg_match('/^[a-zA-Z]+$/',$trainType)){
							$getTrains = "SELECT * FROM train WHERE train_name='".$trainName."'";
							$resultTrains = mysqli_query($con, $getTrains);
							if(mysqli_num_rows($resultTrains) != 0){
								$getTrain = "SELECT * FROM timetable WHERE train_train_id='".$trainCode."'";
								$resultTrain = mysqli_query($con, $getTrain);
								if(mysqli_num_rows($resultTrain) == 0){
									//not used in timetable
									$delete = "DELETE FROM train WHERE train_id='".$trainCode."'";
									if(mysqli_query($con, $delete)){
										//success
										header('Location:../deleteTrains.php?error=su');
									} else {
										//query failed
										header('Location:../deleteTrains.php?error=qf');
									}
								} else {
									//used in timetable cannot delete
									header('Location:../deleteTrains.php?error=ae');
								}
							} else {
								//not found
								header('Location:../deleteTrains.php?error=nf');
							}
						} else {
							//wrong train type format
							header('Location:../deleteTrains.php?error=wt');
						}
					} else {
						//wrong train name format
						header('Location:../deleteTrains.php?error=wn');
					}
				} else {
					//wrong train code format
					header('Location:../deleteTrains.php?error=wc');
				}
			} else {
				//empty fields redirect to cards
				header('Location:../deleteTrains.php?error=ef');
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
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
							if(mysqli_num_rows($resultTrains) == 0){
								$update = "UPDATE train SET train_name='".$trainName."', train_type_type_id='".$trainType."' WHERE train_id='".$trainCode."'";
								if(mysqli_query($con, $update)){
									//success
									header('Location:../updateTrains.php?error=su');
								} else {
									//query failed	
									header('Location:../updateTrains.php?error=qf');
								}
							} else {
								//exists
								header('Location:../updateTrains.php?error=ae');
							}
						} else {
							//wrong train type format
							header('Location:../updateTrains.php?error=wt');
						}
					} else {
						//wrong train name format
						header('Location:../updateTrains.php?error=wn');
					}
				} else {
					//wrong train code format
					header('Location:../updateTrains.php?error=wc');
				}
			} else {
				//empty fields redirect to cards
				header('Location:../updateTrains.php?error=ef');
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
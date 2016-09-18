<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	if(isset($_SESSION['position']) && $_SESSION['position'] == "sysadmin"){
		if(isset($_POST['submit'])){
			if(!empty($_POST['tId']) && !empty($_POST['tName'])){
				$t = trim($_POST['tId']);
				$n = trim($_POST['tName']);
				$typeId = htmlspecialchars(mysqli_real_escape_string($con, $t));
				$typeName = htmlspecialchars(mysqli_real_escape_string($con, $n));
				if(preg_match('/^[a-zA-Z]+$/',$typeId)){
					if(preg_match('/^[a-zA-Z]+$/',$typeName)){
						$getTrains = "SELECT * FROM train WHERE train_type_type_id='".$typeId."'";
						$resultGetTrains = mysqli_query($con, $getTrains);
						if(mysqli_num_rows($resultGetTrains) == 0){
							$deleteTypes = "DELETE FROM train_type WHERE type_id='".$typeId."'";
							if(mysqli_query($con, $deleteTypes)){
								//success
								header('Location:../deleteTrainTypes.php?error=su');
							} else {
								//query failes
								header('Location:../deleteTrainTypes.php?error=qf');
							}
						} else {
							//used in a train
							header('Location:../deleteTrainTypes.php?error=ae');
						}
					} else {
						//wrong name format
						header('Location:../deleteTrainTypes.php?error=wn');
					}
				} else {
					//wrong id format
					header('Location:../deleteTrainTypes.php?error=wi');
				}
			} else {
				//empty fields redirect to cards
				header('Location:../deleteTrainTypes.php?error=ef');
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
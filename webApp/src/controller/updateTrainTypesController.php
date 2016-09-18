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
						$getTypes = "SELECT * FROM train_type WHERE type_name='".$typeName."'";
						$resultGetTypes = mysqli_query($con, $getTypes);
						if(mysqli_num_rows($resultGetTypes) == 0){
							$updateTypes = "UPDATE train_type SET type_name='".$typeName."' WHERE type_id='".$typeId."'";
							if(mysqli_query($con, $updateTypes)){
								//success
								header('Location:../updateTrainTypes.php?error=su');
							} else {
								//query failes
								header('Location:../updateTrainTypes.php?error=qf');
							}
						} else {
							//exists	
							header('Location:../updateTrainTypes.php?error=ae');
						}
					} else {
						//wrong name format
						header('Location:../updateTrainTypes.php?error=wn');
					}
				} else {
					//wrong id format
					header('Location:../updateTrainTypes.php?error=wi');
				}
			} else {
				//empty fields redirect to cards
				header('Location:../updateTrainTypes.php?error=ef');
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
<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	if(isset($_SESSION['position'])){
		if($_SESSION['position'] == "sysadmin"){
			if(isset($_POST['submit'])){
				if(!empty($_POST['tType']) && !empty($_POST['tId'])){
					$tType = trim($_POST['tType']);
					$tId = trim($_POST['tId']);
					$trainType = htmlspecialchars(mysqli_real_escape_string($con, $tType));
					$trainTypeId = htmlspecialchars(mysqli_real_escape_string($con, $tId));
					if(preg_match('/^[a-zA-Z]+$/', $trainType)){
						if(preg_match('/^[a-zA-Z]+$/', $trainTypeId)){
							$getTypes = "SELECT * FROM train_type WHERE type_name='".$trainType."' OR type_id='".$trainTypeId."'";
							$resultTypes = mysqli_query($con, $getTypes);
							if(mysqli_num_rows($resultTypes) == 0){
								$addType = "INSERT INTO train_type VALUES('".$trainTypeId."','".$trainType."')";
								if(mysqli_query($con, $addType)){
									//success
									header('Location:../addTrainTypes.php?error=su');
								} else {
									//query failed
									header('Location:../addTrainTypes.php?error=qf');
								}
							} else {
								//type or name exists
								header('Location:../addTrainTypes.php?error=te');
							}
						} else {
							//wrong format for ID
							header('Location:../addTrainTypes.php?error=wf');
						}
					} else {
						//wrong format for name
						header('Location:../addTrainTypes.php?error=wf');
					}
				} else {
					//empty fields redirect to cards
					header('Location:../addTrainTypes.php?error=ef');
				}
			} else {
				//if submit button is not clicked
				header('Location:../../404.php');	
			}
		} else {
			//if not sysadmin
			header('Location:../../404.php');	
		}
	} else {
		//if session not set
		header('Location:../../404.php');	
	}
?>
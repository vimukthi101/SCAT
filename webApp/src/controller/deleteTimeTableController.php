<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	if(isset($_SESSION['position']) && $_SESSION['position'] == "updater"){
		if(isset($_POST['submit'])){
			if(!empty($_POST['tId'])){
				$id = trim($_POST['tId']);
				$tId = htmlspecialchars(mysqli_real_escape_string($con, $id));
				$gettt = "SELECT * FROM timetable WHERE timetable_id='".$tId."'";
				$resulttt = mysqli_query($con, $gettt);
				if(mysqli_num_rows($resulttt) != 0){
					$deletett = "DELETE FROM timetable WHERE timetable_id='".$tId."'";
					if(mysqli_query($con, $deletett)){
						//success
						header('Location:../deleteTimeTable.php?error=su');
					} else {
						//query failed
						header('Location:../deleteTimeTable.php?error=qf');
					}
				} else {
					//no tt
					header('Location:../deleteTimeTable.php?error=nc');
				}
			} else {
				//empty fields redirect to cards
				header('Location:../deleteTimeTable.php?error=ef');
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
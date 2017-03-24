<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	if(isset($_SESSION['position']) && $_SESSION['position'] == "sysadmin"){
		if(isset($_POST['submit'])){
			if(!empty($_POST['iStation']) && !empty($_POST['oStation']) && !empty($_POST['class']) && !empty($_POST['fee'])){
				$is = trim($_POST['iStation']);
				$os = trim($_POST['oStation']);
				$c = trim($_POST['class']);
				$f = trim($_POST['fee']);
				$inStation = htmlspecialchars(mysqli_real_escape_string($con, $is));
				$outStation = htmlspecialchars(mysqli_real_escape_string($con, $os));
				$class = htmlspecialchars(mysqli_real_escape_string($con, $c));
				$fee = htmlspecialchars(mysqli_real_escape_string($con, $f));
				if(preg_match('/^\d+\.(\d{2})$/',$fee)){
					$update = "UPDATE ticket SET ticket_fee='".$fee."' WHERE station_in_station_code='".$inStation."' AND station_out_station_code='".$outStation."' AND class='".$class."'";
					if(mysqli_query($con, $update)){
						//success
						header('Location:../updateTickets.php?error=su');
					} else {
						//query failed
						header('Location:../updateTickets.php?error=qf');
					}
				} else {
					//wrong new fee format
					header('Location:../updateTickets.php?error=wn');
				}
			} else {
				//empty fields redirect to cards
				header('Location:../updateTickets.php?error=ef');
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
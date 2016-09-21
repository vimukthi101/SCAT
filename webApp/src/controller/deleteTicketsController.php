<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	if(isset($_SESSION['position']) && $_SESSION['position'] == "sysadmin"){
		if(isset($_POST['submit'])){
			if(!empty($_POST['oldtFee'])){
				$cno = trim($_POST['oldtFee']);
				$station = htmlspecialchars(mysqli_real_escape_string($con, $cno));
				$getStation = "SELECT * FROM station WHERE station_code='".$station."'";
				$resultStation = mysqli_query($con, $getStation);
				if(mysqli_num_rows($resultStation) != 0){
					$payment = "SELECT * FROM payment WHERE ticket_id IN (SELECT ticket_id FROM ticket WHERE station_in_station_code='".$station."' OR station_out_station_code='".$station."')";
					$resultPayment = mysqli_query($con, $payment);
					if(mysqli_num_rows($resultPayment) == 0){
						$delete = "DELETE FROM ticket WHERE station_in_station_code='".$station."' OR station_out_station_code='".$station."'";
						if(mysqli_query($con, $delete)){
							//success
							header('Location:../deleteTickets.php?error=su');
						} else {
							//query failed
							header('Location:../deleteTickets.php?error=qf');
						}
					} else {
						//cannot delete, in use	
						header('Location:../deleteTickets.php?error=ae');
					}
				} else {
					//wrong old fee format
					header('Location:../deleteTickets.php?error=wo');
				}
			} else {
				//empty fields redirect to cards
				header('Location:../deleteTickets.php?error=ef');
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
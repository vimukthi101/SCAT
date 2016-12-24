<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	if(isset($_SESSION['position']) && ($_SESSION['position'] == "stationMaster")){
		if(isset($_POST['submit'])){
			if(!empty($_POST['id'])){
				$id = $_POST['id'];
				$nic = $_SESSION['nic'];
				$udpate = "UPDATE registrar_final_payment SET payment_status='1', payment_received_by='".$nic."' WHERE payment_id='".$id."'";
				if(mysqli_query($con, $udpate)){
					//success
					header('Location:../registrarIncome.php?error=su');	
				} else {
					//failed	
					header('Location:../registrarIncome.php?error=qf');	
				}
			} else {
				//redirect to form empty fields
				header('Location:../registrarIncome.php?error=er');		
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
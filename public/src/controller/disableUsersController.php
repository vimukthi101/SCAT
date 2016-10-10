<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	if(isset($_SESSION['nic'])){
			if(isset($_POST['nic'])){
				if(!empty($_POST['nic'])){
					$nic = $_POST['nic'];
					$deactivateUser = "UPDATE commuter SET STATUS='0' WHERE nic='".$nic."'";
					if(mysqli_query($con, $deactivateUser)){
						//sucessfully deactivated
						session_destroy();
						header('Location:../index.php?error=bl');
					} else {
						//query failed
						header('Location:../disableUsers.php?error=qf');
					}
				} else {
					//error page 404
					header('Location:../../404.php');	
				}
			} else {
				//error page 404
				header('Location:../../404.php');
			}
	} else {
		//error page 404
		header('Location:../../404.php');
	}	
?>
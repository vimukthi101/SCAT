<?php
if(!isset($_SESSION[''])){
	session_start();
}
include_once('../../ssi/db.php');
if(isset($_COOKIE['station']) && isset($_COOKIE['terminal'])){
	if(isset($_SESSION['pass']) && isset($_SESSION['credit']) && isset($_SESSION['comuuter_nic']) && isset($_SESSION['attempt'])){
		if(!empty($_POST['pin'])){
			$p = $_POST['pin'];
			if(preg_match('/^\d{4}$/',$p)){
				$pin = trim(htmlspecialchars(mysqli_real_escape_string($con, $p)));
				if($_SESSION['pass'] = $pin){
					//send to select station page
					header('Location:../destination.php');
				} else {
					//wrong pin
					$attempt = $_SESSION['attempt'];
					$nic = $_SESSION['nic'];
					if($attempt >= 2){
						$update = "UPDATE commuter SET STATUS='0', login_attempt = login_attempt + 1 WHERE nic=''".$nic."";	
					} else {
						$update = "UPDATE commuter SET login_attempt = login_attempt + 1 WHERE nic=''".$nic."";
					}
					if(mysqli_num_rows($update)){
						//send to the enter pin page
						header('Location:../enterPin.php');
					}
				}
			} else {
				//wrong pin format
					
			}
		} else {
			//empty pin
			
		}
	} else {
		session_destroy();
		header('Location:../welcome.php');
	}
} else {
	session_destroy();
	header('Location:404.php');
}
?>

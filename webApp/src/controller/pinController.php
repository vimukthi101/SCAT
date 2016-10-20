<?php
if(!isset($_SESSION[''])){
	session_start();
}
include_once('../../ssi/db.php');
if(isset($_COOKIE['station']) && isset($_COOKIE['terminal'])){
	if(isset($_SESSION['pass']) && isset($_SESSION['credit']) && isset($_SESSION['commuter_nic']) && isset($_SESSION['attempt'])){
		if(!empty($_POST['pin'])){
			$p = $_POST['pin'];
			if(preg_match('/^\d{4}$/',$p)){
				$pin = md5(trim(htmlspecialchars(mysqli_real_escape_string($con, $p))));
				if($_SESSION['pass'] == $pin){
					//send to select station page
					header('Location:../destination.php');
				} else {
					//wrong pin
					$attempt = $_SESSION['attempt'];
					$nic = $_SESSION['commuter_nic'];
					if($attempt >= 2){
						$update = "UPDATE commuter SET STATUS='0', login_attempt = login_attempt + 1 WHERE nic='".$nic."'";	
						if(mysqli_query($con, $update)){
							//send to the welcome page : user blocked
							$_SESSION['attempt'] = $_SESSION['attempt'] + 1;
							header('Location:../welcome.php?error=bu');
						}
					} else {
						$update = "UPDATE commuter SET login_attempt = login_attempt + 1 WHERE nic='".$nic."'";
						if(mysqli_query($con, $update)){
							//send to the enter pin page
							$_SESSION['attempt'] = $_SESSION['attempt'] + 1;
							header('Location:../enterPin.php?error=ip');
						}
					}
				}
			} else {
				//wrong pin format
				header('Location:../enterPin.php?error=wf');
			}
		} else {
			//empty pin
			header('Location:../enterPin.php?error=ep');
		}
	} else {
		session_destroy();
		header('Location:../welcome.php');
	}
} else {
	session_destroy();
	header('Location:../../505.php');
}
?>

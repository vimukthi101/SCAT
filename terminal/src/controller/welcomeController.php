<?php
if(!isset($_SESSION[''])){
	session_start();
}
include_once('../../ssi/db.php');
if(isset($_COOKIE['station']) && isset($_COOKIE['terminal'])){
	if(!empty($_POST['cardNo'])){
		$cNo = $_POST['cardNo'];
		if(preg_match('/^\d{16}$/',$cNo)){
			$cardNo = trim(htmlspecialchars(mysqli_real_escape_string($con, $cNo)));
			$get = "SELECT * FROM commuter WHERE card_card_no='".$cardNo."'";
			$result = mysqli_query($con, $get);
			if(mysqli_num_rows($result)!=0){
				while($row = mysqli_fetch_array($result)){
					$pass = $row['password'];
					$status = $row['status'];
					$credit = $row['credit'];
					$nic = $row['nic'];
					$loginAttempt = $row['login_attempt'];
					if($status == 1){
						//send to enter pin page
						$_SESSION['pass'] = $pass;
						$_SESSION['comuuter_nic'] = $nic;
						$_SESSION['credit'] = $credit;
						$_SESSION['attempt'] = $loginAttempt;
						header('Location:../enterPin.php');
					} else {
						//user is blocked
						
					}
				}
			} else {
				//wrong card number
				
			}
		} else {
			//wrong card number format
				
		}
	} else {
		//empty card number
		
	}
} else {
	session_destroy();
	header('Location:404.php');
}
?>

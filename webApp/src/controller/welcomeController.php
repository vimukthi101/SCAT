<?php
if(!isset($_SESSION[''])){
	session_start();
}
include_once('../../ssi/db.php');
if(isset($_COOKIE['station']) && isset($_COOKIE['terminal'])){
	if(!empty($_GET['cardNo'])){
		$cNo = $_GET['cardNo'];
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
						$_SESSION['commuter_nic'] = $nic;
						$_SESSION['credit'] = $credit;
						$_SESSION['attempt'] = $loginAttempt;
						$update = "UPDATE card_reading SET STATUS='1'";
						if(mysqli_query($con, $update));
						header('Location:../enterPin.php');
					} else {
						//user is blocked
						$update = "UPDATE card_reading SET STATUS='1'";
						if(mysqli_query($con, $update));
						header('Location:../welcome.php?error=ub');
					}
				}
			} else {
				//wrong card number
				$update = "UPDATE card_reading SET STATUS='1'";
				if(mysqli_query($con, $update));
				header('Location:../welcome.php?error=iu');
			}
		} else {
			//wrong card number format
			$update = "UPDATE card_reading SET STATUS='1'";
			if(mysqli_query($con, $update));
			header('Location:../welcome.php?error=wf');
		}
	} else {
		//empty card number
		$update = "UPDATE card_reading SET STATUS='1'";
		if(mysqli_query($con, $update));
		header('Location:../welcome.php?error=ec');
	}
} else {
	session_destroy();
	$update = "UPDATE card_reading SET STATUS='1'";
	header('Location:../../505.php');
}
?>

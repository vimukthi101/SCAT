<?php
if(!isset($_SESSION[''])){
	session_start();
}
include_once('../ssi/db.php');
if(!empty($_POST['cardNo'])){
	$cNo = $_POST['cardNo'];
	if(preg_match('/^\d{16}$/',$cNo)){
		$cardNo = trim(htmlspecialchars(mysqli_real_escape_string($con, $cNo)));
		$get = "SELECT * FROM card_reading WHERE STATUS='0'";
		$result = mysqli_query($con, $get);
		if(mysqli_num_rows($result)==0){
			$add = "INSERT INTO card_reading(card_number) VALUES ('".$cardNo."')";
			if(mysqli_query($con, $add)){
				
			}
		}
	}
}
?>

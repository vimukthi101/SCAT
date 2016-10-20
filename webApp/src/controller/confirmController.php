<?php
if(!isset($_SESSION[''])){
	session_start();
}
include_once('../../ssi/db.php');
if(isset($_COOKIE['station']) && isset($_COOKIE['terminal'])){
	if(isset($_SESSION['ticketId']) && isset($_SESSION['date']) && isset($_SESSION['noOfTickets']) && isset($_SESSION['commuter_nic']) && isset($_SESSION['amount'])){
		$tID = $_SESSION['ticketId'];
		$date = $_SESSION['date'];
		$no = $_SESSION['noOfTickets'];
		$nic = $_SESSION['commuter_nic'];
		$amount = $_SESSION['amount'];
		$insert = "INSERT INTO payment(ticket_id, payment_date_time, no_of_tickets, commuter_nic) VALUES('".$tID."','".$date."','".$no."','".$nic."')";
		if(mysqli_query($con, $insert)){
			$update = "UPDATE commuter SET credit= credit-'".$amount."' WHERE nic='".$nic."'";
			if(mysqli_query($con, $update)){
				//success
				header('Location:../thankyou.php');
			} else {
				//query failed
				header('Location:../confirm.php');
			} 
		} else {
			//query failed
			header('Location:../confirm.php');
		}
	} else {
		//empty sessions
		session_destroy();
		header('Location:../welcome.php');
	}
} else {
	session_destroy();
	header('Location:../../505.php');
}
?>

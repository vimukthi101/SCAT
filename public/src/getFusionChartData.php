<?php
if(!isset($_SESSION[''])){
	session_start();
}
include_once('../ssi/db.php');				
if(isset($_GET['key']) && !empty($_GET['key'])){
	if(isset($_GET['value']) && !empty($_GET['value'])){
		$value = $_GET['value'];
		$key = $_GET['key'];
		if($key == "commuter"){
			$nic = $_SESSION['nic'];
			$getDate = "SELECT	CURDATE()";
			$resultGetDate = mysqli_query($con, $getDate);
			if(mysqli_num_rows($resultGetDate)!=0){
				while($rowGetDate = mysqli_fetch_array($resultGetDate)){
					$date = $rowGetDate['amount'];
				}
			}
			if($value == "payment"){
				$in = 0;
				$getSM = "SELECT ticket_id,no_of_tickets FROM payment WHERE payment_date_time LIKE '".$date."%' AND commuter_nic='".$nic."'";
				$resultSM = mysqli_query($con, $getSM);
				if(mysqli_num_rows($resultSM)!=0){
					while($rowSM = mysqli_fetch_array($resultSM)){
						$ticketId = $rowSM['ticket_id'];
						$tickets = $rowSM['no_of_tickets'];
						$getTicket = "SELECT ticket_fee FROM ticket WHERE ticket_id='".$ticketId."'";
						$resultTicket = mysqli_query($con, $getTicket);
						if(mysqli_num_rows($resultTicket)!=0){
							while($rowTicket = mysqli_fetch_array($resultTicket)){
								$fee = $rowTicket['ticket_fee'];
							}
							$in += $fee * $tickets;
						}
					}
					echo '&value='.$in;
				} else {
					echo '&value=0';
				}
			} else if($value == "recharge"){
				$getSM = "SELECT SUM(amount) AS amount FROM recharge WHERE recharge_date_time LIKE '".$date."%' AND card_card_no IN (SELECT card_card_no FROM commuter WHERE nic='".$nic."')";
				$resultSM = mysqli_query($con, $getSM);
				if(mysqli_num_rows($resultSM)!=0){
					while($rowSM = mysqli_fetch_array($resultSM)){
						$amount = $rowSM['amount'];
						if($amount == null){
							echo '&value=0';
						} else {
							echo '&value='.$amount;		
						}
					}
				} else {
					echo '&value=0';
				}
			} else if($value == "travel"){
				$getSM = "SELECT COUNT(*) AS amount FROM payment WHERE payment_date_time LIKE '".$date."%' AND commuter_nic='".$nic."'";
				$resultSM = mysqli_query($con, $getSM);
				if(mysqli_num_rows($resultSM)!=0){
					while($rowSM = mysqli_fetch_array($resultSM)){
						$amount = $rowSM['amount'];
						if($amount == null){
							echo '&value=0';
						} else {
							echo '&value='.$amount;		
						}
					}
				} else {
					echo '&value=0';
				}
			}
		}
	}
}
?>
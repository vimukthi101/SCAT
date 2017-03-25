<?php
if(!isset($_SESSION[''])){
	session_start();
}
include_once('../../ssi/db.php');
include_once('../../ssi/smsSettings.php');
if(isset($_COOKIE['station']) && isset($_COOKIE['terminal'])){
	if(isset($_SESSION['ticketId']) && isset($_SESSION['date']) && isset($_SESSION['noOfTickets']) && isset($_SESSION['commuter_nic']) && isset($_SESSION['amount'])){
		$tID = $_SESSION['ticketId'];
		$inStation = $_COOKIE['station'];
		$outStation = $_SESSION['outStationName'];;
		$date = $_SESSION['date'];
		$no = $_SESSION['noOfTickets'];
		$nic = $_SESSION['commuter_nic'];
		$amount = $_SESSION['amount'];
		$insert = "INSERT INTO payment(ticket_id, payment_date_time, no_of_tickets, commuter_nic) VALUES('".$tID."','".$date."','".$no."','".$nic."')";
		if(mysqli_query($con, $insert)){
			$update = "UPDATE commuter SET credit= credit-'".$amount."' WHERE nic='".$nic."'";
			if(mysqli_query($con, $update)){
				$getContact = "SELECT * FROM commuter WHERE nic='".$nic."'";
				$resultGetContact = mysqli_query($con, $getContact);
				if(mysqli_num_rows($resultGetContact)!=0){
					while($rowGetContact = mysqli_fetch_array($resultGetContact)){
						$contact = $rowGetContact['contact_no'];
						$newCredit = $rowGetContact['credit'];
						//send SMS
						if(!empty($contact)){
							$newContact = "94". trim($contact,"0");
							$DestinationAddress = $newContact;
$Message = "Your payment for the ticket done successfuly! Your new balance is Rs.".$newCredit.".

Date : ".$date."
In Station : ".$inStation."
Out Station : ".$outStation."
No Of Tickets : ".$no."
Amout : ".$amount."

Thank You!
-SCAT System-";
							try {
								// Send SMS through the HTTP API
								$Result = $ViaNettSMS->SendSMS($MsgSender, $DestinationAddress, $Message);
								// Check result object returned and give response to end user according to success or not.
								if ($Result->Success == true){
									$Message = "Message successfully sent!";
								} else {
									$Message = "Error occured while sending SMS";
								}
							} catch (Exception $e) {
								//Error occured while connecting to server.
								//$Message = $e->getMessage();
								echo "error occurred";
							}
						}
					}
				}
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

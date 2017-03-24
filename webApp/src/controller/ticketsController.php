<?php
if(!isset($_SESSION[''])){
	session_start();
}
include_once('../../ssi/db.php');
if(isset($_COOKIE['station']) && isset($_COOKIE['terminal'])){
	if(isset($_SESSION['pass']) && isset($_SESSION['credit']) && isset($_SESSION['commuter_nic']) && isset($_SESSION['attempt']) && isset($_SESSION['outStation']) && isset($_SESSION['ticketClass']) ){
		if(!empty($_POST['ticket'])){
			$p = $_POST['ticket'];
			if(preg_match('/^\d+$/',$p)){
				$tickets = trim(htmlspecialchars(mysqli_real_escape_string($con, $p)));
				$in = $_COOKIE['station'];
				$credit = $_SESSION['credit'];
				$out = $_SESSION['outStation'];
				$ticketClass = $_SESSION['ticketClass'];
				$get = "SELECT * FROM ticket WHERE (station_in_station_code='".$in."' AND station_out_station_code='".$out."' AND class='".$ticketClass."') OR (station_in_station_code='".$out."' AND station_out_station_code='".$in."' AND class='".$ticketClass."')";
				$result = mysqli_query($con, $get);
				if(mysqli_num_rows($result)!=0){
					while($row = mysqli_fetch_array($result)){
						$ticketId = $row['ticket_id'];
						$ticketFee = $row['ticket_fee'];
					}
					$amount = $ticketFee * $tickets;
					if($amount <= $credit){
						//redirect to confirm page
						$_SESSION['amount'] = $amount;
						$_SESSION['noOfTickets'] = $tickets;
						$_SESSION['ticketId'] = $ticketId;
						header('Location:../confirm.php');
					} else {
						//insufficient balance
						header('Location:../commuters.php?error=ib');
					}
				} else {
					//no ticket
					header('Location:../destination.php?error=it');
				}
			} else {
				//wrong tickets number format
				header('Location:../commuters.php?error=wf');
			}
		} else {
			//empty tickets number
			header('Location:../commuters.php?error=et');
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

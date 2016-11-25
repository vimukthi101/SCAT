<?php
if(!isset($_SESSION[''])){
	session_start();
}
include_once('../ssi/db.php');				
if(isset($_GET['key']) && !empty($_GET['key'])){
	if(isset($_GET['value']) && !empty($_GET['value'])){
		$value = $_GET['value'];
		$key = $_GET['key'];
		if($key == "position"){
			$getSM = "SELECT COUNT(*) AS countSM FROM employee WHERE nic IN (SELECT employee_nic FROM staff WHERE employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='".$value."')) AND STATUS='1'";
			$resultSM = mysqli_query($con, $getSM);
			if(mysqli_num_rows($resultSM)!=0){
				while($rowSM = mysqli_fetch_array($resultSM)){
					$countSM = $rowSM['countSM'];
					echo '&value='.$countSM;
				}
			} else {
				echo '&value=0';
			}
		} else if($key == "status"){
			$getSM = "SELECT COUNT(*) AS COUNT FROM card_request WHERE card_request_status_status_id IN (SELECT status_id FROM card_request_status WHERE status_type='request')";
			$resultSM = mysqli_query($con, $getSM);
			if(mysqli_num_rows($resultSM)!=0){
				while($rowSM = mysqli_fetch_array($resultSM)){
					$countSM = $rowSM['COUNT'];
					echo '&value='.$countSM;
				}
			} else {
				echo '&value=0';
			}
		} else if($key == "trains"){
			$getSM = "SELECT COUNT(*) AS COUNT FROM train";
			$resultSM = mysqli_query($con, $getSM);
			if(mysqli_num_rows($resultSM)!=0){
				while($rowSM = mysqli_fetch_array($resultSM)){
					$countSM = $rowSM['COUNT'];
					echo '&value='.$countSM;
				}
			} else {
				echo '&value=0';
			}
		} else if($key == "stations"){
			$getSM = "SELECT COUNT(*) AS COUNT FROM station";
			$resultSM = mysqli_query($con, $getSM);
			if(mysqli_num_rows($resultSM)!=0){
				while($rowSM = mysqli_fetch_array($resultSM)){
					$countSM = $rowSM['COUNT'];
					echo '&value='.$countSM;
				}
			} else {
				echo '&value=0';
			}
		} else if($key == "commuter"){
			$getSM = "SELECT COUNT(*) AS COUNT FROM card WHERE issued_to_commuter='1'";
			$resultSM = mysqli_query($con, $getSM);
			if(mysqli_num_rows($resultSM)!=0){
				while($rowSM = mysqli_fetch_array($resultSM)){
					$countSM = $rowSM['COUNT'];
					echo '&value='.$countSM;
				}
			} else {
				echo '&value=0';
			}
		} else if($key == "income"){
			$mydate = getdate(date("U"));
			$date = $mydate['year']."-".$mydate['mon']."-".$mydate['mday'];
			if($value == "travel"){
				$in = 0;
				$getSM = "SELECT ticket_id,no_of_tickets FROM payment WHERE payment_date_time LIKE '".$date."%'";
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
				$getSM = "SELECT SUM(amount) AS amount FROM recharge WHERE recharge_date_time LIKE '".$date."%'";
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
			} else if($value == "registration"){
				$getSM = "SELECT SUM(reg_fee) AS amount FROM commuter_regfee WHERE regfee_id IN (SELECT commuter_regfee_regfee_id FROM registrar_payment WHERE payment_date_time LIKE '".$date."%')";
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
		} else if($key == "station"){
			$nic = $_SESSION['nic'];
			$getStation = "SELECT station_code FROM station WHERE employee_nic='".$nic."'";
			$resultStation = mysqli_query($con, $getStation);
			if(mysqli_num_rows($resultStation)!=0){
				while($rowStation = mysqli_fetch_array($resultStation)){
					$station = $rowStation['station_code'];
				}
			}
			$mydate = getdate(date("U"));
			$date = $mydate['year']."-".$mydate['mon']."-".$mydate['mday'];
			if($value == "travel"){
				$in = 0;
				$getSM = "SELECT ticket_id,no_of_tickets FROM payment WHERE payment_date_time LIKE '".$date."%'";
				$resultSM = mysqli_query($con, $getSM);
				if(mysqli_num_rows($resultSM)!=0){
					while($rowSM = mysqli_fetch_array($resultSM)){
						$ticketId = $rowSM['ticket_id'];
						$tickets = $rowSM['no_of_tickets'];
						$getTicket = "SELECT ticket_fee FROM ticket WHERE ticket_id='".$ticketId."' AND station_in_station_code='".$station."'";
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
				$getSM = "SELECT SUM(amount) AS amount FROM recharge WHERE recharge_date_time LIKE '".$date."%' AND employee_nic IN (SELECT employee_nic FROM topup_agent WHERE station_code='".$station."')";
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
			} else if($value == "registration"){
				$getSM = "SELECT SUM(reg_fee) AS amount FROM commuter_regfee WHERE regfee_id IN (SELECT commuter_regfee_regfee_id FROM registrar_payment WHERE payment_date_time LIKE '".$date."%' AND employee_nic IN (SELECT employee_nic FROM staff WHERE station_code='".$station."'))";
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
			} else if ($value == "commuter"){
				$getSM = "SELECT COUNT(*) AS COUNT FROM card WHERE issued_to_commuter='1' AND station_station_code='".$station."'";
				$resultSM = mysqli_query($con, $getSM);
				if(mysqli_num_rows($resultSM)!=0){
					while($rowSM = mysqli_fetch_array($resultSM)){
						$countSM = $rowSM['COUNT'];
						echo '&value='.$countSM;
					}
				} else {
					echo '&value=0';
				}	
			}
		} else if($key == "registrar"){
			$nic = $_SESSION['nic'];
			$mydate = getdate(date("U"));
			$date = $mydate['year']."-".$mydate['mon']."-".$mydate['mday'];
			if($value == "registration"){
				$getSM = "SELECT SUM(reg_fee) AS amount FROM commuter_regfee WHERE regfee_id IN (SELECT commuter_regfee_regfee_id FROM registrar_payment WHERE payment_date_time LIKE '".$date."%' AND employee_nic='".$nic."')";
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
			} else if ($value == "commuter"){
				$getSM = "SELECT COUNT(commuter_nic) AS COUNT FROM registrar_payment WHERE payment_date_time LIKE '".$date."%' AND employee_nic='".$nic."'";
				$resultSM = mysqli_query($con, $getSM);
				if(mysqli_num_rows($resultSM)!=0){
					while($rowSM = mysqli_fetch_array($resultSM)){
						$countSM = $rowSM['COUNT'];
						echo '&value='.$countSM;
					}
				} else {
					echo '&value=0';
				}	
			}
		}
	}
}
?>
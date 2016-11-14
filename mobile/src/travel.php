<?php
include_once('../ssi/db.php');
if(!empty($_POST['nic'])){
	$nic = trim($_POST['nic']);
	$another = array();
	$query = "SELECT * FROM payment WHERE commuter_nic='".$nic."' ORDER BY payment_date_time DESC LIMIT 10";
	$result = mysqli_query($con, $query);
	if(mysqli_num_rows($result)!=0){
		while($row = mysqli_fetch_array($result)){
			$ticketId = $row['ticket_id'];
			$date = $row['payment_date_time'];
			$tickets = $row['no_of_tickets'];
			$getTicket = "SELECT * FROM ticket WHERE ticket_id='".$ticketId."'";
			$resultTicket = mysqli_query($con, $getTicket);
			if(mysqli_num_rows($resultTicket)!=0){
				while($rowTicket = mysqli_fetch_array($resultTicket)){
					$ticketFee = $rowTicket['ticket_fee'];
					$inStation = $rowTicket['station_in_station_code'];
					$outStation = $rowTicket['station_out_station_code'];
				}
				$amount = $tickets * $ticketFee;
			} else {
				echo "NODATA";	
			}
			$travel = array('date'=>$date,'inStation'=>$inStation,'outStation'=>$outStation,'noOfTickets'=>$tickets,'amount'=>$amount);
			array_push($another, $travel);
		}
		$arr = array('result'=>'SUCCESS','travel'=>$another);
		echo json_encode($arr);
	} else {
		echo "NODATA";	
	}
} else {
	echo "EMPTY";	
}
?>
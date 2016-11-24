<?php
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
			}
		} else if($key == "status"){
			$getSM = "SELECT COUNT(*) AS COUNT FROM card_request WHERE card_request_status_status_id IN (SELECT status_id FROM card_request_status WHERE status_type='request')";
			$resultSM = mysqli_query($con, $getSM);
			if(mysqli_num_rows($resultSM)!=0){
				while($rowSM = mysqli_fetch_array($resultSM)){
					$countSM = $rowSM['COUNT'];
					echo '&value='.$countSM;
				}
			}
		} else if($key == "trains"){
			$getSM = "SELECT COUNT(*) AS COUNT FROM train";
			$resultSM = mysqli_query($con, $getSM);
			if(mysqli_num_rows($resultSM)!=0){
				while($rowSM = mysqli_fetch_array($resultSM)){
					$countSM = $rowSM['COUNT'];
					echo '&value='.$countSM;
				}
			}
		} else if($key == "stations"){
			$getSM = "SELECT COUNT(*) AS COUNT FROM station";
			$resultSM = mysqli_query($con, $getSM);
			if(mysqli_num_rows($resultSM)!=0){
				while($rowSM = mysqli_fetch_array($resultSM)){
					$countSM = $rowSM['COUNT'];
					echo '&value='.$countSM;
				}
			}
		} else if($key == "commuter"){
			$getSM = "SELECT COUNT(*) AS COUNT FROM card WHERE issued_to_commuter='1'";
			$resultSM = mysqli_query($con, $getSM);
			if(mysqli_num_rows($resultSM)!=0){
				while($rowSM = mysqli_fetch_array($resultSM)){
					$countSM = $rowSM['COUNT'];
					echo '&value='.$countSM;
				}
			}
		}
	}
}
?>
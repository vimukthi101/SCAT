<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	if(isset($_SESSION['position'])){
		if($_SESSION['position'] == "topupAgent"){
			if(isset($_POST['submit'])){
				if(!empty($_POST['total'])){
					$totalSend = $_POST['total'];
					echo $total;
					$total = 0.00;
					$nic = $_SESSION['nic'];
					$query = "SELECT * FROM recharge WHERE employee_nic='".$nic."' AND send_status='0'";
					$result = mysqli_query($con, $query);
					if(mysqli_num_rows($result)!=0){
						while($row = mysqli_fetch_array($result)){
							$amount = $row['amount'];
							$total += $amount;
						}
						if($totalSend == $total){
							$date = date("Y-m-d H:i:s");
							$update = "UPDATE recharge SET send_status='1' WHERE send_status='0' AND employee_nic='".$nic."'";
							if(mysqli_query($con, $update)){
								$insert = "INSERT INTO topup_agent_payment(topup_agent_payment_fee, topup_agent_payment_status, employee_nic, topup_agent_payment_date) VALUES ('".$total."','0','".$nic."','".$date."')";
								if(mysqli_query($con, $insert)){
									//success
									header('Location:../sendToStation.php?error=su');
								} else {
									//failed
									header('Location:../sendToStation.php?error=qf');
								}
							} else {
								//failed
								header('Location:../sendToStation.php?error=qf');
							}
						} else {
							//not matching total
							header('Location:../sendToStation.php?error=nm');
						}
					}
				} else {
					//empty fields
					header('Location:../sendToStation.php?error=ef');
				}
			} else {
				//if submit button is not clicked
				header('Location:../../404.php');	
			}
		} else {
			//if not sysadmin
			header('Location:../../404.php');	
		}
	} else {
		//if session not set
		header('Location:../../404.php');	
	}
?>
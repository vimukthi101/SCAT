<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	if(isset($_SESSION['position'])){
		if($_SESSION['position'] == "registrar"){
			if(isset($_POST['submit'])){
				if(!empty($_POST['total'])){
					$totalSend = $_POST['total'];
					$total = 0.00;
					$nic = $_SESSION['nic'];
					$query = "SELECT * FROM registrar_payment WHERE STATUS='0' AND employee_nic='".$nic."'";
					$result = mysqli_query($con, $query);
					if(mysqli_num_rows($result)!=0){
						while($row = mysqli_fetch_array($result)){
							$id = $row['payment_id'];
							$date = $row['payment_date_time'];
							$regId = $row['commuter_regfee_regfee_id'];
							$getRegFee = "SELECT reg_fee FROM commuter_regfee WHERE regfee_id='".$regId."'";
							$resultRegFee = mysqli_query($con, $getRegFee);
							if(mysqli_num_rows($resultRegFee)){
								while($rowRegFee = mysqli_fetch_array($resultRegFee)){
									$fee = $rowRegFee['reg_fee'];
									$total += $fee;
								}
								if($totalSend == $total){
									$date = date("Y-m-d H:i:s");
									$update = "UPDATE registrar_payment SET status='1' WHERE status='0' AND employee_nic='".$nic."'";
									if(mysqli_query($con, $update)){
										$insert = "INSERT INTO registrar_final_payment(payment_fee, payment_status, payment_date, employee_nic) VALUES ('".$total."','0','".$date."','".$nic."')";
										if(mysqli_query($con, $insert)){
											//success
											header('Location:../registrarSendToStation.php?error=su');
										} else {
											//failed
											header('Location:../registrarSendToStation.php?error=qf');
										}
									} else {
										//failed
										header('Location:../registrarSendToStation.php?error=qf');
									}
								} else {
									//not matching total
									header('Location:../registrarSendToStation.php?error=nm');
								}
							}
						}
					}
				} else {
					//empty fields
					header('Location:../registrarSendToStation.php?error=ef');
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
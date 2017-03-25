<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	$nic = $_SESSION['nic'];
	include_once('../../ssi/db.php');
	include_once('../../ssi/smtpSettings.php');
	if(isset($_POST['submit'])){
		if(!empty($_POST['cards']) && !empty($_POST['cCards'])){
			$op = trim($_POST['cards']);
			$np = trim($_POST['cCards']);
			$Cards = htmlspecialchars(mysqli_real_escape_string($con, $op));
			$ConfirmCards = htmlspecialchars(mysqli_real_escape_string($con, $np));
			if($Cards == $ConfirmCards){
				if(preg_match('/^\d+$/', $Cards)){
					$getStation = "SELECT station_code FROM station WHERE employee_nic='".$nic."'";
					$resultStation = mysqli_query($con, $getStation);
					if(mysqli_num_rows($resultStation) != 0){
						while($rowStation = mysqli_fetch_array($resultStation)){
							$stationId = $rowStation['station_code'];
						}
						$date = date("Y-m-d H:i:s");
						$getStatus = "SELECT status_id FROM card_request_status WHERE status_type='request'";
						$resultStatus = mysqli_query($con, $getStatus);
						if(mysqli_num_rows($resultStatus) != 0){
							while($rowStatus = mysqli_fetch_array($resultStatus)){
								$statusId = $rowStatus['status_id'];
							}
							$insert = "INSERT INTO card_request(no_of_cards_requested, station_station_code, card_request_status_status_id, requested_date) VALUES ('".$Cards."','".$stationId."','".$statusId."','".$date."')";
							if(mysqli_query($con, $insert)){
								$getUsers = "SELECT employee_email FROM employee WHERE status=1 AND nic IN (SELECT employee_nic FROM staff WHERE employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='manager' OR POSITION='sysadmin'))";
								$resultUsers = mysqli_query($con, $getUsers);
								if(mysqli_num_rows($resultUsers)!=0){
									while($rowUsers = mysqli_fetch_array($resultUsers)){
										$email = $rowUsers['employee_email'];
										$to = $email;
										//send mail
										//Set who the message is to be sent to
										$mail->addAddress($to, $to);
										//Set the subject line
										$mail->Subject = "New Card Request";
$mail->Body = "Dear Manager/Sys Admin,

A new card request has being notified by the S.C.A.T. System. Please check below for more information,

	Requested Date : ".$date."
	Requested Cards : ".$Cards."
	Station Code : ".$stationId."

p.s. : Please do not reply to this email.

Thank You!
S.C.A.T System";
										if (!$mail->send()) {
											//success
											header('Location:../requestCards.php?error=su');
										}
									}
								}
								//success
								header('Location:../requestCards.php?error=su');
							} else {
								//query failed
								header('Location:../requestCards.php?error=qf');	
							}
						} else {
							//no status
							header('Location:../requestCards.php?error=er');
						}
					} else {
						//no station
						header('Location:../requestCards.php?error=er');
					}
				} else {
					//invalid format
					header('Location:../requestCards.php?error=if');	
				}
			} else {
				//if cards and confirm cards does not match
				header('Location:../requestCards.php?error=dm');	
			}
		} else {
			//if empty
			header('Location:../requestCards.php?error=ef');	
		}
	} else {
		//if not submitted
		header('Location:../../404.php');
	}
?>
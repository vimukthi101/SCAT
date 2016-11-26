<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	include_once('../../ssi/smtpSettings.php');
	if(isset($_SESSION['position']) && $_SESSION['position'] == "sysadmin"){
		if(isset($_POST['submit'])){
			if(!empty($_POST['sCode']) && !empty($_POST['sName']) && !empty($_POST['smID'])){
				$cno = trim($_POST['sCode']);
				$p = trim($_POST['sName']);
				$cp = trim($_POST['smID']);
				$stationCode = htmlspecialchars(mysqli_real_escape_string($con, $cno));
				$stationName = htmlspecialchars(mysqli_real_escape_string($con, $p));
				$stationMaster = htmlspecialchars(mysqli_real_escape_string($con, $cp));
				if(preg_match('/^[a-zA-Z]+$/',$stationCode)){
					if(preg_match('/^[a-zA-Z]+$/',$stationName)){
						$getSM = "SELECT * FROM staff WHERE employee_nic='".$stationMaster."' AND employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='stationMaster')";
						$resultSM = mysqli_query($con, $getSM);
						if(mysqli_num_rows($resultSM) != 0){
							$getCard = "SELECT * FROM card WHERE station_station_code='".$stationCode."'";
							$resultCard = mysqli_query($con, $getCard);
							if(mysqli_num_rows($resultCard) == 0){
								$getCardRequests = "SELECT * FROM card_request WHERE station_station_code='".$stationCode."'";
								$resultCardRequests = mysqli_query($con, $getCardRequests);
								if(mysqli_num_rows($resultCardRequests) == 0){
									$getTicket = "SELECT * FROM ticket WHERE station_in_station_code='".$stationCode."' OR station_out_station_code='".$stationCode."'";
									$resultGetTicket = mysqli_query($con, $getTicket);
									if(mysqli_num_rows($resultGetTicket) == 0){
										$deleteStation = "DELETE FROM station WHERE station_code='".$stationCode."'";
										if(mysqli_query($con, $deleteStation)){
											$update = "UPDATE staff SET station_code='none' WHERE employee_nic='".$stationMaster."'";
											if(mysqli_query($con, $update)){
												$getEmp = "SELECT employee_email FROM employee WHERE nic IN (SELECT employee_nic FROM staff WHERE employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='manager'))";
												$resultEmp = mysqli_query($con, $getEmp);
												if(mysqli_num_rows($resultEmp) != 0){
													while($rowEmail = mysqli_fetch_array($resultEmp)){
														//send email with new station
														$to = $rowEmail['employee_email'];	
														//Set who the message is to be sent to
														$mail->addAddress($to, $to);
														//Set the subject line
														$mail->Subject = "Station Has Being Deleted";
$mail->Body ="Dear Manager,

Following station has being removed from the system,

	Station Code : ".$stationCode."
	Station Name : ".$stationName."
	Station Master NIC : ".$stationMaster."

Thank You!
S.C.A.T Admin";
														if (!$mail->send()) {
															echo "Mailer Error: " . $mail->ErrorInfo;
														}
													}
												}
												//success
												header('Location:../deleteStations.php?error=su');
											} else {
												//query failed	
												header('Location:../deleteStations.php?error=qf');
											}
										} else {
											//query failed	
											header('Location:../deleteStations.php?error=qf');
										}
									} else {
										//used in tickets
										header('Location:../deleteStations.php?error=at');
									}
								} else {
									//used in card requests
									header('Location:../deleteStations.php?error=ar');	
								}
							} else {
								//used in cards
								header('Location:../deleteStations.php?error=ac');
							}
						} else {
							//SM invalid
							header('Location:../deleteStations.php?error=ws');
						}
					} else {
						//wrong station Name format
						header('Location:../deleteStations.php?error=wn');
					}
				} else {
					//wrong station code format
					header('Location:../deleteStations.php?error=wc');
				}
			} else {
				//empty fields redirect to cards
				header('Location:../deleteStations.php?error=ef');
			}
		} else {
			//redirect to form not submit 404
			header('Location:../../404.php');	
		}
	} else {
		//error page 404
		header('Location:../../404.php');
	}	
?>
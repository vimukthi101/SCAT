<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	include_once('../../ssi/smtpSettings.php');
	if(isset($_SESSION['position'])){
		if($_SESSION['position'] == "sysadmin"){
			if(isset($_POST['submit']) || isset($_POST['reject'])){
				if(isset($_POST['submit']) && $_POST['submit']){
					if(!empty($_POST['rID']) || !empty($_POST['nic']) || !empty($_POST['station']) || !empty($_POST['stationMaster']) || !empty($_POST['nRequest']) || !empty($_POST['date']) || !empty($_POST['nSend'])){
						$id = trim($_POST['rID']);
						$n = trim($_POST['nSend']);
						$ic = trim($_POST['nic']);
						$rDate = trim($_POST['date']);
						$nReq = trim($_POST['nRequest']);
						$station = trim($_POST['station']);
						$sm = trim($_POST['stationMaster']);
						$rID = htmlspecialchars(mysqli_real_escape_string($con, $id));
						$send = htmlspecialchars(mysqli_real_escape_string($con, $n));
						$nic = htmlspecialchars(mysqli_real_escape_string($con, $ic));
						if(preg_match('/^\d+$/', $send)){
							$getCard = "SELECT * FROM card_request WHERE request_id='".$rID."'";
							$resultCard = mysqli_query($con, $getCard);
							if(mysqli_num_rows($resultCard) != 0){
								while($rowCard = mysqli_fetch_array($resultCard)){
									$stationCode = $rowCard['station_station_code'];
								}
								$getStatus = "SELECT status_id FROM card_request_status WHERE status_type='send'";
								$resultStatus = mysqli_query($con, $getStatus);
								if(mysqli_num_rows($resultStatus) != 0){
									while($rowStatus = mysqli_fetch_array($resultStatus)){
										$statusId = $rowStatus['status_id'];
									}
								}
								$getCards = "SELECT COUNT(*) AS number FROM card WHERE station_station_code IS NULL";
								$resultCards = mysqli_query($con, $getCards);
								if(mysqli_num_rows($resultCards)!=0){
									while($rowCards = mysqli_fetch_array($resultCards)){
										$cards = $rowCards['number'];
										if($cards >= $send){
											//enough cards
											$getSet = "SELECT * FROM card WHERE station_station_code IS NULL LIMIT ".$send."";
											$resultSet = mysqli_query($con, $getSet);
											if(mysqli_num_rows($resultSet)!=0){
												while($rowSet = mysqli_fetch_array($resultSet)){
													$cardNo = $rowSet['card_no'];
													$pin = $rowSet['pin'];
													$updateSet = "UPDATE card SET station_station_code='".$stationCode."' WHERE card_no='".$cardNo."'";
													if(mysqli_query($con, $updateSet)){
														$date = date('Y-m-d H:i:s');
														$update = "UPDATE card_request SET no_of_cards_sent='".$send."', card_request_status_status_id='".$statusId."', send_date='".$date."' WHERE request_id='".$rID."'";
														if(mysqli_query($con, $update)){
															//success
														} else {
															//query failed	
															header('Location:../issueCards.php?error=qfi');
														}	
													} else {
														//query failed	
														header('Location:../issueCards.php?error=qfi');
													}
												}
												//send mail to station master
												$getEmp = "SELECT employee_email FROM employee WHERE nic='".$nic."'";
												$resultGetEmp = mysqli_query($con, $getEmp);
												if(mysqli_num_rows($resultGetEmp) != 0){
													while($rowEmp = mysqli_fetch_array($resultGetEmp)){
														$toSM = $rowEmp['employee_email'];
														//Set who the message is to be sent to
														$mail->addAddress($to, $to);
														//Set the subject line
														$mail->Subject = "Card Request Has Being Approved";
$mail->Body ="Dear Station Master,

Your Card request on ".$rDate." of ".$nReq." has being approved,

Approved Date : ".$date."
Approved Number Of Cards : ".$send."

Please change the status of card request to 'Received' when you received the set of cards.

Thank You!
S.C.A.T Admin";
													}
												}
												if (!$mail->send()) {
													//echo "Mailer Error: " . $mail->ErrorInfo;
													echo "error occurred";
												}
												//send mail to managers
												$getEmp = "SELECT employee_email FROM employee WHERE status=1 AND nic IN (SELECT employee_nic FROM staff WHERE employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='manager'))";
													$resultEmp = mysqli_query($con, $getEmp);
													if(mysqli_num_rows($resultEmp) != 0){
														while($rowEmail = mysqli_fetch_array($resultEmp)){
															//send email with rejected
															$to = $rowEmail['employee_email'];				
															//Set who the message is to be sent to
															$mail->addAddress($to, $to);
															//Set the subject line
															$mail->Subject = "Card Request Has Being Approved";
$mail->Body ="Dear Manager,

Card request on ".$rDate." of ".$nReq." from ".$station." has being approved,

Station Master : ".$sm."
Approved Date : ".$date."
Approved Number Of Cards : ".$send."

Thank You!
S.C.A.T Admin";
															if (!$mail->send()) {
																//success
																header('Location:../issueCards.php?error=sui');
															}
														}
													}
												//success
												header('Location:../issueCards.php?error=sui');
											} else {
												//query failed
												header('Location:../issueCards.php?error=qfi');
											}
										} else {
											//not enough cards
											header('Location:../issueCards.php?error=ne&num='.$cards);
										}
									}
								} else {
									//no cards
									header('Location:../issueCards.php?error=nc');
								}
							} else {
								//invalid card request	
								header('Location:../issueCards.php?error=ir');
							}
						} else {
							//invalid send card format	
							header('Location:../issueCards.php?error=wc');
						}
					} else {
						//empty fields redirect to cards
						header('Location:../issueCards.php?error=ef');
					}
				} else if(isset($_POST['reject']) && $_POST['reject']){
					if(!empty($_POST['rID']) || !empty($_POST['nic']) || !empty($_POST['station']) || !empty($_POST['stationMaster']) || !empty($_POST['nRequest']) || !empty($_POST['date'])){
						$id = trim($_POST['rID']);
						$ic = trim($_POST['nic']);
						$rDate = trim($_POST['date']);
						$nReq = trim($_POST['nRequest']);
						$station = trim($_POST['station']);
						$sm = trim($_POST['stationMaster']);
						$rID = htmlspecialchars(mysqli_real_escape_string($con, $id));
						$nic = htmlspecialchars(mysqli_real_escape_string($con, $ic));
						$getCard = "SELECT * FROM card_request WHERE request_id='".$rID."'";
						$resultCard = mysqli_query($con, $getCard);
						if(mysqli_num_rows($resultCard) != 0){
							$getStatus = "SELECT status_id FROM card_request_status WHERE status_type='reject'";
							$resultStatus = mysqli_query($con, $getStatus);
							if(mysqli_num_rows($resultStatus) != 0){
								while($rowStatus = mysqli_fetch_array($resultStatus)){
									$statusId = $rowStatus['status_id'];
								}
							}
							$date = date('Y-m-d H:i:s');
							$update = "UPDATE card_request SET no_of_cards_sent='0', card_request_status_status_id='".$statusId."', send_date='".$date."' WHERE request_id='".$rID."'";
							if(mysqli_query($con, $update)){
								//send mail to station master
								$getEmp = "SELECT employee_email FROM employee WHERE nic='".$nic."'";
								$resultGetEmp = mysqli_query($con, $getEmp);
								if(mysqli_num_rows($resultGetEmp) != 0){
									while($rowEmp = mysqli_fetch_array($resultGetEmp)){
										$toSM = $rowEmp['employee_email'];	
										//Set who the message is to be sent to
										$mail->addAddress($to, $to);
										//Set the subject line
										$mail->Subject = "Card Request Has Being Rejected";
$mail->Body ="Dear Station Master,

Your Card request on ".$rDate." of ".$nReq." has being rejected,

	Rejected Date : ".$date."

Please put another request if you think this is a mistake.

Thank You!
S.C.A.T Admin";
									}
								}
								if (!$mail->send()) {
									//echo "Mailer Error: " . $mail->ErrorInfo;
									echo "error occurred";
								}
								//send mail to managers
								$getEmp = "SELECT employee_email FROM employee WHERE nic IN (SELECT employee_nic FROM staff WHERE employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='manager'))";
									$resultEmp = mysqli_query($con, $getEmp);
									if(mysqli_num_rows($resultEmp) != 0){
										while($rowEmail = mysqli_fetch_array($resultEmp)){
											//send email with rejected
											$to = $rowEmail['employee_email'];	
											//Set who the message is to be sent to
											$mail->addAddress($to, $to);
											//Set the subject line
											$mail->Subject = "Card Request Has Being Rejected";
$mail->Body ="Dear Manager,

Card request on ".$rDate." of ".$nReq." from ".$station." has being rejected,

	Station Master : ".$sm."
	Rejected Date : ".$date."

Thank You!
S.C.A.T Admin";
											if (!$mail->send()) {
												//success
												header('Location:../issueCards.php?error=sur');
											}
										}
									}
								//success
								header('Location:../issueCards.php?error=sur');
							} else {
								//query failed	
								header('Location:../issueCards.php?error=qfr');
							}
						} else {
							//invalid card request	
							header('Location:../issueCards.php?error=ir');
						}
					} else {
						//empty fields redirect to cards
						header('Location:../issueCards.php?error=ef');
					}
				} else {
					header('Location:../../404.php');	
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
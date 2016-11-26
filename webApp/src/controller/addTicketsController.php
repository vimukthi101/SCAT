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
			if(isset($_POST['submit'])){
				if(!empty($_POST['iStation']) || !empty($_POST['oStation']) || !empty($_POST['tFee'])){
					$c = trim($_POST['iStation']);
					$n = trim($_POST['oStation']);
					$i = trim($_POST['tFee']);
					$iStation = htmlspecialchars(mysqli_real_escape_string($con, $c));
					$oStation = htmlspecialchars(mysqli_real_escape_string($con, $n));
					$tFee = htmlspecialchars(mysqli_real_escape_string($con, $i));
					if($iStation != $oStation){
						if(preg_match('/^\d+\.(\d{2})$/',$tFee)){
							$getType = "SELECT station_code FROM station WHERE station_code='".$iStation."'";
							$resultType = mysqli_query($con, $getType);
							if(mysqli_num_rows($resultType) != 0){
								$getStation = "SELECT station_code FROM station WHERE station_code='".$oStation."'";
								$resultStation = mysqli_query($con, $getStation);
								if(mysqli_num_rows($resultStation) != 0){
									$getTickets = "SELECT * FROM ticket WHERE (station_in_station_code='".$iStation."' AND station_out_station_code='".$oStation."') OR (station_in_station_code='".$oStation."' AND station_out_station_code='".$iStation."')";
									$resultTickets = mysqli_query($con, $getTickets);
									if(mysqli_num_rows($resultTickets) == 0){
										$insertTicket = "INSERT INTO ticket(ticket_fee, station_in_station_code, station_out_station_code) VALUES('".$tFee."','".$iStation."','".$oStation."')";
										if(mysqli_query($con, $insertTicket)){
											//get managers
											$getEmp = "SELECT employee_email FROM employee WHERE nic IN (SELECT employee_nic FROM staff WHERE employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='manager'))";
											$resultEmp = mysqli_query($con, $getEmp);
											if(mysqli_num_rows($resultEmp) != 0){
												while($rowEmail = mysqli_fetch_array($resultEmp)){
													//send email with new ticket fee
													$to = $rowEmail['employee_email'];
													//Set who the message is to be sent to
													$mail->addAddress($to, $to);
													//Set the subject line
													$mail->Subject = "New Ticket Fee Has Being Added";
$mail->Body ="Dear Manager,

New ticket fee has being added between following stations to the system. Please find more information,

	In Station Code : ".$iStation."
	Out Station Code : ".$oStation."
	Ticket Fee : ".$tFee."

Thank You!
S.C.A.T Admin";
													if (!$mail->send()) {
														echo "Mailer Error: " . $mail->ErrorInfo;
													}
												}
											}
											//get station masters
											$getEmp = "SELECT employee_email FROM employee WHERE nic IN (SELECT employee_nic FROM station WHERE station_code='".$iStation."' OR station_code='".$oStation."')";
											$resultEmp = mysqli_query($con, $getEmp);
											if(mysqli_num_rows($resultEmp) != 0){
												while($rowEmail = mysqli_fetch_array($resultEmp)){
													//send email with new ticket fee
													$to = $rowEmail['employee_email'];		
													//Set who the message is to be sent to
													$mail->addAddress($to, $to);
													//Set the subject line
													$mail->Subject = "New Ticket Fee Has Being Added";
$mail->Body ="Dear Station Master,

New ticket fee has being added between your station and the following station to the system. Please find more information,

	In Station Code : ".$iStation."
	Out Station Code : ".$oStation."
	Ticket Fee : ".$tFee."

Thank You!
S.C.A.T Admin";
													if (!$mail->send()) {
														echo "Mailer Error: " . $mail->ErrorInfo;
													}
												}
											}
											//success
											header('Location:../addTickets.php?error=su');
										} else {
											//query failed
											header('Location:../addTickets.php?error=qf');
										}
									} else {
										//already exists
										header('Location:../addTickets.php?error=ae');
									}
								} else {
									//wrong out station	
									header('Location:../addTickets.php?error=wo');
								}
							} else {
								//wrong in station
								header('Location:../addTickets.php?error=wi');
							}
						} else {
							//wrong ticket fee format
							header('Location:../addTickets.php?error=wf');
						}
					} else {
						//same istation and ostation
						header('Location:../addTickets.php?error=ss');
					}
				} else {
					//empty fields redirect to stations
					header('Location:../addTickets.php?error=ef');
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
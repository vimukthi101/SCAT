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
				if(!empty($_POST['sCode']) || !empty($_POST['sName']) || !empty($_POST['smID'])){
					$c = trim($_POST['sCode']);
					$n = trim($_POST['sName']);
					$i = trim($_POST['smID']);
					$code = htmlspecialchars(mysqli_real_escape_string($con, $c));
					$name = htmlspecialchars(mysqli_real_escape_string($con, $n));
					$smNic = htmlspecialchars(mysqli_real_escape_string($con, $i));
					if(preg_match('/^[a-zA-Z]+$/',$code)){
						if(preg_match('/^[a-zA-Z]+$/',$name)){
							$getType = "SELECT * FROM staff WHERE employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='stationMaster') AND employee_nic='".$smNic."'";
							$resultType = mysqli_query($con, $getType);
							if(mysqli_num_rows($resultType) != 0){
								$getStation = "SELECT * FROM station WHERE station_code='".$code."' OR station_name='".$name."' OR employee_nic='".$smNic."'";
								$resultStation = mysqli_query($con, $getStation);
								if(mysqli_num_rows($resultStation) == 0){
									$insert = "INSERT INTO station VALUES('".$code."','".$name."','0','".$smNic."')";
									if(mysqli_query($con, $insert)){
										$update = "UPDATE staff SET station_code='".$code."' WHERE employee_nic='".$smNic."'";
										if(mysqli_query($con, $update)){
											$getEmp = "SELECT employee_email FROM employee WHERE status=1 AND nic IN (SELECT employee_nic FROM staff WHERE employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='manager'))";
											$resultEmp = mysqli_query($con, $getEmp);
											if(mysqli_num_rows($resultEmp) != 0){
												while($rowEmail = mysqli_fetch_array($resultEmp)){
													//send email with new station
													$to = $rowEmail['employee_email'];		
													//Set who the message is to be sent to
													$mail->addAddress($to, $to);
													//Set the subject line
													$mail->Subject = "New Station Has Being Added";
$mail->Body ="Dear Manager,

New station has being added to the system with following details.

	Station Code : ".$code."
	Station Name : ".$name."
	Station Master NIC : ".$smNic."

Thank You!
S.C.A.T Admin";
													if (!$mail->send()) {
														echo "Mailer Error: " . $mail->ErrorInfo;
													}
												}
											}
											$getSM = "SELECT employee_email FROM employee WHERE nic='".$smNic."'";
											$resultSM = mysqli_query($con, $getSM);
											if(mysqli_num_rows($resultSM) != 0){
												while($rowSM = mysqli_fetch_array($resultSM)){
													$toSM =  $rowSM['employee_email'];
													//Set who the message is to be sent to
													$mail->addAddress($toSM, $toSM);
													//Set the subject line
													$mail->Subject = "Assigned to a Station";
$mail->Body ="Dear Station Master,

With in Effect from ".date("l jS \of F Y h:i:s A")." you have being assigned to following station as the station master. Please find the information,

	Station Code : ".$code."
	Station Name : ".$name."

Congratulations!

Thank You!
S.C.A.T Admin";
														if (!$mail->send()) {
															echo "Mailer Error: " . $mail->ErrorInfo;
														}
													}
											}
											//success
											header('Location:../addStations.php?error=su');
										} else {
											//query failed	
											header('Location:../addStations.php?error=qf');
										}
									} else {
										//query failed	
										header('Location:../addStations.php?error=qf');
									}
								} else {
									//exists	
									header('Location:../addStations.php?error=ae');
								}
							} else {
								//wrong SM
								header('Location:../addStations.php?error=wt');
							}
						} else {
							//wrong name format
							header('Location:../addStations.php?error=wn');
						}
					} else {
						//wrong code format
						header('Location:../addStations.php?error=wc');
					}
				} else {
					//empty fields redirect to stations
					header('Location:../addStations.php?error=ef');
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
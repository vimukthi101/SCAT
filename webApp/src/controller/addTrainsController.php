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
				if(!empty($_POST['tCode']) || !empty($_POST['tType'])){
					$c = trim($_POST['tCode']);
					$n = trim($_POST['tName']);
					$t = trim($_POST['tType']);
					$code = htmlspecialchars(mysqli_real_escape_string($con, $c));
					$name = htmlspecialchars(mysqli_real_escape_string($con, $n));
					$type = htmlspecialchars(mysqli_real_escape_string($con, $t));
					if(preg_match('/^\d+$/',$code)){
						if(preg_match('/^[a-zA-Z]+$|^$/',$name)){
							$getType = "SELECT * FROM train_type WHERE type_id='".$type."'";
							$resultType = mysqli_query($con, $getType);
							if(mysqli_num_rows($resultType) != 0){
								$getTrain = "SELECT * FROM train WHERE train_id='".$code."' OR train_name='".$name."'";
								$resultTrain = mysqli_query($con, $getTrain);
								if(mysqli_num_rows($resultTrain) == 0){
									$insert = "INSERT INTO train VALUES('".$code."','".$name."','".$type."')";
									if(mysqli_query($con, $insert)){
										$getEmp = "SELECT employee_email FROM employee WHERE nic IN (SELECT employee_nic FROM staff WHERE employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='manager'))";
										$resultEmp = mysqli_query($con, $getEmp);
										if(mysqli_num_rows($resultEmp) != 0){
											while($rowEmail = mysqli_fetch_array($resultEmp)){
												//send email with new reg fee
												$to = $rowEmail['employee_email'];		
												//Set who the message is to be sent to
												$mail->addAddress($to, $to);
												//Set the subject line
												$mail->Subject = "New Train Has Being Added";
$mail->Body ="Dear Manager,

New train has being added to the system with following details.

	Train Code : ".$code."
	Train Name : ".$name."
	Train Type : ".$type."

Thank You!
S.C.A.T Admin";
												if (!$mail->send()) {
													echo "Mailer Error: " . $mail->ErrorInfo;
												}
											}
										}
										//success
										header('Location:../addTrains.php?error=su');
									} else {
										//query failed	
										header('Location:../addTrains.php?error=qf');
									}
								} else {
									//exists	
									header('Location:../addTrains.php?error=ae');
								}
							} else {
								//wrong train type
								header('Location:../addTrains.php?error=wt');
							}
						} else {
							//wrong name format
							header('Location:../addTrains.php?error=wn');
						}
					} else {
						//wrong code format
						header('Location:../addTrains.php?error=wc');
					}
				} else {
					//empty fields redirect to cards
					header('Location:../addTrains.php?error=ef');
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
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
			if(!empty($_POST['tId']) && !empty($_POST['tName'])){
				$t = trim($_POST['tId']);
				$n = trim($_POST['tName']);
				$typeId = htmlspecialchars(mysqli_real_escape_string($con, $t));
				$typeName = htmlspecialchars(mysqli_real_escape_string($con, $n));
				if(preg_match('/^[a-zA-Z]+$/',$typeId)){
					if(preg_match('/^[a-zA-Z]+$/',$typeName)){
						$getTypes = "SELECT * FROM train_type WHERE type_name='".$typeName."'";
						$resultGetTypes = mysqli_query($con, $getTypes);
						if(mysqli_num_rows($resultGetTypes) == 0){
							$updateTypes = "UPDATE train_type SET type_name='".$typeName."' WHERE type_id='".$typeId."'";
							if(mysqli_query($con, $updateTypes)){
								$getEmp = "SELECT employee_email FROM employee WHERE nic IN (SELECT employee_nic FROM staff WHERE employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='manager'))";
								$resultEmp = mysqli_query($con, $getEmp);
								if(mysqli_num_rows($resultEmp) != 0){
									while($rowEmail = mysqli_fetch_array($resultEmp)){
										//send email with new train type
										$to = $rowEmail['employee_email'];	
										//Set who the message is to be sent to
										$mail->addAddress($to, $to);
										//Set the subject line
										$mail->Subject = "Train Type Has Being Updated";
$mail->Body ="Dear Manager,

Following Train type has being updated. Please find the updated information,

	Train Type ID : ".$typeId."
	Train Type Name : ".$typeName."

Thank You!
S.C.A.T Admin";
										if (!$mail->send()) {
											echo "Mailer Error: " . $mail->ErrorInfo;
										}
									}
								}
								//success
								header('Location:../updateTrainTypes.php?error=su');
							} else {
								//query failes
								header('Location:../updateTrainTypes.php?error=qf');
							}
						} else {
							//exists	
							header('Location:../updateTrainTypes.php?error=ae');
						}
					} else {
						//wrong name format
						header('Location:../updateTrainTypes.php?error=wn');
					}
				} else {
					//wrong id format
					header('Location:../updateTrainTypes.php?error=wi');
				}
			} else {
				//empty fields redirect to cards
				header('Location:../updateTrainTypes.php?error=ef');
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
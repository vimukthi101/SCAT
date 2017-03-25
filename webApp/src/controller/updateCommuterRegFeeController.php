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
			if(!empty($_POST['regFee'])){
				$f = trim($_POST['regFee']);
				$fee = htmlspecialchars(mysqli_real_escape_string($con, $f));
				if(preg_match('/^\d+\.(\d{2})$/',$fee)){
					$update = "INSERT INTO commuter_regfee(reg_fee) VALUES('".$fee."')";
					if(mysqli_query($con, $update)){
						$getEmp = "SELECT employee_email FROM employee WHERE nic IN (SELECT employee_nic FROM staff WHERE employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='manager' OR POSITION='registrar' OR POSITION='stationMaster'))";
						$resultEmp = mysqli_query($con, $getEmp);
						if(mysqli_num_rows($resultEmp) != 0){
							while($rowEmail = mysqli_fetch_array($resultEmp)){
								//send email with new reg fee
								$to = $rowEmail['employee_email'];	
								//Set who the message is to be sent to
								$mail->addAddress($to, $to);
								//Set the subject line
								$mail->Subject = "Comuter Reg Fee Changed";
$mail->Body = "Dear All,

With in effect from ".date("l jS \of F Y h:i:s A")." the commuter registration fee was changed as following.

	New Registration Fee : ".$fee."

Thank You!
S.C.A.T Systm";
								if (!$mail->send()) {
									//success
									header('Location:../updateRegistrationFee.php?error=su');
								}
							}
						}
						//success
						header('Location:../updateRegistrationFee.php?error=su');
					} else {
						//query failes	
						header('Location:../updateRegistrationFee.php?error=qf');
					}
				} else {
					//wrong format
					header('Location:../updateRegistrationFee.php?error=wf');
				}
			} else {
				//cannot be empty	
				header('Location:../updateRegistrationFee.php?error=ef');
			}
		}  else {
			//error page 404
			header('Location:../../404.php');
		}	
	}  else {
		//error page 404
		header('Location:../../404.php');
	}	
?>
<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	include_once('../../ssi/smtpSettings.php');
	if(isset($_SESSION['position'])){
		if($_SESSION['position'] == "sysadmin" || $_SESSION['position'] == "stationMaster" || $_SESSION['position'] == "manager"){
			if(isset($_GET['position']) && isset($_GET['nic']) && isset($_GET['email'])){
				if(!empty($_GET['position']) && !empty($_GET['nic']) && !empty($_GET['email'])){
					$position = $_GET['position'];
					$nic = $_GET['nic'];
					$email = $_GET['email'];
					$rand = rand(1000,9999);
					$pass = md5($rand);
					$activateUser = "UPDATE employee SET STATUS='1', login_attempt='0', previous_password='', password='".$pass."' WHERE nic='".$nic."'";
					if(mysqli_query($con, $activateUser)){
						if($position == "topupAgent"){
							$getStatus = "SELECT topup_agent_status_id FROM topup_agent_status WHERE topup_agent_status='registered'";
							$resultStatus = mysqli_query($con, $getStatus);
							if(mysqli_num_rows($resultStatus) != 0){
								while($rowStatus = mysqli_fetch_array($resultStatus)){
									$statusId = $rowStatus['topup_agent_status_id'];
								}
								$deactivate = "UPDATE topup_agent SET topup_agent_status_id='".$statusId."' WHERE employee_nic='".$nic."'";
								mysqli_query($con, $deactivate);
							}
						}
						//send email with new password
						$to = $email;
						//Set who the message is to be sent to
						$mail->addAddress($to, $to);
						//Set the subject line
						$mail->Subject = "Account Activated";
$mail->Body ="Dear ".$position.",

Your account has been reactivated. Please use following credentials to login to your account. Please change your password when you logged in.

	User Name : ".$nic."
	Passowrd : ".$rand."

Please try to minimize such errors in the future.

p.s. : Please do not reply to this email.

Thank You!
S.C.A.T System Admin";
						if (!$mail->send()) {
							//sucessfully activated
							if($position == "manager"){
								header('Location:../enableUsers.php?position=manager&error=su');
							} else if($position == "stationMaster"){
								header('Location:../enableUsers.php?position=stationMaster&error=su');
							} else if($position == "updater"){
								header('Location:../enableUsers.php?position=updater&error=su');
							} else if($position == "registrar"){
								header('Location:../enableUsers.php?position=registrar&error=su');
							} else if($position == "topupAgent"){
								header('Location:../enableUsers.php?position=topupAgent&error=su');
							}
						}
						//sucessfully activated
						if($position == "manager"){
							header('Location:../enableUsers.php?position=manager&error=su');
						} else if($position == "stationMaster"){
							header('Location:../enableUsers.php?position=stationMaster&error=su');
						} else if($position == "updater"){
							header('Location:../enableUsers.php?position=updater&error=su');
						} else if($position == "registrar"){
							header('Location:../enableUsers.php?position=registrar&error=su');
						} else if($position == "topupAgent"){
							header('Location:../enableUsers.php?position=topupAgent&error=su');
						}
					} else {
						//query failed
						if($position == "manager"){
							header('Location:../enableUsers.php?position=manager&error=qf');
						} else if($position == "stationMaster"){
							header('Location:../enableUsers.php?position=stationMaster&error=qf');
						} else if($position == "updater"){
							header('Location:../enableUsers.php?position=updater&error=qf');
						} else if($position == "registrar"){
							header('Location:../enableUsers.php?position=registrar&error=qf');
						} else if($position == "topupAgent"){
							header('Location:../enableUsers.php?position=topupAgent&error=qf');
						}
					}
				} else {
					//error page 404
					header('Location:../../404.php');	
				}
			} else {
				//error page 404
				header('Location:../../404.php');
			}
		} else {
			//error page 404
			header('Location:../../404.php');
		}
	} else {
		//error page 404
		header('Location:../../404.php');
	}	
?>
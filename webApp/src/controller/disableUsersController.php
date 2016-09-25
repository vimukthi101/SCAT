<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	if(isset($_SESSION['position'])){
		if($_SESSION['position'] == "stationMaster" || $_SESSION['position'] == "manager"){
			if(isset($_GET['position']) && isset($_GET['nic']) && isset($_GET['email'])){
				if(!empty($_GET['position']) && !empty($_GET['nic']) && !empty($_GET['email'])){
					$position = $_GET['position'];
					$nic = $_GET['nic'];
					$email = $_GET['email'];
					$deactivateUser = "UPDATE employee SET STATUS='0' WHERE nic='".$nic."'";
					if(mysqli_query($con, $deactivateUser)){
						if($position == "topupAgent"){
							$getStatus = "SELECT topup_agent_status_id FROM topup_agent_status WHERE topup_agent_status='disabled'";
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
						$subject = "Account Activated";
$message = "<p>Dear ".$position.",</p>
<br/>
<p>Your account has been deactivated. You won't be able to login to the system with your credentials. If you think this is a mistake, then please meet the relevant station master.</p>
<br/>
<p>p.s. : Please do not reply to this email</p>
<br/>
<p>Thank You!</p>
<p>S.C.A.T System</p>";
						$headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
						mail($to, $subject, $message, $headers);
						//sucessfully activated
						if($position == "updater"){
							header('Location:../disableUsers.php?position=updater&error=su');
						} else if($position == "registrar"){
							header('Location:../disableUsers.php?position=registrar&error=su');
						} else if($position == "topupAgent"){
							header('Location:../disableUsers.php?position=topupAgent&error=su');
						}
					} else {
						//query failed
						if($position == "updater"){
							header('Location:../disableUsers.php?position=updater&error=qf');
						} else if($position == "registrar"){
							header('Location:../disableUsers.php?position=registrar&error=qf');
						} else if($position == "topupAgent"){
							header('Location:../disableUsers.php?position=topupAgent&error=qf');
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
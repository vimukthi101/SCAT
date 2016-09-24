<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	if(isset($_SESSION['position'])){
		if($_SESSION['position'] == "sysadmin" || $_SESSION['position'] == "stationMaster" || $_SESSION['position'] == "manager" || $_SESSION['topupAgent'] == "manager"){
			if(isset($_GET['position']) && isset($_GET['nic']) && isset($_GET['email'])){
				if(!empty($_GET['position']) && !empty($_GET['nic']) && !empty($_GET['email'])){
					$position = $_GET['position'];
					$nic = $_GET['nic'];
					$email = $_GET['email'];
					$rand = rand(1000,9999);
					$pass = md5($rand);
					$activateUser = "UPDATE employee SET STATUS='1', login_attempt='0', previous_password='', password='".$pass."' WHERE nic='".$nic."'";
					if(mysqli_query($con, $activateUser)){
						//send email with new password
						$to = $email;
						$subject = "Account Activated";
$message = "<p>Dear ".$position.",</p>
<br/>
<p>Your account has been reactivated. Please use following credentials to login to your account. Please change your password when you logged in.</p>
<br/>
<h4>User Name : ".$nic."</h4>
<h4>Passowrd : ".$rand."</h4>
<br/>
<p>Please try to minimize such errors in the future</p>
<br/>
<p>p.s. : Please do not reply to this email</p>
<br/>
<p>Thank You!</p>
<p>S.C.A.T System Admin</p>";
						$headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
						mail($to, $subject, $message, $headers);
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
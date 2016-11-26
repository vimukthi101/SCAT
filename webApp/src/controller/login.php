<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	include_once('../../ssi/smtpSettings.php');
	if(isset($_POST['submit'])){
		if(!empty($_POST['userNIC']) && !empty($_POST['password'])){
			//get user name and password
			$un = trim($_POST['userNIC']);
			$up = trim($_POST['password']);
			if(preg_match('/^(\d){9}[v|V]$/',$un)){
				if(preg_match('/\S+/',$up)){
					$userName = htmlspecialchars(mysql_real_escape_string($un));
					$userPassword = md5(htmlspecialchars(mysql_real_escape_string($up)));
					//mysql query to get employee
					$query = "SELECT * FROM employee WHERE nic='".$userName."' AND password='".$userPassword."'";
					$result = mysqli_query($con, $query) or die();
					if(mysqli_num_rows($result)==0){
						//if password is wrong redirect to login page
						$getStatus = "SELECT * FROM employee WHERE nic='".$userName."'";
						$statusResult = mysqli_query($con, $getStatus) or die();
						if(mysqli_num_rows($statusResult)!=0){
							while($statusRow = mysqli_fetch_array($statusResult)){
								//update login attempt by one
								$loginAttempt = $statusRow['login_attempt'];
								$internal = $statusRow['internal'];
								$email = $statusRow['employee_email'];
								$newLoginAttempt = $loginAttempt + 1;
								$updateLoginAttempt = "UPDATE employee SET login_attempt='".$newLoginAttempt."' WHERE nic='".$userName."'";
								if(mysqli_query($con, $updateLoginAttempt)){
									if($newLoginAttempt >= "3"){
										//block the user if attempts are >= 3
										$updateLoginAttempt = "UPDATE employee SET status='0' WHERE nic='".$userName."'";
										if(mysqli_query($con, $updateLoginAttempt)){
											//check whether internal user or topup agent
											if($internal == '1'){
												//block user, meet admin error message
												$getPositionForBlock = "SELECT position FROM employee_position WHERE position_id IN (SELECT employee_position_position_id FROM staff WHERE employee_nic='".$userName."')";
												$resultPositionForBlock = mysqli_query($con, $getPositionForBlock);
												if(mysqli_num_rows($resultPositionForBlock) != 0){
													while($blockPositionRow = mysqli_fetch_array($resultPositionForBlock)){
														$blockPosition = $blockPositionRow['position'];
														if($blockPosition == 'sysadmin'){
															//send email with randomly generated password
															$rand = rand(1000,9999);
															$md5Rand = md5($rand);
															$updateBlockedAdmin = "UPDATE employee SET PASSWORD='".$md5Rand."', previous_password='', login_attempt='0', STATUS='1' WHERE nic='".$userName."'";
															if(mysqli_query($con, $updateBlockedAdmin)){
																//send email with new password
																$to = $email;
																//Set who the message is to be sent to
																$mail->addAddress($to, $to);
																//Set the subject line
																$mail->Subject = "Password Reset";
$mail->Body = "Dear SysAdmin,

Your account has been deactivated due to a three unsuccessfull login attempts. System detects it as an unauthorized login attempt. Please use the below auto generated one time password to re activate your account and to change your password.

	User Name : ".$userName."
	Passowrd : ".$rand."

Please try to minimize such errors in the future.

p.s. : Please do not reply to this email

Thank You!
S.C.A.T Systm";
																if (!$mail->send()) {
																	echo "Mailer Error: " . $mail->ErrorInfo;
																}
																//account deactivated, contact admin error message
																header('Location:../../index.php?error=ab');
															}
														} else {
															//send email to meet admin
															$to = $email;
															//Set who the message is to be sent to
															$mail->addAddress($to, $to);
															//Set the subject line
															$mail->Subject = "Account Deactivated";
$mail->Body = "Dear User,

Your account has been deactivated due to a three unsuccessfull login attempts. System detects it as an unauthorized login attempt. Please meet the SysAdmin to re activate your account.

Please try to minimize such errors in the future

p.s. : Please do not reply to this email.

Thank You!
S.C.A.T Systm";
															if (!$mail->send()) {
																echo "Mailer Error: " . $mail->ErrorInfo;
															}
															//account deactivated, contact admin error message
															header('Location:../../index.php?error=da');
														}	
													}	
												}
											} else {
												//send email to meet admin
												$to = $email;
												//Set who the message is to be sent to
												$mail->addAddress($to, $to);
												//Set the subject line
												$mail->Subject = "Account Deactivated";
$mail->Body ="Dear Top-Up Agent,

Your account has been deactivated due to a three unsuccessfull login attempts. System detects it as an unauthorized login attempt. Please meet the Station Master to re activate your account.

Please try to minimize such errors in the future.

p.s. : Please do not reply to this email

Thank You!
S.C.A.T Systm";
												if (!$mail->send()) {
													echo "Mailer Error: " . $mail->ErrorInfo;
												}
												//account deactivated, contact admin error message
												header('Location:../../index.php?error=da');
											}
										} else {
											//wrong password error message
											header('Location:../../index.php?error=wp');	
										}
									} else {
										//wrong password error message
										header('Location:../../index.php?error=wp');	
									}
								} else {
									//wrong password error message
									header('Location:../../index.php?error=wp');
								}
							}
						} else {
							//wrong nic error message
							header('Location:../../index.php?error=wu');			
						}
					} else {
						while($row = mysqli_fetch_array($result)){
							$employeeNIC = $row['nic'];
							$employeeContact = $row['contact_no'];
							$employeeNameId = $row['name_id'];
							$employeeAddressID = $row['address_id'];
							$employeeEmail = $row['employee_email'];
							$employeePassword = $row['password'];
							$employeeStatus = $row['status'];
							$employeePreviousPassword = $row['previous_password'];
							$employeeInternal = $row['internal'];
							//sessions
							$_SESSION['name_id'] = $employeeNameId;
							$_SESSION['nic'] = $employeeNIC;
							$_SESSION['address_id'] = $employeeAddressID;
							$_SESSION['email'] = $employeeEmail;
							if($employeeInternal == 1){
								//mysql query to get position
								$getPosition = "SELECT * FROM employee_position WHERE position_id IN (SELECT employee_position_position_id FROM staff where employee_nic='".$employeeNIC."')";
								$positionResult = mysqli_query($con, $getPosition) or die();
								if(mysqli_num_rows($positionResult) != 0){
									while($positionRow = mysqli_fetch_array($positionResult)){
										$position = $positionRow['position'];
										$_SESSION['position'] = $position;
									}
								}
							} else {
								$_SESSION['position'] = 'topupAgent';
							}
							
							if($employeeStatus == "1"){
								if($employeePreviousPassword == ""){
									//if successfull and if it is the first login then redirect to cahnge password
									header('Location:../changePassword.php');	
								} else {
									//if successfull then redirect to home based on the position
									if($_SESSION['position'] == "sysadmin"){
										header('Location:../adminHome.php');		
									} else if($_SESSION['position'] == "manager"){
										header('Location:../managerHome.php');
									} else if($_SESSION['position'] == "topupAgent"){
										header('Location:../topupHome.php');
									} else if($_SESSION['position'] == "registrar"){
										header('Location:../registrarHome.php');
									} else if($_SESSION['position'] == "updater"){
										header('Location:../timeTableUpdaterHome.php');
									} else if($_SESSION['position'] == "stationMaster"){
										header('Location:../stationMasterHome.php');
									} else {
										//wrong position then redirect to login
										session_unset();
										header('Location:../../index.php?error=np');	
									}
								}	
							} else{
								//if user is not active redirect to login page, meet admin error message
								session_unset();
								header('Location:../../index.php?error=na');	
							}
						}
					}
				} else {
					//invalid password
					header('Location:../../index.php?error=ip');
				}
			} else {
				//invalid NIC
				header('Location:../../index.php?error=in');	
			}
		} else {
			//if username or password is empty redirect to login page
			header('Location:../../index.php?error=ep');	
		}
	} else {
		//if submit button is not clicked, then redirect to login page
		header('Location:../../index.php');	
	}
?>
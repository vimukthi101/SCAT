<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
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
					$query = "SELECT * FROM commuter WHERE nic='".$userName."' AND password='".$userPassword."'";
					$result = mysqli_query($con, $query) or die();
					if(mysqli_num_rows($result)==0){
						//if password is wrong redirect to login page
						$getStatus = "SELECT * FROM commuter WHERE nic='".$userName."'";
						$statusResult = mysqli_query($con, $getStatus) or die();
						if(mysqli_num_rows($statusResult)!=0){
							while($statusRow = mysqli_fetch_array($statusResult)){
								//update login attempt by one
								$loginAttempt = $statusRow['login_attempt'];
								$newLoginAttempt = $loginAttempt + 1;
								$updateLoginAttempt = "UPDATE commuter SET login_attempt='".$newLoginAttempt."' WHERE nic='".$userName."'";
								if(mysqli_query($con, $updateLoginAttempt)){
									if($newLoginAttempt >= "3"){
										//block the user if attempts are >= 3
										$updateLoginAttempt = "UPDATE commuter SET status='0' WHERE nic='".$userName."'";
										if(mysqli_query($con, $updateLoginAttempt)){
											header('Location:../../index.php?error=da');
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
							$employeeNameId = $row['name_name_id'];
							$employeeAddressID = $row['address_address_id'];
							$employeePassword = $row['password'];
							$employeeStatus = $row['status'];
							$employeePreviousPassword = $row['previous_password'];
							//sessions
							$_SESSION['name_id'] = $employeeNameId;
							$_SESSION['nic'] = $employeeNIC;
							$_SESSION['address_id'] = $employeeAddressID;
							if($employeeStatus == "1"){
								if($employeePreviousPassword == ""){
									//if successfull and if it is the first login then redirect to cahnge password
									header('Location:../changePassword.php');	
								} else {
									//if successfull then redirect to home based on the position
									header('Location:../commuterHome.php');	
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
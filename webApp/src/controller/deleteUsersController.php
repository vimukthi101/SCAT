<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	if(!empty($_POST['position'])){
		$pos = trim($_POST['position']);
		$employeePosition = htmlspecialchars(mysqli_real_escape_string($con, $pos));
		if(isset($_POST['submit'])){
			if(!empty($_POST['eId']) || !empty($_POST['position']) || !empty($_POST['nic']) || !empty($_POST['fname']) || !empty($_POST['lname']) || !empty($_POST['addressNo']) || !empty($_POST['lane']) || !empty($_POST['city']) || !empty($_POST['email'])){
				$nic = trim($_POST['nic']);
				$getUser = "SELECT * FROM employee WHERE nic='".$nic."'";
				$resultGetUser = mysqli_query($con, $getUser);
				if(mysqli_num_rows($resultGetUser) != 0){
					while($rowUser = mysqli_fetch_array($resultGetUser)){
						$name_id = $rowUser['name_id'];
						$address_id = $rowUser['address_id'];
						$deleteStaff = "DELETE FROM staff WHERE employee_nic='".$nic."'";
						if(mysqli_query($con, $deleteStaff)){
							$deleteEmployee = "DELETE FROM employee WHERE nic='".$nic."'";
							if(mysqli_query($con, $deleteEmployee)){
								$deleteName = "DELETE FROM NAME WHERE name_id='".$name_id."'";
								if(mysqli_query($con, $deleteName)){
									$deleteAddress = "DELETE FROM address WHERE address_id='".$address_id."'";
									if(mysqli_query($con, $deleteAddress)){
										//send email with account deleted
										$to = $_POST['email'];
										$subject = "Account Deleted";
$message = "<p>Hi ".$employeePosition.",</p>
<br/>
<p>Your account has been deleted. No longer you will be able to login to the system. If you think this is a mistake, please meet the system admin.</p>
<br/>
<p>p.s. : Please do not reply to this email</p>
<br/>
<p>Thank You!</p>
<p>S.C.A.T System Admin</p>";
										$headers = "MIME-Version: 1.0" . "\r\n";
										$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
										mail($to, $subject, $message, $headers);
										//success
										if($employeePosition == "manager"){
											header('Location:../deleteUsers.php?position=manager&error=su');		
										} else if($employeePosition == "stationMaster"){
											header('Location:../deleteUsers.php?position=stationMaster&error=su');	
										}	
									} else {
										//query failed
										if($employeePosition == "manager"){
											header('Location:../deleteUsers.php?position=manager&error=qf');		
										} else if($employeePosition == "stationMaster"){
											header('Location:../deleteUsers.php?position=stationMaster&error=qf');	
										}	
									}	
								} else {
									//query failed
									if($employeePosition == "manager"){
										header('Location:../deleteUsers.php?position=manager&error=qf');		
									} else if($employeePosition == "stationMaster"){
										header('Location:../deleteUsers.php?position=stationMaster&error=qf');	
									}	
								}
							} else {
								//query failed
								if($employeePosition == "manager"){
									header('Location:../deleteUsers.php?position=manager&error=qf');		
								} else if($employeePosition == "stationMaster"){
									header('Location:../deleteUsers.php?position=stationMaster&error=qf');	
								}	
							}
						} else {
							//query failed
							if($employeePosition == "manager"){
								header('Location:../deleteUsers.php?position=manager&error=qf');		
							} else if($employeePosition == "stationMaster"){
								header('Location:../deleteUsers.php?position=stationMaster&error=qf');	
							}	
						}
					}
				} else {
					//redirect to form no user
					if($employeePosition == "manager"){
						header('Location:../deleteUsers.php?position=manager&error=nu');		
					} else if($employeePosition == "stationMaster"){
						header('Location:../deleteUsers.php?position=stationMaster&error=nu');	
					}
				}
			} else {
				//redirect to form empty fields
				if($employeePosition == "manager"){
					header('Location:../deleteUsers.php?position=manager&error=ef');		
				} else if($employeePosition == "stationMaster"){
					header('Location:../deleteUsers.php?position=stationMaster&error=ef');	
				}
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
<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	if(isset($_POST['submit'])){
		if(!empty($_POST['eId']) || !empty($_POST['position']) || !empty($_POST['nic']) || !empty($_POST['fname']) || !empty($_POST['lname']) || !empty($_POST['addresNo']) || !empty($_POST['lane']) || !empty($_POST['city'])){
			$fn = trim($_POST['fname']);
			$mn = trim($_POST['mname']);
			$ln = trim($_POST['lname']);
			$no = trim($_POST['addresNo']);
			$lane = trim($_POST['lane']);
			$city = trim($_POST['city']);
			$phone = trim($_POST['contact']);
			$em = trim($_POST['email']);
			$firstName = htmlspecialchars(mysqli_real_escape_string($fn));
			$middleName = htmlspecialchars(mysqli_real_escape_string($fn));
			$lastName = htmlspecialchars(mysqli_real_escape_string($fn));
			$addressNo = htmlspecialchars(mysqli_real_escape_string($fn));
			$addressLane = htmlspecialchars(mysqli_real_escape_string($fn));
			$addressCity = htmlspecialchars(mysqli_real_escape_string($fn));
			$contactNo = htmlspecialchars(mysqli_real_escape_string($phone));
			$email = htmlspecialchars(mysqli_real_escape_string($em));
			$updateEmployee = "UPDATE NAME SET first_name='".$firstName."', second_name='".$middleName."', last_name='".$lastName."' WHERE name_id='".$_SESSION['name_id']."'";
			if(mysqli_query($con, $updateEmployee)){
				$updateEmployeeAddress = "UPDATE address SET address_no='".$addressNo."', address_lane='".$addressLane."', address_city='".$addressCity."' WHERE address_id='".$_SESSION['address_id']."'";
				if(mysqli_query($con, $updateEmployeeAddress)){
					$updateEmployeeContact = "UPDATE employee SET contact_no='".$contactNo."', employee_email='".$email."' WHERE nic='".$_SESSION['nic']."'";
					if(mysqli_query($con, $updateEmployeeContact)){
						header('Location:../Profile.php?error=su');
					} else {
						//redirect to form query faile
						header('Location:../editProfile.php?error=qf');	
					}
				} else {
					//redirect to form query faile
					header('Location:../editProfile.php?error=qf');	
				}
			} else {
				//redirect to form query faile
				header('Location:../editProfile.php?error=qf');	
			}
		} else {
			//redirect to form empty fields
			header('Location:../editProfile.php?error=ef');	
		}
	} else {
		//redirect to form not submit
		header('Location:../editProfile.php?ns');	
	}
?>
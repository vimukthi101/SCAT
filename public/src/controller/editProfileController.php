<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	if(isset($_POST['submit'])){
		if(!empty($_POST['cardNo']) || !empty($_POST['regDate']) || !empty($_POST['nic']) || !empty($_POST['fname']) || !empty($_POST['lname']) || !empty($_POST['addresNo']) || !empty($_POST['lane']) || !empty($_POST['city'])){
			$fn = trim($_POST['fname']);
			$mn = trim($_POST['mname']);
			$ln = trim($_POST['lname']);
			$no = trim($_POST['addresNo']);
			$lane = trim($_POST['lane']);
			$city = trim($_POST['city']);
			$phone = trim($_POST['contact']);
			if(preg_match('/^[a-zA-Z]+$/',$fn)){
				if(preg_match('/^[a-zA-Z]*$|^$/',$mn)){
					if(preg_match('/^[a-zA-Z]+$/',$ln)){
						if(preg_match('/^([0-9].*[\\/][a-zA-Z0-9]*)|([0-9].*)$/',$no)){
							if(preg_match('/^[a-zA-Z ]+$/',$lane)){
								if(preg_match('/^[a-zA-Z]+$/',$city)){
									if(preg_match('/^(\d{10})|(^$)$/',$phone)){
										$firstName = htmlspecialchars(mysqli_real_escape_string($con, $fn));
										$middleName = htmlspecialchars(mysqli_real_escape_string($con, $mn));
										$lastName = htmlspecialchars(mysqli_real_escape_string($con, $ln));
										$addressNo = htmlspecialchars(mysqli_real_escape_string($con, $no));
										$addressLane = htmlspecialchars(mysqli_real_escape_string($con, $lane));
										$addressCity = htmlspecialchars(mysqli_real_escape_string($con, $city));
										$contactNo = htmlspecialchars(mysqli_real_escape_string($con, $phone));
										$updateEmployee = "UPDATE name SET first_name='".$firstName."', second_name='".$middleName."', last_name='".$lastName."' WHERE name_id='".$_SESSION['name_id']."'";
										if(mysqli_query($con, $updateEmployee)){
											$updateEmployeeAddress = "UPDATE address SET address_no='".$addressNo."', address_lane='".$addressLane."', address_city='".$addressCity."' WHERE address_id='".$_SESSION['address_id']."'";
											if(mysqli_query($con, $updateEmployeeAddress)){
												$updateEmployeeContact = "UPDATE commuter SET contact_no='".$contactNo."' WHERE nic='".$_SESSION['nic']."'";
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
										//contact no
										header('Location:../editProfile.php?error=wp');
									}
								} else {
									//address city
									header('Location:../editProfile.php?error=wc');
								}
							} else {
								//address lane
								header('Location:../editProfile.php?error=wa');
							}
						} else {
							//addres no
							header('Location:../editProfile.php?error=wn');
						}
					} else {
						//last name is invalid
						header('Location:../editProfile.php?error=wl');
					}
				} else {
					//middle name is invalid
					header('Location:../editProfile.php?error=wm');
				}
			} else {
				//first name is invalid
				header('Location:../editProfile.php?error=wf');
			}
		} else {
			//redirect to form empty fields
			header('Location:../editProfile.php?error=ef');	
		}
	} else {
		//redirect to form not submit
		header('Location:../../404.php');
	}
?>
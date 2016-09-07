<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	if(isset($_POST['submit'])){
		if(!empty($_POST['eId']) || !empty($_POST['position']) || !empty($_POST['email']) || !empty($_POST['nic']) || !empty($_POST['fname']) || !empty($_POST['lname']) || !empty($_POST['addresNo']) || !empty($_POST['lane']) || !empty($_POST['city']) || !empty($_POST['pass']) || !empty($_POST['cPass'])){
			$id = trim($_POST['eId']);
			$position = trim($_POST['position']);
			$nic = trim($_POST['nic']);
			$em = trim($_POST['email']);
			$fn = trim($_POST['fname']);
			$mn = trim($_POST['mname']);
			$ln = trim($_POST['lname']);
			$no = trim($_POST['addresNo']);
			$lane = trim($_POST['lane']);
			$city = trim($_POST['city']);
			$phone = trim($_POST['contact']);
			$pass = trim($_POST['pass']);
			$cPass = trim($_POST['cPass']);
			$employeeId = htmlspecialchars(mysqli_real_escape_string($con, $id));
			$employeePosition = htmlspecialchars(mysqli_real_escape_string($con, $position));
			$employeeNic = htmlspecialchars(mysqli_real_escape_string($con, $nic));
			$employeeEmail = htmlspecialchars(mysqli_real_escape_string($con, $em));
			$firstName = htmlspecialchars(mysqli_real_escape_string($con, $fn));
			$middleName = htmlspecialchars(mysqli_real_escape_string($con, $mn));
			$lastName = htmlspecialchars(mysqli_real_escape_string($con, $ln));
			$addressNo = htmlspecialchars(mysqli_real_escape_string($con, $no));
			$addressLane = htmlspecialchars(mysqli_real_escape_string($con, $lane));
			$addressCity = htmlspecialchars(mysqli_real_escape_string($con, $city));
			$contactNo = htmlspecialchars(mysqli_real_escape_string($con, $phone));
			$password = md5(htmlspecialchars(mysqli_real_escape_string($con, $pass)));
			$confirmPassword = md5(htmlspecialchars(mysqli_real_escape_string($con, $cPass)));
			//check password and confirm password match
			if($password == $confirmPassword){
				//check whether the data already exists
				$getUsersNic = "SELECT COUNT(*) FROM employee WHERE nic='".$employeeNic."'";
				$resultGetUsersNic = mysqli_query($con, $getUsersNic);
				if(mysqli_num_rows($resultGetUsersNic) != 0){
					$getUsersEmail = "SELECT COUNT(*) FROM employee WHERE employee_email='".$employeeEmail."'";
					$resultGetUsersEmail = mysqli_query($con, $getUsersEmail);
					if(mysqli_num_rows($resultGetUsersEmail) != 0){
						$getUsersEid = "SELECT COUNT(*) FROM staff WHERE employee_id='".$employeeId."'";
						$resultGetUsersEid = mysqli_query($con, $getUsersEid);
						if(mysqli_num_rows($resultGetUsersEid) != 0){
							//add name
							$addEmployeeName = "INSERT INTO name VALUES ('','".$firstName."','".$middleName."','".$lastName."')";
							if(mysqli_query($con, $addEmployeeName)){
								//get name_id
								$nameId = mysqli_insert_id($con);
								//add address
								$addEmployeeAddress = "INSERT INTO address VALUES ('','".$addressNo."','".$addressLane."','".$addressCity."')";
								if(mysqli_query($con, $addEmployeeAddress)){
									//get address_id
									$addressId = mysqli_insert_id($con);
									//get position id
									$getUserPosition = "SELECT position_id FROM employee_position WHERE POSITION='".$employeePosition."'";
									$resultGetUserPosition = mysqli_query($con, $getUserPosition);
									if(mysqli_num_rows($resultGetUserPosition) != 0){
										while($rowGetUserPosition = mysqli_fetch_array($resultGetUserPosition)){
											$positionId = $rowGetUserPosition['position_id'];
										}
										$addUserStaff = "INSERT INTO staff VALUES ('".$employeeId."', '".$positionId."', '".$employeeNic."')";
										if(mysqli_query($con, $addUserStaff)){
											$addUserEmployee = "INSERT INTO employee VALUES ('".$contactNo."', '".$employeeNic."', '".$addressId."', '".$nameId."', '".$password."', '', '1', '0', '1', '".$employeeEmail."')";
											if(mysqli_query($con, $addUserEmployee)){
												
											} else {
												//couldn't add to employee
												
											}
										} else {
											//couldn't add to staff
											
										}
									} else {
										//no position
										
									}
								} else {
									//redirect to form query fails, couldn't add address
									
								}
							} else {
								//redirect to form query fails, couldn't add name
								
							}
						} else {
							//user eid exists
							
						}
					} else {
						//user email exists
						
					}
				} else {
					//user nic exists
					
				}
			} else {
				//password and confirm password does not match
				
			}
		} else {
			//redirect to form empty fields
				
		}
	} else {
		//redirect to form not submit
		
	}
?>
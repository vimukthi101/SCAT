<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	if(isset($_POST['position'])){
		if($_POST['position'] == "manager"){
			if(isset($_POST['submit'])){
				if(!empty($_POST['eId']) && !empty($_POST['position']) && !empty($_POST['email']) && !empty($_POST['nic']) && !empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['addresNo']) && !empty($_POST['lane']) && !empty($_POST['city'])){
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
					if(preg_match('/^\w+$/',$id)){
						if(preg_match('/^(\d){9}[v|V]$/',$nic)){
							if(preg_match('/^[0-9a-zA-Z]([-.\w]*[0-9a-zA-Z_+])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9}$/',$em)){
								if(preg_match('/^[a-zA-Z]+$/',$fn)){
									if(preg_match('/^[a-zA-Z]*$|^$/',$mn)){
										if(preg_match('/^[a-zA-Z]+$/',$ln)){
											if(preg_match('/^([0-9].*[\\/][a-zA-Z0-9]*)|([0-9].*)$/',$no)){
												if(preg_match('/^[a-zA-Z]+$/',$lane)){
													if(preg_match('/^[a-zA-Z]+$/',$city)){
														if(preg_match('/^\d{10}$|^$/',$phone)){
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
															$rand = rand(1000,9999);
															$password = md5($rand);
															//check whether the data already exists
															$getUsersNic = "SELECT * FROM employee WHERE nic='".$employeeNic."'";
															$resultGetUsersNic = mysqli_query($con, $getUsersNic);
															if(mysqli_num_rows($resultGetUsersNic) == 0){
																$getUsersEmail = "SELECT * FROM employee WHERE employee_email='".$employeeEmail."'";
																$resultGetUsersEmail = mysqli_query($con, $getUsersEmail);
																if(mysqli_num_rows($resultGetUsersEmail) == 0){
																	$getUsersEid = "SELECT * FROM staff WHERE employee_id='".$employeeId."'";
																	$resultGetUsersEid = mysqli_query($con, $getUsersEid);
																	if(mysqli_num_rows($resultGetUsersEid) == 0){
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
																					$addUserEmployee = "INSERT INTO employee VALUES ('".$contactNo."', '".$employeeNic."', '".$addressId."', '".$nameId."', '".$password."', '', '1', '0', '1', '".$employeeEmail."')";
																					if(mysqli_query($con, $addUserEmployee)){
																						$addUserStaff = "INSERT INTO staff VALUES ('".$employeeId."', '".$positionId."', '".$employeeNic."')";
																						if(mysqli_query($con, $addUserStaff)){
																							//send email to new user
																							$to = $email;
																							$subject = "Profile Created";
																							$message = "<p>Hi Manager,</p>
											<p>A new user account has been created for you at S.C.A.T. System with below credentials. Please use following user name and password for your first time login. Please change your password as you first login to the system.</p>
											<h4>User Name : ".$employeeEmail."</h4>
											<h4>Password : ".$rand."</h4>
											<p>p.s. : Please do not reply to this email</p>
											<p>Thank You!</p>
											<p>S.C.A.T Admin</p>";
																							$headers = "MIME-Version: 1.0" . "\r\n";
																							$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
																							mail($to, $subject, $message, $headers);
																							//user added successfully
																							header('Location:../userRegistration.php?position=manager&error=as');
																						}
																					}
																				}
																			}
																		} 
																	} else {
																		//user eid exists
																		header('Location:../userRegistration.php?position=manager&error=id');
																	}
																} else {
																	//user email exists
																	header('Location:../userRegistration.php?position=manager&error=ee');
																}
															} else {
																//user nic exists
																header('Location:../userRegistration.php?position=manager&error=ne');
															}
														} else {
															//wrong contact no format	
															header('Location:../userRegistration.php?position=manager&error=wp');
														}
													} else {
														//wrong city format	
														header('Location:../userRegistration.php?position=manager&error=wc');
													}
												} else {
													//wrong lane format	
													header('Location:../userRegistration.php?position=manager&error=wa');
												}
											} else {
												//wrong address no format	
												header('Location:../userRegistration.php?position=manager&error=wn');
											}
										} else {
											//wrong last name format	
											header('Location:../userRegistration.php?position=manager&error=wl');
										}
									} else {
										//wrong middle name format	
										header('Location:../userRegistration.php?position=manager&error=wm');
									}
								} else {
									//wrong first name format	
									header('Location:../userRegistration.php?position=manager&error=wf');
								}
							} else {
								//wrong email format	
								header('Location:../userRegistration.php?position=manager&error=we');
							}
						} else {
							//wrong NIC format	
							header('Location:../userRegistration.php?position=manager&error=wnic');
						}
					} else {
						//wrong EID format	
						header('Location:../userRegistration.php?position=manager&error=weid');
					}
				} else {
					//redirect to form empty fields
					header('Location:../userRegistration.php?position=manager&error=ef');
				}
			} else {
				//redirect to form not submit
				header('Location:../userRegistration.php?position=manager&error=ns');
			}
		} else if($_POST['position'] == "stationMaster"){
			if(isset($_POST['submit'])){
				if(!empty($_POST['eId']) && !empty($_POST['position']) && !empty($_POST['email']) && !empty($_POST['nic']) && !empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['addresNo']) && !empty($_POST['lane']) && !empty($_POST['city'])){
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
					if(preg_match('/^\w+$/',$id)){
						if(preg_match('/^(\d){9}[v|V]$/',$nic)){
							if(preg_match('/^[0-9a-zA-Z]([-.\w]*[0-9a-zA-Z_+])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9}$/',$em)){
								if(preg_match('/^[a-zA-Z]+$/',$fn)){
									if(preg_match('/^[a-zA-Z]*$|^$/',$mn)){
										if(preg_match('/^[a-zA-Z]+$/',$ln)){
											if(preg_match('/^([0-9].*[\\/][a-zA-Z0-9]*)|([0-9].*)$/',$no)){
												if(preg_match('/^[a-zA-Z]+$/',$lane)){
													if(preg_match('/^[a-zA-Z]+$/',$city)){
														if(preg_match('/^\d{10}$|^$/',$phone)){
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
															$rand = rand(1000,9999);
															$password = md5($rand);
															//check whether the data already exists
															$getUsersNic = "SELECT * FROM employee WHERE nic='".$employeeNic."'";
															$resultGetUsersNic = mysqli_query($con, $getUsersNic);
															if(mysqli_num_rows($resultGetUsersNic) == 0){
																$getUsersEmail = "SELECT * FROM employee WHERE employee_email='".$employeeEmail."'";
																$resultGetUsersEmail = mysqli_query($con, $getUsersEmail);
																if(mysqli_num_rows($resultGetUsersEmail) == 0){
																	$getUsersEid = "SELECT * FROM staff WHERE employee_id='".$employeeId."'";
																	$resultGetUsersEid = mysqli_query($con, $getUsersEid);
																	if(mysqli_num_rows($resultGetUsersEid) == 0){
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
																					$addUserEmployee = "INSERT INTO employee VALUES ('".$contactNo."', '".$employeeNic."', '".$addressId."', '".$nameId."', '".$password."', '', '1', '0', '1', '".$employeeEmail."')";
																					if(mysqli_query($con, $addUserEmployee)){
																						$addUserStaff = "INSERT INTO staff VALUES ('".$employeeId."', '".$positionId."', '".$employeeNic."')";
																						if(mysqli_query($con, $addUserStaff)){
																							//send email to new user
																							$to = $email;
																							$subject = "Profile Created";
																							$message = "<p>Hi Station Master,</p>
											<p>A new user account has been created for you at S.C.A.T. System with below credentials. Please use following user name and password for your first time login. Please change your password as you first login to the system.</p>
											<h4>User Name : ".$employeeEmail."</h4>
											<h4>Password : ".$rand."</h4>
											<p>p.s. : Please do not reply to this email</p>
											<p>Thank You!</p>
											<p>S.C.A.T Admin</p>";
																							$headers = "MIME-Version: 1.0" . "\r\n";
																							$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
																							mail($to, $subject, $message, $headers);
																							//user added successfully
																							header('Location:../userRegistration.php?position=manager&error=as');
																						}
																					}
																				}
																			}
																		} 
																	} else {
																		//user eid exists
																		header('Location:../userRegistration.php?position=stationMaster&error=id');
																	}
																} else {
																	//user email exists
																	header('Location:../userRegistration.php?position=stationMaster&error=ee');
																}
															} else {
																//user nic exists
																header('Location:../userRegistration.php?position=stationMaster&error=ne');
															}
														} else {
															//wrong contact no format	
															header('Location:../userRegistration.php?position=stationMaster&error=wp');
														}
													} else {
														//wrong city format	
														header('Location:../userRegistration.php?position=stationMaster&error=wc');
													}
												} else {
													//wrong lane format	
													header('Location:../userRegistration.php?position=stationMaster&error=wa');
												}
											} else {
												//wrong address no format	
												header('Location:../userRegistration.php?position=stationMaster&error=wn');
											}
										} else {
											//wrong last name format	
											header('Location:../userRegistration.php?position=stationMaster&error=wl');
										}
									} else {
										//wrong middle name format	
										header('Location:../userRegistration.php?position=stationMaster&error=wm');
									}
								} else {
									//wrong first name format	
									header('Location:../userRegistration.php?position=stationMaster&error=wf');
								}
							} else {
								//wrong email format	
								header('Location:../userRegistration.php?position=stationMaster&error=we');
							}
						} else {
							//wrong NIC format	
							header('Location:../userRegistration.php?position=stationMaster&error=wnic');
						}
					} else {
						//wrong EID format	
						header('Location:../userRegistration.php?position=stationMaster&error=weid');
					}
				} else {
					//redirect to form empty fields
					header('Location:../userRegistration.php?position=stationMaster&error=ef');
				}
			} else {
				//redirect to form not submit
				header('Location:../userRegistration.php?position=stationMaster&error=ns');
			}
		}
	} else {
		//redirect to 404
		header('Location:../../404.php');
	}
?>
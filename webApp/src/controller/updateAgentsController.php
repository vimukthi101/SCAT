<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	if(isset($_SESSION['position']) && ($_SESSION['position'] == "stationMaster")){
		if(isset($_POST['submit'])){
			if(!empty($_POST['eId']) || !empty($_POST['regFee']) || !empty($_POST['nic']) || !empty($_POST['fname']) || !empty($_POST['lname']) || !empty($_POST['addressNo']) || !empty($_POST['lane']) || !empty($_POST['city']) || !empty($_POST['email'])){
				$fn = trim($_POST['fname']);
				$mn = trim($_POST['mname']);
				$ln = trim($_POST['lname']);
				$no = trim($_POST['addresNo']);
				$lane = trim($_POST['lane']);
				$city = trim($_POST['city']);
				$phone = trim($_POST['contact']);
				$em = trim($_POST['email']);
				$nic = trim($_POST['nic']);
				$eid = trim($_POST['eId']);
				$rFee = trim($_POST['regFee']);
				if(preg_match('/^\w+$/',$eid)){
					if(preg_match('/^(\d){9}[v|V]$/',$nic)){
						if(preg_match('/^[a-zA-Z]+$/',$fn)){
							if(preg_match('/^[a-zA-Z]*$|^$/',$mn)){
								if(preg_match('/^[a-zA-Z]+$/',$ln)){
									if(preg_match('/^([0-9].*[\\/][a-zA-Z0-9]*)|([0-9].*)$/',$no)){
										if(preg_match('/^[a-zA-Z ]+$/',$lane)){
											if(preg_match('/^[a-zA-Z]+$/',$city)){
												if(preg_match('/^(\d{10})|(^$)$/',$phone)){
													if(preg_match('/^[0-9a-zA-Z]([-.\w]*[0-9a-zA-Z_+])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9}$/',$em)){
														$firstName = htmlspecialchars(mysqli_real_escape_string($con, $fn));
														$middleName = htmlspecialchars(mysqli_real_escape_string($con, $mn));
														$lastName = htmlspecialchars(mysqli_real_escape_string($con, $ln));
														$addressNo = htmlspecialchars(mysqli_real_escape_string($con, $no));
														$addressLane = htmlspecialchars(mysqli_real_escape_string($con, $lane));
														$addressCity = htmlspecialchars(mysqli_real_escape_string($con, $city));
														$contactNo = htmlspecialchars(mysqli_real_escape_string($con, $phone));
														$email = htmlspecialchars(mysqli_real_escape_string($con, $em));
														$employeeNic = htmlspecialchars(mysqli_real_escape_string($con, $nic));
														$employeeEid = htmlspecialchars(mysqli_real_escape_string($con, $eid));
														$regFee = htmlspecialchars(mysqli_real_escape_string($con, $rFee));
														$getEMail = "SELECT * FROM employee WHERE employee_email='".$email."'";
														$resultGetEmail = mysqli_query($con, $getEMail);
														if(mysqli_num_rows($resultGetEmail) != 0){
															//email exists
															while($rowEmail = mysqli_fetch_array($resultGetEmail)){
																$newNic = $rowEmail['nic'];
																//same user
																if($newNic == $employeeNic){
																	//get user to update
																	$getUser = "SELECT * FROM employee WHERE nic='".$employeeNic."'";
																	$resultGetUser = mysqli_query($con, $getUser);
																	if(mysqli_num_rows($resultGetUser) != 0){
																		while($rowGetUser = mysqli_fetch_array($resultGetUser)){
																			$addressId = $rowGetUser['address_id'];
																			$nameId = $rowGetUser['name_id'];
																		}
																		//update user name
																		$updateName = "UPDATE NAME SET first_name='".$firstName."', second_name='".$middleName."', last_name='".$lastName."' WHERE name_id='".$nameId."'";
																		if(mysqli_query($con, $updateName)){
																			//update address
																			$updateEmployeeAddress = "UPDATE address SET address_no='".$addressNo."', address_lane='".$addressLane."', address_city='".$addressCity."' WHERE address_id='".$addressId."'";
																			if(mysqli_query($con, $updateEmployeeAddress)){
																				//update reg fee
																				$updatePosition = "UPDATE topup_agent SET topup_agent_regfee_id='".$regFee."' WHERE employee_nic='".$employeeNic."'";
																				if(mysqli_query($con, $updatePosition)){
																					$updateEmployeeAll = "UPDATE employee SET contact_no='".$contactNo."', employee_email='".$email."' WHERE nic='".$employeeNic."'";
																					if(mysqli_query($con, $updateEmployeeAll)){
																						//success
																						header('Location:../updateUsers.php?position=topupAgent&error=su');
																					} else {
																						//redirect to form query faile	
																						header('Location:../updateUsers.php?position=topupAgent&error=qf');
																					}
																				} else {
																					//query failed
																					header('Location:../updateUsers.php?position=topupAgent&error=qf');
																				}
																			} else {
																				//query fails
																				header('Location:../updateUsers.php?position=topupAgent&error=qf');
																			}	
																		} else {
																			//query fails
																			header('Location:../updateUsers.php?position=topupAgent&error=qf');
																		}
																	} else {
																		//user does not exist
																		header('Location:../updateUsers.php?position=topupAgent&error=nu');
																	}
																} else {
																	//another user, error message email exists
																	header('Location:../updateUsers.php?position=topupAgent&error=cu');
																}
															}
														} else {
															//email does not exists	
															//get user to update
															$getUser = "SELECT * FROM employee WHERE nic='".$employeeNic."'";
															$resultGetUser = mysqli_query($con, $getUser);
															if(mysqli_num_rows($resultGetUser) != 0){
																while($rowGetUser = mysqli_fetch_array($resultGetUser)){
																	$addressId = $rowGetUser['address_id'];
																	$nameId = $rowGetUser['name_id'];
																}
																//update user name
																$updateName = "UPDATE NAME SET first_name='".$firstName."', second_name='".$middleName."', last_name='".$lastName."' WHERE name_id='".$nameId."'";
																if(mysqli_query($con, $updateName)){
																	//update address
																	$updateEmployeeAddress = "UPDATE address SET address_no='".$addressNo."', address_lane='".$addressLane."', address_city='".$addressCity."' WHERE address_id='".$addressId."'";
																	if(mysqli_query($con, $updateEmployeeAddress)){
																		//update reg fee
																		$updatePosition = "UPDATE topup_agent SET topup_agent_regfee_id='".$regFee."' WHERE employee_nic='".$employeeNic."'";
																		if(mysqli_query($con, $updatePosition)){
																			$updateEmployeeAll = "UPDATE employee SET contact_no='".$contactNo."', employee_email='".$email."' WHERE nic='".$employeeNic."'";
																			if(mysqli_query($con, $updateEmployeeAll)){
																				//success
																				header('Location:../updateUsers.php?position=topupAgent&error=su');
																			} else {
																				//redirect to form query failed
																				header('Location:../updateUsers.php?position=topupAgent&error=qf');
																			}
																		} else {
																			//query failed
																			header('Location:../updateUsers.php?position=topupAgent&error=qf');
																		}
																	} else {
																		//query fails
																		header('Location:../updateUsers.php?position=topupAgent&error=qf');
																	}	
																} else {
																	//query fails
																	header('Location:../updateUsers.php?position=topupAgent&error=qf');
																}
															} else {
																//user does not exist
																header('Location:../updateUsers.php?position=topupAgent&error=nu');
															}
														}
													} else {
														//email
														header('Location:../updateUsers.php?position=topupAgent&error=we');
													}
												} else {
													//contact no
													header('Location:../updateUsers.php?position=topupAgent&error=wp');
												}
											} else {
												//address city
												header('Location:../updateUsers.php?position=topupAgent&error=wc');
											}
										} else {
											//address lane
											header('Location:../updateUsers.php?position=topupAgent&error=wa');
										}
									} else {
										//addres no
										header('Location:../updateUsers.php?position=topupAgent&error=wn');
									}
								} else {
									//last name is invalid
									header('Location:../updateUsers.php?position=topupAgent&error=wl');
								}
							} else {
								//middle name is invalid
								header('Location:../updateUsers.php?position=topupAgent&error=wm');
							}
						} else {
							//first name is invalid
							header('Location:../updateUsers.php?position=topupAgent&error=wf');
						}
					} else {
						//wrong nic
						header('Location:../updateUsers.php?position=topupAgent&error=wnic');
					}
				} else {
					//wrong eid
					header('Location:../updateUsers.php?position=topupAgent&error=wid');	
				}
			} else {
				//redirect to form empty fields
				header('Location:../updateUsers.php?position=topupAgent&error=ef');		
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
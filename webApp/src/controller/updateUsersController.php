<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	echo '<h1>done</h1>';
	die();
	if(!empty($_POST['position'])){
		$pos = trim($_POST['position']);
		$employeePosition = htmlspecialchars(mysqli_real_escape_string($con, $pos));
		if(isset($_POST['submit'])){
			if(!empty($_POST['eId']) || !empty($_POST['position']) || !empty($_POST['nic']) || !empty($_POST['fname']) || !empty($_POST['lname']) || !empty($_POST['addressNo']) || !empty($_POST['lane']) || !empty($_POST['city']) || !empty($_POST['email'])){
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
				if(preg_match('/^\w+$/',$eid)){
					if(preg_match('/^[a-zA-Z]+$/',$pos)){
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
															$getPosition = "SELECT position_id FROM employee_position WHERE POSITION='".$employeePosition."'";
															$resultGetPosition = mysqli_query($con, $getPosition);
															if(mysqli_num_rows($resultGetPosition) != 0){
																//position is valid
																while($rowPosition = mysqli_fetch_array($con, $resultGetPosition)){
																	$positionId = $rowPosition['position_id'];
																}
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
																						//update position
																						$updatePosition = "UPDATE staff SET employee_position_position_id='".$positionId."' WHERE employee_nic='".$employeeNic."'";
																						if(mysqli_query($con, $updatePosition)){
																							$updateEmployeeAll = "UPDATE employee SET contact_no='".$contactNo."', employee_email='".$email."' WHERE nic='".$employeeNic."'";
																							if(mysqli_query($con, $updateEmployeeContact)){
																								//success
																								if($employeePosition == "manager"){
																									header('Location:../updateUsers.php?position=manager&error=su');
																								} else if($employeePosition == "stationMaster"){
																									header('Location:../updateUsers.php?position=stationMaster&error=su');											
																								}
																							} else {
																								//redirect to form query faile
																								if($employeePosition == "manager"){
																									header('Location:../updateUsers.php?position=manager&error=qf');
																								} else if($employeePosition == "stationMaster"){
																									header('Location:../updateUsers.php?position=stationMaster&error=qf');											
																								}	
																							}
																						} else {
																							//query failed
																							if($employeePosition == "manager"){
																								header('Location:../updateUsers.php?position=manager&error=qf');
																							} else if($employeePosition == "stationMaster"){
																								header('Location:../updateUsers.php?position=stationMaster&error=qf');																								
																							}
																						}
																					} else {
																						//query fails
																						if($employeePosition == "manager"){
																							header('Location:../updateUsers.php?position=manager&error=qf');
																						} else if($employeePosition == "stationMaster"){
																							header('Location:../updateUsers.php?position=stationMaster&error=qf');
																						}
																					}	
																				} else {
																					//query fails
																					if($employeePosition == "manager"){
																						header('Location:../updateUsers.php?position=manager&error=qf');
																					} else if($employeePosition == "stationMaster"){
																						header('Location:../updateUsers.php?position=stationMaster&error=qf');
																					}
																				}
																			} else {
																				//user does not exist
																				if($employeePosition == "manager"){
																					header('Location:../updateUsers.php?position=manager&error=nu');
																				} else if($employeePosition == "stationMaster"){
																					header('Location:../updateUsers.php?position=stationMaster&error=nu');
																				}
																			}
																		} else {
																			//another user, error message email exists
																			if($employeePosition == "manager"){
																				header('Location:../updateUsers.php?position=manager&error=cu');
																			} else if($employeePosition == "stationMaster"){
																				header('Location:../updateUsers.php?position=stationMaster&error=cu');
																			}	
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
																				//update position
																				$updatePosition = "UPDATE staff SET employee_position_position_id='".$positionId."' WHERE employee_nic='".$employeeNic."'";
																				if(mysqli_query($con, $updatePosition)){
																					$updateEmployeeAll = "UPDATE employee SET contact_no='".$contactNo."', employee_email='".$email."' WHERE nic='".$employeeNic."'";
																					if(mysqli_query($con, $updateEmployeeContact)){
																						//success
																						if($employeePosition == "manager"){
																							header('Location:../updateUsers.php?position=manager&error=su');
																						} else if($employeePosition == "stationMaster"){
																							header('Location:../updateUsers.php?position=stationMaster&error=su');
																						}
																					} else {
																						//redirect to form query failed
																						if($employeePosition == "manager"){
																							header('Location:../updateUsers.php?position=manager&error=qf');
																						} else if($employeePosition == "stationMaster"){
																							header('Location:../updateUsers.php?position=stationMaster&error=qf');
																						}	
																					}
																				} else {
																					//query failed
																					if($employeePosition == "manager"){
																						header('Location:../updateUsers.php?position=manager&error=qf');
																					} else if($employeePosition == "stationMaster"){
																						header('Location:../updateUsers.php?position=stationMaster&error=qf');
																					}
																				}
																			} else {
																				//query fails
																				if($employeePosition == "manager"){
																					header('Location:../updateUsers.php?position=manager&error=qf');
																				} else if($employeePosition == "stationMaster"){
																					header('Location:../updateUsers.php?position=stationMaster&error=qf');
																				}
																			}	
																		} else {
																			//query fails
																			if($employeePosition == "manager"){
																				header('Location:../updateUsers.php?position=manager&error=qf');
																			} else if($employeePosition == "stationMaster"){
																				header('Location:../updateUsers.php?position=stationMaster&error=qf');
																			}
																		}
																	} else {
																		//user does not exist
																		if($employeePosition == "manager"){
																			header('Location:../updateUsers.php?position=manager&error=nu');
																		} else if($employeePosition == "stationMaster"){
																			header('Location:../updateUsers.php?position=stationMaster&error=nu');
																		}
																	}
																}
															} else {
																//redirect to error page invalid position 404
																header('Location:../updateUsers.php?position=manager&error=wpo');	
															}
														} else {
															//email
															if($employeePosition == "manager"){
																header('Location:../updateUsers.php?position=manager&error=we');
															} else if($employeePosition == "stationMaster"){
																header('Location:../updateUsers.php?position=stationMaster&error=we');
															}
														}
													} else {
														//contact no
														if($employeePosition == "manager"){
															header('Location:../updateUsers.php?position=manager&error=wp');
														} else if($employeePosition == "stationMaster"){
															header('Location:../updateUsers.php?position=stationMaster&error=wp');
														}
													}
												} else {
													//address city
													if($employeePosition == "manager"){
														header('Location:../updateUsers.php?position=manager&error=wc');
													} else if($employeePosition == "stationMaster"){
														header('Location:../updateUsers.php?position=stationMaster&error=wc');
													}
												}
											} else {
												//address lane
												if($employeePosition == "manager"){
													header('Location:../updateUsers.php?position=manager&error=wa');
												} else if($employeePosition == "stationMaster"){
													header('Location:../updateUsers.php?position=stationMaster&error=wa');
												}
											}
										} else {
											//addres no
											if($employeePosition == "manager"){
												header('Location:../updateUsers.php?position=manager&error=wn');
											} else if($employeePosition == "stationMaster"){
												header('Location:../updateUsers.php?position=stationMaster&error=wn');
											}
										}
									} else {
										//last name is invalid
										if($employeePosition == "manager"){
											header('Location:../updateUsers.php?position=manager&error=wl');
										} else if($employeePosition == "stationMaster"){
											header('Location:../updateUsers.php?position=stationMaster&error=wl');
										}
									}
								} else {
									//middle name is invalid
									if($employeePosition == "manager"){
										header('Location:../updateUsers.php?position=manager&error=wm');
									} else if($employeePosition == "stationMaster"){
										header('Location:../updateUsers.php?position=stationMaster&error=wm');
									}
								}
							} else {
								//first name is invalid
								if($employeePosition == "manager"){
									header('Location:../updateUsers.php?position=manager&error=wf');
								} else if($employeePosition == "stationMaster"){
									header('Location:../updateUsers.php?position=stationMaster&error=wf');
								}
							}
						} else {
							//wrong nic
							if($employeePosition == "manager"){
								header('Location:../updateUsers.php?position=manager&error=wnic');
							} else if($employeePosition == "stationMaster"){
								header('Location:../updateUsers.php?position=stationMaster&error=wnic');
							}
						}
					} else {
						//wrong position 404
						header('Location:../updateUsers.php?position=manager&error=wpo');
					}
				} else {
					//wrong eid
					if($employeePosition == "manager"){
						header('Location:../updateUsers.php?position=manager&error=wid');	
					} else if($employeePosition == "stationMaster"){
						header('Location:../updateUsers.php?position=stationMaster&error=wid');	
					}
				}
			} else {
				//redirect to form empty fields
				if($employeePosition == "manager"){
					header('Location:../updateUsers.php?position=manager&error=ef');		
				} else if($employeePosition == "stationMaster"){
					header('Location:../updateUsers.php?position=stationMaster&error=ef');	
				}
			}
		} else {
			//redirect to form not submit 404
			header('Location:../updateUsers.php?position=manager&error=ns');	
		}
	} else {
		//error page 404
		header('Location:../updateUsers.php?position=manager&error=ns');
	}	
?>
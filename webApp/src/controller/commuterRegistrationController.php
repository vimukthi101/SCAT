<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	include_once('../../ssi/smsSettings.php');
	if(isset($_SESSION['position'])){
		if($_SESSION['position'] == "registrar"){
			if(isset($_POST['submit'])){
				if(!empty($_POST['nic']) && !empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['addressNo']) && !empty($_POST['lane']) && !empty($_POST['city']) && !empty($_POST['cardNo']) && !empty($_POST['regFee'])){
					$nic = trim($_POST['nic']);
					$fn = trim($_POST['fname']);
					$mn = trim($_POST['mname']);
					$ln = trim($_POST['lname']);
					$no = trim($_POST['addressNo']);
					$lane = trim($_POST['lane']);
					$city = trim($_POST['city']);
					$phone = trim($_POST['contact']);
					$cNo = trim($_POST['cardNo']);
					$rFee = trim($_POST['regFee']);
					if(preg_match('/^\d{16}$/',$cNo)){
						if(preg_match('/^(\d){9}[v|V]$/',$nic)){
							if(preg_match('/^[a-zA-Z]+$/',$fn)){
								if(preg_match('/^[a-zA-Z]*$|^$/',$mn)){
									if(preg_match('/^[a-zA-Z]+$/',$ln)){
										if(preg_match('/^([0-9].*[\\/][a-zA-Z0-9]*)|([0-9].*)$/',$no)){
											if(preg_match('/^[a-zA-Z]+$/',$lane)){
												if(preg_match('/^[a-zA-Z]+$/',$city)){
													if(preg_match('/^\d{10}$/',$phone)){
														if(preg_match('/^\d+\.(\d{2})$/',$rFee)){
															$cardNo = htmlspecialchars(mysqli_real_escape_string($con, $cNo));
															$commuterNic = htmlspecialchars(mysqli_real_escape_string($con, $nic));
															$firstName = htmlspecialchars(mysqli_real_escape_string($con, $fn));
															$middleName = htmlspecialchars(mysqli_real_escape_string($con, $mn));
															$lastName = htmlspecialchars(mysqli_real_escape_string($con, $ln));
															$addressNo = htmlspecialchars(mysqli_real_escape_string($con, $no));
															$addressLane = htmlspecialchars(mysqli_real_escape_string($con, $lane));
															$addressCity = htmlspecialchars(mysqli_real_escape_string($con, $city));
															$contactNo = htmlspecialchars(mysqli_real_escape_string($con, $phone));
															$regFee = htmlspecialchars(mysqli_real_escape_string($con, $rFee));
															//check whether the card already exists
															$Enic = $_SESSION['nic'];
															$getCard = "SELECT pin FROM card WHERE card_no='".$cardNo."' AND issued_to_commuter='0' AND station_station_code  IN (SELECT station_code FROM staff WHERE employee_nic='".$Enic."')";
															$resultgetCard = mysqli_query($con, $getCard);
															if(mysqli_num_rows($resultgetCard) == 1){
																while($rowCard = mysqli_fetch_array($resultgetCard)){
																	$pin = $rowCard['pin'];
																}
																$pass = md5($pin);
																//check for nic
																$getCommuter = "SELECT * FROM commuter WHERE nic='".$commuterNic."'";															
																$resultGetCommuter = mysqli_query($con, $getCommuter);
																if(mysqli_num_rows($resultGetCommuter) == 0){
																	//insert name
																	$name = "INSERT INTO NAME(first_name, second_name, last_name) VALUES ('".$firstName."','".$middleName."','".$lastName."')";
																	if(mysqli_query($con, $name)){
																		$nameId = mysqli_insert_id($con);
																		//insert address
																		$address = "INSERT INTO address(address_no, address_lane, address_city) VALUES('".$addressNo."','".$addressLane."','".$addressCity."')";
																		if(mysqli_query($con, $address)){
																			$addressId = mysqli_insert_id($con);
																			//add commuter
																			$date = date("Y-m-d H:i:s");
																			$commuter = "INSERT INTO commuter VALUES('".$commuterNic."','".$contactNo."','".$date."','1','0.00','".$addressId."','".$cardNo."','".$nameId."','".$pass."','','0')";
																			if(mysqli_query($con, $commuter)){
																				//update card
																				$update = "UPDATE card SET issued_to_commuter='1' WHERE card_no='".$cardNo."'";
																				if(mysqli_query($con, $update)){
																					//reg fee
																					$get = "SELECT regfee_id FROM commuter_regfee WHERE reg_fee='".$regFee."'";
																					$result = mysqli_query($con, $get);
																					if(mysqli_num_rows($result)!=0){
																						while($row = mysqli_fetch_array($result)){
																							$regId = $row['regfee_id'];
																						}
																						//payment
																						$payment = "INSERT INTO registrar_payment(payment_date_time,commuter_nic,commuter_regfee_regfee_id,employee_nic,STATUS) VALUES ('".$date."','".$commuterNic."','".$regId."','".$Enic."','0')";
																						if(mysqli_query($con, $payment)){
																							//send sms with activated and with new pin
																							if(!empty($contactNo)){
																								$newContact = "94". trim($contactNo,"0");
																								$DestinationAddress = $newContact;
$Message = "Your SCAT Account is created!

PIN : ".$pin."

Thank You!
-SCAT System-";
																								try
																								{
																									// Send SMS through the HTTP API
																									$Result = $ViaNettSMS->SendSMS($MsgSender, $DestinationAddress, $Message);
																									// Check result object returned and give response to end user according to success or not.
																									if ($Result->Success == true)
																										$Message = "Message successfully sent!";
																									else
																										$Message = "Error occured while sending SMS<br />Errorcode: " . $Result->ErrorCode . "<br />Errormessage: " . $Result->ErrorMessage;
																								}
																								catch (Exception $e)
																								{
																									//Error occured while connecting to server.
																									$Message = $e->getMessage();
																								}
																							}
																							//success
																							header('Location:../commuterRegistration.php?position=manager&error=as');
																						} else {
																							//query failed
																							header('Location:../commuterRegistration.php?position=manager&error=fq');
																						}
																					} else {
																						//query failed
																						header('Location:../commuterRegistration.php?position=manager&error=fq');
																					}
																				} else {
																					//query failed
																					header('Location:../commuterRegistration.php?position=manager&error=fq');
																				}
																			} else {
																				//query failed
																				header('Location:../commuterRegistration.php?position=manager&error=fq');
																			}
																		} else {
																			//query failed
																			header('Location:../commuterRegistration.php?position=manager&error=fq');
																		}
																	} else {
																		//query failed
																		header('Location:../commuterRegistration.php?position=manager&error=fq');
																	}
																} else {
																	//nic exists
																	header('Location:../commuterRegistration.php?position=manager&error=ne');
																}
															} else {
																//invalid card
																header('Location:../commuterRegistration.php?position=manager&error=weid');
															}
														} else {
															//wrong reg fee format
															header('Location:../commuterRegistration.php?position=manager&error=wfee');
														}
													} else {
														//wrong contact no format	
														header('Location:../commuterRegistration.php?position=manager&error=wp');
													}
												} else {
													//wrong city format	
													header('Location:../commuterRegistration.php?position=manager&error=wc');
												}
											} else {
												//wrong lane format	
												header('Location:../commuterRegistration.php?position=manager&error=wa');
											}
										} else {
											//wrong address no format	
											header('Location:../commuterRegistration.php?position=manager&error=wn');
										}
									} else {
										//wrong last name format	
										header('Location:../commuterRegistration.php?position=manager&error=wl');
									}
								} else {
									//wrong middle name format	
									header('Location:../commuterRegistration.php?position=manager&error=wm');
								}
							} else {
								//wrong first name format	
								header('Location:../commuterRegistration.php?position=manager&error=wf');
							}
						} else {
							//wrong NIC format	
							header('Location:../commuterRegistration.php?position=manager&error=wnic');
						}
					} else {
						//wrong card number format	
						header('Location:../commuterRegistration.php?position=manager&error=weid');
					}
				} else {
					//redirect to form empty fields
					header('Location:../commuterRegistration.php?position=manager&error=ef');
				}
			} else {
				//redirect to form not submit
				header('Location:../commuterRegistration.php?position=manager&error=ns');
			}
		} else {
			//redirect to 404
			header('Location:../../404.php');
		}
	} else {
		//redirect to 404
		header('Location:../../404.php');
	}
?>
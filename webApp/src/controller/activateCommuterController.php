<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	if(isset($_SESSION['position']) && ($_SESSION['position'] == "registrar")){
		if(isset($_POST['submit'])){
			if(!empty($_POST['CardNumber']) || !empty($_POST['status']) || !empty($_POST['nic']) || !empty($_POST['fname']) || !empty($_POST['lname']) || !empty($_POST['addressNo']) || !empty($_POST['lane']) || !empty($_POST['city'])){
				$fn = trim($_POST['fname']);
				$mn = trim($_POST['mname']);
				$ln = trim($_POST['lname']);
				$no = trim($_POST['addresNo']);
				$lane = trim($_POST['lane']);
				$city = trim($_POST['city']);
				$phone = trim($_POST['contact']);
				$nic = trim($_POST['nic']);
				$cNo = trim($_POST['CardNumber']);
				$s = trim($_POST['status']);
				if(preg_match('/^\d{16}$/',$cNo)){
					if(preg_match('/^(\d){9}[v|V]$/',$nic)){
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
													$commuterNic = htmlspecialchars(mysqli_real_escape_string($con, $nic));
													$cardNumber = htmlspecialchars(mysqli_real_escape_string($con, $cNo));
													$st = htmlspecialchars(mysqli_real_escape_string($con, $s));
													$get = "SELECT * FROM commuter WHERE card_card_no='".$cardNumber."' AND nic='".$commuterNic."'";
													$result = mysqli_query($con, $get);
													if(mysqli_num_rows($result) == 1){
														if($st == "Active"){
															$update = "UPDATE commuter SET STATUS='0' WHERE nic='".$commuterNic."'";
															if(mysqli_query($con, $update)){
																//success
																header('Location:../activateCards.php?error=sud');
																//send sms with disabled
																
																
																
																
																
																
																
																
																
															} else {
																//query failed
																header('Location:../activateCards.php?error=qfd');
															}
														} else if($st == "Disabled"){
															$rand = rand(1000,9999);
															$pass = md5($rand);
															$update = "UPDATE commuter SET STATUS='1', PASSWORD='".$pass."', previous_password='', login_attempt='0' WHERE nic='".$commuterNic."'";
															if(mysqli_query($con, $update)){
																//success
																header('Location:../activateCards.php?error=sua');
																//send sms with activated and with new pin
																
																
																
																
																
																
															} else {
																//query failed
																header('Location:../activateCards.php?error=qfa');
															}
														} else {
															//wrong status
															header('Location:../activateCards.php?error=ws');
														}
													} else {
														//invalid user
														header('Location:../activateCards.php?error=iu');
													}
												} else {
													//contact no
													header('Location:../activateCards.php?error=wp');
												}
											} else {
												//address city
												header('Location:../activateCards.php?error=wc');
											}
										} else {
											//address lane
											header('Location:../activateCards.php?error=wa');
										}
									} else {
										//addres no
										header('Location:../activateCards.php?error=wn');
									}
								} else {
									//last name is invalid
									header('Location:../activateCards.php?error=wl');
								}
							} else {
								//middle name is invalid
								header('Location:../activateCards.php?error=wm');
							}
						} else {
							//first name is invalid
							header('Location:../activateCards.php?error=wf');
						}
					} else {
						//wrong nic
						header('Location:../activateCards.php?error=wnic');
					}
				} else {
					//wrong card Number
					header('Location:../activateCards.php?error=wcn');	
				}
			} else {
				//redirect to form empty fields
				header('Location:../activateCards.php?error=ef');		
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
<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	include_once('../../ssi/smsSettings.php');
	if(isset($_SESSION['nic'])){
		if(isset($_POST['submit'])){
			if(!empty($_POST['CardNumber']) || !empty($_POST['nic']) || !empty($_POST['name']) || !empty($_POST['pin']) || !empty($_POST['amount'])){
				$c = trim($_POST['nic']);
				$a = trim($_POST['amount']);
				$p = trim($_POST['pin']);
				$commuterTwo = htmlspecialchars(mysqli_real_escape_string($con, $c));
				$amount = htmlspecialchars(mysqli_real_escape_string($con, $a));
				$pin = htmlspecialchars(mysqli_real_escape_string($con, $p));
				$commuterOne = $_SESSION['nic']; 
				if(preg_match('/^(\d){9}[v|V]$/',$commuterOne)){
					if(preg_match('/^\d{4}$/',$pin)){
						if(preg_match('/^\d+\.(\d{2})$/',$amount)){
							$getCommuterOne = "SELECT * FROM commuter WHERE nic='".$commuterOne."'";
							$resultCommuterOne = mysqli_query($con, $getCommuterOne);
							if(mysqli_num_rows($resultCommuterOne) != 0){
								while($row = mysqli_fetch_array($resultCommuterOne)){
									$balance = $row['credit'];
									$pass = $row['password'];
								}
								$newPin = md5($pin);
								if($newPin == $pass){
									if($balance > $amount){
										$getCommuterTwo = "SELECT * FROM commuter WHERE nic='".$commuterTwo."'";
										$resultCommuterTwo = mysqli_query($con, $getCommuterTwo);
										if(mysqli_num_rows($resultCommuterTwo) != 0){
											while($rowComTwo = mysqli_fetch_array($resultCommuterTwo)){
												$contactTwo = $rowComTwo['contact_no'];
											}
											$reduce = "UPDATE commuter SET credit=credit-'".$amount."' WHERE nic='".$commuterOne."'";
											if(mysqli_query($con, $reduce)){
												$increase = "UPDATE commuter SET credit=credit+'".$amount."' WHERE nic='".$commuterTwo."'";
												if(mysqli_query($con, $increase)){
													//get credit of commuter one and commuter two
													$getBalanceC1 = "SELECT credit FROM commuter WHERE nic='".$commuterOne."'";
													$resultBalanceC1 = mysqli_query($con, $getBalanceC1);
													if(mysqli_num_rows($resultBalanceC1) != 0){
														while($rowC1 = mysqli_fetch_array($resultBalanceC1)){
															$creditOne = $rowC1['credit'];
														}
														$getBalanceC2 = "SELECT credit FROM commuter WHERE nic='".$commuterTwo."'";
														$resultBalanceC2 = mysqli_query($con, $getBalanceC2);
														if(mysqli_num_rows($resultBalanceC2) != 0){
															while($rowC2 = mysqli_fetch_array($resultBalanceC2)){
																$creditTwo = $rowC2['credit'];
															}
															if(!empty($contactTwo)){
																//send sms to commuter two with balance
																$newContact = "94". trim($contactTwo,"0");
																$DestinationAddress = $newContact;
$Message = "You received a transfer of Rs.".$amount." from ".$commuterOne." successfully!

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
														} else {
															//no result
															header('Location:../transfer.php?error=nr');
														}
													} else {
														//no result
														header('Location:../transfer.php?error=nr');
													}
													//success
													header('Location:../balance.php');
												} else {
													//query failed
													header('Location:../transfer.php?error=qf');
												}
											} else {
												//query failed
												header('Location:../transfer.php?error=qf');
											}
										} else {
											//commuter two not exists
											header('Location:../transfer.php?error=cde');
										}
									} else {
										//get credit of commuter one
										$getIB = "SELECT credit FROM commuter WHERE nic='".$commuterOne."'";
										$resultIB = mysqli_query($con, $getIB);
										if(mysqli_num_rows($resultIB) != 0){
											while($rowIB = mysqli_fetch_array($resultIB)){
												$IB = $rowIB['credit'];
											}
										}
										//insufficient credits
										header('Location:../transfer.php?error=ib');
									}
								} else {
									//wrong pin
									header('Location:../transfer.php?error=dm');
								}
							} else {
								//commuter one not exists
								header('Location:../transfer.php?error=cde');
							}
						} else {
							//invalid amount format
							header('Location:../transfer.php?error=ia');
						}
					} else {
						//wrong pin format
						header('Location:../transfer.php?error=wp');
					}
				} else {
					//wrong nic format
					header('Location:../transfer.php?error=wn');
				}
			} else {
				//empty fields redirect to cards
				header('Location:../transfer.php?error=ef');
			}
		} else {
			//if submit button is not clicked
			header('Location:../../404.php');	
		}
	} else {
		//if session not set
		header('Location:../../404.php');	
	}
?>
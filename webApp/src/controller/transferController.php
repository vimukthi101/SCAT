<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	if(isset($_SESSION['position'])){
		if($_SESSION['position'] == "topupAgent" || $_SESSION['position'] == "registrar"){
			if(isset($_POST['submit'])){
				if(!empty($_POST['CardNumber']) || !empty($_POST['nic']) || !empty($_POST['name']) || !empty($_POST['pin']) || !empty($_POST['hpin']) || !empty($_POST['CardNumber2']) || !empty($_POST['nic2']) || !empty($_POST['name2']) || !empty($_POST['amount'])){
					$c1 = trim($_POST['nic']);
					$c2 = trim($_POST['nic2']);
					$a = trim($_POST['amount']);
					$p = trim($_POST['pin']);
					$hp = trim($_POST['hpin']);
					$cn1 = trim($_POST['contact']);
					$cn2 = trim($_POST['contact2']);
					$commuterOne = htmlspecialchars(mysqli_real_escape_string($con, $c1));
					$commuterTwo = htmlspecialchars(mysqli_real_escape_string($con, $c2));
					$amount = htmlspecialchars(mysqli_real_escape_string($con, $a));
					$pin = htmlspecialchars(mysqli_real_escape_string($con, $p));
					$hiddenPin = htmlspecialchars(mysqli_real_escape_string($con, $hp));
					$contact = htmlspecialchars(mysqli_real_escape_string($con, $cn1));
					$contactTwo = htmlspecialchars(mysqli_real_escape_string($con, $cn2));
					if(!empty($contact)){
						if(preg_match('/^(\d){9}[v|V]$/',$commuterOne)){
							if(preg_match('/^(\d){9}[v|V]$/',$commuterTwo)){
								if(preg_match('/^\d{4}$/',$pin)){
									if(preg_match('/^\d{4}$/',$hiddenPin)){
										if($pin == $hiddenPin){
											if($commuterOne != $commuterTwo){
												if(preg_match('/^\d+\.(\d{2})$/',$amount)){
													$getCommuterOne = "SELECT * FROM commuter WHERE nic='".$commuterOne."'";
													$resultCommuterOne = mysqli_query($con, $getCommuterOne);
													if(mysqli_num_rows($resultCommuterOne) != 0){
														while($row = mysqli_fetch_array($resultCommuterOne)){
															$balance = $row['credit'];
														}
														if($balance > $amount){
															$getCommuterTwo = "SELECT * FROM commuter WHERE nic='".$commuterTwo."'";
															$resultCommuterTwo = mysqli_query($con, $getCommuterTwo);
															if(mysqli_num_rows($resultCommuterTwo) != 0){
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
																				//send sms to commuter one with balance
																				
																				
																				
																				
																				
																				
																				
																				if(!empty($contactTwo)){
																					//send sms to commuter two with balance
																					
																					
																					
																					
																					
																					
																					
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
																		header('Location:../transfer.php?error=su');
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
															//send sms with balance to commuter one
															
															
															
															
															
															
															
															//insufficient credits
															header('Location:../transfer.php?error=ib');
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
												//commuter one and two are same	
												header('Location:../transfer.php?error=sc');
											}
										} else {
											//pin and cpin does not match
											header('Location:../transfer.php?error=dm');
										}
									} else {
										//wrong confirm pin format
										header('Location:../transfer.php?error=wp');
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
							//wrong nic format
							header('Location:../transfer.php?error=wn');
						}	
					} else {
						//no contact number
						header('Location:../transfer.php?error=nc');	
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
			//if not toup agent or registar
			header('Location:../../404.php');	
		}
	} else {
		//if session not set
		header('Location:../../404.php');	
	}
?>
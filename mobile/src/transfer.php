<?php
//errors will not be shown
//error_reporting(0);
include_once('../ssi/db.php');
include_once('../ssi/smsSettings.php');
if(!empty($_POST['nic']) || !empty($_POST['amount']) || !empty($_POST['user'])){
	$c = trim($_POST['nic']);
	$a = trim($_POST['amount']);
	$u = trim($_POST['user']);
	$commuterTwo = htmlspecialchars(mysqli_real_escape_string($con, $c));
	$commuterOne = htmlspecialchars(mysqli_real_escape_string($con, $u));
	$amount = htmlspecialchars(mysqli_real_escape_string($con, $a));
	if(preg_match('/^(\d){9}[v|V]$/',$commuterOne)){
		if(preg_match('/^(\d){9}[v|V]$/',$commuterTwo)){
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
									} else {
										//no result
										echo 'ERROR';
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
										echo 'ERROR';
									}
									//success
									$arr = array('result'=>'SUCCESS','balance'=>$creditOne);
									echo json_encode($arr);
								} else {
									//query failed
									echo 'ERROR';
								}
							} else {
								//query failed
								echo 'ERROR';
							}
						} else {
							//commuter two not exists
							echo 'IUSER';
						}
					} else {
						//insufficient credits
						echo 'IBALANCE';
					}
				} else {
					//commuter one not exists
					echo 'IUSER';
				}
			} else {
				//invalid amount format
				echo 'WAMOUNT';
			}	
		} else {
			//wrong nic format
			echo 'WNIC';
		}
	} else {
		//wrong nic format
		echo 'WNIC';
	}
} else {
	//empty fields redirect to cards
	echo 'EMPTY';
}
?>
<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	if(isset($_SESSION['position'])){
		if($_SESSION['position'] == "stationMaster"){
			if(isset($_POST['submit'])){
				if(!empty($_POST['rID']) || !empty($_POST['nRequest']) || !empty($_POST['dRequest']) || !empty($_POST['nSend']) || !empty($_POST['dSend'])){
					$id = trim($_POST['rID']);
					$dSend = trim($_POST['dSend']);
					$nSend = trim($_POST['nSend']);
					$rID = htmlspecialchars(mysqli_real_escape_string($con, $id));
					$get = "SELECT status_id FROM card_request_status WHERE status_type='received'";
					$getResult = mysqli_query($con, $get);
					if(mysqli_num_rows($getResult) != 0){
						while($row = mysqli_fetch_array($getResult)){
							$sId = $row['status_id'];
						}
						$date = date('Y-m-d H:i:s');
						$set = "UPDATE card_request SET card_request_status_status_id='".$sId."', received_date='".$date."' WHERE request_id='".$rID."'";
						if(mysqli_query($con, $set)){
							//get station
							$getStation = "SELECT station_code, station_name FROM station WHERE employee_nic='".$_SESSION['nic']."'";
							$resultStation = mysqli_query($con, $getStation);
							if(mysqli_num_rows($resultStation) != 0){
								while($rowStation = mysqli_fetch_array($resultStation)){
									$sCode = $rowStation['station_code'];
									$sName = $rowStation['station_name'];
								}
								$addCards = "UPDATE station SET available_cards = available_cards + '".$nSend."' WHERE station_code='".$sCode."'";
								if(mysqli_query($con, $addCards)){
									//success
									//send mail to managers
									$getEmp = "SELECT employee_email FROM employee WHERE nic IN (SELECT employee_nic FROM staff WHERE employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='manager'))";
									$resultEmp = mysqli_query($con, $getEmp);
									if(mysqli_num_rows($resultEmp) != 0){
										while($rowEmail = mysqli_fetch_array($resultEmp)){
										//send email with received
$to = $rowEmail['employee_email'];														
$subject = "Card Request Has Being Received";
$message = "<p>Dear Manager,</p>
<br/>
<p>Card request sent on ".$dSend." of ".$nSend." to ".$sName." station has being received,</p>
<br/>
<h4>Station : ".$sCode." - ".$sName."</h4>
<h4>Received Date : ".$date."</h4>
<h4>Received Number Of Cards : ".$nSend."</h4>
<br/>
<p>Thank You!</p>
<p>S.C.A.T System</p>";
											$headers = "MIME-Version: 1.0" . "\r\n";
											$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
											mail($to, $subject, $message, $headers);
										}
									}
									//success
									header('Location:../receivedCards.php?error=su');
								} else {
									//query failed
									header('Location:../receivedCards.php?error=qf');	
								}
							}
						} else {
							//failed
							header('Location:../receivedCards.php?error=qf');
						}
					} else {
						//error
						header('Location:../receivedCards.php?error=cu');
					}
				} else {
					//empty fields redirect to cards
					header('Location:../receivedCards.php?error=ef');
				}
			} else {
				//not submitted
				header('Location:../../404.php');
			}
		} else {
			//if not station master
			header('Location:../../404.php');	
		}
	} else {
		//if session not set
		header('Location:../../404.php');	
	}
?>
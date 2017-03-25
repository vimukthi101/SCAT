<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	include_once('../../ssi/smtpSettings.php');
	if(isset($_SESSION['position']) && $_SESSION['position'] == "sysadmin"){
		if(isset($_POST['submit'])){
			if(!empty($_POST['tCode']) && !empty($_POST['tName']) && !empty($_POST['tType'])){
				$cno = trim($_POST['tCode']);
				$p = trim($_POST['tName']);
				$cp = trim($_POST['tType']);
				$trainCode = htmlspecialchars(mysqli_real_escape_string($con, $cno));
				$trainName = htmlspecialchars(mysqli_real_escape_string($con, $p));
				$trainType = htmlspecialchars(mysqli_real_escape_string($con, $cp));
				if(preg_match('/^\d+$/',$trainCode)){
					if(preg_match('/^[a-zA-Z]+$|^$/',$trainName)){
						if(preg_match('/^[a-zA-Z]+$/',$trainType)){
							$getTrains = "SELECT * FROM train WHERE train_name='".$trainName."'";
							$resultTrains = mysqli_query($con, $getTrains);
							if(mysqli_num_rows($resultTrains) != 0){
								$getTrain = "SELECT * FROM timetable WHERE train_train_id='".$trainCode."'";
								$resultTrain = mysqli_query($con, $getTrain);
								if(mysqli_num_rows($resultTrain) == 0){
									//not used in timetable
									$delete = "DELETE FROM train WHERE train_id='".$trainCode."'";
									if(mysqli_query($con, $delete)){
										$getEmp = "SELECT employee_email FROM employee WHERE nic IN (SELECT employee_nic FROM staff WHERE employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='manager'))";
										$resultEmp = mysqli_query($con, $getEmp);
										if(mysqli_num_rows($resultEmp) != 0){
											while($rowEmail = mysqli_fetch_array($resultEmp)){
												//send email with new station
												$to = $rowEmail['employee_email'];	
												//Set who the message is to be sent to
												$mail->addAddress($to, $to);
												//Set the subject line
												$mail->Subject = "Train Has Being Deleted";
$mail->Body ="Dear Manager,

Following train has being removed from the system,

	Train Code : ".$trainCode."
	Train Name : ".$trainName."
	Train Type : ".$trainType."

Thank You!
S.C.A.T Admin";
												if (!$mail->send()) {
													//success
													header('Location:../deleteTrains.php?error=su');
												}
											}
										}
										//success
										header('Location:../deleteTrains.php?error=su');
									} else {
										//query failed
										header('Location:../deleteTrains.php?error=qf');
									}
								} else {
									//used in timetable cannot delete
									header('Location:../deleteTrains.php?error=ae');
								}
							} else {
								//not found
								header('Location:../deleteTrains.php?error=nf');
							}
						} else {
							//wrong train type format
							header('Location:../deleteTrains.php?error=wt');
						}
					} else {
						//wrong train name format
						header('Location:../deleteTrains.php?error=wn');
					}
				} else {
					//wrong train code format
					header('Location:../deleteTrains.php?error=wc');
				}
			} else {
				//empty fields redirect to cards
				header('Location:../deleteTrains.php?error=ef');
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
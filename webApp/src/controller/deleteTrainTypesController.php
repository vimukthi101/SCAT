<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	if(isset($_SESSION['position']) && $_SESSION['position'] == "sysadmin"){
		if(isset($_POST['submit'])){
			if(!empty($_POST['tId']) && !empty($_POST['tName'])){
				$t = trim($_POST['tId']);
				$n = trim($_POST['tName']);
				$typeId = htmlspecialchars(mysqli_real_escape_string($con, $t));
				$typeName = htmlspecialchars(mysqli_real_escape_string($con, $n));
				if(preg_match('/^[a-zA-Z]+$/',$typeId)){
					if(preg_match('/^[a-zA-Z]+$/',$typeName)){
						$getTrains = "SELECT * FROM train WHERE train_type_type_id='".$typeId."'";
						$resultGetTrains = mysqli_query($con, $getTrains);
						if(mysqli_num_rows($resultGetTrains) == 0){
							$deleteTypes = "DELETE FROM train_type WHERE type_id='".$typeId."'";
							if(mysqli_query($con, $deleteTypes)){
								$getEmp = "SELECT employee_email FROM employee WHERE nic IN (SELECT employee_nic FROM staff WHERE employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='manager'))";
								$resultEmp = mysqli_query($con, $getEmp);
								if(mysqli_num_rows($resultEmp) != 0){
									while($rowEmail = mysqli_fetch_array($resultEmp)){
										//send email with new station
$to = $rowEmail['employee_email'];														
$subject = "Train Type Has Being Deleted";
$message = "<p>Dear Manager,</p>
<br/>
<p>Following train type has being removed from the system,</p>
<br/>
<h4>Train Type Code : ".$typeId."</h4>
<h4>Train Type Name : ".$typeName."</h4>
<br/>
<p>Thank You!</p>
<p>S.C.A.T Admin</p>";
										$headers = "MIME-Version: 1.0" . "\r\n";
										$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
										mail($to, $subject, $message, $headers);
									}
								}
								//success
								header('Location:../deleteTrainTypes.php?error=su');
							} else {
								//query failes
								header('Location:../deleteTrainTypes.php?error=qf');
							}
						} else {
							//used in a train
							header('Location:../deleteTrainTypes.php?error=ae');
						}
					} else {
						//wrong name format
						header('Location:../deleteTrainTypes.php?error=wn');
					}
				} else {
					//wrong id format
					header('Location:../deleteTrainTypes.php?error=wi');
				}
			} else {
				//empty fields redirect to cards
				header('Location:../deleteTrainTypes.php?error=ef');
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
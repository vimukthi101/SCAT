<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	if(isset($_SESSION['position'])){
		if($_SESSION['position'] == "sysadmin"){
			if(isset($_POST['submit'])){
				if(!empty($_POST['tType']) && !empty($_POST['tId'])){
					$tType = trim($_POST['tType']);
					$tId = trim($_POST['tId']);
					$trainType = htmlspecialchars(mysqli_real_escape_string($con, $tType));
					$trainTypeId = htmlspecialchars(mysqli_real_escape_string($con, $tId));
					if(preg_match('/^[a-zA-Z]+$/', $trainType)){
						if(preg_match('/^[a-zA-Z]+$/', $trainTypeId)){
							$getTypes = "SELECT * FROM train_type WHERE type_name='".$trainType."' OR type_id='".$trainTypeId."'";
							$resultTypes = mysqli_query($con, $getTypes);
							if(mysqli_num_rows($resultTypes) == 0){
								$addType = "INSERT INTO train_type VALUES('".$trainTypeId."','".$trainType."')";
								if(mysqli_query($con, $addType)){
									$getEmp = "SELECT employee_email FROM employee WHERE nic IN (SELECT employee_nic FROM staff WHERE employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='manager'))";
									$resultEmp = mysqli_query($con, $getEmp);
									if(mysqli_num_rows($resultEmp) != 0){
										while($rowEmail = mysqli_fetch_array($resultEmp)){
											//send email with new station
$to = $rowEmail['employee_email'];														
$subject = "Train Type Has Being Added";
$message = "<p>Hi Manager,</p>
<br/>
<p>Following train type has being added to the system,</p>
<br/>
<h4>Train Type ID : ".$trainTypeId."</h4>
<h4>Train Type : ".$trainType."</h4>
<br/>
<p>Thank You!</p>
<p>S.C.A.T Admin</p>";
											$headers = "MIME-Version: 1.0" . "\r\n";
											$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
											mail($to, $subject, $message, $headers);
										}
									}
									//success
									header('Location:../addTrainTypes.php?error=su');
								} else {
									//query failed
									header('Location:../addTrainTypes.php?error=qf');
								}
							} else {
								//type or name exists
								header('Location:../addTrainTypes.php?error=te');
							}
						} else {
							//wrong format for ID
							header('Location:../addTrainTypes.php?error=wf');
						}
					} else {
						//wrong format for name
						header('Location:../addTrainTypes.php?error=wf');
					}
				} else {
					//empty fields redirect to cards
					header('Location:../addTrainTypes.php?error=ef');
				}
			} else {
				//if submit button is not clicked
				header('Location:../../404.php');	
			}
		} else {
			//if not sysadmin
			header('Location:../../404.php');	
		}
	} else {
		//if session not set
		header('Location:../../404.php');	
	}
?>
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
				if(!empty($_POST['CardNumber']) || !empty($_POST['nic']) || !empty($_POST['name']) || !empty($_POST['contact']) || !empty($_POST['amount'])){
					$cno = trim($_POST['CardNumber']);
					$p = trim($_POST['nic']);
					$cp = trim($_POST['contact']);
					$a = trim($_POST['amount']);
					$cardNo = htmlspecialchars(mysqli_real_escape_string($con, $cno));
					$nic = htmlspecialchars(mysqli_real_escape_string($con, $p));
					$contact = htmlspecialchars(mysqli_real_escape_string($con, $cp));
					$amount = htmlspecialchars(mysqli_real_escape_string($con, $a));
					if(preg_match('/^\d+\.\d{2}$/',$amount)){
						$get = "SELECT * FROM commuter WHERE nic='".$nic."' AND card_card_no='".$cardNo."'";
						$result = mysqli_query($con, $get);
						if(mysqli_num_rows($result) != 0){
							$update = "UPDATE commuter SET credit=credit+'".$amount."' WHERE nic='".$nic."'";
							if(mysqli_query($con, $update)){
								$date = date("Y-m-d H:i:s");
								$employee = $_SESSION['nic'];
								$insert = "INSERT INTO recharge(recharge_date_time, amount, card_card_no, employee_nic) VALUES('".$date."','".$amount."','".$cardNo."','".$employee."')";
								if(mysqli_query($con, $insert)){
									//send sms to commuter
									
									//success
									header('Location:../topup.php?error=su');
								} else {
									//query failed
									header('Location:../topup.php?error=qf');
								}
							} else {
								//query failed
								header('Location:../topup.php?error=qf');
							}
						} else {
							//wrong commuter
							header('Location:../topup.php?error=wc');
						}
					} else {
						//wrong amount format
						header('Location:../topup.php?error=wa');
					}
				} else {
					//empty fields redirect to cards
					header('Location:../topup.php?error=ef');
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
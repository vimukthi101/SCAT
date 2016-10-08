<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	if(isset($_SESSION['position']) && $_SESSION['position'] == "sysadmin"){
		if(isset($_POST['submit'])){
			if(!empty($_POST['cNo']) && !empty($_POST['pin'])){
				$cno = trim($_POST['cNo']);
				$p = trim($_POST['pin']);
				$cardNo = htmlspecialchars(mysqli_real_escape_string($con, $cno));
				$pin = htmlspecialchars(mysqli_real_escape_string($con, $p));
				if(preg_match('/^\d{16}$/',$cardNo)){
					if(preg_match('/^\d{4}$/',$pin)){
						$getCard = "SELECT * FROM card WHERE card_no='".$cardNo."'";
						$resultGetCard = mysqli_query($con, $getCard);
						if(mysqli_num_rows($resultGetCard) != 0){
							$deleteCards = "DELETE FROM card WHERE card_no='".$cardNo."'";
							if(mysqli_query($con, $deleteCards)){
								//success
								header('Location:../deleteCards.php?error=su');
							} else {
								//query failed
								header('Location:../deleteCards.php?error=qf');
							}
						} else {
							//no card
							header('Location:../deleteCards.php?error=nc');
						}
					} else {
						//wrong pin format
						header('Location:../deleteCards.php?error=wp');
					}
				} else {
					//wrong card number format
					header('Location:../deleteCards.php?error=wn');
				}
			} else {
				//empty fields redirect to cards
				header('Location:../deleteCards.php?error=ef');
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
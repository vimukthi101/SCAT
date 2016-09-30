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
				if(!empty($_POST['cardNo'])){
					$cno = trim($_POST['cardNo']);
					$cardNo = htmlspecialchars(mysqli_real_escape_string($con, $cno));
					if(preg_match('/^\d{16}$/',$cardNo)){
						$pin = rand(1000, 9999);
						$getCard = "SELECT * FROM card WHERE card_no='".$cardNo."'";
						$resultCard = mysqli_query($con, $getCard);
						if(mysqli_num_rows($resultCard) == 0){
							$addCard = "INSERT INTO card (card_no, pin) VALUES('".$cardNo."','".$pin."')";
							if(mysqli_query($con, $addCard)){
								//success
								header('Location:../addCard.php?error=su');
							} else {
								//query failed
								header('Location:../addCard.php?error=qf');
							}
						} else {
							//card exists
							header('Location:../addCard.php?error=ce');
						}
					} else {
						//wrong card number format
						header('Location:../addCard.php?error=wn');
					}
				} else {
					//empty fields redirect to cards
					header('Location:../addCard.php?error=ef');
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
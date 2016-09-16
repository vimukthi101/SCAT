<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	if(isset($_SESSION['position']) && $_SESSION['position'] == "sysadmin"){
		if(isset($_POST['submit'])){
			if(!empty($_POST['cNo']) && !empty($_POST['pin']) && !empty($_POST['cPin']) && !empty($_POST['oldCNo'])){
				$cno = trim($_POST['cNo']);
				$p = trim($_POST['pin']);
				$cp = trim($_POST['cPin']);
				$old = trim($_POST['oldCNo']);
				$cardNo = htmlspecialchars(mysqli_real_escape_string($con, $cno));
				$pin = htmlspecialchars(mysqli_real_escape_string($con, $p));
				$cPin = htmlspecialchars(mysqli_real_escape_string($con, $cp));
				$oldCardNo = htmlspecialchars(mysqli_real_escape_string($con, $old));
				if(preg_match('/^\d{16}$/',$cardNo)){
					if(preg_match('/^\d{4}$/',$pin)){
						if(preg_match('/^\d{4}$/',$cPin)){
							if($pin == $cPin){
								if($cardNo == $oldCardNo){
									//card number not changed
									$getCard = "SELECT * FROM card WHERE card_no='".$cardNo."'";
									$resultCard = mysqli_query($con, $getCard);
									if(mysqli_num_rows($resultCard) <= 1){
										$addCard = "UPDATE card SET card_no='".$cardNo."', pin='".$pin."' WHERE card_no='".$oldCardNo."'";
										if(mysqli_query($con, $addCard)){
											//success
											header('Location:../updateCards.php?error=su');
										} else {
											//query failed
											header('Location:../updateCards.php?error=qf');
										}
									} else {
										//card exists
										header('Location:../updateCards.php?error=ce');
									}
								} else {
									//card number has changed	
									$getCard = "SELECT * FROM card WHERE card_no='".$cardNo."'";
									$resultCard = mysqli_query($con, $getCard);
									if(mysqli_num_rows($resultCard) == 0){
										$addCard = "UPDATE card SET card_no='".$cardNo."', pin='".$pin."' WHERE card_no='".$oldCardNo."'";
										if(mysqli_query($con, $addCard)){
											//success
											header('Location:../updateCards.php?error=su');
										} else {
											//query failed
											header('Location:../updateCards.php?error=qf');
										}
									} else {
										//card exists
										header('Location:../updateCards.php?error=ce');
									}
								}
							} else {
								//pin and cpin does not match
								header('Location:../updateCards.php?error=dm');
							}
						} else {
							//wrong confirm pin format
							header('Location:../updateCards.php?error=wc');
						}
					} else {
						//wrong pin format
						header('Location:../updateCards.php?error=wp');
					}
				} else {
					//wrong card number format
					header('Location:../updateCards.php?error=wn');
				}
			} else {
				//empty fields redirect to cards
				header('Location:../updateCards.php?error=ef');
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
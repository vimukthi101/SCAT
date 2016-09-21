<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	if(isset($_SESSION['position']) && $_SESSION['position'] == "sysadmin"){
		if(isset($_POST['submit'])){
			if(!empty($_POST['oldtFee']) && !empty($_POST['tFee'])){
				$cno = trim($_POST['oldtFee']);
				$p = trim($_POST['tFee']);
				$oldFee = htmlspecialchars(mysqli_real_escape_string($con, $cno));
				$newFee = htmlspecialchars(mysqli_real_escape_string($con, $p));
				if(preg_match('/^\d+\.(\d{2})$/',$oldFee)){
					if(preg_match('/^\d+\.(\d{2})$/',$newFee)){
						if($oldFee != $newFee){
							$update = "UPDATE ticket SET ticket_fee='".$newFee."' WHERE ticket_fee='".$oldFee."'";
							if(mysqli_query($con, $update)){
								//success
								header('Location:../updateTickets.php?error=su');
							} else {
								//query failed
								header('Location:../updateTickets.php?error=qf');
							}
						} else {
							//old and new fee is equal
							header('Location:../updateTickets.php?error=eq');
						}
					} else {
						//wrong new fee format
						header('Location:../updateTickets.php?error=wn');
					}
				} else {
					//wrong old fee format
					header('Location:../updateTickets.php?error=wo');
				}
			} else {
				//empty fields redirect to cards
				header('Location:../updateTickets.php?error=ef');
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
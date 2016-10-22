<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position'])){
	if($_SESSION['position'] == "stationMaster"){
		if(isset($_POST['submit'])){
			if(!empty($_POST['terminal'])){
				$cookieValue2 = $_POST['terminal'];
				setcookie("terminal", $cookieValue2, time() + (86400 * 365 * 10), '/');echo 'done';
				header('Location:../../index.php?error=do');
			}
		}
	} else {
		header('Location:../404.php');	
	}
} else {
	header('Location:../404.php');
}
?>
<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_POST['submit'])){
	if(!empty($_POST['code']) && !empty($_POST['name'])){
		$_SESSION['outStation'] = $_POST['code'];
		$_SESSION['outStationName'] = $_POST['name'];
		header('Location:../ticketClass.php');
	} else {
		session_destroy();
		header('Location:../welcome.php');	
	}
} else {
	session_destroy();
	header('Location:../welcome.php');	
}
?>
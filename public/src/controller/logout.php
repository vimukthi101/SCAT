<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	error_reporting(0);
	session_unset();
	//redirect to login page after logout
	header('Location:../../index.php?error=lo');
?>
<?php
$host = 'localhost';
$db = 'scat';
$user = 'root';
$password = '';

//no errors will be shown
//error_reporting(0);

//db connection creation
$con = mysqli_connect($host, $user, $password, $db);
if(!$con){
	die("connection error!".mysqli_connect_error());
}
?>
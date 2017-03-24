<?php
require 'PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
//change following to admin@gmail.com or scat@gmail.com
$mail->Username = "scatfortrains@gmail.com";
$mail->Password = "931340034v";
$mail->setFrom('scatfortrains@gmail.com', 'SCAT SYSTEM');
?>
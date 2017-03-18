<?php
require 'PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
//change following to admin@gmail.com or scat@gmail.com
$mail->Username = "vimukthisaranga1@gmail.com";
$mail->Password = "i<3WaLeS4ever:)@gmail1";
$mail->setFrom('vimukthisaranga1@gmail.com', 'SCAT SYSTEM');
?>
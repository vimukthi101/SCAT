<?php
if(!isset($_SESSION[''])){
	session_start();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" type="image/x-icon" href="images/logo.png" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>S.C.A.T</title>
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="css/animate.css" />
</head>

<body style="background-image:url(images/4.jpg);background-repeat:no-repeat;background-size:cover;">
<!--header start-->
    <div class="col-md-12 text-center" style="background-color:rgb(0,102,255);padding:15px;height:10vh;">
        <font size="+3" color="#FFFFFF" face="Verdana, Geneva, sans-serif">Smart Card at Travelling for Trains</font>
    </div>
<!--header end-->    
<!--body start-->
	<div class="col-md-12">
        <img src="images/404.png" class="img-responsive center-block" style="padding:50px;margin-top:80px;"/>
        <?php
			session_destroy();
			header("Refresh: 5; URL=index.php");
		?>
    </div>
<!--body end-->
<!--footer start-->
    <?php
		include_once('ssi/footer.php');
	?>
<!--footer end-->
</body>
</html>

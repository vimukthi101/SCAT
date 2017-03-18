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
<style>
a#new {
	text-decoration:none;
	color:rgba(0,0,255,0.5);
}
a:hover#new {
	text-decoration:none;
    color:rgba(0,0,255,1);
}
a:visited#new {
	text-decoration:none;
	color:rgba(0,0,255,0.5);
}
a {
	text-decoration:none;
	color:rgba(255,255,255,1);
}
a:hover {
	text-decoration:none;
	color:rgba(255,255,255,0.5);
}
a:visited {
	text-decoration:none;
	color:rgba(255,255,255,1);
}
</style>
</head>

<body style="background-image:url(images/4.jpg);background-repeat:no-repeat;background-size:cover;">
<!--header start-->
    <div class="col-md-12 text-center" style="background-color:rgb(0,102,255);padding:15px;height:10vh;">
        <font size="+3" color="#FFFFFF" face="Verdana, Geneva, sans-serif"><a href="index.php">Smart Card at Travelling for Trains</a></font>
    </div>
<!--header end-->    
<!--body start-->
	<div class="col-md-12">
        <img src="images/505.png" width="50%" height="400px" class="img-responsive center-block" style="padding:50px;"/>
    </div>
<!--body end-->
<!--footer start-->
    <?php
		include_once('ssi/footer.php');
	?>
<!--footer end-->
</body>
</html>

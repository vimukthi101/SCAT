<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position'])){
	if($_SESSION['position'] == "stationMaster"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('../ssi/links.html');
	include_once('../ssi/db.php');
	setcookie("terminal", "", time() - 3600, '/');
	setcookie("station", "", time() - 3600, '/');
?>
<title>Terminal Preferences</title>
</head>

<body style="background-image:url(../images/4.jpg);background-repeat:no-repeat;background-size:cover;">
<?php
	include_once('../ssi/terminalHeader.php');
?>
<div class="container-fluid text-capitalize center-block text-center" style="padding:0px;margin:0px;">
    <div class="col-md-10" style="padding:70px;margin-top:45px;margin-bottom:30px;margin-left:80px;">
        <?php
		$nic = $_SESSION['nic'];
		$get = "SELECT station_code FROM station WHERE employee_nic='".$nic."'";
		$result = mysqli_query($con, $get);
		if(mysqli_num_rows($result)!=0){
			while($row = mysqli_fetch_array($result)){
				$code = $row['station_code'];		
			}
			setcookie("station", $code, time() + (86400 * 365 * 10), '/');
			header('Location:setTerminal.php');
		} else {
			session_destroy();
			header('Location:../index.php?error=np');
		}
		?>
    </div>
</div>
<?php
	include_once('../ssi/footer.php');
?>
</body>
</html>
<?php
	} else {
		header('Location:../404.php');	
	}
} else {
	header('Location:../404.php');
}
?>
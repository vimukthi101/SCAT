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
		$nic = $_SESSION['nic'];
		$getStation = "SELECT station_code FROM staff WHERE employee_nic='".$nic."'";
		$resultStation = mysqli_query($con, $getStation);
		if(mysqli_num_rows($resultStation)!=0){
			while($rowStation = mysqli_fetch_array($resultStation)){
				$station = $rowStation['station_code'];
				$get = "SELECT station_name FROM station WHERE station_code='".$station."'";
				$result = mysqli_query($con, $get);
				if(mysqli_num_rows($result)!=0){
					while($row = mysqli_fetch_array($result)){
						$name = $row['station_name'];
					}
				}
			}
			if($station != "none"){
?>
<title>Payment Preferences</title>
</head>

<body style="background-image:url(../images/4.jpg);background-repeat:no-repeat;background-size:cover;">
<?php
	include_once('../ssi/Header.php');
?>
<div class="container-fluid text-capitalize" style="padding:0px;margin:0px;">
	<div>
		<?php
            include_once('../ssi/stationMasterLeftPanelTerminal.php');
        ?>
    </div>
    <div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1">
                <u>View Payment Terminals</u>
            </font>
        </div>
        <div class="row text-center" style="padding-top:60px;">
            <font face="Verdana, Geneva, sans-serif" size="+2">Welcome To The Payemnt Preferences</font><br/><br/><br/>
            <font face="Verdana, Geneva, sans-serif" size="+2">Follow these steps to make it ready for the payments.</font><br/>
            <font face="Verdana, Geneva, sans-serif" size="+2">STEP 01 : In Station</font><br/><br/><br/>
            <font face="Verdana, Geneva, sans-serif" size="+2">Check your in station is correct. If not please logout and continue.</font><br/>
            <font face="Verdana, Geneva, sans-serif" size="+2">In Station : <?php echo $station.' - '.$name; ?></font><br/><br/><br/>
            <input type="button" onclick="location.href='selectTerminal.php'" name="submit" value="Correct" class="btn btn-success" />
            <input type="button" onclick="location.href='controller/logout.php'" value="InCorrect" class="btn btn-danger" />
        </div>
</div>
<?php
	include_once('../ssi/footer.php');
?>
</body>
</html>
<?php
			} else {
				header('Location:../index.php?error=ns');	
			}
		} else {
			header('Location:../404.php');
		}
	} else {
		header('Location:../404.php');	
	}
} else {
	header('Location:../404.php');
}
?>
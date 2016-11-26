<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position'])){
	if($_SESSION['position'] == "updater"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
.main-box{
	border:rgb(0,0,0) solid;
	margin:10px;
	padding:10px;
	height:180px;
	background-position:center;
	background-size:contain;
	background-repeat:no-repeat;
	background-color:rgb(0,153,255);
}
.inner-box{
	bottom:0;
	left:0;
	position:absolute;
	background-color:rgba(102,102,102,0.5);
	width:100%;
	height:50px;
}
.time-table{
	border:rgb(0,0,0) solid;
	margin:10px;
	padding:10px;
	height:180px;
	background-position:center;
	background-size:contain;
	background-repeat:no-repeat;
	background-color:rgb(0,153,255);
}
.upper-box{
	top:0;
	left:0;
	position:absolute;
	background-color:rgba(102,102,102,0.5);
	width:100%;
	height:50px;
}
.font{
	font-family:Verdana, Geneva, sans-serif;
	color:#FFFFFF;
	padding:10px;
	font-size:19px;
}
</style>
<?php
	include_once('../ssi/links.html');
	include_once('../ssi/db.php');
?>
<title>Registrar Home</title>
</head>

<body style="background-image:url(../images/4.jpg);background-repeat:no-repeat;background-size:cover;">
<?php
	include_once('../ssi/Header.php');
?>
<div class="container-fluid" style="padding:50px;margin:40px;">
    <div class="col-md-12 text-center">
    	<div class="col-md-2 main-box" style="background-image:url(../images/timeTable.png);">
        	<div class="inner-box">
                <a href="addTimeTable.php" style="text-decoration:none;color:rgb(255,255,255);">
                    <font class="font">Time Tables Portal</font>
                </a>
            </div>
        </div>
        <div class="col-md-4 time-table" style="overflow-y: scroll;">
        	<div class="upper-box">
            	<font class="font">Daily Time Table</font>
            </div>
            <?php
				$nic = $_SESSION['nic'];
				$mydate = getdate(date("U"));
				$date = $mydate['weekday'];
				switch($date){
					case "Sunday":
						$date = "sun";
						break;
					case "Monday":
						$date = "mon";
						break;
					case "Tuesday":
						$date = "tus";
						break;
					case "Wednesday":
						$date = "wed";
						break;
					case "Thursday":
						$date = "thu";
						break;
					case "Friday":
						$date = "fri";
						break;
					case "Saturday":
						$date = "sat";
						break;
					default:
						$date = "";
						break;
				}
				$get = "SELECT train_time,train_train_id,station_station_code,line FROM timetable WHERE employee_nic='".$nic."' AND train_date='".$date."' ORDER  BY train_time;";
				$result = mysqli_query($con, $get);
				if(mysqli_num_rows($result)!=0){
					echo '<br/><br/><div class="container-fluid center-block"><table class="table"><tr><th align="left">Time</th><th align="left">Line</th><th align="left">Station</th><th align="left">Train</th></tr>';
					while($row = mysqli_fetch_array($result)){
						$time = $row['train_time'];
						$train = $row['train_train_id'];
						$station = $row['station_station_code'];
						$line = $row['line'];
						echo '<tr><td align="left">'.$time.'</td><td align="left">'.$line.'</td><td align="left">'.$station.'</td><td align="left">'.$train.'</td></tr>';
					}
					echo '</table></div>';
				} else {
					echo '<h3><br/><br/>Not Set Yet!</h3>';	
				}
			?>
        </div>
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
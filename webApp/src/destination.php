<?php
if(!isset($_SESSION[''])){
	session_start();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include_once('../ssi/links.html');
include_once('../ssi/db.php');
if(isset($_COOKIE['station']) && isset($_COOKIE['terminal'])){
	if(isset($_SESSION['pass']) && isset($_SESSION['credit']) && isset($_SESSION['commuter_nic']) && isset($_SESSION['attempt'])){
?>
<title>Payment Terminal</title>
</head>
<body style="background-image:url(../images/home.jpg);background-repeat:no-repeat;background-size:cover;width:100%;">
<!--header start-->
    <div class="col-md-12 text-center" style="background-color:rgb(0,102,255);padding:15px;height:10vh;">
        <font size="+3" color="#FFFFFF" face="Verdana, Geneva, sans-serif">Smart Card at Travelling for Trains</font>
    </div>
    <?php 
		header("Refresh: 20; URL=welcome.php"); 
	?>
<!--header end-->    
<!--body start-->
	<div class="col-md-12">
        <div>
            <div style="background-color:rgba(0,153,255,0.4);padding:10px;top:4vh;background-position:center;height:500px;" class="col-md-12 text-center">
            	<form role="form" class="form-group" method="post">
                    <div style="padding:5px;">
                     <font size="+1" face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">Please Select The Destination.</font>
                    </div>
                    <?php
						 if(isset($_GET['error']) && !empty($_GET['error'])){
							 $error = $_GET['error'];
							 if($error == "it"){
								 echo '<div style="padding:5px;">
								 	<label style="font-size:100%" class="label label-danger">Invalid Ticket.</label>
								   </div>';
							 }
						 }
					 ?>
                    <div  class="row" style="padding:10px;">
                     <?php
					 	$line = $_COOKIE['terminal'];
						$inStation = $_COOKIE['station'];
					 	$get = "SELECT station_name, station_code FROM station WHERE station_code IN (SELECT out_station_code FROM payment_terminal WHERE terminal_line='".$line."' AND in_station_code='".$inStation."') ORDER BY station_name ASC";
						$result = mysqli_query($con, $get);
						if(mysqli_num_rows($result)!=0){
							echo '
								<div class="row" style="padding:10px;">
									<div class="center-block col-md-12">';
							while($row = mysqli_fetch_array($result)){
								$outStation = $row['station_name'];
								$outCode = $row['station_code'];
								echo '
									<div class="col-md-2" style="width:10%;padding:10px;">
										<input type="hidden" id="code" name="code" value="'.$outCode.'">
										<input type="submit" class="btn btn-default text-center" style="width:120px;height:50px;" id="submit" name="submit" value="'.$outStation.'">
									</div>';
							}
							echo '
									</div>
								</div>';
						} else {
							echo '<div class="col-md-12" style="width:10%;padding:10px;margin-top:160px;margin-left:480px;">
									<h1 class="label label-danger" style="font-size:200%">No Stations Added Yet.</h1>
								 </div>';
						}
					 ?>
                    </div>
                </form>
            </div>        
        </div>
    </div>
    <?php
		if(isset($_POST['submit'])){
			if(!empty($_POST['submit']) && !empty($_POST['code'])){
				$_SESSION['outStation'] = $_POST['code'];
				$_SESSION['outStationName'] = $_POST['submit'];
				header('Location:commuters.php');
			}
		}
	?>
<!--body end-->
<!--footer start-->
    <?php
		include_once('../ssi/footer.php');
	?>
<!--footer end-->
</body>
<?php
	} else {
		session_destroy();
		header('Location:welcome.php');
	}
} else {
	session_destroy();
	header('Location:../505.php');
}
?>
</html>
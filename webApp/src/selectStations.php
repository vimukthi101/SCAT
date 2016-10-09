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
			}
			if($station != "none"){
				if(isset($_POST['submit'])){
					if(!empty($_POST['terminal'])){
						$_SESSION['terminal'] = $_POST['terminal'];
?>
<title>Payment Preferences</title>
</head>

<body style="background-image:url(../images/4.jpg);background-repeat:no-repeat;background-size:cover;">
<?php
	include_once('../ssi/Header.php');
?>
<div class="container-fluid" style="padding:50px;margin:40px;">
    <div class="row text-center" style="padding-top:20px;">
    	<font face="Verdana, Geneva, sans-serif" size="+2">Payemnt Preferences</font><br/><br/><br/>
    	<font face="Verdana, Geneva, sans-serif" size="+2">STEP 03 : Out Stations</font><br/><br/><br/>
        <font face="Verdana, Geneva, sans-serif" size="+2">Select The Stations To Show On The Terminal : </font><br/>
        <form role="form" method="post" action="controller/paymentPreferenceController.php" class="form-horizontal">
			<div class="form-group">
                <div class="col-md-12">
                	<?php
						$get = "SELECT * FROM station WHERE station_code != '".$station."'";
						$result = mysqli_query($con, $get);
						if(mysqli_num_rows($result)!=0){
							while($row = mysqli_fetch_array($result)){
								$outName = $row['station_name'];
								$outCode = $row['station_code'];
								echo '<div class="checkbox col-md-2">
											<label><input type="checkbox" name="outStation[]" value="'.$outCode.'">'.$outCode.' - '.$outName.'</label>
										</div><label><input type="checkbox" name="outStation[]" value="kks">kks</label>';
							}
						}
					?>
                </div>
            </div>
            <div class="form-group col-md-11 text-center">
                <input type="submit" name="submit" value="Select" class="btn btn-success" />
            	<input type="button" onclick="location.href='selectTerminal.php'" value="Back" class="btn btn-danger" />
            </div>
        </form>
    </div>
</div>
<?php
	include_once('../ssi/footer.php');
?>
</body>
</html>
<?php
					} else {
						header('Location:selectTerminal.php');
					}
				} else {
					header('Location:selectTerminal.php');
				}
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
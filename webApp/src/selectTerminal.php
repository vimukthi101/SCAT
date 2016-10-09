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
    <div class="row text-center" style="padding-top:40px;">
    	<font face="Verdana, Geneva, sans-serif" size="+2">Payemnt Preferences</font><br/><br/><br/>
    	<font face="Verdana, Geneva, sans-serif" size="+2">STEP 02 : Terminal</font><br/><br/><br/>
        <form role="form" method="post" class="form-horizontal" action="selectStations.php">
            <div class="form-group">
                <label for="cardNo" class="control-label col-md-3">Select The Terminal : </label>
                <div class="col-md-8">
                    <select name="terminal" class="form-control">
                        <option disabled="disabled" selected="selected">--Select The Terminal--</option>
                        <option value="main">Main Line</option>
                        <option value="ptm">PTM Line</option>
                        <option value="kv">KV Line</option>
                        <option value="coast">Coast Line</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-11 text-center">
                <input type="submit" name="submit" value="Correct" class="btn btn-success" />
            <input type="button" onclick="location.href='paymentPreference.php'" value="Back" class="btn btn-danger" />
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
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
	include_once('../ssi/Header.php');
?>
<div class="container-fluid text-capitalize center-block text-center" style="padding:0px;margin:0px;">
    <div class="col-md-10" style="padding:70px;margin-top:45px;margin-bottom:30px;margin-left:80px;">
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1">
            	<u>Terminal Configurations</u>
            </font>
        </div>
    <div class="row text-center" style="padding-top:40px;">
    	<font face="Verdana, Geneva, sans-serif" size="+2">STEP 01 : In Station</font><br/><br/><br/>
        <form role="form" method="post" class="form-horizontal">
            <div class="form-group">
                <label for="station" class="control-label col-md-3">Select The In Station : </label>
                <div class="col-md-8">
                    <select name="station" class="form-control">
                        <option disabled="disabled" selected="selected">--Select The Station--</option>
                        <?php
						$getStation = "SELECT station_code, station_name FROM station";
						$resultStation = mysqli_query($con, $getStation);
						if(mysqli_num_rows($resultStation)!=0){
							while($rowStation = mysqli_fetch_array($resultStation)){
								$stationCode = $rowStation['station_code'];
								$stationName = $rowStation['station_name'];
								echo '<option value="'.$stationCode.'">'.$stationCode.' - '.$stationName.'</option>';
							}
						} else {
							echo '<option disabled>No Stations Added Yet.</option>';	
						}
						?>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-12 text-center">
                <input type="submit" name="submit" value="Select" class="btn btn-success" />
            	<input type="reset" value="Reset" class="btn btn-danger" />
            </div>
        </form>
        <?php
		if(isset($_POST['station'])){
			if(isset($_POST['submit'])){
				if(!empty($_POST['station'])){
					$cookieValue = $_POST['station'];
					setcookie("station", $cookieValue, time() + (86400 * 365 * 10), '/');
					header('Location:setTerminal.php');
				}
			}
		}
		?>
    </div>
</div>
<?php
	include_once('../ssi/footer.php');
?>
</body>
</html>
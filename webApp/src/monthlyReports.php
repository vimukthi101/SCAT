<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position'])){
	if($_SESSION['position'] == "manager" || $_SESSION['position'] == "stationMaster"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('../ssi/links.html');
	include_once('../ssi/db.php');
?>
<title>Reports Management</title>
</head>

<body style="background-image:url(../images/4.jpg);background-repeat:no-repeat;background-size:cover;">
<div>
	<?php
        include_once('../ssi/Header.php');
    ?>
</div>
<div class="container-fluid text-capitalize" style="padding:0px;margin:0px;">
	<div>
		<?php
            include_once('../ssi/LeftPanelReports.php');
        ?>
    </div>
    <div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1">
            	<u>Reports Portal</u>
            </font>
        </div>
        <div style="padding:10px;"> 
            <form role="form" class="form-horizontal">
            	<div class="form-group">
                    <label for="employeeId" class="control-label col-md-3">Select Month : </label>
                    <div class="col-md-8">
                    	<input type="month" class="form-control" name="date" id="date" />
                	</div>
                </div>
                <?php
				if($_SESSION['position'] == "manager"){
					echo '<div class="form-group">
                    <label for="station" class="control-label col-md-3">Select Station : </label>
                    <div class="col-md-8">
                    	<select name="station" id="station" class="form-control">
                          <option selected="selected" disabled="disabled">--Select the Station--</option>';
						  echo '<option value="all">All Stations</option>';
					$getStation = "SELECT station_code, station_name FROM station";
					$resultStation = mysqli_query($con, $getStation);
					if(mysqli_num_rows($resultStation)!=0){
						while($rowStation = mysqli_fetch_array($resultStation)){
							$sCode = $rowStation['station_code'];
							$sName = $rowStation['station_name'];
							echo '<option value="'.$sCode.'">'.$sCode.' - '.$sName.'</option>';
						}
					} else {
						echo '<option disabled="disabled">No Stations Added Yet.</option>';
					}
					 echo    '</select>
                	</div>
                	</div>';
				}
				?>s
                <div class="form-group">
                    <div class="col-md-12 text-center">
                        <input type="submit" value="Generate" class="btn btn-success" />
                        <input type="reset" value="Clear" class="btn btn-danger" />
                    </div>
                </div>
                <hr/>
            </form>
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
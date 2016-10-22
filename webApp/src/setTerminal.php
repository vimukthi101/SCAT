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
		if(isset($_COOKIE['station']) && !isset($_COOKIE['terminal'])){
?>
	<title>Terminal Preferences</title>
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
		<div class="col-md-10 text-center" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
			<div class="text-center" style="padding:10px;">
				<font face="Verdana, Geneva, sans-serif" size="+1">
					<u>Terminal Configurations</u>
				</font>
			</div>
		<div class="row text-center" style="padding-top:60px;margin-left:80px;">
            <font face="Verdana, Geneva, sans-serif" size="+1">By selecting a terminal from here you can set this terminal for the selected lane. You need to log out after selecting a lane from here. Then click the 'Click here to go to the terminal.' link on the login page to proceed.</font><br/><br/><br/>
            <div class="form-group">	
                <form role="form" method="post" class="form-horizontal text-justify" action="controller/setTerminalController.php">
					<label for="cardNo" class="control-label col-md-3">Select The Terminal : </label>
					<div class="col-md-8">
						<select name="terminal" class="form-control">
							<option disabled="disabled" selected="selected">--Select The Terminal--</option>
							<?php
							$getTerminal = "SELECT DISTINCT(terminal_line) AS line FROM payment_terminal WHERE in_station_code='".$_COOKIE['station']."'";
							$resultTerminal = mysqli_query($con, $getTerminal);
							if(mysqli_num_rows($resultTerminal)!=0){
								while($rowTerminal = mysqli_fetch_array($resultTerminal)){
									$terminal = $rowTerminal['line'];
									echo '<option value="'.$terminal.'" style="text-transform:uppercase">'.$terminal.'</option>';
								}
							} else {
								echo '<option disabled>No Terminals Added Yet.</option>';	
							}
							?>
						</select>
					</div>
                    <div class="form-group col-md-12 text-center" style="padding:20px;">
                        <input type="submit" name="submit" id="submit" value="Select" class="btn btn-success" />
                        <input type="button" value="Back" onclick="location.href='setup.php'" class="btn btn-danger" />
                    </div>
				</form>
            </div>
		</div>
	</div>
	<?php
		include_once('../ssi/footer.php');
	?>
	</body>
<?php
} else {
	setcookie("terminal", "", time() - 3600, '/');
	setcookie("station", "", time() - 3600, '/');
	header('Location:setup.php');
}
?>
</html>
<?php
	} else {
		header('Location:../404.php');	
	}
} else {
	header('Location:../404.php');
}
?>
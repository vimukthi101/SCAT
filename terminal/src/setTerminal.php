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
	<div class="container-fluid text-capitalize center-block text-center" style="padding:0px;margin:0px;">
		<div class="col-md-10" style="padding:70px;margin-top:45px;margin-bottom:30px;margin-left:80px;">
			<div class="text-center" style="padding:10px;">
				<font face="Verdana, Geneva, sans-serif" size="+1">
					<u>Terminal Configurations</u>
				</font>
			</div>
		<div class="row text-center" style="padding-top:40px;">
			<form role="form" method="post" class="form-horizontal" action="">
				<font face="Verdana, Geneva, sans-serif" size="+2">STEP 02 : Terminal</font><br/><br/><br/>
				<div class="form-group">
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
				</div>
				<div class="form-group col-md-12 text-center">
					<input type="submit" name="submit" value="Select" class="btn btn-success" />
					<input type="button" value="Back" onclick="location.href='setup.php'" class="btn btn-danger" />
				</div>
			</form>
			<?php
			if(isset($_POST['terminal'])){
				if(isset($_POST['submit'])){
					if(!empty($_POST['terminal'])){
						$cookieValue2 = $_POST['terminal'];
						setcookie("terminal", $cookieValue2, time() + (86400 * 365 * 10), '/');
						header('Location:welcome.php');
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
<?php
} else {
	setcookie("terminal", "", time() - 3600, '/');
	setcookie("station", "", time() - 3600, '/');
	header('Location:setup.php');
}
?>
</html>
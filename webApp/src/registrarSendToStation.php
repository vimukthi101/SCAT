<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position'])){
	if($_SESSION['position'] == "registrar"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('../ssi/links.html');
	include_once('../ssi/db.php');
?>
<title>Top-up</title>
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
			include_once('../ssi/registrarLeftPanelAccount.php');
        ?>
    </div>
    <div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1">
            	<u>Registration Amount Of This Month</u>
            </font>
        </div>
        <div style="padding-left:90px;padding-top:40px;"> 
        <?php
			if(isset($_GET['error'])){
				if(!empty($_GET['error'])){
					$error = $_GET['error'];
					if($error == "ef"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Required Fields Cannot Be Empty.</label>
							</div>';
					} else if($error == "nm"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Amount Not Matching. Please Try Again.</label>
							</div>';
					} else if($error == "qf"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Could Not Send The Registration Amount. Please Try Again Later.</label>
							</div>';
					} else if($error == "su"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control label-success" style="height:35px;">Send The Registration Amount Successfully.</label>
							</div>';
					}
				}
			}
			$total = 0.00;
			$nic = $_SESSION['nic'];
			$query = "SELECT * FROM registrar_payment WHERE STATUS='0' AND employee_nic='".$nic."'";
			$result = mysqli_query($con, $query);
			if(mysqli_num_rows($result)!=0){
				while($row = mysqli_fetch_array($result)){
					$id = $row['payment_id'];
					$date = $row['payment_date_time'];
					$regId = $row['commuter_regfee_regfee_id'];
					$getRegFee = "SELECT reg_fee FROM commuter_regfee WHERE regfee_id='".$regId."'";
					$resultRegFee = mysqli_query($con, $getRegFee);
					if(mysqli_num_rows($resultRegFee)){
						while($rowRegFee = mysqli_fetch_array($resultRegFee)){
							$fee = $rowRegFee['reg_fee'];
							$total += $fee;
						}
					}
				}
				echo '<table class="table table-responsive table-bordered table-striped">
				<tr>
					<th>
						<p>Total Registration Amount</p>
					</th>
					<th>
						<p>To Send Amount</p>
					</th>
				</tr>
				<tr>
					<td>'.$total.'</td>
					<td>'.$total.'</td>
				</tr>
				</table>';
		?>
        </div>
        <div class="text-center" style="padding:10px;">
            <form method="post" role="form" class="form-horizontal" action="controller/registrarSendToStationController.php">
                <input type="submit" class="btn btn-success" name="submit" id="submit" value="Send To Station"/>
                <input type="text" name="total" id="total" value="<?php echo $total; ?>" readonly="readonly" hidden="hidden" />
            </form>
        </div>
        <?php
			} else {
				echo '<h3 class="text-center">No registrations have done yet!</h3>';	
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
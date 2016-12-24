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
			$total = 0.00;
			$nic = $_SESSION['nic'];
			$query = "SELECT * FROM registrar_payment WHERE STATUS='0' AND employee_nic='".$nic."'";
			$result = mysqli_query($con, $query);
			if(mysqli_num_rows($result)!=0){
				echo '<table class="table table-responsive table-bordered table-striped">
                <tr>
                    <th>
                    	<p>Id</p>
                    </th>
                    <th>
                    	<p>Date</p>
                    </th>
                    <th>
                    	<p>Amount</p>
                    </th>
                </tr>';
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
							echo '<tr>
							<td>'.$id.'</td>
							<td>'.$date.'</td>
							<td>'.$fee.'</td> 
						</tr>';
						}
					}
				}
				echo '</table>';
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
			} else {
				echo '<h3 class="text-center">No registrations have done yet!</h3>';	
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
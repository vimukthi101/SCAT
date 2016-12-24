<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position'])){
	if($_SESSION['position'] == "topupAgent"){
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
			include_once('../ssi/topupAgentLeftPanelAccount.php');
        ?>
    </div>
    <div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1">
            	<u>Top-Up Amount Of This Month</u>
            </font>
        </div>
        <div style="padding-left:90px;padding-top:40px;"> 
        <?php
			$total = 0.00;
			$nic = $_SESSION['nic'];
			$query = "SELECT * FROM recharge WHERE employee_nic='".$nic."' AND send_status='0'";
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
					$id = $row['topup_id'];
					$date = $row['recharge_date_time'];
					$amount = $row['amount'];
					$total += $amount;
					echo '<tr>
						<td>'.$id.'</td>
						<td>'.$date.'</td>
						<td>'.$amount.'</td> 
					</tr>';
				}
				echo '</table>';
				$get = "SELECT topup_agent_regfee FROM topup_agent_regfee WHERE topup_agent_regfee_id IN (SELECT topup_agent_regfee_id FROM topup_agent WHERE employee_nic='".$nic."')";
				$res = mysqli_query($con, $get);
				if(mysqli_num_rows($res)!=0){
					while($r = mysqli_fetch_array($res)){
						$regFee = $r['topup_agent_regfee'];
					}
					echo '<table class="table table-responsive table-bordered table-striped">
					<tr>
						<th>
							<p>Total Recharged Amount</p>
						</th>
						<th>
							<p>To Send Amount</p>
						</th>
						<th>
							<p>Registered Amount</p>
						</th>
						<th>
							<p>Available Amount</p>
						</th>
					</tr>
					<tr>
						<td>'.$total.'</td>
						<td>'.$total.'</td>
						<td>'.$regFee.'</td> 
						<td>'.($regFee - $total).'</td> 
					</tr>
					</table>';
				}
			} else {
				echo '<h3 class="text-center">No recharges have done yet!</h3>';	
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
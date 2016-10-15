<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position'])){
	if($_SESSION['position'] == "manager" || $_SESSION['position'] == "stationMaster"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="../js/fusioncharts.js"></script>
<script type="text/javascript" src="../js/fusioncharts.theme.ocean.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('../ssi/links.html');
	include_once('../ssi/db.php');
	include("../js/fusioncharts.php");
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
            <form class="form-horizontal">
            	<div class="form-group">
                    <label for="employeeId" class="control-label col-md-3">Select Week : </label>
                    <div class="col-md-8">
                    	<input type="week" class="form-control" name="date" id="date" />
                	</div>
                </div>
                <?php
				if($_SESSION['position'] == "manager"){
					echo '<div class="form-group">
                    <label for="station" class="control-label col-md-3">Select Station : </label>
                    <div class="col-md-8">
                    	<select name="station" id="station" class="form-control">';
					$getStation = "SELECT station_code, station_name FROM station";
					$resultStation = mysqli_query($con, $getStation);
					if(mysqli_num_rows($resultStation)!=0){
						echo '<option value="all">All Stations</option>';
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
				?>
                <div class="form-group">
                    <div class="col-md-12 text-center">
                    <?php
						if($_SESSION['position'] == "manager"){
                        	echo '<input type="button" value="Generate" onclick="location.href=\'weeklyReports.php?date=\'+ document.getElementById(\'date\').value+\'&station=\'+document.getElementById(\'station\').value;" class="btn btn-success" />';
						} else {
							echo '<input type="button" value="Generate" onclick="location.href=\'weeklyReports.php?date=\'+ document.getElementById(\'date\').value;" class="btn btn-success" />';
						}
					?>
                        <input type="reset" value="Clear" class="btn btn-danger" />
                    </div>
                </div>
                <hr/>
            </form>
        </div>
    <div class="form-horizontal">
        <?php
		if($_SESSION['position'] == "manager"){
			if(isset($_GET['date']) && !empty($_GET['date']) && !empty($_GET['station']) && !empty($_GET['station'])){
				$q = trim(htmlspecialchars(mysqli_real_escape_string($con, $_GET['date'])));
				$s = trim(htmlspecialchars(mysqli_real_escape_string($con, $_GET['station'])));
				$year = substr($q,0,4);
				$week = substr($q,6,8);
				$getDate1 = "SELECT STR_TO_DATE('".$year.$week." sunday', '%X%V %W') AS date1";
				$getDate2 = "SELECT STR_TO_DATE('".$year.$week." saturday', '%X%V %W') AS date2";
				$resultDate1 = mysqli_query($con, $getDate1);
				$resultDate2 = mysqli_query($con, $getDate2);
				if(mysqli_num_rows($resultDate1)!=0 && mysqli_num_rows($resultDate2)!=0){
					while($rowDate1 = mysqli_fetch_array($resultDate1)){
						$date1 = $rowDate1['date1'];
					}
					while($rowDate2 = mysqli_fetch_array($resultDate2)){
						$date2 = $rowDate2['date2'];
					}
					if($s == "all"){
						$strQuery = "SELECT * FROM payment WHERE payment_date_time BETWEEN '".$date1." 00:00:00' AND '".$date2." 23:59:59'";	
					} else {
						$strQuery = "SELECT * FROM payment WHERE payment_date_time BETWEEN '".$date1." 00:00:00' AND '".$date2." 23:59:59' AND ticket_id IN (SELECT ticket_id FROM ticket WHERE station_in_station_code='".$s."')";
					}
						$result = mysqli_query($con, $strQuery);
						if (mysqli_num_rows($result)!=0) {
						$arrData = array(
						  "chart" => array(
							  "caption" => "Weekly Travels from ".$date1." to ".$date2."",
							  "paletteColors" => "#0075c2",
							  "bgColor" => "#ffffff",
							  "borderAlpha"=> "20",
							  "canvasBorderAlpha"=> "0",
							  "usePlotGradientColor"=> "0",
							  "plotBorderAlpha"=> "10",
							  "showXAxisLine"=> "1",
							  "xAxisLineColor" => "#999999",
							  "showValues" => "0",
							  "divlineColor" => "#999999",
							  "divLineIsDashed" => "1",
							  "showAlternateHGridColor" => "0"
							)
						);
						$arrData["data"] = array();
						while($row = mysqli_fetch_array($result)) {
							$ticketId = $row['ticket_id'];
							$ticket = "SELECT * FROM ticket WHERE ticket_id='".$ticketId."'";
							$resultTicket = mysqli_query($con, $ticket);
							if(mysqli_num_rows($resultTicket)!=0){
								while($rowTicket = mysqli_fetch_array($resultTicket)){
									$num = rand(111111,999999);
									$ticketFee = $rowTicket['ticket_fee'];
									$inStation = $rowTicket['station_in_station_code'];
									$outStation = $rowTicket['station_out_station_code'];
									array_push($arrData["data"], array(
										  "label" => $rowTicket["station_in_station_code"],
										  "value" => $row["no_of_tickets"],
										  "color" => "#".$num
										  )
									  );
								}
							}
						}
						$jsonEncodedData = json_encode($arrData);
						$columnChart = new FusionCharts("column3d", "myFirstChart" , 1000, 400, "chart-1", "json", $jsonEncodedData);
						$columnChart->render();
					  } else {
							echo "<h3 style=\"padding-left:450px;padding-top:100px;\">No Travellings To Display</h3>";	
					  }
				} else {
					echo "<h3 style=\"padding-left:450px;padding-top:100px;\">No Travellings To Display</h3>";
				}
			}
		} else {
			if(isset($_GET['date']) && !empty($_GET['date'])){
				$nic = $_SESSION['nic'];
				$q = trim(htmlspecialchars(mysqli_real_escape_string($con, $_GET['date'])));
				$year = substr($q,0,4);
				$week = substr($q,6,8);
				$getDate1 = "SELECT STR_TO_DATE('".$year.$week." sunday', '%X%V %W') AS date1";
				$getDate2 = "SELECT STR_TO_DATE('".$year.$week." saturday', '%X%V %W') AS date2";
				$resultDate1 = mysqli_query($con, $getDate1);
				$resultDate2 = mysqli_query($con, $getDate2);
				if(mysqli_num_rows($resultDate1)!=0 && mysqli_num_rows($resultDate2)!=0){
					while($rowDate1 = mysqli_fetch_array($resultDate1)){
						$date1 = $rowDate1['date1'];
					}
					while($rowDate2 = mysqli_fetch_array($resultDate2)){
						$date2 = $rowDate2['date2'];
					}
					$strQuery = "SELECT SUM(payment.no_of_tickets) AS no_of_tickets, ticket.station_out_station_code FROM payment LEFT JOIN ticket ON payment.ticket_id = ticket.ticket_id WHERE payment_date_time BETWEEN '".$date1." 00:00:00' AND '".$date2." 23:59:59' AND ticket.station_in_station_code IN (SELECT station_code FROM station WHERE employee_nic='".$nic."') GROUP BY ticket.station_out_station_code";
					$result = mysqli_query($con, $strQuery);
						if (mysqli_num_rows($result)!=0) {
						$arrData = array(
						  "chart" => array(
							  "caption" => "Weekly Travels from ".$date1." to ".$date2."",
							  "paletteColors" => "#0075c2",
							  "bgColor" => "#ffffff",
							  "borderAlpha"=> "20",
							  "canvasBorderAlpha"=> "0",
							  "usePlotGradientColor"=> "0",
							  "plotBorderAlpha"=> "10",
							  "showXAxisLine"=> "1",
							  "xAxisLineColor" => "#999999",
							  "showValues" => "0",
							  "divlineColor" => "#999999",
							  "divLineIsDashed" => "1",
							  "showAlternateHGridColor" => "0"
							)
						);
						$arrData["data"] = array();
						while($row = mysqli_fetch_array($result)) {
							$num = rand(111111,999999);
							$outStation = $row['station_out_station_code'];
							array_push($arrData["data"], array(
								  "label" => $outStation,
								  "value" => $row["no_of_tickets"],
								  "color" => "#".$num
								  )
							  );
						}
						$jsonEncodedData = json_encode($arrData);
						$columnChart = new FusionCharts("column3d", "myFirstChart" , 1000, 400, "chart-1", "json", $jsonEncodedData);
						$columnChart->render();
					  } else {
							echo "<h3 style=\"padding-left:450px;padding-top:100px;\">No Travellings To Display</h3>";	
					  }
				} else {
					echo "<h3 style=\"padding-left:450px;padding-top:100px;\">No Travellings To Display</h3>";
				}
			}
		}
		?>
        <?php
		$nic = $_SESSION['nic'];
		if($_SESSION['position'] == "manager"){
			if(isset($_GET['date']) && !empty($_GET['date'])){
				$q = trim(htmlspecialchars(mysqli_real_escape_string($con, $_GET['date'])));
				$s = trim(htmlspecialchars(mysqli_real_escape_string($con, $_GET['station'])));
				$year = substr($q,0,4);
				$week = substr($q,6,8);
				$getDate1 = "SELECT STR_TO_DATE('".$year.$week." sunday', '%X%V %W') AS date1";
				$getDate2 = "SELECT STR_TO_DATE('".$year.$week." saturday', '%X%V %W') AS date2";
				$resultDate1 = mysqli_query($con, $getDate1);
				$resultDate2 = mysqli_query($con, $getDate2);
				if(mysqli_num_rows($resultDate1)!=0 && mysqli_num_rows($resultDate2)!=0){
					while($rowDate1 = mysqli_fetch_array($resultDate1)){
						$date1 = $rowDate1['date1'];
					}
					while($rowDate2 = mysqli_fetch_array($resultDate2)){
						$date2 = $rowDate2['date2'];
					}
					if($s == "all"){
						$strQuery = "SELECT * FROM payment WHERE payment_date_time BETWEEN '".$date1." 00:00:00' AND '".$date2." 23:59:59'";	
					} else {
						$strQuery = "SELECT * FROM payment WHERE payment_date_time BETWEEN '".$date1." 00:00:00' AND '".$date2." 23:59:59' AND ticket_id IN (SELECT ticket_id FROM ticket WHERE station_in_station_code='".$s."')";
					}
					$result = mysqli_query($con, $strQuery);
						if (mysqli_num_rows($result)!=0) {
						$arrData = array(
						  "chart" => array(
							  "caption" => "Daily Travelling Charges from ".$date1." to ".$date2."",
							  "paletteColors" => "#0075c2",
							  "bgColor" => "#ffffff",
							  "borderAlpha"=> "20",
							  "canvasBorderAlpha"=> "0",
							  "usePlotGradientColor"=> "0",
							  "plotBorderAlpha"=> "10",
							  "showXAxisLine"=> "1",
							  "xAxisLineColor" => "#999999",
							  "showValues" => "0",
							  "divlineColor" => "#999999",
							  "divLineIsDashed" => "1",
							  "showAlternateHGridColor" => "0"
							)
						);
						$arrData["data"] = array();
						while($row = mysqli_fetch_array($result)) {
							$ticketId = $row['ticket_id'];
							$ticket = "SELECT * FROM ticket WHERE ticket_id='".$ticketId."'";
							$resultTicket = mysqli_query($con, $ticket);
							if(mysqli_num_rows($resultTicket)!=0){
								while($rowTicket = mysqli_fetch_array($resultTicket)){
									$num = rand(111111,999999);
									$ticketFee = $rowTicket['ticket_fee'];
									$inStation = $rowTicket['station_in_station_code'];
									$outStation = $rowTicket['station_out_station_code'];
									$mul =  $row["no_of_tickets"]*$rowTicket['ticket_fee'];
									array_push($arrData["data"], array(
										  "label" => $rowTicket['station_in_station_code'],
										  "value" => $mul,
										  "color" => "#".$num
										  )
									  );
								}
							}
						}
						$jsonEncodedData = json_encode($arrData);
						$columnChart = new FusionCharts("column3d.swf", "mySecondChart" , 1000, 400, "chart-2", "json", $jsonEncodedData);
						$columnChart->render();
					  }
				} 
			}
		} else {
			if(isset($_GET['date']) && !empty($_GET['date'])){
				$q = trim(htmlspecialchars(mysqli_real_escape_string($con, $_GET['date'])));
				$year = substr($q,0,4);
				$week = substr($q,6,8);
				$getDate1 = "SELECT STR_TO_DATE('".$year.$week." sunday', '%X%V %W') AS date1";
				$getDate2 = "SELECT STR_TO_DATE('".$year.$week." saturday', '%X%V %W') AS date2";
				$resultDate1 = mysqli_query($con, $getDate1);
				$resultDate2 = mysqli_query($con, $getDate2);
				if(mysqli_num_rows($resultDate1)!=0 && mysqli_num_rows($resultDate2)!=0){
					while($rowDate1 = mysqli_fetch_array($resultDate1)){
						$date1 = $rowDate1['date1'];
					}
					while($rowDate2 = mysqli_fetch_array($resultDate2)){
						$date2 = $rowDate2['date2'];
					}
					$strQuery = "SELECT (SUM(payment.no_of_tickets) * ticket.ticket_fee) AS fee, ticket.station_out_station_code FROM payment LEFT JOIN ticket ON payment.ticket_id = ticket.ticket_id WHERE payment_date_time BETWEEN '".$date1." 00:00:00' AND '".$date2." 23:59:59' AND ticket.station_in_station_code IN (SELECT station_code FROM station WHERE employee_nic='".$nic."') GROUP BY ticket.station_out_station_code";
					$result = mysqli_query($con, $strQuery);
						if (mysqli_num_rows($result)!=0) {
						$arrData = array(
						  "chart" => array(
							  "caption" => "Daily Travelling Charges from ".$date1." to ".$date2."",
							  "paletteColors" => "#0075c2",
							  "bgColor" => "#ffffff",
							  "borderAlpha"=> "20",
							  "canvasBorderAlpha"=> "0",
							  "usePlotGradientColor"=> "0",
							  "plotBorderAlpha"=> "10",
							  "showXAxisLine"=> "1",
							  "xAxisLineColor" => "#999999",
							  "showValues" => "0",
							  "divlineColor" => "#999999",
							  "divLineIsDashed" => "1",
							  "showAlternateHGridColor" => "0"
							)
						);
						$arrData["data"] = array();
						while($row = mysqli_fetch_array($result)){
							$num = rand(111111,999999);
							$outStation = $row['station_out_station_code'];
							$fee = $row['fee'];
							array_push($arrData["data"], array(
								  "label" => $outStation,
								  "value" => $fee,
								  "color" => "#".$num
								  )
							  );
						}
						$jsonEncodedData = json_encode($arrData);
						$columnChart = new FusionCharts("column3d.swf", "mySecondChart" , 1000, 400, "chart-2", "json", $jsonEncodedData);
						$columnChart->render();
					  }
				}
			}
		}
		?>
        <?php
		if($_SESSION['position'] == "manager"){
			if(isset($_GET['date']) && !empty($_GET['date']) && !empty($_GET['station']) && !empty($_GET['station'])){
				$q = trim(htmlspecialchars(mysqli_real_escape_string($con, $_GET['date'])));
				$s = trim(htmlspecialchars(mysqli_real_escape_string($con, $_GET['station'])));
				$year = substr($q,0,4);
				$week = substr($q,6,8);
				$getDate1 = "SELECT STR_TO_DATE('".$year.$week." sunday', '%X%V %W') AS date1";
				$getDate2 = "SELECT STR_TO_DATE('".$year.$week." saturday', '%X%V %W') AS date2";
				$resultDate1 = mysqli_query($con, $getDate1);
				$resultDate2 = mysqli_query($con, $getDate2);
				if(mysqli_num_rows($resultDate1)!=0 && mysqli_num_rows($resultDate2)!=0){
					while($rowDate1 = mysqli_fetch_array($resultDate1)){
						$date1 = $rowDate1['date1'];
					}
					while($rowDate2 = mysqli_fetch_array($resultDate2)){
						$date2 = $rowDate2['date2'];
					}
					if($s == "all"){
					$strQuery = "SELECT SUM(recharge.amount) AS amount, topup_agent.station_code AS station  FROM recharge LEFT JOIN topup_agent ON recharge.employee_nic = topup_agent.employee_nic WHERE recharge.recharge_date_time BETWEEN '".$date1." 00:00:00' AND '".$date2." 23:59:59' GROUP BY topup_agent.station_code";	
					} else {
						$strQuery = "SELECT SUM(recharge.amount) AS amount, topup_agent.station_code AS station  FROM recharge LEFT JOIN topup_agent ON recharge.employee_nic = topup_agent.employee_nic WHERE recharge.recharge_date_time BETWEEN '".$date1." 00:00:00' AND '".$date2." 23:59:59' AND topup_agent.station_code='".$s."' GROUP BY topup_agent.station_code";
					}
					$result = mysqli_query($con, $strQuery);
						if (mysqli_num_rows($result)!=0) {
						$arrData = array(
						  "chart" => array(
							  "caption" => "Daily Recharge Payments from ".$date1." to ".$date2."",
							  "paletteColors" => "#0075c2",
							  "bgColor" => "#ffffff",
							  "borderAlpha"=> "20",
							  "canvasBorderAlpha"=> "0",
							  "usePlotGradientColor"=> "0",
							  "plotBorderAlpha"=> "10",
							  "showXAxisLine"=> "1",
							  "xAxisLineColor" => "#999999",
							  "showValues" => "0",
							  "divlineColor" => "#999999",
							  "divLineIsDashed" => "1",
							  "showAlternateHGridColor" => "0"
							)
						);
						$arrData["data"] = array();
						while($row = mysqli_fetch_array($result)) {
							$num = rand(111111,999999);	
							$amount = $row['amount'];
							if($s == "all"){
								array_push($arrData["data"], array(
								  "label" => $row['station'],
								  "value" => $amount,
								  "color" => "#".$num
								  )
								);
							} else {
								array_push($arrData["data"], array(
								  "label" => $s,
								  "value" => $amount,
								  "color" => "#".$num
								  )
								);
							}
						}
						$jsonEncodedData = json_encode($arrData);
						$columnChart = new FusionCharts("column3d", "myThirdChart" , 1000, 400, "chart-3", "json", $jsonEncodedData);
						$columnChart->render();
					  }  else {
						  echo "<h3 style=\"padding-left:450px;padding-top:100px;\">No Rechargings To Display</h3>";	
					  }
				} else {
					echo "<h3 style=\"padding-left:450px;padding-top:100px;\">No Rechargings To Display</h3>";	
				}
			}
		} else {
			if(isset($_GET['date']) && !empty($_GET['date'])){
				$q = trim(htmlspecialchars(mysqli_real_escape_string($con, $_GET['date'])));
				$year = substr($q,0,4);
				$week = substr($q,6,8);
				$getDate1 = "SELECT STR_TO_DATE('".$year.$week." sunday', '%X%V %W') AS date1";
				$getDate2 = "SELECT STR_TO_DATE('".$year.$week." saturday', '%X%V %W') AS date2";
				$resultDate1 = mysqli_query($con, $getDate1);
				$resultDate2 = mysqli_query($con, $getDate2);
				if(mysqli_num_rows($resultDate1)!=0 && mysqli_num_rows($resultDate2)!=0){
					while($rowDate1 = mysqli_fetch_array($resultDate1)){
						$date1 = $rowDate1['date1'];
					}
					while($rowDate2 = mysqli_fetch_array($resultDate2)){
						$date2 = $rowDate2['date2'];
					}
					$strQuery = "SELECT SUM(amount) AS amount, employee_nic  FROM recharge WHERE recharge_date_time BETWEEN '".$date1." 00:00:00' AND '".$date2." 23:59:59' AND employee_nic IN (SELECT employee_nic FROM topup_agent WHERE station_code IN (SELECT station_code FROM station WHERE employee_nic='".$nic."')) GROUP BY employee_nic";
					$result = mysqli_query($con, $strQuery);
						if (mysqli_num_rows($result)!=0) {
						$arrData = array(
						  "chart" => array(
							  "caption" => "Daily Recharge Payments from ".$date1." to ".$date2."",
							  "paletteColors" => "#0075c2",
							  "bgColor" => "#ffffff",
							  "borderAlpha"=> "20",
							  "canvasBorderAlpha"=> "0",
							  "usePlotGradientColor"=> "0",
							  "plotBorderAlpha"=> "10",
							  "showXAxisLine"=> "1",
							  "xAxisLineColor" => "#999999",
							  "showValues" => "0",
							  "divlineColor" => "#999999",
							  "divLineIsDashed" => "1",
							  "showAlternateHGridColor" => "0"
							)
						);
						$arrData["data"] = array();
						while($row = mysqli_fetch_array($result)) {	
							$num = rand(111111,999999);	
							array_push($arrData["data"], array(
								  "label" => $row["employee_nic"],
								  "value" => $row["amount"],
								  "color" => "#".$num
								  )
							  );
						}
						$jsonEncodedData = json_encode($arrData);
						$columnChart = new FusionCharts("column3d", "myThirdChart" , 1000, 400, "chart-3", "json", $jsonEncodedData);
						$columnChart->render();
					  }  else {
						   echo "<h3 style=\"padding-left:450px;padding-top:100px;\">No Rechargings To Display</h3>";	
					  }
				}  else {
					 echo "<h3 style=\"padding-left:450px;padding-top:100px;\">No Rechargings To Display</h3>";	
				 }
			}
		}
		?>
        <?php
		if($_SESSION['position'] == "manager"){
			if(isset($_GET['date']) && !empty($_GET['date']) && !empty($_GET['station']) && !empty($_GET['station'])){
				$q = trim(htmlspecialchars(mysqli_real_escape_string($con, $_GET['date'])));
				$s = trim(htmlspecialchars(mysqli_real_escape_string($con, $_GET['station'])));
				$year = substr($q,0,4);
				$week = substr($q,6,8);
				$getDate1 = "SELECT STR_TO_DATE('".$year.$week." sunday', '%X%V %W') AS date1";
				$getDate2 = "SELECT STR_TO_DATE('".$year.$week." saturday', '%X%V %W') AS date2";
				$resultDate1 = mysqli_query($con, $getDate1);
				$resultDate2 = mysqli_query($con, $getDate2);
				if(mysqli_num_rows($resultDate1)!=0 && mysqli_num_rows($resultDate2)!=0){
					while($rowDate1 = mysqli_fetch_array($resultDate1)){
						$date1 = $rowDate1['date1'];
					}
					while($rowDate2 = mysqli_fetch_array($resultDate2)){
						$date2 = $rowDate2['date2'];
					}
					if($s == "all"){
						$strQuery = "SELECT SUM(commuter_regfee.reg_fee) AS regfee, staff.station_code AS station FROM registrar_payment LEFT JOIN commuter_regfee ON registrar_payment.commuter_regfee_regfee_id = commuter_regfee.regfee_id LEFT JOIN staff ON registrar_payment.employee_nic = staff.employee_nic WHERE registrar_payment.payment_date_time BETWEEN '".$date1." 00:00:00' AND '".$date2." 23:59:59' AND registrar_payment.employee_nic IN (SELECT employee_nic FROM staff WHERE station_code LIKE '%') GROUP BY staff.station_code";	
					} else {
						$strQuery = "SELECT SUM(commuter_regfee.reg_fee) AS regfee, staff.station_code AS station FROM registrar_payment LEFT JOIN commuter_regfee ON registrar_payment.commuter_regfee_regfee_id = commuter_regfee.regfee_id LEFT JOIN staff ON registrar_payment.employee_nic = staff.employee_nic WHERE registrar_payment.payment_date_time BETWEEN '".$date1." 00:00:00' AND '".$date2." 23:59:59' AND registrar_payment.employee_nic IN (SELECT employee_nic FROM staff WHERE station_code='".$s."') GROUP BY staff.station_code";
					}
					$result = mysqli_query($con, $strQuery);
						if (mysqli_num_rows($result)!=0) {
						$arrData = array(
						  "chart" => array(
							  "caption" => "Daily Registration Payments from ".$date1." to ".$date2."",
							  "paletteColors" => "#0075c2",
							  "bgColor" => "#ffffff",
							  "borderAlpha"=> "20",
							  "canvasBorderAlpha"=> "0",
							  "usePlotGradientColor"=> "0",
							  "plotBorderAlpha"=> "10",
							  "showXAxisLine"=> "1",
							  "xAxisLineColor" => "#999999",
							  "showValues" => "0",
							  "divlineColor" => "#999999",
							  "divLineIsDashed" => "1",
							  "showAlternateHGridColor" => "0"
							)
						);
						$arrData["data"] = array();
						while($row = mysqli_fetch_array($result)) {
							$num = rand(111111,999999);
							array_push($arrData["data"], array(
							  "label" => $row['station'],
							  "value" => $row['regfee'],
							  "color" => "#".$num
							  )
							);
						}
						$jsonEncodedData = json_encode($arrData);
						$columnChart = new FusionCharts("column3d", "myFourthChart" , 1000, 400, "chart-4", "json", $jsonEncodedData);
						$columnChart->render();
					  }  else {
							echo "<h3 style=\"padding-left:450px;padding-top:100px;\">No Registrations To Display</h3>";	
						}
				}
			}
		} else {
			if(isset($_GET['date']) && !empty($_GET['date'])){
				$q = trim(htmlspecialchars(mysqli_real_escape_string($con, $_GET['date'])));
				$year = substr($q,0,4);
				$week = substr($q,6,8);
				$getDate1 = "SELECT STR_TO_DATE('".$year.$week." sunday', '%X%V %W') AS date1";
				$getDate2 = "SELECT STR_TO_DATE('".$year.$week." saturday', '%X%V %W') AS date2";
				$resultDate1 = mysqli_query($con, $getDate1);
				$resultDate2 = mysqli_query($con, $getDate2);
				if(mysqli_num_rows($resultDate1)!=0 && mysqli_num_rows($resultDate2)!=0){
					while($rowDate1 = mysqli_fetch_array($resultDate1)){
						$date1 = $rowDate1['date1'];
					}
					while($rowDate2 = mysqli_fetch_array($resultDate2)){
						$date2 = $rowDate2['date2'];
					}
					$strQuery = "SELECT registrar_payment.employee_nic AS employee, SUM(commuter_regfee.reg_fee) AS regfee FROM registrar_payment LEFT JOIN commuter_regfee ON registrar_payment.commuter_regfee_regfee_id = commuter_regfee.regfee_id WHERE registrar_payment.employee_nic IN (SELECT employee_nic FROM staff WHERE station_code IN (SELECT station_code FROM station WHERE employee_nic='".$nic."')) AND registrar_payment.payment_date_time BETWEEN '".$date1." 00:00:00' AND '".$date2." 23:59:59' GROUP BY employee_nic";
					$result = mysqli_query($con, $strQuery);
						if (mysqli_num_rows($result)!=0) {
						$arrData = array(
						  "chart" => array(
							  "caption" => "Daily Registration Payments from ".$date1." to ".$date2."",
							  "paletteColors" => "#0075c2",
							  "bgColor" => "#ffffff",
							  "borderAlpha"=> "20",
							  "canvasBorderAlpha"=> "0",
							  "usePlotGradientColor"=> "0",
							  "plotBorderAlpha"=> "10",
							  "showXAxisLine"=> "1",
							  "xAxisLineColor" => "#999999",
							  "showValues" => "0",
							  "divlineColor" => "#999999",
							  "divLineIsDashed" => "1",
							  "showAlternateHGridColor" => "0"
							)
						);
						$arrData["data"] = array();
						while($row = mysqli_fetch_array($result)) {	
							$num = rand(111111,999999);	
							array_push($arrData["data"], array(
								  "label" => $row["employee"],
								  "value" => $row["regfee"],
								  "color" => "#".$num
								  )
							  );
						}
						$jsonEncodedData = json_encode($arrData);
						$columnChart = new FusionCharts("column3d", "myFourthChart" , 1000, 400, "chart-4", "json", $jsonEncodedData);
						$columnChart->render();
					  }  else {
							echo "<h3 style=\"padding-left:450px;padding-top:100px;\">No Registrations To Display</h3>";	
						}
				}
			}
		}
		?>
        <div class="col-md-12">
            <div style="padding-left:70px;padding-top:20px;" id="chart-1"></div>
        </div>
        <div class="col-md-12">
            <div style="padding-left:70px;padding-top:20px;" id="chart-2"></div>
        </div>
        <div class="col-md-12">
            <div style="padding-left:70px;padding-top:20px;" id="chart-3"></div>
        </div>
        <div class="col-md-12">
            <div style="padding-left:70px;padding-top:20px;" id="chart-4"></div>
        </div>
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
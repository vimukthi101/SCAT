<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['nic'])){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="../js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="../js/fusioncharts.js"></script>
<script type="text/javascript" src="../js/fusioncharts.theme.ocean.js"></script>
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
            <div class="form-horizontal">
            	<div class="form-group">
                    <label for="date" class="control-label col-md-3">Select Date : </label>
                    <div class="col-md-8">
                    	<input type="date"  class="form-control" name="date" id="date" />
                	</div>
                </div>
                <div class="form-group">
                    <div class="col-md-12 text-center">
                        <input type="submit" value="Generate" onclick="location.href='dailyReports.php?date=' + document.getElementById('date').value;" class="btn btn-success" />
                        <input type="reset" value="Clear" class="btn btn-danger" />
                    </div>
                </div>
                <hr/>
            </div>
        </div>
		<div class="form-horizontal">
        <?php
		if(isset($_GET['date']) && !empty($_GET['date'])){
			$q = trim(htmlspecialchars(mysqli_real_escape_string($con, $_GET['date'])));
			$strQuery = "SELECT * FROM payment WHERE payment_date_time LIKE '".$q."%' AND commuter_nic='".$_SESSION['nic']."'";
			$result = mysqli_query($con, $strQuery);
				if (mysqli_num_rows($result)!=0) {
				$arrData = array(
				  "chart" => array(
					  "caption" => "Daily Travels of ".$q."",
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
				$columnChart = new FusionCharts("column3d", "myFirstChart" , 400, 300, "chart-1", "json", $jsonEncodedData);
				$columnChart->render();
			  }  else {
					echo "<h3 style=\"padding-left:450px;padding-top:100px;\">No Data To Display</h3>";	
				}
		}
		?>
        <?php
		if(isset($_GET['date']) && !empty($_GET['date'])){
			$q = trim(htmlspecialchars(mysqli_real_escape_string($con, $_GET['date'])));
			$strQuery = "SELECT * FROM payment WHERE payment_date_time LIKE '".$q."%' AND commuter_nic='".$_SESSION['nic']."'";
			$result = mysqli_query($con, $strQuery);
				if (mysqli_num_rows($result)!=0) {
				$arrData = array(
				  "chart" => array(
					  "caption" => "Daily Payment Charges of ".$q."",
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
				$columnChart = new FusionCharts("column3d.swf", "mySecondChart" , 400, 300, "chart-2", "json", $jsonEncodedData);
				$columnChart->render();
			  }
		}
		?>
        	<div class="col-md-12">
				<div class="col-md-6" style="padding-left:70px;padding-top:20px;" id="chart-1"></div>
        		<div class="col-md-6" style="padding:20px;" id="chart-2"></div>
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
?>
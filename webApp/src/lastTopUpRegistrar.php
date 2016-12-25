<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position'])){
	if($_SESSION['position'] == "registrar"){
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
<title>Registrar Income</title>
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
    	<?php
			$year = date('Y');
		?>
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1">
            	<u>Registrartion Incomes of <?php  echo $year;?></u>
            </font>
        </div>
        <div style="padding:10px;"> 
        	<?php
				$nic = $_SESSION['nic'];
				$num = rand(111111,999999);
				$strQuery = "SELECT * FROM registrar_final_payment WHERE payment_date LIKE '".$year."%' AND employee_nic='".$nic."' AND payment_status='1'";
				$result = mysqli_query($con, $strQuery);
				if (mysqli_num_rows($result)!=0) {
					$arrData = array(
					  "chart" => array(
						  "caption" => "Year : ".$year."",
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
						$fee = $row['payment_fee'];
						$paymentDate = $row['payment_date'];
						array_push($arrData["data"], array(
							  "label" => $paymentDate,
							  "value" => $fee,
							  "color" => "#".$num
							  )
						  );
					}
					$jsonEncodedData = json_encode($arrData);
					$columnChart = new FusionCharts("column3d", "myFirstChart" , 1000, 400, "chart-1", "json", $jsonEncodedData);
					$columnChart->render();
			  } else {
					echo "<h3 style=\"padding-left:350px;padding-top:100px;\">No Registration Incomes To Display.</h3>";	
			  }
            ?>
        </div>
        <div class="col-md-12">
            <div style="padding-left:70px;padding-top:20px;" id="chart-1"></div>
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
<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['nic'])){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
.main-box{
	border:rgb(0,0,0) solid;
	margin:10px;
	padding:10px;
	height:180px;
	background-position:center;
	background-size:contain;
	background-repeat:no-repeat;
	background-color:rgb(0,153,255);
}
.inner-box{
	bottom:0;
	left:0;
	position:absolute;
	background-color:rgba(102,102,102,0.5);
	width:100%;
	height:50px;
}
.font{
	font-family:Verdana, Geneva, sans-serif;
	color:#FFFFFF;
	padding:10px;
	font-size:19px;
}
</style>
<script type="text/javascript" src="../js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="../js/fusioncharts.js"></script>
<script type="text/javascript" src="../js/fusioncharts.widgets.js"></script>
<script type="text/javascript" src="../js/fusioncharts.theme.ocean.js"></script>
<?php
	include_once('../ssi/links.html');
?>
<title>Commuter Home</title>
</head>

<body style="background-image:url(../images/4.jpg);background-repeat:no-repeat;background-size:cover;">
<?php
	include_once('../ssi/Header.php');
?>
<div class="container-fluid" style="padding:50px;margin-top:30px;margin-right:0px;padding-right:0px;">
    <div class="col-md-12 text-center">
    	<div class="col-md-2 main-box" style="background-image:url(../images/topup.png);">
        	<div class="inner-box">
                <a href="balance.php" style="text-decoration:none;color:rgb(255,255,255);">
                    <font class="font">Acounts Management</font>
                </a>
            </div>
        </div>
        <div class="col-md-2 main-box" style="background-image:url(../images/graphs.png);">
        	<div class="inner-box">
                <a href="dailyReports.php" style="text-decoration:none;color:rgb(255,255,255);">
                    <font class="font">Travels Management</font>
                </a>
            </div>
        </div>
        <div class="col-md-2" id="chart-recharge" style="margin-left:10px;margin-right:10px;padding:10px;">Could not load the chart!</div>
        <div class="col-md-2" id="chart-payment" style="margin-left:10px;margin-right:10px;padding:10px;">Could not load the chart!</div>
        <div class="col-md-2" id="chart-travel" style="margin-left:10px;margin-right:10px;padding:10px;">Could not load the chart!</div>
    </div>
    </div>
</div>
<script type="text/javascript">
  FusionCharts.ready(function(){
    var fusioncharts = new FusionCharts({
    type: 'hlineargauge',
    renderAt: 'chart-recharge',
    width: '210',
    height: '180',
    dataFormat: 'json',
    dataSource: {
        "chart": {
            "theme": "fint",
            "caption": "Daily Recharges",
            "lowerLimit": "0",
            "upperLimit": "1000",
            "chartBottomMargin": "20",
            "valueFontSize": "11",
            "valueFontBold": "0",
            "gaugeFillMix": "{light-10},{light-70},{dark-10}",
            "gaugeFillRatio": "40,20,40",
			"dataStreamURL": "getFusionChartData.php?key=commuter&value=recharge",
            "refreshInterval": "1"
        },
        "colorRange": {
            "color": [{
                "minValue": "0",
                "maxValue": "350",
                "label": "Low",
            }, {
                "minValue": "350",
                "maxValue": "700",
                "label": "Moderate",
            }, {
                "minValue": "700",
                "maxValue": "1000",
                "label": "High",
            }]
        },
        "pointers": {
            "pointer": [{
                "value": "$value"
            }]
        }
    }
}
);
    fusioncharts.render();
});
</script>
<script type="text/javascript">
  FusionCharts.ready(function(){
    var fusioncharts = new FusionCharts({
    type: 'hlineargauge',
    renderAt: 'chart-payment',
    width: '210',
    height: '180',
    dataFormat: 'json',
    dataSource: {
        "chart": {
            "theme": "fint",
            "caption": "Daily Traveelings",
            "lowerLimit": "0",
            "upperLimit": "1000",
            "chartBottomMargin": "20",
            "valueFontSize": "11",
            "valueFontBold": "0",
            "gaugeFillMix": "{light-10},{light-70},{dark-10}",
            "gaugeFillRatio": "40,20,40",
			"dataStreamURL": "getFusionChartData.php?key=commuter&value=payment",
            "refreshInterval": "1"
        },
        "colorRange": {
            "color": [{
                "minValue": "0",
                "maxValue": "350",
                "label": "Low",
            }, {
                "minValue": "350",
                "maxValue": "700",
                "label": "Moderate",
            }, {
                "minValue": "700",
                "maxValue": "1000",
                "label": "High",
            }]
        },
        "pointers": {
            "pointer": [{
                "value": "$value"
            }]
        }
    }
}
);
    fusioncharts.render();
});
</script>
<script>
  FusionCharts.ready(function(){
    var fusioncharts = new FusionCharts({
    type: 'angulargauge',
    renderAt: 'chart-travel',
    width: '210',
    height: '180',
    dataFormat: 'json',
    dataSource: {
        "chart": {
            "caption": "Daily Travellings",
            "lowerLimit": "0",
            "upperLimit": "10",
            "dataStreamUrl": "getFusionChartData.php?key=commuter&value=travel",
            "refreshInterval": "1",
            "theme": "fint"
        },
        "colorRange": {
            "color": [{
                "minValue": "0",
                "maxValue": "3",
                "code": "#e44a00"
            }, {
                "minValue": "3",
                "maxValue": "7",
                "code": "#f8bd19"
            }, {
                "minValue": "7",
                "maxValue": "10",
                "code": "#6baa01"
            }]
        },
        "dials": {
            "dial": [{
                "value": "$value",
				"tooltext": "$value"
            }]
        }
    }
}
);
    fusioncharts.render();
});
</script>

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
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
	font-size:20px;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="../js/fusioncharts.js"></script>
<script type="text/javascript" src="../js/fusioncharts.widgets.js"></script>
<script type="text/javascript" src="../js/fusioncharts.theme.ocean.js"></script>
<?php
	include_once('../ssi/links.html');
?>
<title>Registrar Home</title>
</head>

<body style="background-image:url(../images/4.jpg);background-repeat:no-repeat;background-size:cover;">
<?php
	include_once('../ssi/Header.php');
?>
<div class="container-fluid" style="padding:50px;margin-top:30px;margin-right:0px;padding-right:0px;">
    <div class="col-md-12 text-center">
        <div class="col-md-2 main-box" style="background-image:url(../images/commuter.png);">
        	<div class="inner-box">
                <a href="commuterRegistration.php" style="text-decoration:none;color:rgb(255,255,255);">
                    <font class="font">Commuters Portal</font>
                </a>
            </div>
        </div>
        <div class="col-md-2 main-box" style="background-image:url(../images/topup.png);">
        	<div class="inner-box">
                <a href="transfer.php" style="text-decoration:none;color:rgb(255,255,255);">
                    <font class="font">Accounts Portal</font>
                </a>
            </div>
        </div> 
        <div class="col-md-2" id="chart-registration" style="margin-top:1px;margin-left:10px;padding:10px;">Could not load the chart!</div>  
        <div class="col-md-2" id="chart-commuter" style="margin-top:2px;margin-left:20px;padding:10px;">Could not load the chart!</div>   
    </div>
</div>
<script type="text/javascript">
  FusionCharts.ready(function(){
    var fusioncharts = new FusionCharts({
    type: 'hlineargauge',
    renderAt: 'chart-registration',
    id: 'cpu-linear-gauge-1',
    width: '210',
    height: '180',
    dataFormat: 'json',
    dataSource: {
        "chart": {
            "theme": "fint",
            "caption": "Registartion Income",
            "lowerLimit": "0",
            "upperLimit": "10000",
            "chartBottomMargin": "20",
            "valueFontSize": "11",
            "valueFontBold": "0",
            "gaugeFillMix": "{light-10},{light-70},{dark-10}",
            "gaugeFillRatio": "40,20,40",
			"dataStreamURL": "getFusionChartData.php?key=registrar&value=registration",
            "refreshInterval": "1"
        },
        "colorRange": {
            "color": [{
                "minValue": "0",
                "maxValue": "3500",
                "label": "Low",
            }, {
                "minValue": "3500",
                "maxValue": "7000",
                "label": "Moderate",
            }, {
                "minValue": "7000",
                "maxValue": "10000",
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
    type: 'hled',
    renderAt: 'chart-commuter',
    width: '210',
    height: '180',
    dataFormat: 'json',
    dataSource: {
        "chart": {
            "caption": "Registered Commuters",
            "lowerLimit": "0",
            "upperLimit": "1000",
            "lowerLimitDisplay": "None",
            "upperLimitDisplay": "Lot",
            "valueFontSize": "12",
            "showhovereffect": "1",
            "origW": "400",
            "origH": "150",
            "ledSize": "2",
            "ledGap": "1",
            "manageResize": "1",
            "theme": "fint",
			"dataStreamURL": "getFusionChartData.php?key=registrar&value=commuter",
            "refreshInterval": "1",
        },
        "annotations": {
            "showbelow": "1",
            "groups": [{
                "id": "indicator",
                "items": [
                    {
                        "id": "bgRectAngle",
                        "type": "rectangle",
                        "alpha": "90",
                        "radius": "1",
                        "fillColor": "#6baa01",
                        "x": "$gaugeCenterX - 20",
                        "tox": "$gaugeCenterX + 20",
                        "y": "$gaugeEndY + 25",
                        "toy": "$gaugeEndY + 45"
                    }
                ]
            }]

        },
        "colorRange": {
            "color": [{
                "minValue": "0",
                "maxValue": "400",
                "code": "#e44a00"
            }, {
                "minValue": "401",
                "maxValue": "800",
                "code": "#f8bd19"
            }, {
                "minValue": "801",
                "maxValue": "1000",
                "code": "#6baa01"
            }]
        },
        "value": "$value"
    },
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
} else {
	header('Location:../404.php');
}
?>
<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position'])){
	if($_SESSION['position'] == "sysadmin"){
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
	include_once('../ssi/db.php');
?>
<title>Admin Home</title>
</head>

<body style="background-image:url(../images/4.jpg);background-repeat:no-repeat;background-size:cover;">
<?php
	include_once('../ssi/Header.php');
?>
<div class="container-fluid" style="padding:50px;margin-top:30px;margin-right:0px;padding-right:0px;">
    <div class="col-md-12 text-center">
    	<div class="col-md-2 main-box" style="background-image:url(../images/users.png);">
        	<div class="inner-box">
                <a href="../src/userRegistration.php?position=manager" style="text-decoration:none;color:rgb(255,255,255);">
                    <font class="font">Users Portal</font>
                </a>
            </div>
        </div>
       <div class="col-md-2 main-box" style="background-image:url(../images/cards.png);">
        	<div class="inner-box">
            	<a href="../src/addCard.php" style="text-decoration:none;color:rgb(255,255,255);">
            		<font class="font">Cards Portal</font>
                </a>
            </div>
        </div>
        <div class="col-md-2 main-box" style="background-image:url(../images/train.png);">
        	<div class="inner-box">
            	<a href="../src/addTrains.php" style="text-decoration:none;color:rgb(255,255,255);">
            		<font class="font">Trains Portal</font>
                </a>
            </div>
        </div>
        <div class="col-md-2 main-box" style="background-image:url(../images/station.png);">
        	<div class="inner-box">
            	<a href="../src/addStations.php" style="text-decoration:none;color:rgb(255,255,255);">
            		<font class="font">Stations Portal</font>
                </a>
            </div>
        </div>
        <div class="col-md-2 main-box" style="background-image:url(../images/settings.png);">
        	<div class="inner-box">
            	<a href="updateRegistrationFee.php" style="text-decoration:none;color:rgb(255,255,255);">
            		<font class="font">Systems Portal</font>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-12 text-center">
    	<div class="col-md-2" id="chart-SM" style="margin:2px;padding:10px;">Could not load the chart!</div>
        <div class="col-md-2" id="chart-Manager" style="margin-top:2px;margin-left:20px;padding:10px;">Could not load the chart!</div>
        <div class="col-md-2" id="chart-requests" style="margin-top:2px;margin-left:20px;padding:10px;">Could not load the chart!</div>
        <div class="col-md-2" id="chart-trains" style="margin-top:2px;margin-left:20px;padding:10px;">Could not load the chart!</div>
        <div class="col-md-2" id="chart-stations" style="margin-top:2px;margin-left:20px;padding:10px;">Could not load the chart!</div>
    </div>
    <div class="col-md-12 text-center">
        <div class="col-md-2" id="chart-commuter" style="margin:2px;padding:10px;">Could not load the chart!</div>
    </div>
</div>
<script>
  FusionCharts.ready(function(){
    var fusioncharts = new FusionCharts({
    type: 'angulargauge',
    renderAt: 'chart-SM',
    width: '210',
    height: '180',
    dataFormat: 'json',
    dataSource: {
        "chart": {
            "caption": "Registered Station Masters",
            "lowerLimit": "0",
            "upperLimit": "500",
            "dataStreamUrl": "getFusionChartData.php?key=position&value=stationMaster",
            "refreshInterval": "1",
            "theme": "fint"
        },
        "colorRange": {
            "color": [{
                "minValue": "0",
                "maxValue": "100",
                "code": "#e44a00"
            }, {
                "minValue": "100",
                "maxValue": "400",
                "code": "#f8bd19"
            }, {
                "minValue": "400",
                "maxValue": "500",
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
<script>
  FusionCharts.ready(function(){
    var fusioncharts = new FusionCharts({
    type: 'angulargauge',
    renderAt: 'chart-Manager',
    width: '210',
    height: '180',
    dataFormat: 'json',
    dataSource: {
        "chart": {
            "caption": "Registered Top Managers",
            "lowerLimit": "0",
            "upperLimit": "50",
            "dataStreamUrl": "getFusionChartData.php?key=position&value=manager",
            "refreshInterval": "1",
            "theme": "fint"
        },
        "colorRange": {
            "color": [{
                "minValue": "0",
                "maxValue": "10",
                "code": "#e44a00"
            }, {
                "minValue": "10",
                "maxValue": "40",
                "code": "#f8bd19"
            }, {
                "minValue": "40",
                "maxValue": "50",
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
<script type="text/javascript">
  FusionCharts.ready(function(){
    var fusioncharts = new FusionCharts({
    type: 'hled',
    renderAt: 'chart-requests',
    width: '210',
    height: '180',
    dataFormat: 'json',
    dataSource: {
        "chart": {
            "caption": "Card Requests",
            "lowerLimit": "0",
            "upperLimit": "10",
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
			"dataStreamURL": "getFusionChartData.php?key=status&value=request",
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
                "maxValue": "3",
                "code": "#e44a00"
            }, {
                "minValue": "4",
                "maxValue": "7",
                "code": "#f8bd19"
            }, {
                "minValue": "8",
                "maxValue": "10",
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
<script>
  FusionCharts.ready(function(){
    var fusioncharts = new FusionCharts({
    type: 'angulargauge',
    renderAt: 'chart-trains',
    width: '210',
    height: '180',
    dataFormat: 'json',
    dataSource: {
        "chart": {
            "caption": "Registered Trains",
            "lowerLimit": "0",
            "upperLimit": "100",
            "dataStreamUrl": "getFusionChartData.php?key=trains&value=all",
            "refreshInterval": "1",
            "theme": "fint"
        },
        "colorRange": {
            "color": [{
                "minValue": "0",
                "maxValue": "20",
                "code": "#e44a00"
            }, {
                "minValue": "21",
                "maxValue": "80",
                "code": "#f8bd19"
            }, {
                "minValue": "81",
                "maxValue": "100",
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
<script>
  FusionCharts.ready(function(){
    var fusioncharts = new FusionCharts({
    type: 'angulargauge',
    renderAt: 'chart-stations',
    width: '210',
    height: '180',
    dataFormat: 'json',
    dataSource: {
        "chart": {
            "caption": "Registered Stations",
            "lowerLimit": "0",
            "upperLimit": "350",
            "dataStreamUrl": "getFusionChartData.php?key=stations&value=all",
            "refreshInterval": "1",
            "theme": "fint"
        },
        "colorRange": {
            "color": [{
                "minValue": "0",
                "maxValue": "100",
                "code": "#e44a00"
            }, {
                "minValue": "101",
                "maxValue": "250",
                "code": "#f8bd19"
            }, {
                "minValue": "251",
                "maxValue": "350",
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
			"dataStreamURL": "getFusionChartData.php?key=commuter&value=all",
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
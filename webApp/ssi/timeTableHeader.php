<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<!--header start-->
<div class="container-fluid navbar-fixed-top" style="background-color:rgb(0,102,255);">
	<div class="row text-center text-capitalize">
    	<div class="col-md-3" style="padding:10px;text-align:left;"> 
        	<?php
				$nic = $_SESSION['nic'];
				$getStation = "SELECT station_name FROM station WHERE station_code IN (SELECT station_code FROM staff WHERE employee_nic='".$nic."')";
				$resultStation = mysqli_query($con, $getStation);
				if(mysqli_num_rows($resultStation) != 0){
					while($rowStation = mysqli_fetch_array($resultStation)){
						$station = $rowStation['station_name'];
						echo '<font face="Verdana, Geneva, sans-serif" size="+1" color="#FFFFFF">Station : '.$station.'</font>';
					}
				}
			?>
        </div>
    	<div class="col-md-3" style="padding:10px;text-align:center;"> 
            <?php
				if(isset($_GET['r']) && isset($_GET['q'])){
					$d = $_GET['r'];
					$l = $_GET['q'];
					switch($l){
						case 'matara':
							$line = 'Colombo - Matara';
							break;
						case 'kandy':
							$line = 'Colombo - Kandy';
							break;
						case 'vauniya':
							$line = 'Colombo - Vauniya';
							break;
						case 'taleimannar':
							$line = 'Colombo - Taleimannar';
							break;
						case 'jaffna':
							$line = 'Colombo - Jaffna';
							break;
						default :
							break;
					}
					echo '<font face="Verdana, Geneva, sans-serif" size="+1" color="#FFFFFF">Line : '.$line.'</font>';
				}
			?>
        </div>
        <div class="col-md-3" style="padding:10px;text-align:center;"> 
            <font face="Verdana, Geneva, sans-serif" size="+1" color="#FFFFFF">Date : <?php echo date("Y-M-d"); ?></font>
        </div>
        <div class="col-md-3" style="padding:10px;text-align:right;"> 
            <font face="Verdana, Geneva, sans-serif" size="+1" color="#FFFFFF">Time : <?php echo date("h:i:sa"); ?></font>
        </div>
	</div>
</div>
</body>
</html>

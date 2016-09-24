<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position'])){
	if($_SESSION['position'] == "sysadmin" || $_SESSION['position'] == "stationMaster"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('../ssi/links.html');
	include_once('../ssi/db.php');
?>
<style>
a {
	color:rgba(255,0,0,0.5);
}
a:hover {
    color:rgba(255,0,0,1);
}
a:visited{
	color:rgba(255,0,0,0.5);
}
</style>
<title>Cards Management</title>
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
            if($_SESSION['position']=="sysadmin"){
				include_once('../ssi/adminLeftPanelCards.php');
			} else if($_SESSION['position']=="stationMaster"){
				include_once('../ssi/stationMasterLeftPanelCards.php');
			}
        ?>
    </div>
    <div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1">
            	<u>View S.C.A.T. Card Requests</u>
            </font>
        </div>
        <div style="padding-left:100px;padding-top:20px;"> 
        <?php
			if($_SESSION['position']=="sysadmin"){
				$getCards = "SELECT * FROM card_request WHERE card_request_status_status_id IN (SELECT status_id FROM card_request_status WHERE status_type='request')";
				$resultCards = mysqli_query($con, $getCards);
				if(mysqli_num_rows($resultCards) != 0){
					echo '<table class="table table-striped">
						<tr>
						<th>Request ID</th>
						<th>Station Code</th>
						<th>Station Master</th>
						<th>Number of Cards Requested</th>
						<th>Requested Date</th>
					   </tr>';
					while($rowCards = mysqli_fetch_array($resultCards)){
						$reqId = $rowCards['request_id'];
						$cardsReq = $rowCards['no_of_cards_requested'];
						$station = $rowCards['station_station_code'];
						$date = $rowCards['requested_date'];
						$getStation = "SELECT * FROM station WHERE station_code='".$station."'";
						$resultStation = mysqli_query($con, $getStation);
						if(mysqli_num_rows($resultStation) != 0){
							while($rowStation = mysqli_fetch_array($resultStation)){
								$stationName = $rowStation['station_name'];
								$smNic = $rowStation['employee_nic'];
								$getSM = "SELECT * FROM NAME WHERE name_id IN (SELECT name_id FROM employee WHERE nic='".$smNic."')";
								$resultSM = mysqli_query($con, $getSM);
								if(mysqli_num_rows($resultSM) != 0){
									while($rowSM = mysqli_fetch_array($resultSM)){
										$fName = $rowSM['first_name'];
										$sName = $rowSM['second_name'];
										$lName = $rowSM['last_name'];
									}
								}
							}
						}echo '<tr>
								<td>'.$reqId.'</td>
								<td>'.$station.' - '.$stationName.'</td>
								<td>'.$fName.' '.$sName.' '.$lName.'</td>
								<td>'.$cardsReq.'</td>
								<td>'.$date.'</td>
							  </tr>';
					}
					echo '</table>';
				} else {
					//no requests
					echo '<h3 class="text-center" style="padding:50px;">No Card Requests To Display.</h3>';
				}
			} else if($_SESSION['position']=="stationMaster"){
				$getS = "SELECT station_code FROM station WHERE employee_nic='".$_SESSION['nic']."'";
				$resultS = mysqli_query($con, $getS);
				if(mysqli_num_rows($resultS) != 0){
					while($rowS = mysqli_fetch_array($resultS)){
						$stationId = $rowS['station_code'];
					}
					$getCards = "SELECT * FROM card_request WHERE card_request_status_status_id IN (SELECT status_id FROM card_request_status WHERE status_type='request') AND station_station_code='".$stationId."'";
					$resultCards = mysqli_query($con, $getCards);
					if(mysqli_num_rows($resultCards) != 0){
						echo '<table class="table table-striped">
							<tr>
							<th>Request ID</th>
							<th>Station Code</th>
							<th>Station Master</th>
							<th>Number of Cards Requested</th>
							<th>Requested Date</th>
						   </tr>';
						while($rowCards = mysqli_fetch_array($resultCards)){
							$reqId = $rowCards['request_id'];
							$cardsReq = $rowCards['no_of_cards_requested'];
							$station = $rowCards['station_station_code'];
							$date = $rowCards['requested_date'];
							$getStation = "SELECT * FROM station WHERE station_code='".$station."'";
							$resultStation = mysqli_query($con, $getStation);
							if(mysqli_num_rows($resultStation) != 0){
								while($rowStation = mysqli_fetch_array($resultStation)){
									$stationName = $rowStation['station_name'];
									$smNic = $rowStation['employee_nic'];
									$getSM = "SELECT * FROM NAME WHERE name_id IN (SELECT name_id FROM employee WHERE nic='".$smNic."')";
									$resultSM = mysqli_query($con, $getSM);
									if(mysqli_num_rows($resultSM) != 0){
										while($rowSM = mysqli_fetch_array($resultSM)){
											$fName = $rowSM['first_name'];
											$sName = $rowSM['second_name'];
											$lName = $rowSM['last_name'];
										}
									}
								}
							}echo '<tr>
									<td>'.$reqId.'</td>
									<td>'.$station.' - '.$stationName.'</td>
									<td>'.$fName.' '.$sName.' '.$lName.'</td>
									<td>'.$cardsReq.'</td>
									<td>'.$date.'</td>
								  </tr>';
						}
						echo '</table>';
					} else {
						//no requests
						echo '<h3 class="text-center" style="padding:50px;">No Card Requests To Display.</h3>';
					}
				} else {
					//wrong station
					echo '<h3 class="text-center" style="padding:50px;">You Are Not Assigned To A Station.</h3>';
				}
			} else {
				header('Location:../404.php');
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
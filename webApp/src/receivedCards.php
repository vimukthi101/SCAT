<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position'])){
	if($_SESSION['position'] == "stationMaster"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('../ssi/links.html');
	include_once('../ssi/db.php');
?>
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
            include_once('../ssi/stationMasterLeftPanelCards.php');
        ?>
    </div>
    <div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1">
            	<u>Issue S.C.A.T. Cards</u>
            </font>
        </div>
        <div style="padding:10px;"> 
        <?php
			if(isset($_GET['error'])){
				if(!empty($_GET['error'])){
					$error = $_GET['error'];
					if($error == "ef"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Required Fields Cannot Be Empty.</label>
							</div>';
					} else if($error == "cu"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Please Try Again Later.</label>
							</div>';
					} else if($error == "qf"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Could Not Mark As Received. Please Try Again Later.</label>
							</div>';
					} else if($error == "su"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control label-success" style="height:35px;">Card Request Successfully Updated As Received.</label>
							</div>';
					}
				}
			}
			$getS = "SELECT station_code FROM station WHERE employee_nic='".$_SESSION['nic']."'";
			$resultS = mysqli_query($con, $getS);
			if(mysqli_num_rows($resultS) != 0){
				while($rowS = mysqli_fetch_array($resultS)){
					$stationId = $rowS['station_code'];
				}
				$getReq = "SELECT * FROM card_request WHERE station_station_code='".$stationId."' AND card_request_status_status_id IN (SELECT status_id FROM card_request_status WHERE status_type='send')";
				$resultReq = mysqli_query($con, $getReq);
				if(mysqli_num_rows($resultReq) != 0){
					while($rowReq = mysqli_fetch_array($resultReq)){
						$rID = $rowReq['request_id'];
						$rCards = $rowReq['no_of_cards_requested'];
						$sCards = $rowReq['no_of_cards_sent'];
						$rDate = $rowReq['requested_date'];
						$sDate = $rowReq['send_date'];
					}
					echo '<form role="form" method="post" action="controller/cardRequestReceivedController.php" class="form-horizontal">
							<div class="form-group">
								<label for="rID" class="control-label col-md-3">Request ID</label>
								<div class="col-md-8">
									<input class="form-control" type="text" name="rID" id="rID" readonly="readonly" value="'.$rID.'"/>
								</div>
							</div>
							<div class="form-group">
								<label for="nRequest" class="control-label col-md-3">Number of Cards Requested</label>
								<div class="col-md-8">
									<input class="form-control" type="text" name="nRequest" id="nRequest" readonly="readonly" value="'.$rCards.'"/>
								</div>
							</div>
							<div class="form-group">
								<label for="nRequest" class="control-label col-md-3">Card Requested Date</label>
								<div class="col-md-8">
									<input class="form-control" type="text" name="dRequest" id="dRequest" readonly="readonly" value="'.$rDate.'"/>
								</div>
							</div>
							<div class="form-group">
								<label for="nSend" class="control-label col-md-3">Number of Cards Received</label>
								<div class="col-md-8">
									<input class="form-control" type="text" name="nSend" id="nSend" readonly="readonly" value="'.$sCards.'"/>
								</div>
							</div>
							<div class="form-group">
								<label for="nRequest" class="control-label col-md-3">Number of Cards Requested</label>
								<div class="col-md-8">
									<input class="form-control" type="text" name="dSend" id="dSend" readonly="readonly" value="'.$sDate.'"/>
								</div>
							</div>
							<div class="form-group col-md-11 text-center">
								<input name="submit" id="submit" type="submit" value="Received" class="btn btn-success" onclick="return confirm(\'Do You Wish to Mark Cards Request As Received?\');return false;"/>
							</div>
						</form>';
				} else {
					//no send requests
					echo '<h3 class="text-center" style="padding:50px;">No Requests To Display.</h3>';
				}
			} else {
				//wrong station
				echo '<h3 class="text-center" style="padding:50px;">You Are Not Assigned To A Station.</h3>';
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
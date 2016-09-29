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
            include_once('../ssi/adminLeftPanelCards.php');
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
					} else if($error == "ir"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Invalid Card Request.</label>
							</div>';
					} else if($error == "wc"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Wrong Card Number Format.</label>
							</div>';
					} else if($error == "qfi"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Could Not Issue The Cards. Please Try Again Later.</label>
							</div>';
					} else if($error == "sui"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control label-success" style="height:35px;">Cards Successfully Issued.</label>
							</div>';
					} else if($error == "qfr"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Could Not Reject The Cards. Please Try Again Later.</label>
							</div>';
					} else if($error == "sur"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control label-danger" style="height:35px;">Cards Successfully Rejected.</label>
							</div>';
					} else if($error == "nc"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">There Are No Cards To Issue.</label>
							</div>';
					} else if($error == "ne"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Not Enough Cards To Send. There Are Only '.$_GET['num'].' Cards On The System.</label>
							</div>';
					}
				}
			}
			?>
            <div class="form-horizontal">
            	<div class="form-group">
                    <label for="rID" class="control-label col-md-3">Request ID</label>
                    <div class="col-md-8">
                        <select class="form-control" name="rID" id="rID" onchange="showHint(this.value)">
                            <option selected="selected" disabled="disabled">--Select Card Request ID--</option>
                        <?php 
                            $getCards = "SELECT * FROM card_request WHERE card_request_status_status_id IN (SELECT status_id FROM card_request_status WHERE status_type='request')";
                            $resultCards = mysqli_query($con, $getCards);
                            if(mysqli_num_rows($resultCards) != 0){
                                while($rowCards = mysqli_fetch_array($resultCards)){
                                    $reqId = $rowCards['request_id'];
									$station = $rowCards['station_station_code'];
									$getStation = "SELECT * FROM station WHERE station_code='".$station."'";
									$resultStation = mysqli_query($con, $getStation);
									if(mysqli_num_rows($resultStation) != 0){
										while($rowStation = mysqli_fetch_array($resultStation)){
											$stationName = $rowStation['station_name'];
										}
									}
									echo '<option value="'.$reqId.'">'.$reqId.' - '.$stationName.'</option>';
                                }
								$getSM = "SELECT * FROM NAME WHERE name_id IN (SELECT name_id FROM employee WHERE nic='".$smNic."')";
								$resultSM = mysqli_query($con, $getSM);
								if(mysqli_num_rows($resultSM) != 0){
									while($rowSM = mysqli_fetch_array($resultSM)){
										$fName = $rowSM['first_name'];
										$sName = $rowSM['second_name'];
										$lName = $rowSM['last_name'];
									}
								}
                            } else {
								echo '<option disabled="disabled">No Cards Requests.</option>';	
							}
                        ?>
                    	</select>
                	</div>
                </div>
                </div>
                <hr />
                <script>
					function showHint(str) {
						if (str.length == 0) { 
							document.getElementById("txtHint").innerHTML = "";
							return;
						} else {
							var xmlhttp = new XMLHttpRequest();
							xmlhttp.onreadystatechange = function() {
								if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
									document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
								}
							};
							xmlhttp.open("GET", "getCardInfo.php?p=requests&q=" + str, true);
							xmlhttp.send();
						}
					}
                </script>
				<div class="form-horizontal">
					<div style="padding-left:70px;" id="txtHint"></div>
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
<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position'])){
	if($_SESSION['position'] == "topupAgent"){	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('../ssi/links.html');
	include_once('../ssi/db.php');
?>
<title>Top-up</title>
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
			include_once('../ssi/topupAgentLeftPanel.php');
        ?>
    </div>
    	<?php
			$total = 0.00;
			$nic = $_SESSION['nic'];
			$payment = "SELECT * FROM topup_agent_payment WHERE topup_agent_payment_status='0' AND employee_nic='".$nic."'";
			$resultPayment = mysqli_query($con, $payment);
			if(mysqli_num_rows($resultPayment)==0){
				$query = "SELECT * FROM recharge WHERE employee_nic='".$nic."' AND send_status='0'";
				$result = mysqli_query($con, $query);
				if(mysqli_num_rows($result)!=0){
					while($row = mysqli_fetch_array($result)){
						$amount = $row['amount'];
						$total += $amount;
					}
					$get = "SELECT topup_agent_regfee FROM topup_agent_regfee WHERE topup_agent_regfee_id IN (SELECT topup_agent_regfee_id FROM topup_agent WHERE employee_nic='".$nic."')";
					$res = mysqli_query($con, $get);
					if(mysqli_num_rows($res)!=0){
						while($r = mysqli_fetch_array($res)){
							$regFee = $r['topup_agent_regfee'];
						}
						if($total >= $regFee){
							echo '<h3 class="text-center center-block col-md-12" style="padding-top:250px;padding-left:200px;">please send money to the station before proceed with topup.<h3>';
						} else {
		?>
							//success flow
							<div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
								<div class="text-center" style="padding:10px;">
									<font face="Verdana, Geneva, sans-serif" size="+1">
										<u>Top-Up a Card</u>
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
												} else if($error == "wa"){
													echo '<div class="form-group text-center" style="padding-left:100px;">
															<label class="form-control" style="height:35px;">Amount Should Be In The Format Of 100.00</label>
														</div>';
												} else if($error == "wc"){
													echo '<div class="form-group text-center" style="padding-left:100px;">
															<label class="form-control" style="height:35px;">Invalid Commuter.</label>
														</div>';
												} else if($error == "qf"){
													echo '<div class="form-group text-center" style="padding-left:100px;">
															<label class="form-control" style="height:35px;">Could Not Top-Up The Card. Please Try Again Later.</label>
														</div>';
												} else if($error == "su"){
													echo '<div class="form-group text-center" style="padding-left:100px;">
															<label class="form-control label-success" style="height:35px;">Top-Up The Card Successfully.</label>
														</div>';
												}
											}
										}
									?>
									<form role="form" class="form-horizontal">
										<div class="form-group">
											<label for="employeeId" class="control-label col-md-3">Search By : </label>
											<div class="col-md-8">
												<select onchange="load(this);" name="searchBy" id="searchBy" class="form-control">
												  <option selected="selected" disabled="disabled">--Select the search criteria--</option>
												  <option value="cNo">Card Number</option>
												  <option value="nic">NIC</option>      
												</select>
											</div>
										</div>
										<hr/>
									</form>
									<script type="text/javascript">
										 function load(selectObj) { 
											 var idx = selectObj.selectedIndex; 
											 var which = selectObj.options[idx].value; 
											 if(which=='cNo'){
												 document.getElementById('new').innerHTML = '<div class="form-group"><label for="CardNo" class="control-label col-md-3">Card Number</label><div class="col-md-8"><input class="form-control" type="text" name="CardNo" id="CardNo"/></div><div><input type="button" value="Search" class="btn btn-success" onClick="showHint(document.getElementById(\'CardNo\').value, document.getElementById(\'CardNo\').id);"/></div></div><hr/>'; 
											 } else if(which=='nic'){
												 document.getElementById('new').innerHTML = '<div class="form-group"><label for="employeelNIC" class="control-label col-md-3">NIC</label><div class="col-md-8"><input class="form-control" type="text" name="nic" id="nic" /></div><div><input type="button" value="Search" class="btn btn-success" onClick="showHint(document.getElementById(\'nic\').value, document.getElementById(\'nic\').id);"/></div></div><hr/>';
											 } else {
												 document.getElementById('new').innerHTML = '';
											 }
										 } 
									</script>
									<script>
									function showHint(str, id) {
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
											xmlhttp.open("GET", "getCommuterInfo.php?p=topup&q=" + str + "&r=" + id, true);
											xmlhttp.send();
										}
									}
									</script>
									<div class="form-horizontal">
										<div id="new"></div>
										<div style="padding-left:70px;" id="txtHint"></div>
									</div>
								</div>
							</div>
        <?php
						}
					}
				} else {
					//first time or after sending money
		?>
        			<div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
                        <div class="text-center" style="padding:10px;">
                            <font face="Verdana, Geneva, sans-serif" size="+1">
                                <u>Top-Up a Card</u>
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
                                        } else if($error == "wa"){
                                            echo '<div class="form-group text-center" style="padding-left:100px;">
                                                    <label class="form-control" style="height:35px;">Amount Should Be In The Format Of 100.00</label>
                                                </div>';
                                        } else if($error == "wc"){
                                            echo '<div class="form-group text-center" style="padding-left:100px;">
                                                    <label class="form-control" style="height:35px;">Invalid Commuter.</label>
                                                </div>';
                                        } else if($error == "qf"){
                                            echo '<div class="form-group text-center" style="padding-left:100px;">
                                                    <label class="form-control" style="height:35px;">Could Not Top-Up The Card. Please Try Again Later.</label>
                                                </div>';
                                        } else if($error == "su"){
                                            echo '<div class="form-group text-center" style="padding-left:100px;">
                                                    <label class="form-control label-success" style="height:35px;">Top-Up The Card Successfully.</label>
                                                </div>';
                                        }
                                    }
                                }
                            ?>
                            <form role="form" class="form-horizontal">
                                <div class="form-group">
                                    <label for="employeeId" class="control-label col-md-3">Search By : </label>
                                    <div class="col-md-8">
                                        <select onchange="load(this);" name="searchBy" id="searchBy" class="form-control">
                                          <option selected="selected" disabled="disabled">--Select the search criteria--</option>
                                          <option value="cNo">Card Number</option>
                                          <option value="nic">NIC</option>      
                                        </select>
                                    </div>
                                </div>
                                <hr/>
                            </form>
                            <script type="text/javascript">
                                 function load(selectObj) { 
                                     var idx = selectObj.selectedIndex; 
                                     var which = selectObj.options[idx].value; 
                                     if(which=='cNo'){
                                         document.getElementById('new').innerHTML = '<div class="form-group"><label for="CardNo" class="control-label col-md-3">Card Number</label><div class="col-md-8"><input class="form-control" type="text" name="CardNo" id="CardNo"/></div><div><input type="button" value="Search" class="btn btn-success" onClick="showHint(document.getElementById(\'CardNo\').value, document.getElementById(\'CardNo\').id);"/></div></div><hr/>'; 
                                     } else if(which=='nic'){
                                         document.getElementById('new').innerHTML = '<div class="form-group"><label for="employeelNIC" class="control-label col-md-3">NIC</label><div class="col-md-8"><input class="form-control" type="text" name="nic" id="nic" /></div><div><input type="button" value="Search" class="btn btn-success" onClick="showHint(document.getElementById(\'nic\').value, document.getElementById(\'nic\').id);"/></div></div><hr/>';
                                     } else {
                                         document.getElementById('new').innerHTML = '';
                                     }
                                 } 
                            </script>
                            <script>
                            function showHint(str, id) {
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
                                    xmlhttp.open("GET", "getCommuterInfo.php?p=topup&q=" + str + "&r=" + id, true);
                                    xmlhttp.send();
                                }
                            }
                            </script>
                            <div class="form-horizontal">
                                <div id="new"></div>
                                <div style="padding-left:70px;" id="txtHint"></div>
                            </div>
                        </div>
                    </div>
        <?php
				}
			} else{
				echo '<h3 class="text-center center-block col-md-12" style="padding-top:250px;padding-left:200px;">not received the payment yet.<h3>';
			}
		?>
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
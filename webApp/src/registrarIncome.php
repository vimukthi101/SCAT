<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position']) && $_SESSION['position'] == "stationMaster"){
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
            include_once('../ssi/stationMasterLeftPanelPayments.php');
        ?>
    </div>
    <div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1">
            	<u>Received Registrar Payments</u>
            </font>
        </div>
        <div style="padding:10px;"> 
			<?php
                if(isset($_GET['error'])){
                    $error = $_GET['error'];
                    if($error == "qf"){
                        echo '<div class="form-group col-md-10 text-center" style="padding:10px;margin-left:100px;">
                            <label class="form-control col-md-3">Could Not Mark The Payment As Received. Please Try Again Later.</label>
                        </div>';
                    } else if($error == "er"){
                        echo '<div class="form-group col-md-10 text-center" style="padding:10px;margin-left:100px;">
                            <label class="form-control col-md-3">Please Try Again Later.</label>
                        </div>';
                    } else if($error == "su"){
                        echo '<div class="form-group col-md-10 text-center" style="padding:10px;margin-left:100px;">
                            <label class="form-control col-md-3 label-success">Successfully Received The Payment.</label>
                        </div>';
                    }
                }
            ?>
			<div class="form-horizontal">
            	<div class="form-group">
                    <label for="pass" class="control-label col-md-3">Registrar : </label>
                    <div class="col-md-8">
                    	<select onchange="showHint(this.value);" class="form-control" name="topup" id="topup">
                        	<?php
								$get = "SELECT employee_id, employee_nic FROM staff WHERE employee_position_position_id IN (SELECT position_id FROM employee_position WHERE POSITION='registrar')";
								$result = mysqli_query($con, $get);
								if(mysqli_num_rows($result)!=0){
									echo '<option disabled="disabled" selected="selected">Select A Registrar</option>';
									while($row = mysqli_fetch_array($result)){
										$nic = $row['employee_nic'];
										$id = $row['employee_id'];
										echo '<option value="'.$nic.'">'.$nic.' - '.$id.'</option>';
									}
								} else {
									echo '<option>Registrars Not Added Yet.</option>';
								}
							?>
                        </select>
                	</div>
                </div><hr/>
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
							xmlhttp.open("GET", "getIncome.php?p=registrar&q=" + str , true);
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
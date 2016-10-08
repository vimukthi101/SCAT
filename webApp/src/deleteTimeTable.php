<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position'])){
	if($_SESSION['position'] == "updater"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('../ssi/links.html');
	include_once('../ssi/db.php');
?>
<title>Time Table Management</title>
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
			include_once('../ssi/timeTableUpdaterLeftPanel.php'); 
        ?>
    </div>
    <div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1">
            	<u>Remove Time Table</u>
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
					} else if($error == "qf"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Could Not Delete The Time Table. Please Try Again Later.</label>
							</div>';
					} else if($error == "su"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control label-success" style="height:35px;">Time Table Successfully Deleted.</label>
							</div>';
					} else if($error == "nc"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control label-success" style="height:35px;">No Time Table With Such Details.</label>
							</div>';
					}
				}
			}
			?>
            <form role="form" class="form-horizontal">
            	<div class="form-group">
                    <label for="day" class="control-label col-md-3">Select the Time Table : </label>
                    <div class="col-md-8">
                    	<select onchange="showHint(this.value);" name="id" id="id" class="form-control">
                        	<option selected="selected" disabled="disabled">--Select The Time Table--</option>
							<?php
                                $nic = $_SESSION['nic'];
								echo $nic;
                                $get = "SELECT * FROM timetable WHERE employee_nic='".$nic."'";
                                $result = mysqli_query($con, $get);
                                if(mysqli_num_rows($result) != 0){
									echo '<option disabled="disabled">Line , Date Time , Train</option>';
                                    while($row = mysqli_fetch_array($result)){
                                        $time = $row['train_time'];
                                        $date = $row['train_date'];
                                        $l = $row['line'];
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
                                        $ttId = $row['timetable_id'];
                                        $train = $row['train_train_id'];
                                        $station = $row['station_station_code'];
										if(!empty($ttId) && !empty($line) && !empty($date) && !empty($time) && !empty($train)){
											echo '<option value="'.$ttId.'">'.$line.' , '.$date.' '.$time.' , '.$train.'</option>';	
										}
                                    }
                                } else {
                                   echo '<option disabled="disabled">No Time Tables Added Yet.</option>';
                                }
                            ?>
                         </select>
                    </div>
                </div>
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
							xmlhttp.open("GET", "getTimeTableInfo.php?p=delete&q=" + str + "&r=all", true);
							xmlhttp.send();
						}
					}
				</script>
            </form>
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
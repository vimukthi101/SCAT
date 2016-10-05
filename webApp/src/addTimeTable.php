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
            	<u>Add New Time Table</u>
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
					} else if($error == "ss"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Destination Station Cannot Be Your Station.</label>
							</div>';
					} else if($error == "ae"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Already A Time Table Has Being Added For The Same Date Time On Same Line.</label>
							</div>';
					}  else if($error == "ws"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Station Invalid.</label>
							</div>';
					} else if($error == "wt"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Train Invalid.</label>
							</div>';
					} else if($error == "te"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Train Has Being Already Added At The Same Date And Time For Another Time Table.</label>
							</div>';
					} else if($error == "qf"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Could Not Add The Time Table. Please Try Again Later.</label>
							</div>';
					} else if($error == "su"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control label-success" style="height:35px;">Time Table Successfully Added.</label>
							</div>';
					}
				}
			}
		?>
            <form role="form" class="form-horizontal" method="post" action="controller/addTimeTableController.php">
            	<div class="form-group">
                    <label for="day" class="control-label col-md-3">Select the Day : </label>
                    <div class="col-md-8">
                    	<select name="day" id="day" class="form-control">
                          <option selected="selected" disabled="disabled">--Select the Day--</option>
                          <option value="sun">Sunday</option>
                          <option value="mon">Monday</option>
                          <option value="tus">Tuesday</option>
                          <option value="wed">Wednesday</option>
                          <option value="thu">Thursday</option>
                          <option value="fri">Friday</option>
                          <option value="sat">Saturday</option>
                        </select>
                	</div>
                </div>
                <div class="form-group">
                    <label for="line" class="control-label col-md-3">Select the Line : </label>
                    <div class="col-md-8">
                    	<select name="line" id="line" class="form-control">
                          <option selected="selected" disabled="disabled">--Select the Line--</option>
                          <option value="kandy">Colombo - Kandy</option>
                          <option value="matara">Colombo - Matara</option>
                          <option value="vauniya">Colombo - Vauniya</option>
                          <option value="taleimannar">Colombo - Taleimannar</option>
                          <option value="jaffna">Colombo - Jaffna</option>
                        </select>
                	</div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Fill Following Information</label>
                </div>
                <div class="form-group">
                    <div class="col-md-12" style="padding-left:150px;">
                    	<table style="width:100%;" class="table table-striped" id="table">
                          <tr>
                            <th>Train</th>
                            <th>Time</th>
         					<th>Destination</th>
                          </tr>
                          <tr>
                            <td>
                                <select name="tNo" id="tNo" class="form-control">
                                      <option selected="selected" disabled="disabled">--Select the Train--</option>
										<?php
                                            $getTrain = "SELECT * FROM train";
                                            $resultTrain = mysqli_query($con, $getTrain);
                                            if(mysqli_num_rows($resultTrain)!=0){
                                                while($rowTrain = mysqli_fetch_array($resultTrain)){
                                                    $trainId = $rowTrain['train_id'];
                                                    $trainName = $rowTrain['train_name'];
                                                    $trainType = $rowTrain['train_type_type_id'];
                                                    echo '<option value="'.$trainId.'">'.$trainId.' - '.$trainName.' - '.$trainType.'</option>';
                                                }
                                            } else {
                                                echo '<option disabled="disabled">No Trains Added To The System Yet.</option>';
                                            }
                                        ?>
                                </select>
                            </td>
                            <td>
                            	<input type="time" class="form-control" id="time" name="time" required="required"/>
                            </td>
                            <td>
                                <select name="station" id="station" class="form-control">
                                  <option selected="selected" disabled="disabled">--Select the Station--</option>
                                    <?php
                                        $getStation = "SELECT * FROM station";
                                        $resultStation = mysqli_query($con, $getStation);
                                        if(mysqli_num_rows($resultStation)!=0){
                                            while($rowTrain = mysqli_fetch_array($resultStation)){
                                                $stationId = $rowTrain['station_code'];
                                                $stationName = $rowTrain['station_name'];
                                                echo '<option value="'.$stationId.'">'.$stationId.' - '.$stationName.'</option>';
                                            }
                                        } else {
                                            echo '<option disabled="disabled">No Stations Added To The System Yet.</option>';
                                        }
                                    ?>
                                </select>
                            </td>
                          </tr>
                        </table>
                	</div>
                </div>
                <div class="form-group col-md-11 text-center">
                    <input type="submit" name="submit" id="submit" onclick="return confirm('Do You Wish to Add Time Table?');return false;" value="Add" class="btn btn-success" />
                    <input type="reset" value="Clear" class="btn btn-danger"/>
                </div>
            </form>
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
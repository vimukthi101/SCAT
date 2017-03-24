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
<title>System Configurations</title>
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
            include_once('../ssi/adminLeftPanelSystem.php');
        ?>
    </div>
    <div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1">
            	<u>Add Ticket Fee</u>
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
									<label class="form-control" style="height:35px;">In Station And The Out Station Both Cannot Be The Same.</label>
								</div>';
						} else if($error == "wf"){
							echo '<div class="form-group text-center" style="padding-left:100px;">
									<label class="form-control" style="height:35px;">Ticket Fee Should Be Like 100.00 Format.</label>
								</div>';
						} else if($error == "wi"){
							echo '<div class="form-group text-center" style="padding-left:100px;">
									<label class="form-control" style="height:35px;">Invalid In Station.</label>
								</div>';
						} else if($error == "wo"){
							echo '<div class="form-group text-center" style="padding-left:100px;">
									<label class="form-control" style="height:35px;">Invalid Out Station.</label>
								</div>';
						} else if($error == "ae"){
							echo '<div class="form-group text-center" style="padding-left:100px;">
									<label class="form-control" style="height:35px;">Ticket Already Has Being Added Between Those Two Stations.</label>
								</div>';
						} else if($error == "qf"){
							echo '<div class="form-group text-center" style="padding-left:100px;">
									<label class="form-control" style="height:35px;">Could Not Add The Ticket. Please Try Again Later.</label>
								</div>';
						} else if($error == "su"){
							echo '<div class="form-group text-center" style="padding-left:100px;">
									<label class="form-control label-success" style="height:35px;">Ticket Fee Successfully Added.</label>
								</div>';
						} else if($error == "nm"){
							echo '<div class="form-group text-center" style="padding-left:100px;">
									<label class="form-control label-success" style="height:35px;">Ticket Fee Successfully Added. Couldn\' send the email.</label>
								</div>';
						}
					}
				}
			?>
            <form role="form" class="form-horizontal" method="post" action="controller/addTicketsController.php">
            	<div class="form-group">
                    <label for="iStation" class="control-label col-md-3">In Station <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<select name="iStation" id="iStation" class="form-control">
                          <option selected="selected" disabled="disabled">--Select the In Station--</option>
							<?php
                                $getStations = "SELECT station_code, station_name FROM station";
                                $resultStations = mysqli_query($con, $getStations);
                                if(mysqli_num_rows($resultStations) != 0){
                                    while($rowStations = mysqli_fetch_array($resultStations)){
                                        $stationCode = $rowStations['station_code'];
                                        $stationName = $rowStations['station_name'];
                                        echo '<option value="'.$stationCode.'">'.$stationName.'</option>';
                                    }
                                } else {
                                    //no stations	
									echo '<option value="empty">No Stations Added Yet.</option>';
                                }
                            ?>
                        </select>
                	</div>
                </div>
                <div class="form-group">
                    <label for="oStation" class="control-label col-md-3">Out Station <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<select name="oStation" id="oStation" class="form-control">
                          <option selected="selected" disabled="disabled">--Select the In Station--</option>
							<?php
                                $getStations = "SELECT station_code, station_name FROM station";
                                $resultStations = mysqli_query($con, $getStations);
                                if(mysqli_num_rows($resultStations) != 0){
                                    while($rowStations = mysqli_fetch_array($resultStations)){
                                        $stationCode = $rowStations['station_code'];
                                        $stationName = $rowStations['station_name'];
                                        echo '<option value="'.$stationCode.'">'.$stationName.'</option>';
                                    }
                                } else {
                                    //no stations	
									echo '<option value="empty">No Stations Added Yet.</option>';
                                }
                            ?>
                        </select>
                	</div>
                </div> 
                <div class="form-group">
                    <label for="tFee" class="control-label col-md-3">Ticket Fee <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="tFee" id="tFee" pattern="^\d+\.(\d{2})$" title="Should Be Like 100.00 Format." required="required"/>
                	</div>
                </div> 
                <div class="form-group">
                    <label for="class" class="control-label col-md-3">Class <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<select class="form-control" id="class" name="class">
                        	<option value="1">1<sup>st</sup> Class</option>
                            <option value="2">2<sup>nd</sup> Class</option>
                            <option value="3">3<sup>rd</sup> Class</option>
                        </select>
                	</div>
                </div>
                <div class="form-group" style="text-align:center;">
							<label style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
						</div>
                <div class="form-group col-md-11 text-center">
                    <input type="submit" value="Add" id="submit" name="submit" class="btn btn-success" />
                    <input type="reset" value="Clear" class="btn btn-danger" />
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
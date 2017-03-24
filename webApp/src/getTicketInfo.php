<?php
include_once('../ssi/links.html');
include_once('../ssi/db.php');
?>
<!DOCTYPE html>
<html>
<head>
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
<?php
//value enter by user
$q = trim(htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST["q"])));
//operation : view/update/delete
$p = trim(htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST["p"])));
//html idd
$r = trim(htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST["r"])));
if($p != "" && $r != ""){
	if($p == "view"){
		if ($q != "") {
			if($r == "all"){
				$getType = "SELECT * FROM ticket";
			} else if($r == "tFee") {
				$getType = "SELECT * FROM ticket WHERE ticket_fee LIKE '".$q."%'";
			} else if($r == "Station"){
				$getType = "SELECT * FROM ticket WHERE station_in_station_code LIKE '".$q."%' OR station_out_station_code LIKE '".$q."%'";
			}
			$resultGetType = mysqli_query($con, $getType);
			if(mysqli_num_rows($resultGetType) != 0){
				echo '<div class="form-group">
							<div class="container-fluid center-block">
								<table style="width:100%;" class="table table-striped">
								  <tr>
									<th>In Station Code</th>
									<th>Out Station Code</th>
									<th>Class</th>
									<th>Ticket Fee</th>
								  </tr>';
				while($rowTypes = mysqli_fetch_array($resultGetType)){
					$iCode = $rowTypes['station_in_station_code'];
					$oCode = $rowTypes['station_out_station_code'];
					$class = $rowTypes['class'];
					$fee = $rowTypes['ticket_fee'];			
						echo '<tr>
						<td>'.$iCode.'</td>
						<td>'.$oCode.'</td>
						<td>'.$class.'</td>
						<td>'.$fee.'</td>
					  </tr>';
				}
				echo '</table>
							</div>
						</div>';
			} else {
				//if no result to show
				echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';
			}	 			  
		} else {
			//if empty q
			echo '<h3 class="text-center" style="padding:50px;">Please Enter A Value To Search.</h3>';
		}	
	} else if($p == "update"){
		if($q != ""){
			if($r == "fee") {
				$getTicket = "SELECT * FROM ticket WHERE ticket_fee='".$q."'";
			} else if($r == "station"){
				$getTicket = "SELECT * FROM ticket WHERE station_in_station_code='".$q."' OR station_out_station_code='".$q."'";
			}
			$resultGetTicket = mysqli_query($con, $getTicket);
			if(mysqli_num_rows($resultGetTicket) != 0){
				while($rowGetTicket = mysqli_fetch_array($resultGetTicket)){
					$iStation = $rowGetTicket['station_in_station_code'];
					$oStation = $rowGetTicket['station_out_station_code'];
					$class = $rowGetTicket['class'];
					$fee = $rowGetTicket['ticket_fee'];
					echo '<form role="form" class="form-horizontal" method="post" action="controller/updateTicketsController.php">
					  <div class="col-md-12">
						<div class="col-md-3">
							<label>In Station</label>
							<input class="form-control" readonly name="iStation" type="text" value="'.$iStation.'"/>
						</div>
						<div class="col-md-3">
							<label>Out Station</label>
							<input class="form-control" readonly type="text" name="oStation" value="'.$oStation.'"/>
						</div>
						<div class="col-md-1">
							<label>Class</label>
							<input class="form-control" readonly type="text" value="'.$class.'" name="class"/>
						</div>
						<div class="col-md-2">
							<label>Fee</label>
							<input class="form-control" type="text" value="'.$fee.'" name="fee"/>
						</div>
						<div class="col-md-2">
							<label>Operation</label>
							<input class="form-control btn btn-success" type="submit" id="submit" name="submit"/>
						</div>
					  </div>
					  </form>';
				}
			} else {
				//no data	
				echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';
			}
		} else {
			//if empty q
			echo '<h3 class="text-center" style="padding:50px;">Please Enter A Value To Search.</h3>';
		}	
	} else if ($p == "delete") {
		if($q != ""){
			$getTicket = "SELECT * FROM ticket WHERE station_in_station_code='".$q."' OR station_out_station_code='".$q."'";
			$resultGetTicket = mysqli_query($con, $getTicket);
			if(mysqli_num_rows($resultGetTicket) != 0){
				echo '<div class="form-group">
							<div class="container-fluid center-block">
								<table style="width:100%;" class="table table-striped">
								  <tr>
									<th>In Station Code</th>
									<th>Out Station Code</th>
									<th>Class</th>
									<th>Ticket Fee</th>
								  </tr>';
				while($rowGetTicket = mysqli_fetch_array($resultGetTicket)){
					$iStation = $rowGetTicket['station_in_station_code'];
					$oStation = $rowGetTicket['station_out_station_code'];
					$class = $rowGetTicket['class'];
					$fee = $rowGetTicket['ticket_fee'];
					echo '<tr>
						<td>'.$iStation.'</td>
						<td>'.$oStation.'</td>
						<td>'.$class.'</td>
						<td>'.$fee.'</td>
					  </tr>';
				}
				echo '</table>
							</div>
						</div>';
				echo '<form role="form" class="form-horizontal" method="post" action="controller/deleteTicketsController.php">
				<input class="form-control" type="hidden" name="oldtFee" id="oldtFee" value="'.$q.'"/>
				<div class="form-group col-md-11 text-center">
					<input type="submit" id="submit" name="submit" value="Delete" class="btn btn-danger"  onclick="return confirm(\'Do You Wish to Delete Ticket Fee?\');return false;"/>
				</div>
			</form>';
			} else {
				//no data	
				echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';
			}
		} else {
			//if empty q
			echo '<h3 class="text-center" style="padding:50px;">Please Enter A Value To Search.</h3>';
		}		
	} else {
		// 404 wrong operation
		header('Location:../404.php');	
	}
} else {
	// 404 no operation
	header('Location:../404.php');	
}
?>
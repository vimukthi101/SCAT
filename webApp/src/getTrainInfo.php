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
//html id
$r = trim(htmlspecialchars(mysqli_real_escape_string($con, $_REQUEST["r"])));
if($p != ""){
	if($r != ""){
		if($p == "view"){
			if ($q != "") {
				if($r == "TrainCode"){
					$getTrain = "SELECT * FROM train WHERE train_id LIKE '".$q."%'";
					$resultTrain = mysqli_query($con, $getTrain);
					if(mysqli_num_rows($resultTrain) != 0){
						echo '<div class="form-group">
							<div class="container-fluid center-block">
								<table style="width:100%;" class="table table-striped">
								  <tr>
									<th>Train ID</th>
									<th>Train Name</th>
									<th>Train Type</th>
								  </tr>';
						while($rowTrain = mysqli_fetch_array($resultTrain)){
							$trainName = $rowTrain['train_name'];
							$trainId = $rowTrain['train_id'];
							$trainType = $rowTrain['train_type_type_id'];
							echo '<tr>
							<td>'.$trainId.'</td>
							<td>'.$trainName.'</td>
							<td>'.$trainType.'</td>
						  </tr>';
						}
						echo '</table>
							</div>
						</div>';
					} else {
						//if no result to show
						echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';
					}
				} else if($r == "TrainName"){
					$getTrain = "SELECT * FROM train WHERE train_name LIKE '".$q."%'";
					$resultTrain = mysqli_query($con, $getTrain);
					if(mysqli_num_rows($resultTrain) != 0){
						echo '<div class="form-group">
							<div class="container-fluid center-block">
								<table style="width:100%;" class="table table-striped">
								  <tr>
									<th>Train ID</th>
									<th>Train Name</th>
									<th>Train Type</th>
								  </tr>';
						while($rowTrain = mysqli_fetch_array($resultTrain)){
							$trainId = $rowTrain['train_id'];
							$trainName = $rowTrain['train_name'];
							$trainType = $rowTrain['train_type_type_id'];
							echo '<tr>
							<td>'.$trainId.'</td>
							<td>'.$trainName.'</td>
							<td>'.$trainType.'</td>
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
					//404	
					header('Location:../404.php');
				}				  
			} else {
				//if empty q
				echo '<h3 class="text-center" style="padding:50px;">Please Enter A Value To Search.</h3>';
			}
		} else if($p == "update"){
			if ($q != "") {
				if($r == "TrainCode"){
					$getTrain = "SELECT * FROM train WHERE train_id='".$q."'";
					$resultTrain = mysqli_query($con, $getTrain);
					if(mysqli_num_rows($resultTrain) != 0){
						while($rowTrain = mysqli_fetch_array($resultTrain)){
							$trainName = $rowTrain['train_name'];
							$trainId = $rowTrain['train_id'];
							$trainType = $rowTrain['train_type_type_id'];
							echo '<form role="form" class="form-horizontal" method="post" action="controller/updateTrainsController.php">
							<div class="form-group">
								<label for="tCode" class="control-label col-md-3">Train Code <span style="color:rgb(255,0,0);">*</span></label>
								<div class="col-md-8">
									<input class="form-control" type="text" name="tCode" value="'.$trainId.'" id="tCode" readonly/>
								</div>
							</div>
							<div class="form-group">
								<label for="tName" class="control-label col-md-3">Name of the Train</label>
								<div class="col-md-8">
									<input class="form-control" type="text" name="tName" id="tName" value="'.$trainName.'" pattern="^[a-zA-Z]+$" title="Train Name Should Be Letters Only."/>
								</div>
							</div> 
							<div class="form-group">
								<label for="tName" class="control-label col-md-3">Type of the Train <span style="color:rgb(255,0,0);">*</span></label>
								<div class="col-md-8">
									<select class="form-control" name="tType" id="tType">
									<option selected="selected" disabled="disabled">--Select The Train Type--</option>';
									$getTypes = "SELECT * FROM train_type";
									$result = mysqli_query($con, $getTypes);
									if(mysqli_num_rows($result) != 0){
										while($row = mysqli_fetch_array($result)){
											$id = $row['type_id'];
											$name = $row['type_name'];
											if($trainType == $id){
												echo '<option value="'.$id.'" selected>'.$name.'</option>';
											} else {
												echo '<option value="'.$id.'">'.$name.'</option>';
											}
										}
									} else {
										echo '<option>No Train Types</option>';
									} 
									echo '</select>
								</div>
							</div> 
							<div class="form-group" style="text-align:center;">
								<label for="employeeContact" style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
							</div>
							<div class="form-group col-md-11 text-center">
								<input name="submit" id="submit" type="submit" value="Update" class="btn btn-success" onclick="return confirm(\'Do You Wish to Update Train?\');return false;"/>
							</div>
						</form>';
						}
					} else {
						//if no result to show
						echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';
					}
				} else if($r == "TrainName"){
					$getTrain = "SELECT * FROM train WHERE train_name='".$q."'";
					$resultTrain = mysqli_query($con, $getTrain);
					if(mysqli_num_rows($resultTrain) != 0){
						while($rowTrain = mysqli_fetch_array($resultTrain)){
							$trainName = $rowTrain['train_name'];
							$trainId = $rowTrain['train_id'];
							$trainType = $rowTrain['train_type_type_id'];
							echo '<form role="form" class="form-horizontal" method="post" action="controller/updateTrainsController.php">
							<div class="form-group">
								<label for="tCode" class="control-label col-md-3">Train Code <span style="color:rgb(255,0,0);">*</span></label>
								<div class="col-md-8">
									<input class="form-control" type="text" name="tCode" value="'.$trainId.'" id="tCode" readonly/>
								</div>
							</div>
							<div class="form-group">
								<label for="tName" class="control-label col-md-3">Name of the Train</label>
								<div class="col-md-8">
									<input class="form-control" type="text" name="tName" id="tName" value="'.$trainName.'" pattern="^[a-zA-Z]+$" title="Train Name Should Be Letters Only."/>
								</div>
							</div> 
							<div class="form-group">
								<label for="tName" class="control-label col-md-3">Type of the Train <span style="color:rgb(255,0,0);">*</span></label>
								<div class="col-md-8">
									<select class="form-control" name="tType" id="tType">
									<option selected="selected" disabled="disabled">--Select The Train Type--</option>';
									$getTypes = "SELECT * FROM train_type";
									$result = mysqli_query($con, $getTypes);
									if(mysqli_num_rows($result) != 0){
										while($row = mysqli_fetch_array($result)){
											$id = $row['type_id'];
											$name = $row['type_name'];
											if($trainType == $id){
												echo '<option value="'.$id.'" selected>'.$name.'</option>';
											} else {
												echo '<option value="'.$id.'">'.$name.'</option>';
											}
										}
									} else {
										echo '<option>No Train Types</option>';
									} 
									echo '</select>
								</div>
							</div> 
							<div class="form-group" style="text-align:center;">
								<label for="employeeContact" style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
							</div>
							<div class="form-group col-md-11 text-center">
								<input name="submit" id="submit" type="submit" value="Update" class="btn btn-success" onclick="return confirm(\'Do You Wish to Update Train?\');return false;"/>
							</div>
						</form>';
						}
					} else {
						//if no result to show
						echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';
					}
				} else {
					//404	
					header('Location:../404.php');
				}				  
			} else {
				//if empty q
				echo '<h3 class="text-center" style="padding:50px;">Please Enter A Value To Search.</h3>';
			}
		} else if ($p == "delete") {
						if ($q != "") {
				if($r == "TrainCode"){
					$getTrain = "SELECT * FROM train WHERE train_id='".$q."'";
					$resultTrain = mysqli_query($con, $getTrain);
					if(mysqli_num_rows($resultTrain) != 0){
						while($rowTrain = mysqli_fetch_array($resultTrain)){
							$trainName = $rowTrain['train_name'];
							$trainId = $rowTrain['train_id'];
							$trainType = $rowTrain['train_type_type_id'];
							echo '<form role="form" class="form-horizontal" method="post" action="controller/deleteTrainsController.php">
							<div class="form-group">
								<label for="tCode" class="control-label col-md-3">Train Code</label>
								<div class="col-md-8">
									<input class="form-control" type="text" name="tCode" value="'.$trainId.'" id="tCode" readonly/>
								</div>
							</div>
							<div class="form-group">
								<label for="tName" class="control-label col-md-3">Name of the Train</label>
								<div class="col-md-8">
									<input class="form-control" type="text" name="tName" id="tName" value="'.$trainName.'" readonly/>
								</div>
							</div> 
							<div class="form-group">
								<label for="tType" class="control-label col-md-3">Type of the Train</label>
								<div class="col-md-8">
									<input class="form-control" type="text" name="tType" id="tType" value="'.$trainType.'" readonly/>
								</div>
							</div> 
							<div class="form-group" style="text-align:center;">
								<label for="employeeContact" style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
							</div>
							<div class="form-group col-md-11 text-center">
								<input name="submit" id="submit" type="submit" value="Delete" class="btn btn-danger" onclick="return confirm(\'Do You Wish to Delete Train?\');return false;"/>
							</div>
						</form>';
						}
					} else {
						//if no result to show
						echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';
					}
				} else if($r == "TrainName"){
					$getTrain = "SELECT * FROM train WHERE train_name='".$q."'";
					$resultTrain = mysqli_query($con, $getTrain);
					if(mysqli_num_rows($resultTrain) != 0){
						while($rowTrain = mysqli_fetch_array($resultTrain)){
							$trainName = $rowTrain['train_name'];
							$trainId = $rowTrain['train_id'];
							$trainType = $rowTrain['train_type_type_id'];
							echo '<form role="form" class="form-horizontal" method="post" action="controller/deleteTrainsController.php">
							<div class="form-group">
								<label for="tCode" class="control-label col-md-3">Train Code</label>
								<div class="col-md-8">
									<input class="form-control" type="text" name="tCode" value="'.$trainId.'" id="tCode" readonly/>
								</div>
							</div>
							<div class="form-group">
								<label for="tName" class="control-label col-md-3">Name of the Train</label>
								<div class="col-md-8">
									<input class="form-control" type="text" name="tName" id="tName" value="'.$trainName.'" readonly/>
								</div>
							</div> 
							<div class="form-group">
								<label for="tType" class="control-label col-md-3">Type of the Train</label>
								<div class="col-md-8">
									<input class="form-control" type="text" name="tType" id="tType" value="'.$trainType.'" readonly/>
								</div>
							</div> 
							<div class="form-group" style="text-align:center;">
								<label for="employeeContact" style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
							</div>
							<div class="form-group col-md-11 text-center">
								<input name="submit" id="submit" type="submit" value="Delete" class="btn btn-danger" onclick="return confirm(\'Do You Wish to Delete Train?\');return false;"/>
							</div>
						</form>';
						}
					} else {
						//if no result to show
						echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';
					}
				} else {
					//404	
					header('Location:../404.php');
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
} else { 
	// 404 no operation
	header('Location:../404.php');	
}
?>
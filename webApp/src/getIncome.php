<?php
include_once('../ssi/db.php');
//value enter by user
$q = trim(htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST["q"])));
$p = trim(htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST["p"])));
if($p != ""){
	if($q != ""){
		if($p == "topup"){
			$get = "SELECT * FROM topup_agent_payment WHERE topup_agent_payment_status='0' AND employee_nic='".$q."'";
			$result = mysqli_query($con, $get);
			if(mysqli_num_rows($result)){
				while($row = mysqli_fetch_array($result)){
					$fee = $row['topup_agent_payment_fee'];
					$date = $row['topup_agent_payment_date'];
					$id = $row['topup_agent_payment_id'];
					$getAgent = "SELECT * FROM NAME WHERE name_id IN (SELECT name_id FROM employee WHERE nic='".$q."')";
					$resultAgent = mysqli_query($con, $getAgent);
					if(mysqli_num_rows($resultAgent)){
						while($rowAgent = mysqli_fetch_array($resultAgent)){
							$fName = $rowAgent['first_name'];
							$mName = $rowAgent['second_name'];
							$lName = $rowAgent['last_name'];
							$fullName = $fName." ".$mName." ".$lName;
							echo '<form style="padding-top:50px;" role="form" class="form-horizontal" method="post" action="controller/receivedTopUpIncome.php">
									<div class="form-group">
										<label for="name" class="control-label col-md-3">Full Name : </label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="name" id="name" value="'.$fullName.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="id" class="control-label col-md-3">Id : </label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="id" id="id" value="'.$id.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="fee" class="control-label col-md-3">Payment : </label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="fee" id="fee" value="'.$fee.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="date" class="control-label col-md-3">Date : </label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="date" id="date" value="'.$date.'" readonly/>
										</div>
									</div>
									<div class="form-group col-md-11 text-center">
										<input type="submit" name="submit" id="submit" value="Received" class="btn btn-success" onclick="return confirm(\'Do You Wish to Update Payment As Received?\');return false;"/>
									</div>
								</form>';
						}
					} else {
						//no data	
						echo '<h3 class="text-center" style="padding-top:90px;">No Data To Show</h3>';
					}
				}
			} else {
				//no data	
				echo '<h3 class="text-center" style="padding-top:90px;">No Payments To Show</h3>';
			}
		} else if ($p == "registrar"){
			$get = "SELECT * FROM registrar_final_payment WHERE payment_status='0' AND employee_nic='".$q."'";
			$result = mysqli_query($con, $get);
			if(mysqli_num_rows($result)){
				while($row = mysqli_fetch_array($result)){
					$fee = $row['payment_fee'];
					$date = $row['payment_date'];
					$id = $row['payment_id'];
					$getAgent = "SELECT * FROM NAME WHERE name_id IN (SELECT name_id FROM employee WHERE nic='".$q."')";
					$resultAgent = mysqli_query($con, $getAgent);
					if(mysqli_num_rows($resultAgent)){
						while($rowAgent = mysqli_fetch_array($resultAgent)){
							$fName = $rowAgent['first_name'];
							$mName = $rowAgent['second_name'];
							$lName = $rowAgent['last_name'];
							$fullName = $fName." ".$mName." ".$lName;
							echo '<form style="padding-top:50px;" role="form" class="form-horizontal" method="post" action="controller/receivedRegistrarIncome.php">
									<div class="form-group">
										<label for="name" class="control-label col-md-3">Full Name : </label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="name" id="name" value="'.$fullName.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="id" class="control-label col-md-3">Id : </label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="id" id="id" value="'.$id.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="fee" class="control-label col-md-3">Payment : </label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="fee" id="fee" value="'.$fee.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="date" class="control-label col-md-3">Date : </label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="date" id="date" value="'.$date.'" readonly/>
										</div>
									</div>
									<div class="form-group col-md-11 text-center">
										<input type="submit" name="submit" id="submit" value="Received" class="btn btn-success" onclick="return confirm(\'Do You Wish to Update Payment As Received?\');return false;"/>
									</div>
								</form>';
						}
					} else {
						//no data	
						echo '<h3 class="text-center" style="padding-top:90px;">No Data To Show</h3>';
					}
				}
			} else {
				//no data	
				echo '<h3 class="text-center" style="padding-top:90px;">No Payments To Show</h3>';
			}
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
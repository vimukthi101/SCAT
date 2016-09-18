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
$hint = "";
if($p != ""){
	if($p == "view"){
		if ($q != "") {
			if($q == "all"){
				$getType = "SELECT * FROM train_type";
			} else {
				$getType = "SELECT * FROM train_type WHERE type_id LIKE '".$q."%'";	
			}
			$resultGetType = mysqli_query($con, $getType);
			if(mysqli_num_rows($resultGetType) != 0){
				echo '<div class="form-group">
							<div class="container-fluid center-block">
								<table style="width:100%;" class="table table-striped">
								  <tr>
									<th>Train Type ID</th>
									<th>Train Type Name</th>
								  </tr>';
				while($rowTypes = mysqli_fetch_array($resultGetType)){
					$Id = $rowTypes['type_id'];
					$Name = $rowTypes['type_name'];			
						echo '<tr>
						<td>'.$Id.'</td>
						<td>'.$Name.'</td>
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
			$getCard = "SELECT * FROM train_type WHERE type_id='".$q."'";
			$resultGetCard = mysqli_query($con, $getCard);
			if(mysqli_num_rows($resultGetCard) != 0){
				while($rowGetCard = mysqli_fetch_array($resultGetCard)){
					$TypeName = $rowGetCard['type_name'];
				}
				echo '<form role="form" class="form-horizontal" method="post" action="controller/updateTrainTypesController.php">
						<div class="form-group">
							<label class="control-label col-md-3">Train Type ID <span style="color:rgb(255,0,0);">*</span></label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="tId" id="tId" value="'.$q.'" readonly/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Train Type Name <span style="color:rgb(255,0,0);">*</span></label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="tName" id="tName" value="'.$TypeName.'"/>
							</div>
						</div>
						<div class="form-group" style="text-align:center;">
							<label for="employeeContact" style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
						</div>
						<div class="form-group col-md-11 text-center">
							<input type="submit" id="submit" name="submit" value="Update" class="btn btn-success"  onclick="return confirm(\'Do You Wish to Update Train Types?\');return false;"/>
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
	} else if ($p == "delete") {
		if($q != ""){
			$getCard = "SELECT * FROM train_type WHERE type_id='".$q."'";
			$resultGetCard = mysqli_query($con, $getCard);
			if(mysqli_num_rows($resultGetCard) != 0){
				while($rowGetCard = mysqli_fetch_array($resultGetCard)){
					$TypeName = $rowGetCard['type_name'];
				}
				echo '<form role="form" class="form-horizontal" method="post" action="controller/deleteTrainTypesController.php">
						<div class="form-group">
							<label class="control-label col-md-3">Train Type ID</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="tId" id="tId" value="'.$q.'" readonly/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Train Type Name</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="tName" id="tName" value="'.$TypeName.'" readonly/>
							</div>
						</div>
						<div class="form-group col-md-11 text-center">
							<input type="submit" id="submit" name="submit" value="Delete" class="btn btn-danger"  onclick="return confirm(\'Do You Wish to Delete Train Type?\');return false;"/>
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
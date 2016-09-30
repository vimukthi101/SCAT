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
$r = trim(htmlspecialchars(mysqli_real_escape_string($con,$_REQUEST["r"])));
if($p != "" && $r != ""){
	if($p == "transfer"){
		if($q != ""){
			if($r == "Card"){
				if(preg_match('/^\d{16}$/',$q)){
					$getCommuter = "SELECT * FROM commuter WHERE card_card_no='".$q."'";
					$resultCommuter = mysqli_query($con, $getCommuter);
					if(mysqli_num_rows($resultCommuter) != 0){
						while($rowCommuter = mysqli_fetch_array($resultCommuter)){
							$cardNo = $rowCommuter['card_card_no'];
							$nic = $rowCommuter['nic'];
							$nameId = $rowCommuter['name_name_id'];
							$contactNo = $rowCommuter['contact_no'];
						}
						$getName = "SELECT * FROM NAME WHERE name_id='".$nameId."'";
						$resultName = mysqli_query($con, $getName);
						if(mysqli_num_rows($resultName) != 0){
							while($rowName = mysqli_fetch_array($resultName)){
								$fName = $rowName['first_name'];
								$sName = $rowName['second_name'];
								$lName = $rowName['last_name'];
							}
							echo '<div class="form-horizontal">
									<div class="form-group">
										<label for="CardNumber" class="control-label col-md-3">Card Number</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="CardNumber2" value="'.$cardNo.'" id="CardNumber2" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="employeelNIC" class="control-label col-md-3">NIC</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="nic2" id="nic2" value="'.$nic.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="fName" class="control-label col-md-3">Full Name</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="name2" id="name2" value="'.$fName.' '.$sName.' '.$lName.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="contact" class="control-label col-md-3">Contact Number</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="contact2" id="contact2" value="'.$contactNo.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="amount" class="control-label col-md-3">Amount <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="amount" id="amount" pattern="^\d+\.\d{2}$" title="Should Be The Format Of 100.00" required/>
										</div>
									</div>
									<div class="form-group" style="text-align:center;">
										<label for="employeeContact" style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
									</div>
									<div class="form-group col-md-11 text-center">
										<input type="submit" value="Transfer" name="submit" id="submit" class="btn btn-success" onclick="return confirm(\'Do You Wish to Transfer Credit?\');return false;"/>
									</div>
								</div>';
						} else {
							//if no result to show
							echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
						}
					} else {
						//if no result to show
						echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
					}
				} else {
					echo '<h3 class="text-center" style="padding:50px;">Wrong Card Number Format.</h3>';
				}
			} else if($r == "commuter"){
				if(preg_match('/^(\d){9}[v|V]$/',$q)){
					$getCommuter = "SELECT * FROM commuter WHERE nic='".$q."'";
					$resultCommuter = mysqli_query($con, $getCommuter);
					if(mysqli_num_rows($resultCommuter) != 0){
						while($rowCommuter = mysqli_fetch_array($resultCommuter)){
							$cardNo = $rowCommuter['card_card_no'];
							$nic = $rowCommuter['nic'];
							$nameId = $rowCommuter['name_name_id'];
							$contactNo = $rowCommuter['contact_no'];
						}
						$getName = "SELECT * FROM NAME WHERE name_id='".$nameId."'";
						$resultName = mysqli_query($con, $getName);
						if(mysqli_num_rows($resultName) != 0){
							while($rowName = mysqli_fetch_array($resultName)){
								$fName = $rowName['first_name'];
								$sName = $rowName['second_name'];
								$lName = $rowName['last_name'];
							}
							echo '<div class="form-horizontal">
									<div class="form-group">
										<label for="CardNumber" class="control-label col-md-3">Card Number</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="CardNumber2" value="'.$cardNo.'" id="CardNumber2" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="employeelNIC" class="control-label col-md-3">NIC</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="nic2" id="nic2" value="'.$nic.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="fName" class="control-label col-md-3">Full Name</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="name2" id="name2" value="'.$fName.' '.$sName.' '.$lName.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="contact" class="control-label col-md-3">Contact Number</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="contact2" id="contact2" value="'.$contactNo.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="amount" class="control-label col-md-3">Amount <span style="color:rgb(255,0,0);">*</span></label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="amount" id="amount" required pattern="^\d+\.\d{2}$" title="Should Be The Format Of 100.00"/>
										</div>
									</div>
									<div class="form-group" style="text-align:center;">
										<label for="employeeContact" style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
									</div>
									<div class="form-group col-md-11 text-center">
										<input type="submit" value="Transfer" name="submit" id="submit" class="btn btn-success" onclick="return confirm(\'Do You Wish to Transfer Credit?\');return false;"/>
									</div>
								</div>';
						} else {
							//if no result to show
							echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
						}
					} else {
						//if no result to show
						echo '<h3 class="text-center" style="padding:50px;">No Records To Display.</h3>';	
					}
				} else {
					echo '<h3 class="text-center" style="padding:50px;">Wrong NIC Format.</h3>';
				}
			} else {
				//wrong html id
				echo '<h3 class="text-center" style="padding:50px;">There Was An Error. Please Try Again Later.</h3>';
			}
		} else {
			//no value entered for search
			echo '<h3 class="text-center" style="padding:50px;">Please Enter A Value To Search.</h3>';
		}
	} else {
		//404, wrong operation
		echo '<h3 class="text-center" style="padding:50px;">There Was An Error. Please Try Again Later.</h3>';
	}
} else {
	//404, no operation or no id
	echo '<h3 class="text-center" style="padding:50px;">There Was An Error. Please Try Again Later.</h3>';
}
?>
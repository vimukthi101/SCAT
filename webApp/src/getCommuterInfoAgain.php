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
	if($p == "balance"){
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
							$balance = $rowCommuter['credit'];
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
											<input class="form-control" type="text" name="CardNumber" value="'.$cardNo.'" id="CardNumber" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="employeelNIC" class="control-label col-md-3">NIC</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="nic" id="nic" value="'.$nic.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="fName" class="control-label col-md-3">Full Name</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="name" id="name" value="'.$fName.' '.$sName.' '.$lName.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="contact" class="control-label col-md-3">Contact Number</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="contact" id="contact" value="'.$contactNo.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="amount" class="control-label col-md-3">Amount</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="amount" id="amount" value="'.$balance.'" readonly/>
										</div>
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
			} else if($r == "enic"){
				if(preg_match('/^(\d){9}[v|V]$/',$q)){
					$getCommuter = "SELECT * FROM commuter WHERE nic='".$q."'";
					$resultCommuter = mysqli_query($con, $getCommuter);
					if(mysqli_num_rows($resultCommuter) != 0){
						while($rowCommuter = mysqli_fetch_array($resultCommuter)){
							$cardNo = $rowCommuter['card_card_no'];
							$nic = $rowCommuter['nic'];
							$nameId = $rowCommuter['name_name_id'];
							$contactNo = $rowCommuter['contact_no'];
							$balance = $rowCommuter['credit'];
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
											<input class="form-control" type="text" name="CardNumber" value="'.$cardNo.'" id="CardNumber" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="employeelNIC" class="control-label col-md-3">NIC</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="nic" id="nic" value="'.$nic.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="fName" class="control-label col-md-3">Full Name</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="name" id="name" value="'.$fName.' '.$sName.' '.$lName.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="contact" class="control-label col-md-3">Contact Number</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="contact" id="contact" value="'.$contactNo.'" readonly/>
										</div>
									</div>
									<div class="form-group">
										<label for="amount" class="control-label col-md-3">Amount</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="amount" id="amount"  value="'.$balance.'" readonly/>
										</div>
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
				header('Location:../404.php');
			}
		} else {
			//no value entered for search
			echo '<h3 class="text-center" style="padding:50px;">Please Enter A Value To Search.</h3>';
		}
	} else {
		//404, wrong operation
		header('Location:../404.php');	
	}
} else {
	//404, no operation or no id
	header('Location:../404.php');	
}
?>
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
	if($p == "view"){
		if ($q != "") {
			$hint .= '<div class="form-group">
							<div class="container-fluid">
								<table style="width:100%;" class="table table-striped">
								  <tr>
									<th>Card Number</th>
									<th>NIC</th> 
									<th>First Name</th>
									<th>Middle Name</th>
									<th>Last Name</th>
									<th>Address</th>
									<th>Contact No</th>
									<th>Settings</th>
								  </tr>
								  <tr>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
									<td>ad</td>
									<td>asd</td>
									<td>ada</td>
									<td>add</td>
									<td><a href="#"><i class="fa fa-2x fa-cog" style="padding-left:5px;" aria-hidden="true"></i></a></td>
								  </tr>
								  <tr>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
									<td>ad</td>
									<td>asd</td>
									<td>ada</td>
									<td>add</td>
									<td>add</td>
								  </tr>
								  <tr>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
									<td>add</td>
									<td>ad</td>
									<td>asd</td>
									<td>ada</td>
									<td>add</td>
								  </tr>
								</table>
							</div>
						</div>';
		} else {
			//no value entered for search
			echo '<h3 class="text-center" style="padding:50px;">Please Enter A Value To Search.</h3>';
		}
	} else if($p == "update"){
		if($q != ""){
			$hint .= '<form role="form" class="form-horizontal">
				<div class="form-group text-center">
                    <label class="col-md-11">S.C.A.T. Card Information</label> 
                </div>
            	<div class="form-group">
                    <label for="CardNumber" class="control-label col-md-3">Card Number</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="CardNumber" id="CardNumber" />
                	</div>
                </div>
                <div class="form-group text-center">
                    <label class="col-md-11">Personal Information</label> 
                </div>
                <div class="form-group">
                    <label for="employeelNIC" class="control-label col-md-3">NIC</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="nic" id="nic" />
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeefName" class="control-label col-md-3">First Name</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="fname" id="fname" />
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeemName" class="control-label col-md-3">Middle Name</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="mname" id="mname" />
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeelName" class="control-label col-md-3">Last Name</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="lname" id="lname" />
                	</div>
                </div>
                <div class="form-group">
                    <label for="addressNo" class="control-label col-md-3">Address Number</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="addresNo" id="addressNo" />
                	</div>
                </div>
                <div class="form-group">
                    <label for="addressLane" class="control-label col-md-3">Lane/ Street</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="lane" id="lane" />
                	</div>
                </div>
                <div class="form-group">
                    <label for="addressCity" class="control-label col-md-3">City</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="city" id="city" />
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeeContact" class="control-label col-md-3">Contact Number</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="contact" id="contact" />
                	</div>
                </div>
                <div class="form-group col-md-11 text-center">
                    <input type="submit" value="Update" class="btn btn-success" />
                    <input type="reset" value="Clear" class="btn btn-danger" />
                </div>
            </form>';
		}  else {
			//no value entered for search
			echo '<h3 class="text-center" style="padding:50px;">Please Enter A Value To Search.</h3>';
		}
	} else if($p == "topup"){
		if($q != ""){
			if($r == "CardNo"){
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
							echo '<form role="form" class="form-horizontal" method="post" action="controller/topupController.php">
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
											<input class="form-control" type="text" name="amount" id="amount" required pattern="^\d+\.\d{2}$" title="Should Be The Format Of 100.00"/>
										</div>
									</div>
									<div class="form-group col-md-11 text-center">
										<input type="submit" value="Top-Up" name="submit" id="submit" class="btn btn-success" onclick="return confirm(\'Do You Wish to Top-Up Card?\');return false;"/>
									</div>
								</form>';
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
			} else if($r == "nic"){
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
							echo '<form role="form" class="form-horizontal" method="post" action="controller/topupController.php">
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
											<input class="form-control" type="text" name="amount" id="amount" required pattern="^\d+\.\d{2}$" title="Should Be The Format Of 100.00"/>
										</div>
									</div>
									<div class="form-group col-md-11 text-center">
										<input type="submit" value="Top-Up" name="submit" id="submit" class="btn btn-success" onclick="return confirm(\'Do You Wish to Top-Up Card?\');return false;"/>
									</div>
								</form>';
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
	} else if($p == "transfer"){
		if($r == "CardNo"){
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
										<label for="CardNumber" class="control-label col-md-5 text-center"><u>To</u></label>
									</div>
									<div class="form-group">
										<label for="employeeId" class="control-label col-md-3">Search By : </label>
										<div class="col-md-8">
											<select onchange="another(this);" name="searchBy" id="searchBy" class="form-control">
											  <option selected="selected" disabled="disabled">--Select the search criteria--</option>
											  <option value="cNo">Card Number</option>
											  <option value="nic">NIC</option>      
											</select>
										</div>
									</div>
									<hr/>
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
			} else if($r == "nic"){
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
										<label for="CardNumber" class="control-label col-md-5 text-center"><u>From</u></label>
									</div>
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
										<label for="CardNumber" class="control-label col-md-5 text-center"><u>To</u></label>
									</div>
									<div class="form-group">
										<label for="employeeId" class="control-label col-md-3">Search By : </label>
										<div class="col-md-8">
											<select onchange="another(this);" name="searchBy" id="searchBy" class="form-control">
											  <option selected="selected" disabled="disabled">--Select the search criteria--</option>
											  <option value="cNo">Card Number</option>
											  <option value="nic">NIC</option>      
											</select>
										</div>
									</div>
									<hr/>
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
	} else if($p == "balance"){
		if($q != ""){
			if($r == "CardNo"){
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
			} else if($r == "nic"){
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
	} else if($p == "activate"){
		if($q != ""){
			
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
<?php
include_once('../ssi/links.html');
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
$q = $_REQUEST["q"];
$p = $_REQUEST["p"];
$hint = "";

if($p != ""){
	if($p == "view"){
		if ($q != "") {
			$hint .= '<div class="form-group">
							<div class="container-fluid">
								<table style="width:100%;" class="table table-striped">
								  <tr>
									<th>Employee ID</th>
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
									<td><a href="#"><i class="fa fa-2x fa-trash-o" style="padding-right:10px;" aria-hidden="true"></i></a><a href="#"><i class="fa fa-2x fa-cog" style="padding-left:5px;" aria-hidden="true"></i></a></td>
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
		}
	} else if($p == "update"){
		if($q != ""){
			$hint .= '<form role="form" class="form-horizontal">
            	<div class="form-group">
                    <label for="employeeId" class="control-label col-md-3">Employee ID</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="eId" id="eId" />
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeePosition" class="control-label col-md-3">Position</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="position" id="position" value="" readonly="readonly"/>
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
		}
	} else {
		if($q != ""){
			$hint .= '<form role="form" class="form-horizontal">
            	<div class="form-group">
                    <label for="employeeId" class="control-label col-md-3">Employee ID</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="eId" id="eId" />
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeePosition" class="control-label col-md-3">Position</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="position" id="position" value="" readonly="readonly"/>
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
                    <input type="submit" value="Delete" class="btn btn-success" />
                    <input type="reset" value="Clear" class="btn btn-danger" />
                </div>
            </form>';
		}
	}
}


echo $hint === "" ? "no suggestion" : $hint;
?>
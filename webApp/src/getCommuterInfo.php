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
		}
	} else if($p == "topup"){
		if($q != ""){
			$hint .= '<form role="form" class="form-horizontal">
            	<div class="form-group">
                    <label for="CardNumber" class="control-label col-md-3">Card Number</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="CardNumber" id="CardNumber" readonly/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeelNIC" class="control-label col-md-3">NIC</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="nic" id="nic" readonly/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="fName" class="control-label col-md-3">Full Name</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="fname" id="fname" readonly/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="contact" class="control-label col-md-3">Contact Number</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="contact" id="contact" readonly/>
                	</div>
                </div>
				<div class="form-group">
                    <label for="amount" class="control-label col-md-3">Amount</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="amount" id="amount"/>
                	</div>
                </div>
                <div class="form-group col-md-11 text-center">
                    <input type="submit" value="Top-Up" class="btn btn-success" />
                    <input type="reset" value="Clear" class="btn btn-danger" />
                </div>
            </form>';
		}
	} else if($p == "transfer"){
		if($q != ""){
			$hint .= '<form role="form" class="form-horizontal">
            	<div class="form-group">
                    <label for="CardNumber" class="control-label col-md-3">Card Number</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="CardNumber" id="CardNumber" readonly/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeelNIC" class="control-label col-md-3">NIC</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="nic" id="nic" readonly/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="fName" class="control-label col-md-3">Full Name</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="fname" id="fname" readonly/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="contact" class="control-label col-md-3">Contact Number</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="contact" id="contact" readonly/>
                	</div>
                </div>
				<div class="text-center" style="padding:10px;">
					<font face="Verdana, Geneva, sans-serif" size="+1">
						<u>Card to Transfer</u>
					</font>
				</div>
				<hr/>
				<div style="padding:10px;"> 
            <form role="form" class="form-horizontal">
            	<div class="form-group">
                    <label for="employeeId" class="control-label col-md-3">Search By : </label>
                    <div class="col-md-8">
                    	<select onchange="loadAgain(this);" name="searchBy" id="searchBy" class="form-control">
                          <option selected="selected" disabled="disabled">--Select the search criteria--</option>
                          <option value="cNo">Card Number</option>
                          <option value="nic">NIC</option>      
                        </select>
                	</div>
                </div>
                <hr/>
            </form>'
			?>
            <script type="text/javascript">
				 function loadAgain(selectObj) { 
					 var idx = selectObj.selectedIndex; 
					 var which = selectObj.options[idx].value; 
					 if(which=='cNo'){
						 document.getElementById('Again').innerHTML = '<div class="form-group"><label for="CardNo" class="control-label col-md-3">Card Number</label><div class="col-md-8"><input class="form-control" type="text" name="CardNo" id="CardNo" /></div><div><input type="button" value="Search" class="btn btn-success" onClick="showHintAgain(this.value);"/></div></div><hr/>'; 
					 } else if(which=='nic'){
						 document.getElementById('Again').innerHTML = '<div class="form-group"><label for="employeelNIC" class="control-label col-md-3">NIC</label><div class="col-md-8"><input class="form-control" type="text" name="nic" id="nic" /></div><div><input type="button" value="Search" class="btn btn-success" onClick="showHintAgain(this.value);"/></div></div><hr/>';
					 } else {
						 document.getElementById('Again').innerHTML = '';
					 }
				 } 
			</script>
            <script>
			function showHintAgain(str) {
				if (str.length == 0) { 
					document.getElementById("txtHintAnother").innerHTML = "";
					return;
				} else {
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							document.getElementById("txtHintAnother").innerHTML = xmlhttp.responseText;
						}
					};
					xmlhttp.open("GET", "getCommuterInfoAgain.php?p=transfer&q=" + str, true);
					xmlhttp.send();
				}
			}
			</script>
            <?php
            '<form role="form" class="form-horizontal">
            	
                <div id="Again"></div>
            	<div style="padding-left:70px;" id="txtHintAnother"></div>
            </form></div>';
		}
	} else if($p == "balance"){
		if($q != ""){
			$hint .= '<form role="form" class="form-horizontal">
            	<div class="form-group">
                    <label for="CardNumber" class="control-label col-md-3">Card Number</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="CardNumber" id="CardNumber" readonly/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeelNIC" class="control-label col-md-3">NIC</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="nic" id="nic" readonly/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="fName" class="control-label col-md-3">Full Name</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="fname" id="fname" readonly/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="contact" class="control-label col-md-3">Contact Number</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="contact" id="contact" readonly/>
                	</div>
                </div>
                <div class="form-group col-md-11 text-center">
                    <input type="submit" value="Balance" class="btn btn-success" />
                    <input type="reset" value="Clear" class="btn btn-danger" />
                </div>
            </form>';
		}
	} else if($p == "activate"){
		if($q != ""){
			$hint .= '<form role="form" class="form-horizontal">
            	<div class="form-group">
                    <label for="CardNumber" class="control-label col-md-3">Card Number</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="CardNumber" id="CardNumber" readonly/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeelNIC" class="control-label col-md-3">NIC</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="nic" id="nic" readonly/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="fName" class="control-label col-md-3">Full Name</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="fname" id="fname" readonly/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="contact" class="control-label col-md-3">Contact Number</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="contact" id="contact" readonly/>
                	</div>
                </div>
                <div class="form-group col-md-11 text-center">
				<input type="submit" value="Activate" class="btn btn-warning" />
                <input type="reset" value="Clear" class="btn btn-danger" /> 
               		 </div>
            </form>';
		}
	} 
}


echo $hint === "" ? "no suggestion" : $hint;
?>
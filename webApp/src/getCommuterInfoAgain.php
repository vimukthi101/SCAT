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
	if($p == "transfer"){
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
	}
}


echo $hint === "" ? "no suggestion" : $hint;
?>
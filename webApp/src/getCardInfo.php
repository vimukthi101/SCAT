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
							<div class="container-fluid center-block">
								<table style="width:80%;" class="table table-striped">
								  <tr>
									<th>Card No</th>
									<th>Pin</th>
									<th>Settings</th>
								  </tr>
								  <tr>
									<td>asd</td>
									<td>asd</td>
									<td><a href="#"><i class="fa fa-2x fa-trash-o" style="padding-right:10px;" aria-hidden="true"></i></a><a href="#"><i class="fa fa-2x fa-cog" style="padding-left:5px;" aria-hidden="true"></i></a></td>
								  </tr>
								  <tr>
									<td>asd</td>
									<td>asd</td>
									<td><a href="#"><i class="fa fa-2x fa-trash-o" style="padding-right:10px;" aria-hidden="true"></i></a><a href="#"><i class="fa fa-2x fa-cog" style="padding-left:5px;" aria-hidden="true"></i></a></td>
								  </tr>
								  <tr>
									<td>asd</td>
									<td>asd</td>
									<td><a href="#"><i class="fa fa-2x fa-trash-o" style="padding-right:10px;" aria-hidden="true"></i></a><a href="#"><i class="fa fa-2x fa-cog" style="padding-left:5px;" aria-hidden="true"></i></a></td>
								  </tr>
								</table>
							</div>
						</div>';
		}
	} else if($p == "update"){
		if($q != ""){
			$hint .= '<form role="form" class="form-horizontal">
            	<div class="form-group">
                    <label for="cNo" class="control-label col-md-3">Card No</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="cNo" id="cNo" />
                	</div>
                </div>
                <div class="form-group">
                    <label for="pin" class="control-label col-md-3">Pin</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="pin" id="pin" value=""/>
                	</div>
                </div>
				<div class="form-group">
                    <label for="cPin" class="control-label col-md-3">Confirm Pin</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="cPin" id="cPin" value=""/>
                	</div>
                </div>
                <div class="form-group col-md-11 text-center">
                    <input type="submit" value="Update" class="btn btn-success" />
                    <input type="reset" value="Clear" class="btn btn-danger" />
                </div>
            </form>';
		}
	} else if ($p == "delete") {
		if($q != ""){
			$hint .= '<form role="form" class="form-horizontal">
            	<div class="form-group">
                    <label for="cNo" class="control-label col-md-3">Card No</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="cNo" id="cNo" />
                	</div>
                </div>
                <div class="form-group">
                    <label for="pin" class="control-label col-md-3">Pin</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="pin" id="pin" value=""/>
                	</div>
                </div>
                <div class="form-group col-md-11 text-center">
                    <input type="submit" value="Delete" class="btn btn-success" />
                    <input type="reset" value="Clear" class="btn btn-danger" />
                </div>
            </form>';
		}
	} else {
		if($q != ""){
			$hint .= '<div class="form-group">
							<div class="container-fluid center-block">
								<table style="width:100%;" class="table table-striped">
								  <tr>
									<th>Request ID</th>
									<th>Station Name</th>
									<th>Station Master</th>
									<th>Number of Cards Requested</th>
									<th>Number of Cards Send</th>
									<th>Status</th>
								  </tr>
								  <tr>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
								  </tr>
								  <tr>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
								  </tr>
								  <tr>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
								  </tr>
								</table>
							</div>
						</div>';
		}
	}
}


echo $hint === "" ? "no suggestion" : $hint;
?>
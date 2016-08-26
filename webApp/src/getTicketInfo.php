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
			if($q == "all"){
				$hint .= '<div class="form-group">
							<div class="container-fluid center-block">
								<table style="width:80%;" class="table table-striped">
								  <tr>
									<th>In Station</th>
									<th>Out Station</th>
									<th>Ticket Fee</th>
									<th>Settings</th>
								  </tr>
								  <tr>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
									<td><a href="#"><i class="fa fa-2x fa-trash-o" style="padding-right:10px;" aria-hidden="true"></i></a><a href="#"><i class="fa fa-2x fa-cog" style="padding-left:5px;" aria-hidden="true"></i></a></td>
								  </tr>
								  <tr>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
									<td><a href="#"><i class="fa fa-2x fa-trash-o" style="padding-right:10px;" aria-hidden="true"></i></a><a href="#"><i class="fa fa-2x fa-cog" style="padding-left:5px;" aria-hidden="true"></i></a></td>
								  </tr>
								  <tr>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
									<td><a href="#"><i class="fa fa-2x fa-trash-o" style="padding-right:10px;" aria-hidden="true"></i></a><a href="#"><i class="fa fa-2x fa-cog" style="padding-left:5px;" aria-hidden="true"></i></a></td>
								  </tr>
								</table>
							</div>
						</div>';
			} else {
				$hint .= '<div class="form-group">
							<div class="container-fluid center-block">
								<table style="width:80%;" class="table table-striped">
								  <tr>
									<th>In Station</th>
									<th>Out Station</th>
									<th>Ticket Fee</th>
									<th>Settings</th>
								  </tr>
								  <tr>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
									<td><a href="#"><i class="fa fa-2x fa-trash-o" style="padding-right:10px;" aria-hidden="true"></i></a><a href="#"><i class="fa fa-2x fa-cog" style="padding-left:5px;" aria-hidden="true"></i></a></td>
								  </tr>
								  <tr>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
									<td><a href="#"><i class="fa fa-2x fa-trash-o" style="padding-right:10px;" aria-hidden="true"></i></a><a href="#"><i class="fa fa-2x fa-cog" style="padding-left:5px;" aria-hidden="true"></i></a></td>
								  </tr>
								  <tr>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
									<td><a href="#"><i class="fa fa-2x fa-trash-o" style="padding-right:10px;" aria-hidden="true"></i></a><a href="#"><i class="fa fa-2x fa-cog" style="padding-left:5px;" aria-hidden="true"></i></a></td>
								  </tr>
								</table>
							</div>
						</div>';
			}
		}
	} else if($p == "update"){
		if($q != ""){
			$hint .= '<form role="form" class="form-horizontal">
            	<div class="form-group">
                    <label for="nFee" class="control-label col-md-3">New Ticket Fee</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="nFee" id="nFee" />
                	</div>
                </div> 
                <div class="form-group col-md-11 text-center">
                    <input type="submit" value="Update" class="btn btn-success" />
                    <input type="reset" value="Clear" class="btn btn-danger" />
                </div>
            </form>';
		}
	}
}


echo $hint === "" ? "no suggestion" : $hint;
?>
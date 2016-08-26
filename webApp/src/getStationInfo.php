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
									<th>Station Code</th>
									<th>Station Name</th>
									<th>Station Master\'s Name</th>
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
	} else if($p == "update"){
		if($q != ""){
			$hint .= '<form role="form" class="form-horizontal">
            	<div class="form-group">
                    <label for="sCode" class="control-label col-md-3">Station Code</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="sCode" id="sCode" />
                	</div>
                </div>
                <div class="form-group">
                    <label for="sName" class="control-label col-md-3">Name of the Station</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="sName" id="sName" value=""/>
                	</div>
                </div>
				<div class="form-group">
                    <label for="smName" class="control-label col-md-3">Station Master\'s Name</label>
                    <div class="col-md-8">
                    	<select name="smName" id="smName" class="form-control">
                          <option selected="selected" disabled="disabled">--Select the Station Master--</option>
                          <option value="kusal">kusal</option>
                          <option value="sanga">sanga</option>
                        </select>
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
                    <label for="sCode" class="control-label col-md-3">Station Code</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="sCode" id="sCode" />
                	</div>
                </div>
                <div class="form-group">
                    <label for="sName" class="control-label col-md-3">Name of the Station</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="sName" id="sName" value=""/>
                	</div>
                </div>
				<div class="form-group">
                    <label for="smName" class="control-label col-md-3">Station Master\'s Name</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="smName" id="smName" value=""/>
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
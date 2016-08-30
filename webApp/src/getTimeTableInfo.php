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
							<h3>Main Line</h3>
								<table style="width:90%;" class="table table-striped">
								  <tr>
									<th>Train Number</th>
									<th>Train Name</th>
									<th>Time</th>
									<th>Type</th>
								  </tr>
								  <tr>
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
								  </tr>
								  <tr>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
								  </tr>
								</table>
							<h3>KVN Line</h3>
								<table style="width:90%;" class="table table-striped">
								  <tr>
									<th>Train Number</th>
									<th>Train Name</th>
									<th>Time</th>
									<th>Type</th>
								  </tr>
								  <tr>
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
								  </tr>
								  <tr>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
									<td>asd</td>
								  </tr>
								</table>
							</div>
						</div>';
		}
	} else if($p == "update"){
		if($q != ""){
			$hint .= '<div class="form-group">
                    <label for="day" class="control-label col-md-3">Fill Following Information</label>
                </div>
                <div class="form-group">
                    <div class="col-md-12" style="padding-left:150px;">
                    	<table style="width:100%;" class="table table-striped" id="table">
                          <tr>
                            <th>Train Number</th>
                            <th>Train Name</th>
                            <th>Time</th>
                            <th>Type</th>
                            <th>Setthings</th>
                          </tr>
                          <tr>
                            <td>
                            	<select name="tNo" id="tNo" class="form-control">
                                  <option selected="selected" disabled="disabled">--Select the Train Number--</option>
                                  <option value="109">109</option>
                                  <option value="125">125</option>
                                  <option value="1055">1055</option>
                                  <option value="4077">4077</option>
                                </select>
                            </td>
                            <td>
                            	<input type="text" class="form-control" name="tName" id="tName" value="" readonly="readonly" />
                            </td>
                            <td>
                            	<input type="time" class="form-control" id="time" name="time" />
                            </td>
                            <td>
                            	<select name="type" id="type" class="form-control">
                                  <option selected="selected" disabled="disabled">--Select the Train Type--</option>
                                  <option value="exp">Express</option>
                                  <option value="ice">Intercity</option>
                                  <option value="slow">Slow</option>
                                  <option value="sem">Semi</option>
                                </select>
                            </td>
                            <td>
                            	<a href="#" onclick="addRow();">
                                	<i class="fa fa-2x fa-plus" style="padding-right:10px;" aria-hidden="true"></i>
                                </a>
                            </td> 
                          </tr>
                        </table>
                	</div>
                </div>
                <div class="form-group col-md-11 text-center">
                    <input type="submit" value="Update" class="btn btn-success" />
                    <input type="reset" value="Clear" class="btn btn-danger"/>
                </div>';
		}
	}
}

echo $hint === "" ? "no suggestion" : $hint;
?>
<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position'])){
	if($_SESSION['position'] == "sysadmin"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('../ssi/links.html');
?>
<title>Stations Management</title>
</head>

<body style="background-image:url(../images/4.jpg);background-repeat:no-repeat;background-size:cover;">
<div>
	<?php
        include_once('../ssi/Header.php');
    ?>
</div>
<div class="container-fluid text-capitalize" style="padding:0px;margin:0px;">
	<div>
		<?php
            include_once('../ssi/adminLeftPanelStations.php');
        ?>
    </div>
    <div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1">
            	<u>Update Stations</u>
            </font>
        </div>
        <div style="padding:10px;"> 
        	<?php
			if(isset($_GET['error'])){
				if(!empty($_GET['error'])){
					$error = $_GET['error'];
					if($error == "ef"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Required Fields Cannot Be Empty.</label>
							</div>';
					} else if($error == "wc"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Station Code Should Be Letters Only.</label>
							</div>';
					} else if($error == "wn"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Station Name Should Be Letters Only.</label>
							</div>';
					} else if($error == "ws"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Invalid Station Master.</label>
							</div>';
					} else if($error == "aes"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Station Name Already Exists.</label>
							</div>';
					} else if($error == "ae"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Station Master Has Already Being Assigned To Another Station.</label>
							</div>';
					} else if($error == "aea"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Station Name Already Exists Or Station Master Has Already Being Assigned To Another Station.</label>
							</div>';
					} else if($error == "qf"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Could Not Update The Station. Please Try Again Later.</label>
							</div>';
					} else if($error == "su"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control label-success" style="height:35px;">Station Successfully Updated.</label>
							</div>';
					}
				}
			}
			?>
            <form role="form" class="form-horizontal">
            	<div class="form-group">
                    <label for="search" class="control-label col-md-3">Search By : </label>
                    <div class="col-md-8">
                    	<select onchange="load(this);" name="searchBy" id="searchBy" class="form-control">
                          <option selected="selected" disabled="disabled">--Select the search criteria--</option>
                          <option value="sCode">Station Code</option>
                          <option value="sName">Name of the Station</option>
                          <option value="sm">Station Master</option>
                        </select>
                	</div>
                </div>
                <hr/>
            </form>
            <script type="text/javascript">
				 function load(selectObj) { 
					 var idx = selectObj.selectedIndex; 
					 var which = selectObj.options[idx].value; 
					 if(which=='sCode'){
						 document.getElementById('new').innerHTML = '<div class="form-group"><label for="StationCode" class="control-label col-md-3">Station Code</label><div class="col-md-8"><input class="form-control" type="text" name="StationCode" id="StationCode" /></div><div><input type="button" value="Search" class="btn btn-success" onClick="showHint(document.getElementById(\'StationCode\').value, document.getElementById(\'StationCode\').id);"/></div></div><hr/>'; 
					 } else if(which=='sName'){
						 document.getElementById('new').innerHTML = '<div class="form-group"><label for="StationName" class="control-label col-md-3">Station Name</label><div class="col-md-8"><input class="form-control" type="text" name="StationName" id="StationName" /></div><div><input type="button" value="Search" class="btn btn-success" onClick="showHint(document.getElementById(\'StationName\').value, document.getElementById(\'StationName\').id);"/></div></div><hr/>';
					 } else if(which=='sm'){
						 document.getElementById('new').innerHTML = '<div class="form-group"><label class="control-label col-md-3">Station Master NIC</label><div class="col-md-8"><input class="form-control" type="text" name="StationMaster" id="StationMaster" /></div><div><input type="button" value="Search" class="btn btn-success" onClick="showHint(document.getElementById(\'StationMaster\').value, document.getElementById(\'StationMaster\').id);"/></div></div><hr/>';
					 } else {
						 document.getElementById('new').innerHTML = '';
					 }
				 } 
			</script>
            <script>
			function showHint(str, id) {
				if (str.length == 0) { 
					document.getElementById("txtHint").innerHTML = "";
					return;
				} else {
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
						}
					};
					xmlhttp.open("GET", "getStationInfo.php?p=update&q=" + str + "&r=" + id, true);
					xmlhttp.send();
				}
			}
			</script>
            <div class="form-horizontal">
            	<div id="new"></div>
            	<div style="padding-left:70px;" id="txtHint"></div>
            </div>
        </div>
    </div>
</div>
<?php
	include_once('../ssi/footer.php');
?>
<!--disable the enter key-->
<script type="text/javascript">
	window.addEventListener('keydown',function(e){
		if(e.keyIdentifier=='U+000A'||e.keyIdentifier=='Enter'||e.keyCode==13){
			if(e.target.nodeName=='INPUT'&&e.target.type=='text'){
				e.preventDefault();
				return false;
			}
		}
	},true);
</script>
</body>
</html>
<?php
	} else {
		header('Location:../404.php');
	}
} else {
	header('Location:../404.php');
}
?>
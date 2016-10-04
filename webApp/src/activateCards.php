<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position'])){
	if($_SESSION['position'] == "registrar"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('../ssi/links.html');
?>
<title>Activate/ Deactivate Cards</title>
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
			include_once('../ssi/registrarLeftPanelUsers.php');	
        ?>
    </div>
    <div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1">
            	<u>Activate/ Deactivate Cards</u>
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
					} else if($error == "wcn"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Invalid Card Number.</label>
							</div>';
					} else if($error == "wnic"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Should be a valid NIC of 9 digits and \'v\'.</label>
							</div>';
					} else if($error == "wf"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">First Name Should Be Letters. Cannot Be Empty.</label>
							</div>';
					} else if($error == "wm"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Second Name Should Be Letters. Can Be Empty.</label>
							</div>';
					} else if($error == "wl"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Last Name Should Be Letters. Cannot Be Empty.</label>
							</div>';
					} else if($error == "wn"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Address Number Should Be Letters, Numbers, / or \. Cannot Be Empty.</label>
							</div>';
					} else if($error == "wa"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Lane Should Be Letters. Cannot Be Empty.</label>
							</div>';
					} else if($error == "wc"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">City Should Be Letters. Cannot Be Empty.</label>
							</div>';
					} else if($error == "wp"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Should Be A Valid Number With 10 Digits.</label>
							</div>';
					} else if($error == "iu"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Commuter Is Not Valid.</label>
							</div>';
					} else if($error == "ws"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Invalid Status.</label>
							</div>';
					} else if($error == "qfa"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Could Not Activate The Commuter. Please Try Again Later.</label>
							</div>';
					} else if($error == "qfd"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Could Not Disable The Commuter. Please Try Again Later.</label>
							</div>';
					} else if($error == "sua"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control label-success" style="height:35px;">Commuter Activated Succesfully. Will Get A SMS With New Pin Soon.</label>
							</div>';
					} else if($error == "sud"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control label-success" style="height:35px;">Commuter Disabled Succesfully. Won\'t Be Able To Use The S.C.A.T. Card Until Activate It.</label>
							</div>';
					}
				}
			}
		?>
            <form role="form" class="form-horizontal">
            	<div class="form-group">
                    <label for="employeeId" class="control-label col-md-3">Search By : </label>
                    <div class="col-md-8">
                    	<select onchange="load(this);" name="searchBy" id="searchBy" class="form-control">
                          <option selected="selected" disabled="disabled">--Select the search criteria--</option>
                          <option value="cNo">Card Number</option>
                          <option value="nic">NIC</option>
                        </select>
                	</div>
                </div>
                <hr/>
            </form>
            <script type="text/javascript">
				 function load(selectObj) { 
					 var idx = selectObj.selectedIndex; 
					 var which = selectObj.options[idx].value; 
					 if(which=='cNo'){
						 document.getElementById('new').innerHTML = '<div class="form-group"><label for="CardNo" class="control-label col-md-3">Card Number</label><div class="col-md-8"><input class="form-control" type="text" name="CardNo" id="CardNo" required/></div><div><input type="button" value="Search" class="btn btn-success" onClick="showHint(document.getElementById(\'CardNo\').value, document.getElementById(\'CardNo\').id);"/></div></div><hr/>'; 
					 } else if(which=='nic'){
						 document.getElementById('new').innerHTML = '<div class="form-group"><label for="employeelNIC" class="control-label col-md-3">NIC</label><div class="col-md-8"><input class="form-control" type="text" name="nic" id="nic" required/></div><div><input type="button" value="Search" class="btn btn-success" onClick="showHint(document.getElementById(\'nic\').value, document.getElementById(\'nic\').id);"/></div></div><hr/>';
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
					xmlhttp.open("GET", "getCommuterInfo.php?p=activate&q=" + str + "&r=" + id, true);
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
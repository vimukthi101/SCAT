<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position'])){
	if($_SESSION['position'] == "sysadmin" || $_SESSION['position'] == "stationMaster" || $_SESSION['position'] == "manager"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('../ssi/links.html');
?>
<title>User Management</title>
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
            if($_SESSION['position']=="sysadmin"){
				include_once('../ssi/adminLeftPanelUsers.php');
			} else if($_SESSION['position']=="stationMaster"){
				include_once('../ssi/stationMasterLeftPanelUsers.php');
			} else if($_SESSION['position']=="manager"){
				include_once('../ssi/managerLeftPanelUsers.php');
			}  
			$sendPos = $_GET['position'];
        ?>
    </div>
    <div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1"><u>Remove  
                <?php
                    echo $sendPos.'s';
                ?>
            </u>
            </font>
        </div>
        <div style="padding:10px;"> 
        	<?php
			if(isset($_GET['error'])){
				if(!empty($_GET['error'])){
					$error = $_GET['error'];
					if($error == "ns"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Please Submit The Form.</label>
							</div>';
					} else if($error == "ef"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Information Is Not Sufficient.</label>
							</div>';
					} else if($error == "nu"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">User Does Not Exist.</label>
							</div>';
					} else if($error == "qf"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Could Not Complete The Operation Now. Please Try Again Later.</label>
							</div>';
					} else if($error == "su"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control label-success" style="height:35px;">User Deleted Succesfully.</label>
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
                          <option value="eid">Employee ID</option>
                          <option value="nic">NIC</option>
                          <option value="email">E-mail</option>
                        </select>
                	</div>
                </div>
                <hr/>
            </form>
            <script type="text/javascript">
				 function load(selectObj) { 
					 var idx = selectObj.selectedIndex; 
					 var which = selectObj.options[idx].value; 
					 if(which=='eid'){
						 document.getElementById('new').innerHTML = '<div class="form-group"><label for="employeeId" class="control-label col-md-3">Employee ID</label><div class="col-md-8"><input class="form-control" type="text" name="<?php echo $sendPos ?>" id="EID" required/></div><div><input type="button" value="Search" class="btn btn-success" onclick="showHint(document.getElementById(\'EID\').value, document.getElementById(\'EID\').id, document.getElementById(\'EID\').name);"/></div></div><hr/>'; 
					 } else if(which=='nic'){
						 document.getElementById('new').innerHTML = '<div class="form-group"><label for="employeelNIC" class="control-label col-md-3">NIC</label><div class="col-md-8"><input class="form-control" type="text" name="<?php echo $sendPos ?>" id="nic" required/></div><div><input type="button" value="Search" class="btn btn-success" onclick="showHint(document.getElementById(\'nic\').value, document.getElementById(\'nic\').id, document.getElementById(\'nic\').name);"/></div></div><hr/>';
					 } else if(which=='email'){
						 document.getElementById('new').innerHTML = '<div class="form-group"><label for="employeeEmail" class="control-label col-md-3">E-Mail</label><div class="col-md-8"><input class="form-control" type="text" name="<?php echo $sendPos ?>" id="EMail" required/></div><div><input type="button" value="Search" class="btn btn-success" onclick="showHint(document.getElementById(\'EMail\').value, document.getElementById(\'EMail\').id, document.getElementById(\'EMail\').name);"/></div></div><hr/>';
					 } else {
						 document.getElementById('new').innerHTML = '';
					 }
				 } 
			</script>
            <script>
			function showHint(str, id, pos) {
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
					xmlhttp.open("GET", "getUserInfo.php?p=delete&q=" + str + "&r=" + id + "&s=" + pos, true);
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
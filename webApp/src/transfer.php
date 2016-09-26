<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position'])){
	if($_SESSION['position'] == "topupAgent" || $_SESSION['position'] == "registrar"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('../ssi/links.html');
?>
<title>Credit Transfer</title>
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
			include_once('../ssi/registrarLeftPanelCards.php');
        ?>
    </div>
    <div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1">
            	<u>Transfer S.C.A.T. Credits</u>
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
                        } else if($error == "nc"){
                            echo '<div class="form-group text-center" style="padding-left:100px;">
                                    <label class="form-control label-success" style="height:35px;">Commuter Cannot Use This Service As Contact Number Has Not Added Yet.</label>
                                </div>';
                        } else if($error == "wn"){
                            echo '<div class="form-group text-center" style="padding-left:100px;">
                                    <label class="form-control" style="height:35px;">Entered NIC Is Not Valid.</label>
                                </div>';
                        } else if($error == "wp"){
                            echo '<div class="form-group text-center" style="padding-left:100px;">
                                    <label class="form-control" style="height:35px;">Entered Pin Is Not Valid.</label>
                                </div>';
                        } else if($error == "dm"){
                            echo '<div class="form-group text-center" style="padding-left:100px;">
                                    <label class="form-control" style="height:35px;">Entered Pin Does Not Match.</label>
                                </div>';
                        } else if($error == "sc"){
                            echo '<div class="form-group text-center" style="padding-left:100px;">
                                    <label class="form-control label-success" style="height:35px;">Both Commuter One And Two Cannot Be Same.</label>
                                </div>';
                        } else if($error == "ia"){
                            echo '<div class="form-group text-center" style="padding-left:100px;">
                                    <label class="form-control label-success" style="height:35px;">Amount Should Be In The Format Of 100.00</label>
                                </div>';
                        } else if($error == "cde"){
                            echo '<div class="form-group text-center" style="padding-left:100px;">
                                    <label class="form-control label-success" style="height:35px;">Commuter Does Not Exists.</label>
                                </div>';
                        } else if($error == "ib"){
                            echo '<div class="form-group text-center" style="padding-left:100px;">
                                    <label class="form-control label-success" style="height:35px;">Could Not Complete The Transaction As Balance Is Insufficient. Will Receive A SMS With Existing Balance Shortly.</label>
                                </div>';
                        } else if($error == "qf"){
                            echo '<div class="form-group text-center" style="padding-left:100px;">
                                    <label class="form-control label-success" style="height:35px;">Could Not Complete The Transaction. Please Try Again Later.</label>
                                </div>';
                        } else if($error == "qf"){
                            echo '<div class="form-group text-center" style="padding-left:100px;">
                                    <label class="form-control label-success" style="height:35px;">Transfer Completed. Couldn\'t Send The SMS.</label>
                                </div>';
                        } else if($error == "su"){
                            echo '<div class="form-group text-center" style="padding-left:100px;">
                                    <label class="form-control label-success" style="height:35px;">Successfully Transfer The Credits. Will Receive A SMS With Existing Balance Shortly.</label>
                                </div>';
                        }
                    }
                }
            ?>
            <form role="form" class="form-horizontal">
            	<div class="form-group">
                    <label for="employeeId" class="control-label col-md-3">Search By : </label>
                    <div class="col-md-8">
                    	<select onchange="load(this);"  class="form-control">
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
						 document.getElementById('new').innerHTML = '<div class="form-group"><label for="CardNo" class="control-label col-md-3">Card Number</label><div class="col-md-8"><input class="form-control" type="text" name="CardNo" id="CardNo"/></div><div><input type="button" value="Search" class="btn btn-success" onClick="showHint(document.getElementById(\'CardNo\').value, document.getElementById(\'CardNo\').id);"/></div></div><hr/>'; 
					 } else if(which=='nic'){
						 document.getElementById('new').innerHTML = '<div class="form-group"><label for="employeelNIC" class="control-label col-md-3">NIC</label><div class="col-md-8"><input class="form-control" type="text" name="nic" id="nic" /></div><div><input type="button" value="Search" class="btn btn-success" onClick="showHint(document.getElementById(\'nic\').value, document.getElementById(\'nic\').id);"/></div></div><hr/>';
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
					xmlhttp.open("GET", "getCommuterInfo.php?p=transfer&q=" + str + "&r=" + id, true);
					xmlhttp.send();
				}
			}
			</script>
            <!--second time data-->
            <script type="text/javascript">
				 function loadAgain(selectObj) { 
					 var idx = selectObj.selectedIndex; 
					 var which = selectObj.options[idx].value; 
					 if(which=='cardNumber'){
						 document.getElementById('again').innerHTML = '<div class="form-group"><label for="CardNo" class="control-label col-md-3">Card Number</label><div class="col-md-8"><input class="form-control" type="text" name="Card" id="Card"/></div><div><input type="button" value="Search" class="btn btn-success" onClick="showAnother(document.getElementById(\'Card\').value, document.getElementById(\'Card\').id);"/></div></div><hr/>'; 
					 } else if(which=='commuterNic'){
						 document.getElementById('again').innerHTML = '<div class="form-group"><label for="employeelNIC" class="control-label col-md-3">NIC</label><div class="col-md-8"><input class="form-control" type="text" name="commuter" id="commuter" /></div><div><input type="button" value="Search" class="btn btn-success" onClick="showAnother(document.getElementById(\'commuter\').value, document.getElementById(\'commuter\').id);"/></div></div><hr/>';
					 } else {
						 document.getElementById('again').innerHTML = '';
					 }
				 } 
			</script> 
			<script>
			function showAnother(str, id) {
				if (str.length == 0) { 
					document.getElementById("txtAnother").innerHTML = "";
					return;
				} else {
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							document.getElementById("txtAnother").innerHTML = xmlhttp.responseText;
						}
					};
					xmlhttp.open("GET", "getCommuterInfoAgain.php?p=transfer&q=" + str + "&r=" + id, true);
					xmlhttp.send();
				}
			}
			</script>
            <div class="form-horizontal">
            	<div id="new"></div>
                <form role="form" method="post" action="controller/transferController.php">
            	<div style="padding-left:70px;" id="txtHint"></div>
                <!--second time-->
                <div id="again"></div>
                <div style="padding-left:70px;" id="txtAnother"></div>
                </form>
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
<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position'])){
	if($_SESSION['position'] == "sysadmin" || $_SESSION['position'] == "stationMaster"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('../ssi/links.html');
?>
<title>Cards Management</title>
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
				include_once('../ssi/adminLeftPanelCards.php');
			} else if($_SESSION['position']=="stationMaster"){
				include_once('../ssi/stationMasterLeftPanelCards.php');
			}
        ?>
    </div>
    <div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1">
            	<u>View Issued/ Rejected S.C.A.T. Cards</u>
            </font>
        </div>
        <div style="padding:10px;"> 
            <form role="form" class="form-horizontal">
            	<div class="form-group">
                    <label for="search" class="control-label col-md-3">Search By : </label>
                    <div class="col-md-8">
                    	<select onchange="load(this);" name="searchBy" id="searchBy" class="form-control">
                          <option selected="selected" disabled="disabled">--Select the search criteria--</option>
                          <?php if($_SESSION['position'] == "sysadmin"){ ?>
                              <option value="station">Station Name</option>
                              <option value="status">Status</option>
                          <?php } else if($_SESSION['position'] == "stationMaster"){?>
                          	  <option value="status">Status</option>
                          <?php }?>
                        </select>
                	</div>
                </div>
                <hr/>
            </form>
			<script type="text/javascript">
                 function load(selectObj) { 
                     var idx = selectObj.selectedIndex; 
                     var which = selectObj.options[idx].value; 
                     if(which=='station'){
                         document.getElementById('new').innerHTML = '<div class="form-group"><label for="stationName" class="control-label col-md-3">Station Name</label><div class="col-md-8"><input class="form-control" onkeyup="showHint(this.value, this.id);" type="text" name="stationName" id="stationName" /></div></div><hr/>'; 
                     } else if(which=='status'){
                         document.getElementById('new').innerHTML = '<div class="form-group"><label for="cardStatus" class="control-label col-md-3">Status</label><div class="col-md-8"><select onchange="showHint(this.value, this.id);" name="cardStatus" id="cardStatus" class="form-control"><option selected="selected" disabled="disabled">--Select the Card Status--</option><option value="all">All</option><option value="issued">Issued By Admin</option><option value="received">Received By Station</option><option value="rejected">Rejected By Admin</option></select></div></div><hr/>';
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
					xmlhttp.open("GET", "getCardInfo.php?p=list&q=" + str + "&r=" + id, true);
					xmlhttp.send();
				}
			}
			</script>
            <div class="form-horizontal">
            	<div id="new"></div>
            	<div style="padding-left:100px;" id="txtHint"></div>
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
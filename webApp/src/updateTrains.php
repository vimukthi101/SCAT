<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('../ssi/links.html');
?>
<title>Trains Management</title>
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
            include_once('../ssi/adminLeftPanelTrains.php');
        ?>
    </div>
    <div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1">
            	<u>Update Trains</u>
            </font>
        </div>
        <div style="padding:10px;"> 
            <form role="form" class="form-horizontal">
            	<div class="form-group">
                    <label for="search" class="control-label col-md-3">Search By : </label>
                    <div class="col-md-8">
                    	<select onchange="load(this);" name="searchBy" id="searchBy" class="form-control">
                          <option selected="selected" disabled="disabled">--Select the search criteria--</option>
                          <option value="tCode">Train Code</option>
                          <option value="tName">Name of the Train</option>
                        </select>
                	</div>
                </div>
                <hr/>
            </form>
            <script type="text/javascript">
				 function load(selectObj) { 
					 var idx = selectObj.selectedIndex; 
					 var which = selectObj.options[idx].value; 
					 if(which=='tCode'){
						 document.getElementById('new').innerHTML = '<div class="form-group"><label for="TrainCode" class="control-label col-md-3">Train Code</label><div class="col-md-8"><input class="form-control" type="text" name="TrainCode" id="TrainCode" /></div><div><input type="button" value="Search" class="btn btn-success" onClick="showHint(this.value);"/></div></div><hr/>'; 
					 } else if(which=='tName'){
						 document.getElementById('new').innerHTML = '<div class="form-group"><label for="TrainName" class="control-label col-md-3">Train Name</label><div class="col-md-8"><input class="form-control" type="text" name="TrainName" id="TrainName" /></div><div><input type="button" value="Search" class="btn btn-success" onClick="showHint(this.value);"/></div></div><hr/>';
					 } else {
						 document.getElementById('new').innerHTML = '';
					 }
				 } 
			</script>
            <script>
			function showHint(str) {
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
					xmlhttp.open("GET", "getTrainInfo.php?p=update&q=" + str, true);
					xmlhttp.send();
				}
			}
			</script>
            <form role="form" class="form-horizontal">
            	<div id="new"></div>
            	<div style="padding-left:70px;" id="txtHint"></div>
            </form>
        </div>
    </div>
</div>
<?php
	include_once('../ssi/footer.php');
?>
</body>
</html>
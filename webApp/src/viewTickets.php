<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('../ssi/links.html');
?>
<title>System Configurations</title>
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
            include_once('../ssi/adminLeftPanelSystem.php');
        ?>
    </div>
    <div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1">
            	<u>View Ticket Info</u>
            </font>
        </div>
        <div style="padding:10px;"> 
            <form role="form" class="form-horizontal">
            	<div class="form-group">
                    <label for="search" class="control-label col-md-3">Search By : </label>
                    <div class="col-md-8">
                    	<select onchange="load(this);" name="searchBy" id="searchBy" class="form-control">
                          <option selected="selected" disabled="disabled">--Select the search criteria--</option>
                          <option value="all">List All</option>
                          <option value="inStation">In Station</option>
                          <option value="outStation">Out Station</option>
                          <option value="fee">Ticket Fee</option>
                        </select>
                	</div>
                </div>
                <hr/>
            </form>
             <script type="text/javascript">
				 function load(selectObj) { 
					 var idx = selectObj.selectedIndex; 
					 var which = selectObj.options[idx].value; 
					 if(which=='inStation'){
						 document.getElementById('new').innerHTML = '<div class="form-group"><label for="inStation" class="control-label col-md-3">In Station</label><div class="col-md-8"><select onchange="showHint(this.value);" name="inStation" id="inStation" class="form-control"><option selected="selected" disabled="disabled">--Select the In Station--</option><option value="maradana">maradana</option><option value="">colombo</option><option value="">Galle</option></select></div></div><hr/>';
					 } else if(which=='outStation'){
						 document.getElementById('new').innerHTML = '<div class="form-group"><label for="outStation" class="control-label col-md-3">Out Station</label><div class="col-md-8"><select onchange="showHint(this.value);" name="outStation" id="outStation" class="form-control"><option selected="selected" disabled="disabled">--Select the In Station--</option><option value="maradana">maradana</option><option value="">colombo</option><option value="">Galle</option></select></div></div><hr/>';
					 } else if(which=='fee'){
						 document.getElementById('new').innerHTML = '<div class="form-group"><label for="tFee" class="control-label col-md-3">Ticket Fee</label><div class="col-md-8"><input class="form-control" onkeyup="showHint(this.value)" type="text" name="tFee" id="tFee" /></div></div><hr/>';
					 } else if(which=='all'){
						 showHint('all');
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
					xmlhttp.open("GET", "getTicketInfo.php?p=view&q=" + str, true);
					xmlhttp.send();
				}
			}
			</script>
            <form role="form" class="form-horizontal">
            	<div id="new"></div>
            	<div style="padding-left:200px;" id="txtHint"></div>
            </form>
        </div>
    </div>
</div>
<?php
	include_once('../ssi/footer.php');
?>
</body>
</html>
<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position'])){
	if($_SESSION['position'] == "updater"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include('../ssi/links.html');
?>
<title>Time Table Management</title>
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
			include_once('../ssi/timeTableUpdaterLeftPanel.php'); 
        ?>
    </div>
    <div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1">
            	<u>View Time Table</u>
            </font>
        </div>
        <div style="padding:10px;"> 
            <form role="form" class="form-horizontal">
            	<div class="form-group">
                    <label for="day" class="control-label col-md-3">Select the Day : </label>
                    <div class="col-md-8">
                    	<select name="day" id="day" class="form-control" onchange="showHint(document.getElementById('line').value, this.value);">
                          <option selected="selected" disabled="disabled">--Select the Day--</option>
                          <option value="sun">Sunday</option>
                          <option value="mon">Monday</option>
                          <option value="tus">Tuesday</option>
                          <option value="wed">Wednesday</option>
                          <option value="thu">Thursday</option>
                          <option value="fri">Friday</option>
                          <option value="sat">Saturday</option>
                        </select>
                	</div>
                </div>
                <div class="form-group">
                    <label for="line" class="control-label col-md-3">Select the Line : </label>
                    <div class="col-md-8">
                    	<select name="line" id="line" class="form-control" onchange="showHint(this.value, document.getElementById('day').value);">
                          <option selected="selected" disabled="disabled">--Select the Line--</option>
                          <option value="kandy">Colombo - Kandy</option>
                          <option value="matara">Colombo - Matara</option>
                          <option value="vauniya">Colombo - Vauniya</option>
                          <option value="taleimannar">Colombo - Taleimannar</option>
                          <option value="jaffna">Colombo - Jaffna</option>
                        </select>
                	</div>
                </div>
                <hr/>
            </form>
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
					xmlhttp.open("GET", "getTimeTableInfo.php?p=view&q=" + str + "&r=" + id, true);
					xmlhttp.send();
				}
			}
			</script>
            <div class="form-horizontal">
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
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
	include_once('../ssi/links.html');
?>
<title>Time Table Management</title>
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
            	<u>Add New Time Table</u>
            </font>
        </div>
        <div style="padding:10px;"> 
            <form role="form" class="form-horizontal">
            	<div class="form-group">
                    <label for="day" class="control-label col-md-3">Select the Day : </label>
                    <div class="col-md-8">
                    	<select name="day" id="day" class="form-control">
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
                </div>
            </form>
            <script type="text/javascript">
				 function addRow() {
					var table = document.getElementById("table");
					var row = table.insertRow(-1);
					var cell0 = row.insertCell(0);
					var cell1 = row.insertCell(1);
					var cell2 = row.insertCell(2);
					var cell3 = row.insertCell(3);
					var cell4 = row.insertCell(4);
					cell0.innerHTML = '<select name="tNo" id="tNo" class="form-control"><option selected="selected" disabled="disabled">--Select the Train Number--</option><option value="109">109</option><option value="125">125</option><option value="1055">1055</option><option value="4077">4077</option></select>';
					cell1.innerHTML = '<input type="text" class="form-control" name="tName" id="tName" value="" readonly="readonly" />';
					cell2.innerHTML = '<input type="time" class="form-control" id="time" name="time" />';
					cell3.innerHTML = '<select name="type" id="type" class="form-control"><option selected="selected" disabled="disabled">--Select the Train Type--</option><option value="exp">Express</option><option value="ice">Intercity</option><option value="slow">Slow</option><option value="sem">Semi</option></select>';
					cell4.innerHTML = '<a href="#" onclick="addRow();"><i class="fa fa-2x fa-plus" style="padding-right:10px;" aria-hidden="true"></i></a><a href="#" onclick="deleteRow(this);"><i class="fa fa-2x fa-minus" style="padding-left:5px;" aria-hidden="true"></i></a>';
				}
				
				function deleteRow(x) {
					var rows = document.getElementById('table').getElementsByTagName('tr');
					for (i = 0; i < rows.length; i++) {
						rows[i].onclick = function() {
							document.getElementById("table").deleteRow(this.rowIndex);
						}
					}
				}
			</script>
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
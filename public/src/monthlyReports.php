<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('../ssi/links.html');
?>
<title>Travels Management</title>
</head>

<body style="background-image:url(../images/4.jpg);background-repeat:no-repeat;background-size:cover;">
<div>
	<?php
        include_once('../ssi/commuterHeader.php');
    ?>
</div>
<div class="container-fluid text-capitalize" style="padding:0px;margin:0px;">
	<div>
		<?php
            include_once('../ssi/commuterLeftPanelCards.php');
        ?>
    </div>
    <div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1">
            	<u>Travels Portal</u>
            </font>
        </div>
        <div style="padding:10px;"> 
            <form role="form" class="form-horizontal">
            	<div class="form-group">
                    <label for="employeeId" class="control-label col-md-3">Select Date : </label>
                    <div class="col-md-8">
                    	<input type="month" class="form-control" name="date" id="date" />
                	</div>
                </div>
                <div class="form-group">
                    <label for="nRecords" class="control-label col-md-3">Number of Records : </label>
                    <div class="col-md-8">
                    	<select name="nRecords" id="nRecords" class="form-control">
                          <option selected="selected" disabled="disabled">--Select the Limit--</option>
                          <option value="eid">All</option>
                          <option value="nic">5</option>
                          <option value="fname">10</option>
                          <option value="lname">20</option>
                        </select>
                	</div>
                </div>
                <div class="form-group">
                    <div class="col-md-12 text-center">
                        <input type="submit" value="Generate" class="btn btn-success" />
                        <input type="reset" value="Clear" class="btn btn-danger" />
                    </div>
                </div>
                <hr/>
            </form>
        </div>
    </div>
</div>
<?php
	include_once('../ssi/footer.php');
?>
</body>
</html>
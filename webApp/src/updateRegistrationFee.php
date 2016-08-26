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
            <u>Update Registration Fee</u>
            </font>
        </div>
        <div style="padding:10px;"> 
        	<form role="form" class="form-horizontal">
            	<div class="form-group">
                    <label for="regFee" class="control-label col-md-3">Registration Fee : </label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="rFee" id="rFee" readonly="readonly"/>
                    </div>
                </div>
                <hr/>
            </form> 
            <form role="form" class="form-horizontal">
            	<div class="form-group">
                    <label for="regFee" class="control-label col-md-3">New Registration Fee : </label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="regFee" id="regFee" />
                    </div>
                    <div>
                    	<input type="submit" value="Update" class="btn btn-success"/>
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
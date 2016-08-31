<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('../ssi/links.html');
	//remove this when the login is done
	$_SESSION['position'] = "commuter";
?>
<title>Deactivate Cards</title>
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
            	<u>Deactivate Cards</u>
            </font>
        </div>
        <div style="padding:10px;"> 
        	<form role="form" class="form-horizontal">
            	<div class="form-group">
                    <label for="CardNumber" class="control-label col-md-3">Card Number</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="CardNumber" id="CardNumber" readonly/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="employeelNIC" class="control-label col-md-3">NIC</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="nic" id="nic" readonly/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="fName" class="control-label col-md-3">Full Name</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="fname" id="fname" readonly/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="contact" class="control-label col-md-3">Contact Number</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="contact" id="contact" readonly/>
                	</div>
                </div>
                <div class="form-group col-md-11 text-center">
                    <input type="submit" value="Deactivate" class="btn btn-warning" />
                    <input type="reset" value="Clear" class="btn btn-danger" /> 
               	</div>
            </form>
        </div>
    </div>
</div>
<?php
	include_once('../ssi/footer.php');
?>
</body>
</html>
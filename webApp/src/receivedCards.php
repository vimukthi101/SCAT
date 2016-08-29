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
            include_once('../ssi/stationMasterLeftPanelCards.php');
        ?>
    </div>
    <div class="col-md-10" style="padding:20px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
        <div class="text-center" style="padding:10px;">
            <font face="Verdana, Geneva, sans-serif" size="+1">
            	<u>Issue S.C.A.T. Cards</u>
            </font>
        </div>
        <div style="padding:10px;"> 
            <form role="form" class="form-horizontal">
            	<div class="form-group">
                    <label for="rID" class="control-label col-md-3">Request ID</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="rID" id="rID" readonly="readonly"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="station" class="control-label col-md-3">Station Name</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="station" id="station" readonly="readonly"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="stationMaster" class="control-label col-md-3">Station Master</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="stationMaster" id="stationMaster" readonly="readonly"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="nRequest" class="control-label col-md-3">Number of Cards Requested</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="nRequest" id="nRequest" readonly="readonly"/>
                	</div>
                </div>
                <div class="form-group">
                    <label for="nSend" class="control-label col-md-3">Number of Cards Received</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="nSend" id="nSend" readonly="readonly"/>
                	</div>
                </div>
                <div class="form-group col-md-11 text-center">
                    <input type="submit" value="Received" class="btn btn-success" />
                    <input type="reset" value="Request Again" class="btn btn-danger" />
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
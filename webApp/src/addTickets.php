<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_SESSION['position'])){
	if($_SESSION['position'] == "sysadmin"){
?>
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
            	<u>Add Ticket Fee</u>
            </font>
        </div>
        <div style="padding:10px;"> 
            <form role="form" class="form-horizontal">
            	<div class="form-group">
                    <label for="iStation" class="control-label col-md-3">In Station</label>
                    <div class="col-md-8">
                    	<select name="iStation" id="iStation" class="form-control">
                          <option selected="selected" disabled="disabled">--Select the In Station--</option>
                          <option value="pettah">Pettah</option>
                          <option value="maradana">Maradana</option>
                        </select>
                	</div>
                </div>
                <div class="form-group">
                    <label for="oStation" class="control-label col-md-3">Out Station</label>
                    <div class="col-md-8">
                    	<select name="oStation" id="oStation" class="form-control">
                          <option selected="selected" disabled="disabled">--Select the Out Station--</option>
                          <option value="pettah">Pettah</option>
                          <option value="maradana">Maradana</option>
                        </select>
                	</div>
                </div> 
                <div class="form-group">
                    <label for="tFee" class="control-label col-md-3">Ticket Fee</label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="tFee" id="tFee"/>
                	</div>
                </div> 
                <div class="form-group col-md-11 text-center">
                    <input type="submit" value="Add" class="btn btn-success" />
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
<?php
	} else {
		header('Location:../404.php');
	}
} else {
	header('Location:../404.php');
}
?>
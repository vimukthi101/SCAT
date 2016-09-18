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
	include_once('../ssi/db.php');
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
            <u>Update Commuter Registration Fee</u>
            </font>
        </div>
        <div style="padding:10px;"> 
        <?php
			if(isset($_GET['error'])){
				if(!empty($_GET['error'])){
					$error = $_GET['error'];
					if($error == "ef"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Required Fields Cannot Be Empty.</label>
							</div>';
					} else if($error == "wf"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Should Be Like 100.00 Format.</label>
							</div>';
					} else if($error == "qf"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control" style="height:35px;">Could Not Update The Registration Fee. Please Try Again Later.</label>
							</div>';
					} else if($error == "su"){
						echo '<div class="form-group text-center" style="padding-left:100px;">
								<label class="form-control label-success" style="height:35px;">Registration Fee Successfully Updated.</label>
							</div>';
					}
				}
			}
			?>
        	<div class="form-horizontal">
            	<div class="form-group">
                    <label for="regFee" class="control-label col-md-3">Registration Fee : Rs.</label>
                    <div class="col-md-8">
                    <?php
					$getFee = "SELECT * FROM commuter_regfee";
					$resultFee = mysqli_query($con, $getFee);
					if(mysqli_num_rows($resultFee) != 0){
						while($rowFee = mysqli_fetch_array($resultFee)){
							$tFee = $rowFee['reg_fee'];
						}
					} else {
						$tFee = "200.00";
					}
					?>
                    	<input class="form-control" type="text" name="rFee" id="rFee" readonly="readonly" value="<?php echo $tFee; ?>"/>
                    </div>
                </div>
                <hr/>
            </div> 
            <form role="form" class="form-horizontal" method="post" action="controller/updateCommuterRegFeeController.php">
            	<div class="form-group">
                    <label for="regFee" class="control-label col-md-3">New Registration Fee : Rs. <span style="color:rgb(255,0,0);">*</span></label>
                    <div class="col-md-8">
                    	<input class="form-control" type="text" name="regFee" id="regFee" pattern="^\d+\.(\d{2})$" title="Should Be Like 100.00 Format." required="required"/>
                    </div>
                    <div>
                    	<input type="submit" value="Update" class="btn btn-success" name="submit" id="submit"/>
                    </div>
                </div>
                <hr/>
            </form> 
             <div class="form-group" style="text-align:center;">
                    <label style="text-align:center;" class="control-label col-md-11"><span style="color:rgb(255,0,0);">*</span> Mandatory Fields</label> 
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
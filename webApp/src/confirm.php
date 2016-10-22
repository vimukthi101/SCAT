<?php
if(!isset($_SESSION[''])){
	session_start();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include_once('../ssi/links.html');
if(isset($_COOKIE['station']) && isset($_COOKIE['terminal'])){
	if(isset($_SESSION['pass']) && isset($_SESSION['credit']) && isset($_SESSION['commuter_nic']) && isset($_SESSION['attempt']) && $_SESSION['amount'] && $_SESSION['noOfTickets'] && $_SESSION['ticketId'] && $_SESSION['outStation'] && $_SESSION['outStationName']){
?>
<title>Payment Terminal</title>
</head>
<body style="background-image:url(../images/home.jpg);background-repeat:no-repeat;background-size:cover;width:100%;">
<!--header start-->
    <div class="col-md-12 text-center" style="background-color:rgb(0,102,255);padding:15px;height:10vh;">
        <font size="+3" color="#FFFFFF" face="Verdana, Geneva, sans-serif">Smart Card at Travelling for Trains</font>
    </div>
    <?php 
		header("Refresh: 15; URL=welcome.php"); 
	?>
<!--header end-->    
<!--body start-->
	<div class="col-md-12">
        <div>
            <div style="background-color:rgba(0,153,255,0.4);padding:10px;top:10vh;background-position:center;left:33%;" class="col-md-4 text-center">
            	<form role="form" class="form-group" action="controller/confirmController.php" method="post">
                    <div style="padding:10px;">
                     <font size="+1" face="Verdana, Geneva, sans-serif" color="#FFFFFF" style="padding:10px;">Please confirm your ticket.</font>
                    </div>
                    <div  class="row" style="padding:10px;">
                    <?php
						$date = date("Y-m-d H:i:s");
						$_SESSION['date'] = $date;
					?>
                     <label class="form-control">Commuter NIC : <?php echo $_SESSION['commuter_nic']; ?></label>
                     <label class="form-control">Date/ Time : <?php echo $date; ?></label>
                     <label class="form-control">In Station : <?php echo $_COOKIE['station']; ?></label>
                     <label class="form-control">Out Station : <?php echo $_SESSION['outStationName']; ?></label>
                     <label class="form-control">Number of Tickets : <?php echo $_SESSION['noOfTickets']; ?></label>
                     <label class="form-control">Total Amount : <?php echo $_SESSION['amount']; ?></label>
                    </div>
                    <div class="row" style="padding:10px;">
                        <div class="center-block col-md-12">
                        	<div class="col-md-1"></div>
                        	<div class="col-md-3">
                            	<input type="submit" class="btn btn-default" style="width:80px;height:50px;" id="done" name="done" value="Confirm" />
                            </div>
                            <div class="col-md-3">
                            	<input type="button" onclick="document.location.href='welcome.php'" class="btn btn-default" style="width:80px;height:50px;" id="clear" name="clear" value="Clear" />
                            </div>
                            <div class="col-md-3">
                            	<input type="button" onclick="document.location.href='commuters.php'" class="btn btn-default" style="width:80px;height:50px;" id="back" name="back" value="Back" />
                            </div>
                            <div class="col-md-2"></div>
                         </div>
                    </div>
                </form>
            </div>        
        </div>
    </div>
    <script>
	function send(value){
		old = document.getElementById('pin').value;
		if(old.length<4){
			document.getElementById('pin').value = old + value;	
		}
	}
	</script>
<!--body end-->
<!--footer start-->
    <?php
		include_once('../ssi/footer.php');
	?>
<!--footer end-->
</body>
<?php
	} else {
		session_destroy();
		header('Location:welcome.php');
	}
} else {
	session_destroy();
	header('Location:../505.php');
}
?>
</html>
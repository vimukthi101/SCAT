<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('../ssi/links.html');
?>
<title>User Management</title>
</head>

<body  style="background-image:url(../images/4.jpg);background-repeat:no-repeat;background-size:cover;">
<div>
	<?php
        include_once('../ssi/adminHeader.php');
    ?>
</div>
<div class="container-fluid text-capitalize" style="padding:0px;margin:0px;">
	<div>
		<?php
            include_once('../ssi/adminLeftPanelUsers.php');
        ?>
    </div>
    <div class="col-md-10" style="padding:10px;margin-left:160px;margin-top:45px;margin-bottom:30px;">
    	<div class="text-center"  style="padding:10px;>
            <font face="Verdana, Geneva, sans-serif" size="+1"><u>Update a 
                <?php
                    echo $_GET['position'];
                ?>
            </u>
            </font>
        </div>
        <div>
        	<p>asdf</p>
        </div>
    </div>
</div>
<?php
	include_once('../ssi/footer.php');
?>
</body>
</html>
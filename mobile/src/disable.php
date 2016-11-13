<?php
	//errors will not be shown
	//error_reporting(0);
	include_once('../ssi/db.php');
	if(isset($_POST['nic']) && isset($_POST['status'])){
		if(!empty($_POST['nic'])){
			$nic = $_POST['nic'];
			$status = $_POST['status'];
			if($status == "0"){
				$deactivateUser = "UPDATE commuter SET STATUS='0' WHERE nic='".$nic."'";
				if(mysqli_query($con, $deactivateUser)){
					echo "SUCCESS";
				} else {
					echo "FAILED";
				}	
			} else {
				echo "FAILED";
			}
		} else {
			echo "FAILED";	
		}
	} else {
		echo "FAILED";
	}	
?>
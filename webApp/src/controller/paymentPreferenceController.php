<?php
	if(!isset($_SESSION[''])){
		session_start();
	}
	//errors will not be shown
	//error_reporting(0);
	include_once('../../ssi/db.php');
	if(isset($_SESSION['position'])){
		if($_SESSION['position'] == "stationMaster"){
			$nic = $_SESSION['nic'];
			$getStation = "SELECT station_code FROM station WHERE employee_nic='".$nic."'";
			$resultStation = mysqli_query($con, $getStation);
			if(mysqli_num_rows($resultStation)!=0){
				while($rowStation = mysqli_fetch_array($resultStation)){
					$inStation = $rowStation['station_code'];
				}
			}
			$terminal = $_SESSION['terminal'];
			if(isset($_POST['submit'])){
				if(!empty($_POST['outStation'])){
					$delete = "DELETE FROM payment_terminal WHERE in_station_code='".$inStation."' AND terminal_line='".$terminal."'";
					if(mysqli_query($con, $delete)){
						foreach($_POST['outStation'] as $out){
							$insert = "INSERT INTO payment_terminal(out_station_code, terminal_line, in_station_code) VALUES('".$out."','".$terminal."','".$inStation."')";
							if(mysqli_query($con, $insert)){
								//success
								header('Location:../paymentTerminal.php');
							} else {
								//query failed
								header('Location:../paymentTerminal.php');
							}
						}
					} else {
						//query failed
						header('Location:../paymentTerminal.php');
					}
				}
			} else {
				//if submit button is not clicked
				header('Location:../selectStations.php');	
			}
		} else {
			//if not sysadmin
			header('Location:../../404.php');	
		}
	} else {
		//if session not set
		header('Location:../../404.php');	
	}
?>
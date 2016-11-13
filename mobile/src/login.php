<?php
	//errors will not be shown
	//error_reporting(0);
	include_once('../ssi/db.php');
	if(!empty($_POST['userNIC']) && !empty($_POST['password'])){
		//get user name and password
		$un = trim($_POST['userNIC']);
		$up = trim($_POST['password']);
		if(preg_match('/^(\d){9}[v|V]$/',$un)){
			if(preg_match('/\S+/',$up)){
				$userName = htmlspecialchars(mysql_real_escape_string($un));
				$userPassword = md5(htmlspecialchars(mysql_real_escape_string($up)));
				//mysql query to get employee
				$query = "SELECT * FROM commuter WHERE nic='".$userName."' AND password='".$userPassword."'";
				$result = mysqli_query($con, $query) or die();
				if(mysqli_num_rows($result)==0){
					//if password is wrong redirect to login page
					$getStatus = "SELECT * FROM commuter WHERE nic='".$userName."'";
					$statusResult = mysqli_query($con, $getStatus) or die();
					if(mysqli_num_rows($statusResult)!=0){
						while($statusRow = mysqli_fetch_array($statusResult)){
							//update login attempt by one
							$loginAttempt = $statusRow['login_attempt'];
							$newLoginAttempt = $loginAttempt + 1;
							$updateLoginAttempt = "UPDATE commuter SET login_attempt='".$newLoginAttempt."' WHERE nic='".$userName."'";
							if(mysqli_query($con, $updateLoginAttempt)){
								if($newLoginAttempt >= "3"){
									//block the user if attempts are >= 3
									$updateLoginAttempt = "UPDATE commuter SET status='0' WHERE nic='".$userName."'";
									if(mysqli_query($con, $updateLoginAttempt)){
										echo "DEACTIVATED";
									} else {
										//wrong password error message
										echo "INCORRECT";	
									}
								} else {
									//wrong password error message
									echo "INCORRECT";
								}
							} else {
								//wrong password error message
								echo "INCORRECT";
							}
						}
					} else {
						//wrong nic error message
						echo "NONIC";			
					}
				} else {
					while($row = mysqli_fetch_array($result)){
						$employeeNIC = $row['nic'];
						$employeeContact = $row['contact_no'];
						$employeeNameId = $row['name_name_id'];
						$employeeAddressID = $row['address_address_id'];
						$employeePassword = $row['password'];
						$commuterCardNo = $row['card_card_no'];
						$employeeStatus = $row['status'];
						$regDate = $row['registered_date_time'];
						$balance = $row['credit'];
						$getName = "SELECT * FROM NAME WHERE name_id='".$employeeNameId."'";
						$resultName = mysqli_query($con, $getName);
						if(mysqli_num_rows($resultName)!=0){
							while($rowName = mysqli_fetch_array($resultName)){
								$fName = $rowName['first_name'];
								$mName = $rowName['second_name'];
								$LName = $rowName['last_name'];
							}
						}
						$getAddress = "SELECT * FROM address WHERE address_id='".$employeeAddressID."'";
						$resultAddress = mysqli_query($con, $getAddress);
						if(mysqli_num_rows($resultAddress)!=0){
							while($rowAddress = mysqli_fetch_array($resultAddress)){
								$aNo = $rowAddress['address_no'];
								$aLane = $rowAddress['address_lane'];
								$aCity = $rowAddress['address_city'];
							}
						}
						if($employeeStatus == "1"){
							$arr = array('result'=>'SUCCESS','nic'=>$employeeNIC,'cardNo'=>$commuterCardNo,'regDate'=>$regDate,'fName'=>$fName,'mName'=>$mName,'lName'=>$LName,'aNo'=>$aNo,'lane'=>$aLane,'city'=>$aCity,'contact'=>$employeeContact,'balance'=>$balance);
							echo json_encode($arr);
						} else{
							//if user is not active redirect to login page, meet admin error message
							echo "DISABLED";	
						}
					}
				}
			} else {
				//invalid password
				echo "PASSWORD";
			}
		} else {
			//invalid NIC
			echo "NIC";	
		}
	} else {
		//if username or password is empty redirect to login page
		echo "EMPTY";
	}
?>
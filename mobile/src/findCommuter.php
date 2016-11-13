<?php
include_once('../ssi/db.php');
if(!empty($_POST['nic']) || !empty($_POST['amount'])){
	$q = trim($_POST['nic']);
	$getCommuter = "SELECT * FROM commuter WHERE nic='".$q."' AND STATUS='1'";
	$resultCommuter = mysqli_query($con, $getCommuter);
	if(mysqli_num_rows($resultCommuter) != 0){
		while($rowCommuter = mysqli_fetch_array($resultCommuter)){
			$cardNo = $rowCommuter['card_card_no'];
			$nic = $rowCommuter['nic'];
			$nameId = $rowCommuter['name_name_id'];
			$contactNo = $rowCommuter['contact_no'];
			$getName = "SELECT * FROM NAME WHERE name_id='".$nameId."'";
			$resultName = mysqli_query($con, $getName);
			if(mysqli_num_rows($resultName) != 0){
				while($rowName = mysqli_fetch_array($resultName)){
					$fName = $rowName['first_name'];
					$sName = $rowName['second_name'];
					$lName = $rowName['last_name'];
				}
				$arr = array('result'=>'SUCCESS','nic'=>$nic,'cardNo'=>$cardNo,'fName'=>$fName,'mName'=>$sName,'lName'=>$lName,'contact'=>$contactNo);
				echo json_encode($arr);
			} else {
				//if no result to show
				echo "ERROR";		
			}	
		}
	} else {
		//if no result to show
		echo "ERROR";	
	}
} else {
	//empty
	echo "ERROR";	
}
?>
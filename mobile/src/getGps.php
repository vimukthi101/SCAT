<?php
include_once('../ssi/db.php');
if(!empty($_POST['train'])){
	$key = trim($_POST['train']);
	$another = array();
	$query = "SELECT train_train_id, lat, lon FROM gps";
	$result = mysqli_query($con, $query);
	if(mysqli_num_rows($result)!=0){
		while($row = mysqli_fetch_array($result)){
			$trainId = $row['train_train_id'];
			$latitude = $row['lat'];
			$longitude = $row['lon'];
			$list = array('id'=>$trainId, 'lat'=>$latitude, 'lon'=>$longitude,);
			array_push($another, $list);
		}
		$arr = array('result'=>'SUCCESS','list'=>$another);
		echo json_encode($arr);
	} else {
		echo "NODATA";	
	}
} else {
	echo "FAIL";	
}
?>
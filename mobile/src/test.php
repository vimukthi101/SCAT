<?php
$no = '23';
$arr = array('result'=>'SUCCESS','nic'=>$no,'cardNo'=>'456','regDate'=>'2016');
$commuter = array('commuter'=>$arr);
							echo json_encode($commuter);
?>
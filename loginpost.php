<?php
   $con=mysqli_connect("localhost","root","","SCAT");

   if (mysqli_connect_errno($con)) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
	
   $username = $_POST['username'];
   $password = md5($_POST['password']);
   $result = mysqli_query($con,"SELECT * FROM commuter WHERE nic='".$username."' AND PASSWORD='".$password."'");
   if(mysqli_num_rows($result)!=0){
		echo "SUCCESS";
   } else {
		echo "FAILED";   
   }
	
   mysqli_close($con);
?>
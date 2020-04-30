<?php
	include "../../../dbcon/connect.php";
	 $buser = $_GET['q'];
	$sql = "SELECT * FROM  `branches` WHERE `buser`='".$buser."'";
	$result = mysqli_query($con,$sql);
	if(!$result) {
		echo "Error: ".mysql_error($con);
	}
	if (mysqli_num_rows($result)>0) {
		echo "<span style='color:red'>username is already taken</span>";
	}

?>
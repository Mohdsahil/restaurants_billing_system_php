<?php
	include '../../../dbcon/connect.php';
	echo $pid = $_GET['pid'];
	echo $img = $_GET['img'];

	$sql = "DELETE FROM `products` WHERE `pid`='".$pid."'";

	$result = mysqli_query($con,$sql);

	if(!$result)
	{
		echo "<br>Error: ".mysqli_error($con);
	} else {
		$path = "../../../products/".$img;
		unlink($path);
		echo "<script>alert('product is deleted ')</script>";
		echo "<script>window.location.replace('../alldish/')</script>";

	}

?>
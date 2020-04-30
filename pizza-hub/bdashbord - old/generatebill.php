<?php
	include "../../dbcon/connect.php";
	session_start();

	$tmp = "temp".$_SESSION['bid'];
	$sql = "SELECT * FROM `".$tmp."`";
	$result = mysqli_query($con,$sql);
	$table = $_SESSION['bid'];
	$pid='';
	$pname='';
	$tprice=0;
	echo  		"<tr>
	    				<td>P Name</td>
	    				<td>Price</td>
	    				<td>tex.</td>
	    				<td>Total</td>
	    				
	    			</tr>";

	while($row = mysqli_fetch_array($result)) {
		$pid = $pid . $row['pid'].",";
		//$pname = $pname . $row['pname'].",";
		$tprice = $tprice + floatval($row['tprice']); 	
		echo "<tr>
	    				<td>".$row['pid']."</td>
	    				<td>".$row['price']."</td>
	    				<td> 18% gst</td>
	    				<td>".$row['tprice']."</td>
	    			</tr>";
	}	

	echo 	"<tr>
	    				<td>Total</td>
	    				
	    				<td colspan='3'>".$tprice."</td>
	    				
	    			</tr>";

	$sqlb = "INSERT INTO `".$table."`(`pids`, `totalbill`) VALUES ('".$pid."','".$tprice."')";
	if(!mysqli_query($con,$sqlb)) {
		echo "error: ".mysqli_error($con);
	} else {
		$tmp  = "temp".$_SESSION['bid'];
		$sqld = "DROP TABLE `".$tmp."`";
		
		if(!mysqli_query($con,$sqld)){
			echo "Error : ".mysqli_error($con);
		} else {
			//echo "tabel delet";
		}		
	}

?>
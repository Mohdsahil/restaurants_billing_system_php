<?php
	include "../dbcon/connect.php";


function gstcalc(float $p) {
	
	$tp = ($p*(18/100));
	return $tp;
}		
$gst = 0;
$tprice = 0;

	session_start();
	if(isset($_GET['q'])) {
	 $q = $_GET['q'];
	
	$sql = "SELECT * FROM  `products` WHERE `pname` LIKE '".$q."%'";
	$result = mysqli_query($con,$sql);
	if(!$result) {
		echo "Error: ".mysql_error($con);
	}

		//echo '<datalist id="browse">';
	while ($row = mysqli_fetch_array($result)) {
	 		echo "<option >".$row['pname']."</option>";
	 } 
	 //echo '<datalist>';
	 return;
	 }

	 if (isset($_GET['pnm'])) {
	 	 $pname = $_GET['pnm'];

		$sql = "SELECT * FROM  `products` WHERE `pname`='".$pname."'";
		$result = mysqli_query($con,$sql);
		if(!$result) {
		echo "Error: ".mysql_error($con);
		}else {
			$row = mysqli_fetch_array($result);

			
			$gst = gstcalc(floatval($row['price']));
			$tprice  = $gst + $row['price'] ;
			$lnk = $row['pid'] .',"'. $row['pname'] .'",'.$row['price'] .','. $gst.','. $tprice;

			echo "<div class='bdr col'>
		       <img src='../../products/".$row['img']."'>
			</div>
			
			<div class='bdr col'>
			  <p>Pizza Name: ".$row['pname']." </p>
			  <p>Category:  ".$row['category']." </p>
			  <p>Price: ₹ ".$row['price'] ."</p>
			  <p>18% GST: ₹ ".$gst ."</p>
			  <p>Total Price: ₹ ".$tprice   ."</p>
			  <button onclick='addTemp(".$lnk.");'>Add to Bill</button>

			</div>";
		}	 	
	 	$tmp  = "temp".$_SESSION['bid'];
		
		
	$sqlcreat = "CREATE TABLE `".$tmp."` (
tpid INT(13) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
pid INT(30) NOT NULL,
pname VARCHAR(100) NOT NULL,
price VARCHAR(100) NOT NULL,
tprice VARCHAR(100) NOT NULL,
img VARCHAR(200) NOT NULL)";

  if(!mysqli_query($con,$sqlcreat)) {
  	//echo "Error: ".mysqli_error($con);
  }
			

	 	return;
	 }

	 if(isset($_GET['pid'])) {
	 	$tmp  = "temp".$_SESSION['bid'];
	 	$pid = $_GET['pid'];
	 	$pname = $_GET['pname'];
	 	$price = $_GET['price'];
	 	$tprice = $_GET['tprice'];

	 $sql = "INSERT INTO  `".$tmp."` (`pid`, `pname`, `price`,`tprice`) VALUES('$pid','$pname','$price','$tprice') ";
	 if(!mysqli_query($con,$sql)) {
	 		echo "Error: ".mysqli_error($con);
	 }
	 else {
	 	echo  		"<tr>
	    				<td>P Name</td>
	    				<td>Price</td>
	    				<td>18% GST</td>
	    				<td>Total</td>
	    				<td>Remove</td>
	    			</tr>";

	    		$sqltmp = "SELECT * FROM `".$tmp."`";
	    		$result = mysqli_query($con,$sqltmp);
	    		$tp = 0;
	    		while($row = mysqli_fetch_array($result)) {
	    		echo "<tr>
	    				<td>".$row['pname']."</td>
	    				<td>".$row['price']."</td>
	    				<td> gst </td>
	    				<td>".$row['tprice']."</td>
	    				<td></td>
	    			</tr>";
	    			$tp = $tp + $row['tprice'];
	    			}	
 
	    	echo 	"<tr>
	    				<td>Total</td>
	    				
	    				<td colspan='3'>".$tp."</td>
	    				<td></td>
	    			</tr>";	
	 }
	 return;
	}

	if(isset($_GET['delet'])) {

	 	$tmp  = "temp".$_SESSION['bid'];
		$sql = "DROP TABLE `".$tmp."`";
		
		if(!mysqli_query($con,$sql)){
			echo "Error : ".mysqli_error($con);
		} else {
			echo "tabel delet";
		}
	}
?>
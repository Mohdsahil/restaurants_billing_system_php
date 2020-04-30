<?php declare(strict_types=1);
	include "../dbcon/connect.php";
	
	session_start();

	if (!isset($_SESSION['bid'])) {
		header('location: ../');
	}
	$last_id = '';
	if(isset($_POST['submit']) && $_POST['pid']!='' && $_POST['tprice']!='') {
		$sql = "insert into billing_table (`branch_id`, `products_id`, `total_bill`) values('".$_SESSION['bid']."','".$_POST['pid']."', '".$_POST['tprice']."')";

		if(!mysqli_query($con, $sql)) {
			echo "Error: ".mysqli_error($con);
		}else {
			$last_id = mysqli_insert_id($con);
 			echo "<script> window.print()</script>";
		}

	}




	$tmp = "temp".$_SESSION['bid'];

 

	if(isset($_GET['srch'])) {
		$pname = $_GET['srch'];

		$sql = "SELECT * FROM  `products` WHERE `pname` LIKE'".$pname."%'";
		$result = mysqli_query($con,$sql);
		if(!$result) {
			echo "Error: ".mysqli_error($con);
		}
		$row = mysqli_fetch_array($result);
		// print_r($row);
	} 


// function gstcalc(float $p) {
	
// 	$tp = ($p*(18/100));
// 	return $tp;
// }		 
	
$sql = "select * from products";
$result = mysqli_query($con,$sql);
if(!$result) {
	echo "error: ".mysqli_erro($con);
}


?>








<!DOCTYPE html>
<html>
<head>
	<title>pizzahub | Dashbord</title>
	<link rel="stylesheet" href="../css/style.css">

	</style>
</head>
<body>

<header>
	
		<nav class="b-nav search">
			
			 <ul>
				 <!-- <li><a href="javascript:void(0)" id="open">&#9776;</a></li>	 -->
				 <li>
				<form>	
				 <input type="search" name="srch" class="search-input" placeholder="pizza name" id="">
				</form>
			   </li>
				 <li>
					 <input type="text" src="" disable alt="" value="Bill Id: <?php
					  if(empty($last_id))
					   			echo "";
						else echo $last_id;
						?>">
				 </li>	
			 </ul>
			 <a href="./logout/">logout</a>
			 
		</nav>
</header>
<div class="main">	
<aside id="addsidebar">
	<table id="cart-products">
		<tr>
			<th>PID</th>
			<th>NAME</th>
			<th>PRICE</th>
			<th>ACTION</th>
		</tr>

	</table>
	<hr>
	<table id="total-bill">
		<tr id="total">
			<td>Total</td>
			<td>+ gst</td>
			<td>0</td>
		</tr>
		<tr>
			<td colspan="3">
				<!-- <button id="bill-paid">Bill Paid</button> -->
				<form action="" id="bill-form" method="post">
	<input type="hidden" id="pid" name="pid">
	<input type="hidden" id="tprice" name="tprice">
	<button id="bill-paid" name="submit">Bill Paid</button>
</form>
			</td>
		</tr>
	</table>
	
</aside>
	<div class="" id="products">
		
	</div>
</div>	


<script src="../script/jquery-3.5.0.js"></script>
	<!-- <script src="../../scriptscript.js"></script> -->
	<script>

fetch_all_products()
			
			
      	$('#addsidebar').animate({
					height:"500px"		
            })

				
					

			$(document).on('click','.product-item',function() {
				
				var product_id = $(this).data('pid');
				
				var product_name = $(this).data('pname');
				var price = $(this).data('price');
				var tr = '<tr id="tr_delete_'+product_id+'" data-pid="'+product_id+'" data-pname="'+product_name+'" data-price="'+price+'"><td>'+product_id+'</td><td>'+product_name+'</td><td>Rs. '+price+'/-</td>			<th><a href="javascript:void(0)" class="btn-delete" id="delete_'+product_id+'">Remove</a></th></tr>';
				

				$('#cart-products tbody').append(tr);
				

				total_bill()
			});	

			function total_bill() {

				var trows = $('#cart-products tbody tr')
				var tpid =''
				var tprice = 0;
				$('#cart-products tbody tr').each(function(index) {
				if($(this).data('pid')!=undefined) {
					// console.log(index+" : " + $(this).data('pid'))
					tprice += $(this).data('price')
					tpid += $(this).data('pid')+','
				}
				});
				tprice += gstcalc(tprice)
				$('#total').html("<td>Total</td><td>+18%gst</td>	<td data-tprice='"+tprice+"'>Rs. "+tprice+"/-</td>")
				
				$('#pid').val(tpid);
				$('#tprice').val(tprice);
			}

			function gstcalc(p) {
				var tp = (p*(18/100));
				return tp;
			}	

			$(document).on('click','.btn-delete', function() {
				var did = $(this).attr('id')
				
				$("#tr_"+did).remove()
				total_bill()
			})

			$(document).on('click','#bill-paid', function() {
					var bill = $('#total-bill #bill td:first').html()
					console.log(bill)
			})

			function fetch_all_products() {
				
				var xmlhttp = new XMLHttpRequest();
      			  xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
                document.getElementById("products").innerHTML = this.responseText;
          	  }
        	};
       		 xmlhttp.open("POST", "./fetch/fetch_all_products.php", true);
      	 	 xmlhttp.send();
			}

					

	</script>
</body>
</html>
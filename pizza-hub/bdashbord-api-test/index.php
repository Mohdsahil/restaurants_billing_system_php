<?php
	 include '../dbcon/config.php';
	
session_start();

if (!isset($_SESSION['bid'])) {
	header('location: ../');
}
$last_id = '';
if(isset($_POST['submit']) && $_POST['pid']!='' && $_POST['tprice']!='') {

	$data = [
		"branch_id"    =>  $_SESSION['bid'],
		"products_id"  =>  $_POST['pid'],
		"total_bill"   =>  $_POST['tprice']
	];
	$curl = curl_init($addbill_url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($curl, CURLOPT_HTTPHEADER, [
		'Content-type:application/json'
	]);

	$response = curl_exec($curl);
        curl_close($curl);
		  $res = json_decode($response);
		  
			$data = $res->data;
			
		$last_id = $data->insertId;
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
					
				 <input type="search" name="search" id="search" class="search-input" placeholder="pizza name" id="">
				
			   </li>
				 <li>
					 <input type="text" src="" disabled alt="" value="Bill Id: <?php
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

			$('#search').keypress(function(evt) {
					var keyCode = (event.keyCode ? event.keyCode : event.which)
					if(keyCode == "13" && $(this).val!='') {
							fetch_single_product($(this).val())
					}
			})

			function fetch_all_products() {
				
				var xmlhttp = new XMLHttpRequest();
      			  xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
                document.getElementById("products").innerHTML = this.responseText;
          	  }
        	}
       		 xmlhttp.open("POST", "./fetch/fetch_all_products.php", true);
      	 	 xmlhttp.send();
			}

			function fetch_single_product(pname){
				
				var xmlhttp = new XMLHttpRequest() 
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
					document.getElementById("products").innerHTML = this.responseText;
				}
			  }
			  xmlhttp.open("GET", "./fetch/fetch_single_product.php?pname="+pname, true);
      	 	 xmlhttp.send();
			}
							

	</script>
</body>
</html>
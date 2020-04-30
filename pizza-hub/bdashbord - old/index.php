<?php declare(strict_types=1);
	include "../dbcon/connect.php";
	
	session_start();

	if (!isset($_SESSION['bid'])) {
		header('location: ../../');
	}

	$tmp = "temp".$_SESSION['bid'];

 

	if(isset($_GET['srch'])) {
		$pname = $_GET['srch'];

		$sql = "SELECT * FROM  `products` WHERE `pname`='".$pname."'";
		$result = mysqli_query($con,$sql);
		if(!$result) {
			echo "Error: ".mysqli_error($con);
		}
		$row = mysqli_fetch_array($result);

	} else {
		$row['pid'] = "";
		$row['pname'] = "";
		$row['price'] = "0";
		$row['pid'] = "";
		$row['category'] = "";
		$gst = 0; 
		$tprice = 0;

	}


function gstcalc(float $p) {
	
	$tp = ($p*(18/100));
	return $tp;
}		 
		 
?>








<!DOCTYPE html>
<html>
<head>
	<title>pizzahub | Dashbord</title>
	<style type="text/css">
		body {
			margin: 0;
			padding: 0;
		}
		table {
			border: 1px solid #000;
			width: 100%;
		}
		table tr td {
			border:  1px solid #000;
		}

		.bdr {
			border:1px dotted #000;
		}

		.bord {
			width: 100%;
			display: inline-flex;

		} 

		.bord .inner-bord {
			display: inline-flex;
		}

		.bord .col {
			width: 50%;
		} 
		.bord .inner-bord .col {
			width: 50%;
		}


	</style>
</head>
<body>


	<br>
		Search: <input list="browse" type="text" onkeyup="chkpro(this.value);" id="srch" name="srch">

			<datalist id="browse">
  
			</datalist>
			<button onclick="search();">search</button>
	
	<a href="../logout/" style="float: right;">logout</a>

	<div class="bord">
		
		<div class="inner-bord col" id="srchresult">
			<div class="bdr col">
		       <img src="../../products/<?php echo $row['img']?>">
			</div>
			
			
	    </div> 

	    <?php
	    	$sqltmp = "SELECT * FROM `".$tmp."`";
	    	$result = mysqli_query($con,$sqltmp);

	    ?>
	    <div class="col" id="bill">
	    	<div class="bdr">
	    		<table id="tbl">
	    			
	    				
	    		</table>
			  
			  

			  <button onclick="genBill();">Generate Bill</button>	    		
	    	</div>
	    </div>
		
	</div>	
	<button style="float: right;" onclick="cancel()">cancel</button>

	<script type="text/javascript">
		function search() {
			var srch = document.getElementById('srch').value;
			console.log(srch);
			if (srch.length == 0) {
				document.getElementById('srchresult').innerHTML = "";
			} else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("srchresult").innerHTML = this.responseText;
            }
        }
    	    xmlhttp.open("GET", "gethint.php?pnm="+srch , true);
        	xmlhttp.send();
    
		}

	}



		function chkpro(str) {
			if(str.length == 0) {
				document.getElementById('browse').innerHTML = "";
				return;
			} else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("browse").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "gethint.php?q=" + str, true);
        xmlhttp.send();
    
		}
	}

	function addTemp(pid,pname,price,gst,tprice) {
		

		if(pname.length == 0) {
				document.getElementById('tbl').innerHTML = "";
				return;
			} else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("tbl").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "gethint.php?pid=" + pid+"&pname="+pname+"&price="+price+"&gst="+gst+"&tprice="+tprice, true);
        xmlhttp.send();
    
		}
		
	}


	function genBill() {
		window.print();
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("tbl").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "generatebill.php", true);
        xmlhttp.send();

	}


	function cancel() {
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("tbl").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "gethint.php?delet=yes" , true);
        xmlhttp.send();
	}


	</script>

</body>
</html>
<?php
		session_start();
	if(!isset($_SESSION['aid'])) {
		header('location:../../');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>pizza hub | dashbord</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="../../css/style.css">
</head>
<body>
	<header>
		<nav class="nav">
			 <ul>
				 <li><a href="#" id="open">=</a></li>	
				 <li><a href="javascript:void(0)">Dashbord</a></li>	
			 </ul>
			 
		</nav>
	</header>
	<div class="main">
	<aside id="sidebar">
	<ul >
		<li>
			<a href="addnewdish/">Add New Dish</a>
		</li>
		<li>
			<a href="alldish/">All Dish</a> <!-- update, remove option are availabel --> 
		</li>
		<li>
			<a href="addnewbranch/">Add New Branch</a>
		</li>
		<li>
			<a href="allbranch/">All Branch</a>
		</li>
		<li>
		<a href="../../logout/" >logout</a>

		</li>
	</ul>
	</aside>
	<!--  main  content -->
	<div class="content">
	<h1 class="text-center">Welcome to dashbord</h1>
		<div class="menu">
			<div class="menu-item"><a href="addnewdish/">Add New Dish</a></div>
			<div class="menu-item"><a href="alldish/">All Dish</a></div>
			<div class="menu-item"><a href="addnewbranch/">Add New Branch</a></div>
			<div class="menu-item"><a href="allbranch/">All Branch</a></div>
		</div>
	</div>
</div>

	<script src="../../script/jquery-3.5.0.js"></script>
	<!-- <script src="../../scriptscript.js"></script> -->
	<script>
				$('#sidebar').animate({
					height:window.innerHeight
				})

		$('#open').click(()=> {
			var sidebar = $('#sidebar').css('width');
			
			
			if(sidebar == "280px") {

				$('#sidebar ul').animate({
					opacity:0
				},()=>{
				$('#sidebar').animate({
					width:"10px"
				},1000)
				});
			}else {
				$('#sidebar').animate({
					width:"280px"
				},1000,()=> {
					$('#sidebar ul').animate({
						opacity:1
				},500)
				})
				
			}		
		})
	</script>
	
</body>
</html>
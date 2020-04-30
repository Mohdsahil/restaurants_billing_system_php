<?php
    include '../../../dbcon/connect.php';
    

    
	if(isset($_POST['submit'])) {
		$sql = "select * from branches where bid='".$_POST['bid']."'";
		$result = mysqli_query($con,$sql);
	}else {
		$sql = "SELECT * FROM branches";
    $result = mysqli_query($con,$sql);
	}
    
?>


<!DOCTYPE html>
<html>
<head>
	<title>pizza hub | all dish</title > 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../../../css/style.css">   

	<style type="text/css">
		
	</style>
</head>
<body>
	
<header>
		<nav class="nav">
			 <ul>
				 <li><a href="#" id="open">&#9776;</a></li>	
				 <li><a href="javascript:void(0)">Dashbord</a></li>	
			 </ul>
			 
		</nav>
	</header>
	<div class="main">
	<aside id="sidebar">
	<ul >
		<li>
			<a href="../addnewdish/">Add New Dish</a>
		</li>
		<li>
			<a href="../alldish/">All Dish</a> <!-- update, remove option are availabel --> 
		</li>
		<li>
			<a href="../addnewbranch/">Add New Branch</a>
		</li>
		<li>
			<a href="../allbranch/">All Branch</a>
		</li>
		<li>
		<a href="../../logout/" >logout</a>

		</li>
	</ul>
	</aside>
	<!--  main  content -->
	<div class="content">
	<h1>all dishes | update or remove</h1>

	<div class="search">
		<form action="" method="post">  
		<table>
			<tr>
				<td>
		<input type="search" name="bid" placeholder="Branch Id" class="search-input"  >
				</td>
				<td>
		<button class="show-all"  name="submit" >Find</button>
				</td>
			</tr>
		</table>
		</form>

	</div><br><br>

	<div class="branchs">
	<table>
			<tr class="">
				
				<th>Branch Id</th>
				<th>Manager</th>
				<th>Phone</th>
				<th>Email</th>
				<th>address</th>
				<th>Action</th>
				

			</tr>
			<?php $j=1;
			while($row = mysqli_fetch_assoc($result)) { ?>
			<tr >
				
				<td><?php echo $row['bid']?></td>
				<td><?php echo $row['bmanagername']?></td>
				<td><?php echo $row['bphone']?></td>
				<td><?php echo $row['bmanageremail']?></td>
				<td><?php echo $row['baddress']?></td>
				<td><a href="javascript:void(0)" class="btn-delete" onclick="myfun(<?php echo $row['pid']; $i = $row['img'];?>, '<?php echo $i;?>');">delet</a>  <a href="edit.php?pid=<?php echo $row['pid']?> " class="btn-edit">edit</a> </td>
			</tr>
		<?php } ?>
		</table>
	</div>
		
	</div>
</div>

	<script src="../../../script/jquery-3.5.0.js"></script>
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

      $('#round').click(()=> {
       $('#pizza-img').click()
       
      })

   
    
	</script>



</body>
</html>
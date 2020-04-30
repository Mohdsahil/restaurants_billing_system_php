<?php 
include '../../../dbcon/connect.php';
error_reporting(0);
session_start();
if(!isset($_SESSION['aid']))
{
  header("Location: ../../../"); 
}

if(isset($_POST['submit'])) {

$pname = $_POST['name'];
$category = $_POST['category'];

$sql = "SELECT * FROM `products` WHERE `category`='".$category."' AND `pname` LIKE '%".$pname."%'";
$result = mysqli_query($con,$sql);
if(!$result) 
	echo "Error: ".mysqli_error($con);
} else {

	$sql = "SELECT * FROM `products`";
	$result = mysqli_query($con,$sql);
	if(!$result) 
		echo "Error: ".mysqli_error($con);
	}

// if(isset($_POST['submit'])) {
// 	$sql = "SELECT * FROM `products` ";
// 	$result = mysqli_query($con,$sql);
// 	if(!$result) 
// 		echo "Error: ".mysqli_error($con);
// 		$_POST['submit'] = "";
// }

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
	<!-- <h1>all dishes | update or remove</h1>
    <a href="../../../logout/" style="float: right;">logout</a>
	
		<form action="" method="post">
			<input type="text" name="srch"> 
			<input type="submit"  name="submit"> <br><br><br>
	 </form>
	<div id="products">
		<table>
			<tr>
				<td>image</td>
				<td>category</td>
				<td>name</td>
				<td>price</td>
				<td>delet</td>
				<td>edit</td>

			</tr>
			
		</table>
	</div> -->

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
				<td >
			<select name="category" class="category" id="">
				
				<option>veg</option>
				<option>non-veg</option>
			</select>
				</td>
				<td>
		<input type="search" name="name" placeholder="pizza name" class="search-input"  >
				</td>
				<td>
		<button class="show-all"  name="submit" >Find</button>
				</td>
			</tr>
		</table>
		</form>

	</div><br><br>

	<div class="dishs">
	<table>
			<tr class="bdr">
				<th>srno.</th>
				<th>image</th>
				<th>category</th>
				<th>name</th>
				<th>price</th>
				<th>Action</th>
				

			</tr>
			<?php $j=1;
			while($row = mysqli_fetch_assoc($result)) { ?>
			<tr >
				<td><?php echo $j++; ?></td>
				<td>  <img src="../../../products/<?php echo $row['img']?>" style="width: 200px;border-radius: 105px;"></td>
				<td><?php echo $row['category']?></td>
				<td><?php echo $row['pname']?> </td>
				<td> <?php echo $row['price']?></td>
				<td> <a href="javascript:void(0)" class="btn-delete" onclick="myfun(<?php echo $row['pid']; $i = $row['img'];?>, '<?php echo $i;?>');">delet</a>  <a href="edit.php?pid=<?php echo $row['pid']?> " class="btn-edit">edit</a> </td>
				
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
	

<script>

function myfun(pid,img) {
	console.log(pid);
  var txt;
  var r = confirm("do you wand to delet this product!!");
  if (r == true) {
    window.location.replace("delet.php?pid="+pid+"&img="+img);
  } else {
    txt = "You pressed Cancel!";
  }

}
</script>

</body>
</html>
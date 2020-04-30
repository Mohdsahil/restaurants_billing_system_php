<?php 
include '../../../dbcon/connect.php';
error_reporting(0);
session_start();
if(!isset($_SESSION['aid']))
{
  header("Location: ../../../"); 
}

$err['img']='';

if(isset($_FILES['image']) ){

      $errors = array();
      $path = "../../../products/";
      $file_name = $_FILES['image']['name'];
      $file_size = $_FILES['image']['size'];
      $file_tmp = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$file_name)));
      
      $pname = $_POST['name'];
      $price = $_POST['price'];      
      $category = $_POST['category'];      
      
      $extensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152) {
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true) {
         if(!empty($_POST['name']) && !empty($_POST['price']) && $_POST['category']!="select") {
            $path .= $file_name;
            move_uploaded_file($file_tmp,$path);
             $query = "INSERT INTO `products`(`pname`,`category`,`price`,`img`) VALUES ('$pname', '$category', '$price', '$file_name')"; 
             if(mysqli_query($con, $query))
            echo "<script> alert('The product is added')</script>";
              else echo "Error: ".mysqli_error($con);
         }else {
               if(empty($_POST['name'])) {
                  $err['name'] = "<span class='err'>*Name should not be empty</span>";
               }
               if(empty($_POST['price'])) {
                  $err['price'] = "<span class='err'>*price should not be empty</span>";
               }
               if($_POST['category']=="select") {
                  $err['category'] = "<span class='err'>*Select a Category</span>";
               }
            
         }
        
      }else{
         // print_r($errors);
            $err['img'] = "<span class='err'>*".$errors[0]."<span>";

      }
   } else{
      $err['img'] = "<span class='err'>*please choose image</span>";
   }

?>



<!DOCTYPE html>
<html>
<head>
	<title>pizza hub | add new  dish</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="../../../css/style.css">   
</head>
<body>
	<!-- <h1>add new dish</h1>
    <a href="../../../logout/" style="float: right;">logout</a>
  
		<form method="post" enctype="multipart/form-data">
			pizza img: <input type="file" name="image"> <br><br>
      Category: <select name="category">

          <option>veg</option>
          <option>non-veg</option>
      </select><br><br>
			pizza name: <input type="text" name="name"> <br><br>
			pizza price: <input type="text" name="price"> <br><br>
		 	<input type="submit" name="submit"> <br>
      </form> -->
      
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
	
		<div class="add-form">
         <form action="" method="post" enctype="multipart/form-data">
         <h2 class="text-center">Add New Pizza Item</h2>
            <div class="form-group">
   			    <label for="username" >Image: </label>	
                <input type="file" class="form-control" id="pizza-img" name="image">
                <span id="round">select img:</span><br>
                <?php
                  if($err['img']!="") {
                     echo $err['img'];
                  }
                ?>
            </div>
            <div class="form-group">
               <label for="">Category</label>
               <select name="category"  class="form-control">
                  <option>select</option>
                  <option>Veg</option>
                  <option>Non-Veg</option>
               </select>
               <?php
                  if($err['category']!="") {
                     echo $err['category'];
                  }
                ?>
            </div><br>
            <div class="form-group">
   			   <label for="username" >Pizza name: </label>	
               <input type="text" class="form-control" name="name">
               <?php
                  if($err['name']!="") {
                     echo $err['name'];
                  }
                ?>
            </div><br>
            <div class="form-group">
   			   <label for="username" >Price: </label>	
               <input type="text" class="form-control" name="price">
               <?php
                  if($err['price']!="") {
                     echo $err['price'];
                  }
                ?>
            </div><br>
            <div class="form-group">
            <input type="submit" class=" btn-add"  name="submit">
            </div>
         </form>
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
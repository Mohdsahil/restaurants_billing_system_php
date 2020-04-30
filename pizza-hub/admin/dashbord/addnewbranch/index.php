<?php
	include "../../../dbcon/connect.php";
    session_start();
    if(!isset($_SESSION['aid'])) {
        header('location:../../../');
    }
	$err['address'] = '';
	$err['bphone'] = '';
	$err['bmanagerename'] = '';
	$err['bmanageremail'] = '';
	$err['buser'] = '';
	$err['password'] = '';

	$succ['bid'] ='' ;
	$succ['btable'] ='' ;

	if(isset($_POST['submit'])) {

		$address = $_POST['address'];
		$phone = $_POST['bphone'];
		$bmanagerename = $_POST['bmanagerename'];
		$bmanageremail = $_POST['bmanageremail'];
		$buser = $_POST['buser'];
		$password = $_POST['password'];

		if(!empty($_POST['address']) && !empty($_POST['bphone']) && !empty($_POST['bmanagerename']) && !empty($_POST['bmanageremail']) && !empty($_POST['buser']) && !empty($_POST['password'])) {

			$sql = "INSERT INTO `branches`(`baddress`, `bphone`, `bmanagername`, `bmanageremail`, `buser`, `bpassword`) VALUES ('$address', '$phone', '$bmanagerename', '$bmanageremail', '$buser', '$password')";
     	if(mysqli_query($con,$sql)) {
	 				
			echo "new branch is created";
     	}
     	else {
     		echo "error: ".mysqli_error($con);
     	}

		} else {
				if(empty($_POST['address'])) {
					$err['address'] = "<span class='err'>*address not be empty</span>";
				}
				if(empty($_POST['bphone'])) {
					$err['bphone'] = "<span class='err'>*phone no. not be empty</span>";
				}if(empty($_POST['bmanagerename'])) {
					$err['bmanagerename'] = "<span class='err'>*manager name not be empty</span>";
				}if(empty($_POST['bmanageremail'])) {
					$err['bmanageremail'] = "<span class='err'>*email not be empty</span>";
				}if(empty($_POST['buser'])) {
					$err['buser'] = "<span class='err'>*please choose username</span>";
				}if(empty($_POST['password'])) {
					$err['password'] = "<span class='err'>*password not be empty</span>";
				}
		}


     	
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>pizza hub | add new branch</title>
	<link rel="stylesheet" href="../../../css/style.css">   

</head>
<body>
	<!-- <h1>add new branch</h1>
    <a href="../../../logout/" style="float: right;">logout</a>

	<form action="" method="post">
		Branch address: <textarea name="address" placeholder="address" rows="3" cols="20"></textarea> <br><br>
		Branch phone: <input type="text" name="bphone"  onkeypress="return ValidateNum(event);" placeholder="phone" /><br><br>
		branch Manager Name: <input type="text" name="bmanagerename" maxlength="10" placeholder="Manager Name"/><br><br>
		branch Manager Email: <input type="text" name="bmanageremail"><br><br>
		Create User name: <input type="text" name="buser" onkeyup="checkuser(this.value);" placeholder="User name"><br><br>
		<div id="uerr">
			
		</div>
		Create Password: <input type="text" name="password" placeholder="password"><br><br>
		<input type="submit" name="submit">
	</form> -->

	<header>
		<nav class="nav">
			 <ul>
				 <li><a href="avascript:void(0)" id="open">&#9776;</a></li>	
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
	<?php
		if($succ['bid']!="") {
			echo '<table>
				<tr>
					<td>bid: '.$succ['bid'].'</td>
					<td>btable: '.$succ['btable'].'</td>
				</tr>
			</table>';
		}
	?>
		<div class="add-form">
         <form action="" method="post" enctype="multipart/form-data">
         <h2 class="text-center">Add New Branch</h2>
            <div class="form-group">
   			    <label for="username" >Branch Address: </label>	
				   <textarea name="address" class="form-control" placeholder="address" rows="3" cols="20"></textarea>
				<?php
					if($err['address']!="") {
						echo $err['address'];
					}
				?>
               
            </div><br>
            <div class="form-group">
               <label for="">Branch Phone:</label>
               <input type="text" class="form-control" name="bphone" maxlength="10" onkeypress="return ValidateNum(event);" placeholder="phone" />
			   <?php
					if($err['bphone']!="") {
						echo $err['bphone'];
					}
				?>
            </div><br>
            <div class="form-group">
   			   <label for="username" >Branch  manager Name: </label>	
			   <input type="text" class="form-control" name="bmanagerename"  placeholder="Manager Name"/>
               <?php
					if($err['bmanagerename']!="") {
						echo $err['bmanagerename'];
					}
				?>
            </div><br>
            <div class="form-group">
   			   <label for="username" >Branch manager Email: </label>	
			   <input type="text" class="form-control" name="bmanageremail" placeholder="Email">
			   <?php
					if($err['bmanageremail']!="") {
						echo $err['bmanageremail'];
					}
				?>
			</div><br>
			<div class="form-group">
			<label for="username" >Create User Name: </label>	
			<input type="text" name="buser" class="form-control" onkeyup="checkuser(this.value);" placeholder="User name">
			<?php
					if($err['buser']!="") {
						echo $err['buser'];
					}
				?>
			<div id="uerr">
			
			</div>
			</div><br>
			<div class="form-group">
				<label for="password">Create Password:</label>
				<input type="password" name="password"  class="form-control" placeholder="password">
				<?php
					if($err['password']!="") {
						echo $err['password'];
					}
				?>
			</div><br>
            <div class="form-group">
            <input type="submit" class="btn-add"  name="submit">
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

	<script type="text/javascript">
		
		function checkuser(str) {
			if (str.length == 0) {
        document.getElementById("uerr").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("uerr").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "gethint.php?q=" + str, true);
        xmlhttp.send();
    }
		}

		function ValidateNum(evt)
    	{	
        var keyCode = (evt.which) ? evt.which : evt.keyCode
        if ((keyCode < 48 || keyCode > 57) )
         
        return false;
            return true;
    	}
    	

	</script>
</body>
</html>
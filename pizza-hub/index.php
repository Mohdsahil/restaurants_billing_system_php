<?php
	include "./dbcon/connect.php";
	include "./functions/functions.php";
		session_start();
		
	
	$err='';
	if(isset($_POST['submit']) && isset($_POST['user']) && isset($_POST['password'])) {
		
		 $sql = "SELECT * FROM `branches` WHERE `buser`='".$_POST['user']."' AND `bpassword`='".$_POST['password']."'";
		 $result = mysqli_query($con,$sql);
		 if(!$result) {
		 	echo "erro: ".mysql_error($con);
		 }


		 if(mysqli_num_rows($result)>0) {
		 	echo "successfully login";
		 	$row = mysqli_fetch_array($result);
		 	echo $_SESSION['bid'] = $row['bid'];
		 	header("location: bdashbord-api-test/");
		 }else {
			 $err = "<span class='text-danger text-center'>please enter correct username or password </span><br>";
		 } 
		 	
	}
?>



<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./css/style.css">
</head>
<body >



<!-- brance login -->
<div class="login-body">
<div class="login-form"  >
<h1 class="text-center text-white">branch login</h1>
<form action="" method="post">
		<div class="form-group">
			<label for="username" >user: </label>	
	 		<input type="text" name="user" placeholder="username"/><br>
		</div>
		<div class="form-group">
			<label for="username">Password: </label>
			 <input type="password" name="password" placeholder="password" 
			 /><br>
			
		</div>
		<?php
			if($err!='') {
				echo $err;
			}
		?>
		<div class="from-group">
			<input type="submit" name="submit" class="btn-submit">
		</div>
</form>
</div>
</div>

</body>
</html>
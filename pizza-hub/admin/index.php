<?php
	include "../dbcon/connect.php";
	include "../functions/functions.php";
		session_start();
		
	
$err = "";
	if(isset($_POST['submit']) && isset($_POST['user']) && isset($_POST['password'])) {
		
		 $sql = "SELECT * FROM `admin` WHERE `user`='".$_POST['user']."' AND `password`='".$_POST['password']."'";
		 $result = mysqli_query($con,$sql);
		 if(!$result) {
		 	echo "erro: ".mysql_error($con);
		 }else {
		 	echo "query  is run";
		 }
		 if(mysqli_num_rows($result)>0) {
		 	echo "successfully login";
		 	$row = mysqli_fetch_array($result);
		 	 $_SESSION['aid'] = $row['id'];
		 	header("location: dashbord/");
		 }else 
		 	echo "login id is invalid";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<!-- 
<h3>admin login</h3>
<form action="" method="post">
	user: <input type="text" name="user"/><br>
	password: <input type="text" name="password"/><br>
	<input type="submit" name="submit">
</form><br><br>
<hr> -->
<div class="admin-body">
<div class="login-form"  >
<h1 class="text-center text-white">Admin</h1>
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
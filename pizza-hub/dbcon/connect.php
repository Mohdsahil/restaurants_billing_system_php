<?php

	define("server", "localhost");
	define("user", "root");
	define("pass", "");
	define("db", "pizzabub_db");

	$con = mysqli_connect(server,user,pass,db);
	if(!$con){
		echo "erro: ".mysql_error($con);
	}else {
		// echo "connected";
	}
	


?>
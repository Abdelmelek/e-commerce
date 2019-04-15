<?php

	$dsn = 'mysql:host=localhost;dbname=ecmrc';
	$user = 'root';
	$pass = 'melek';
	$options = array( 
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', 
		
		);

	try{
		$con = new PDO($dsn, $user, $pass,$options);
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo 'you are connected';
		//echo '<br>';

	}
	catch(PDOException $e){
		echo 'failed to connect' . $e->getMessage();
	}
?>

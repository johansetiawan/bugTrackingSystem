<?php
	
	 
		$hostname = 'localhost';
		$username = 'root';
		$userpassword = '';
		$_database = 'roger_db';
		$seed = (!empty($_POST['seed'])) ? true : false ;
		
		if (!empty($hostname)&&!empty($username)&&!empty($_database)) {
			$userpassword = ($userpassword == "null") ? null : $userpassword ;
			$data = [
				'host' => $hostname,
				'root' => $username,
				'pass' => $userpassword,
				'db' => $_database,
			];
			$file = fopen("app/app.config","w");
			fwrite($file,json_encode($data));
			fclose($file);
			$link = mysqli_connect($hostname, $username, $userpassword); 
			$queryDB = "CREATE DATABASE IF NOT EXISTS ".$_database; 
			mysqli_query($link, $queryDB); 
			mysqli_select_db($link, $_database);
    		header('location:index.php');
		}
?>
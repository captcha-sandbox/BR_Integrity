<?php
/*function sql_connect($database) {
	$connection = mysql_connect('localhost','root','root');
		if(!$connection) {
			die("Database Connection Failed: ".mysql_error());
		}
	mysql_select_db($database);
}*/
	$servername = "localhost";
	$username = "root";
	$password = "root";

	try {
		$conn = new PDO("mysql:host=$servername;dbname=information_schema", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo "Connected successfully";
	}
	catch(PDOException $e)
	{
		echo "Connection failed: " . $e->getMessage();
	}
?>
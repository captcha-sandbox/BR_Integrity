<?php
	require('sql_connect.inc');

	$params = $_POST['dynamic'];
	$i = 0;
	$order = 1;
	// foreach ($params as $value) {
	// 	echo $value." ";
	// }
	while ($i<sizeof($params)-1) {
		//echo $params[$i]."\n";

		$param_value = $params[$i].".".$params[$i+1]." ".$params[$i+2]." ".$params[$i+3].".".$params[$i+4];
		$member = sizeof($params)/6;

		echo $param_value."<br>";
		echo $member."<br>";
		echo $order."<br>";
		$order++; 
		$i = $i + 6;
	}

	$conn = null;
?>
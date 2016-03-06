<?php
	require('sql_connect.inc');

	$params = $_POST['answers'];
	for($i=0; $i<sizeof($params); $i++) {
		echo $params[$i]."\n";
	}

	$conn = null;
?>
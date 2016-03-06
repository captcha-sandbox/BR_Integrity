<?php
	include "classes.inc";

	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "praktikum";

	function validateStatus($nim, $conn) {
		$stmt = $conn->prepare("SELECT nilai FROM mengambil WHERE nim = $nim");
		$stmt->execute();

		$result = $stmt->fetchAll();
		$avg = 0;
		for($i=0; $i<$stmt->rowCount(); $i++) {
			$avg+=$result[$i]['nilai']; 
		}
		//echo("NR = ".$avg/4);
		if(($avg/4) < 2) {
			echo ("Mahasiswa ".$nim." tidak boleh mengambil lebih dari 22 SKS");
		}
	}
	/*
	try {
		$conn = new PDO("mysql:host=$servername;dbname=praktikum", $username, $password);
		
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
		echo "Connected successfully \n";

		$stmt = $conn->prepare("SELECT nim, status FROM daftar_ulang WHERE status = 'boleh'");
		$stmt->execute();

		$temp = array();

		$result = $stmt->fetchAll();
		for($i=0; $i<$stmt->rowCount(); $i++) {
			//echo($result[$i]['nim'])." ";
			//echo($result[$i]['status']);
			$temp[$i] = $result[$i]['nim'];
			print("\n");
		}
		
		foreach($temp as $nim) {
			echo $nim."\n";
			validateStatus($nim, $conn);
		}
	
	}catch(PDOException $e) {
		echo "Connection failed: ".$e->getMessage();
	}

    $conn = null */

    $br = new BusinessRule();
    $cond = new Condition();
    $br->getBusinessRule('syarat_daftar_ulang');
    $br->getConditions('syarat_daftar_ulang');
    $conditions = $br->showConditions();
    echo $br->getSource()."\n";
    
    if(is_array($conditions)) {
	    foreach($conditions as $condition) {
	    	$id = $condition->getConditionId();
		    //echo $id."\n";
		    $condition->getParameters($id);
		}
	}

	//echo $conditions[0]->getSource();
	$test = $conditions[0]->showParameters();
	//echo sizeof($test);
	/*
	if(is_array($test)) {
		foreach ($test as $param) {
			if($param->getConjType() == "") {
				echo $param->getParamValue()."\n";
			}
			else {
				echo $param->getConjType()." ".$param->getParamValue()."\n";
			}
		}
	} */

	//Begin first condition
	$table = new Table();
	$source = $table->getTable($br->getSource());
	unset($table);
	$first = "";

	if(is_array($conditions)) {
	    foreach($conditions as $condition) {
	    	if($condition->isOrdered()) {
	    		$first = $condition;
	    	}
		}
	}
	$params = "";
	$temp = $first->showParameters();

	for($i=0; $i<sizeof($temp); $i++) {
		if($temp[$i]->isOrdered()) {
			$params = $params.$temp[$i]->getParamValue()." ";
		}
		else {
			$params = $params." ".$temp[$i]->getConjType()." ".$temp[$i]->getParamValue()." ";	
		}
	} 
	$params = $params.")";

	echo $params."\n";
	$table = new Table();
	$param_source = $table->getTable($first->getSource());
	unset($table);
	// end of first condition

	//Begin other condition
	$other = array();
	
    for($i=0; $i<sizeof($conditions); $i++) {
    	if(!$conditions[$i]->isOrdered()) {
   			$other[$i] = $conditions[$i];
    	}
	}

	$values = "";
	$table = new Table();
	for($j=0; $j<sizeof($other); $j++) {
		$temp2[$j] = $other[$j]->showParameters();
		$cond_source = $table->getTable($other[$j]->getSource());
		//echo $temp2[$j][0]->getParamValue()."\n";
		$where = "";
		for($k=0; $k<sizeof($temp2[$j]); $k++) {
			if($temp2[$j][$k]->isOrdered()) {
				$where = $where.$temp2[$j][$k]->getParamValue()." ";
			}
			else {
				$where = $where." ".$temp2[$j][$k]->getConjType()." ".$temp2[$j][$k]->getParamValue()." ";	
			}
		}
		$values = $values.$other[$j]->getConjType()." NOT EXISTS (SELECT NULL FROM ".$cond_source->getName()." ".
				  $cond_source->getAlias()." WHERE ".$where.")";
		unset($cond_source);
	}
	//echo $values."\n";

	//End of other condition

	$query = "SELECT ".$source->getAlias().".".$br->getTarget()." FROM ".$source->getName()." ".$source->getAlias().
		 " WHERE NOT EXISTS (SELECT NULL FROM ".$param_source->getName()." ".$param_source->getAlias()." WHERE ".$params." ".$values;

	$conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	echo $query."\n";
	$stmt = $conn->prepare($query);
	$stmt->execute();

	/*$result = $stmt->fetchAll();
	for($i=0; $i<$stmt->rowCount(); $i++) {
		echo($result[$i][$br->getTarget()])." ";
		print("\n");
	} */
	while ($result = $stmt->fetch()) {
		echo($result[$br->getTarget()])." ";
		print("\n");	
	}
?>


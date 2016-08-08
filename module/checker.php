<?php
	
	/**
	* 
	*/
	class Checker {
		
		var $instance;
		var $reference;

		function generateTarget($predicate) {
			global $conn;

			$q = new QueryGenerator();
			//get reference table for instance checking
			$stmt = $conn->prepare("SELECT `nama_predikat` FROM `predikat` WHERE id_predikat = (SELECT `target` FROM predikat p INNER JOIN br_statement br ON p.id_predikat = br.predikat WHERE p.nama_predikat = '$predicate')");
			$stmt->execute();
			$res = $stmt->fetch();
			$reference = $res[0];

			$mgr = new RuleManager();
			$bodies = $mgr->collectRules($reference);
			$this->generateRef($bodies);
			$queries = $q->ruleToQuery($bodies, $reference, $cons);

			// print_r($queries);
			return $queries;
		}

		function generateRef($bodies) { //prepare reference for predicate

			$queries = array(); $i=0;
			$rule = new Rule();
			$q = new QueryGenerator();

			while($i<sizeof($bodies)) {
				foreach ($bodies[$i] as $body) {
					$predicate = $body->getPredicate();

					if(!$rule->isOperator($predicate) && !$rule->isIDB($predicate)) {
						$ref = $this->getReference($predicate);
						$queries[$predicate] = $q->refToQuery($ref);
					}
				}
				$i++;
			}
			// echo "Masuk \n";
			foreach ($queries as $name => $query) {
				$q->createView($query, $name);
			}
		}

		function getReference($predicate) { //get reference table for a predicate
			global $conn;

			$ref = new Reference();
			$stmt = $conn->prepare("SELECT `id_ref`, `table_name`, `db_name` FROM `reference` WHERE id_ref = '$predicate'");
			$stmt->execute();

			$id_ref = "";
			while ($res = $stmt->fetch()) {
				$id_ref = $res['id_ref'];
				$ref->setDatabase($res['db_name']);
				$ref->setTablename($res['table_name']);
			}

			$attr = array();
			$stmt = $conn->prepare("SELECT `attr_name` FROM `ref_attribute` WHERE id_ref = '$id_ref' ORDER BY `order` ASC");
			$stmt->execute();

			$i=0;
			while ($res = $stmt->fetch()) {
				$attr[$i] = $res['attr_name'];
				$i++;
			}
			$ref->setAttributes($attr);

			// print_r($ref);
			return $ref;
		}

		function getCurrentRow($cons) {
			global $conn;

			$rule = new Rule();
			$values = "";
			if(!empty($cons)) { //only executed when constant is provided
				foreach ($cons as $idx => $arg) {
					if(!$rule->isVariable($idx)) {
						$values =  $values.$arg." ";
					}
				}
			}
			// print_r($values);
			return $values;
		}

		function prepareChecking($predicate) { //prepare all tables(s) needed for comparation
			global $conn;

			$q = new QueryGenerator();
			$mgr = new RuleManager();
			#generate constant to be checked
			$ref = $this->generateTarget($predicate); //done
			echo "Reference \n"; print_r($ref);
			foreach ($ref as $name => $query) {
				$q->createView($query, $name);
			}

			$stmt = $conn->prepare("SELECT * FROM $name"); 
			$stmt->execute();
			$cons = $stmt->fetchAll();
			echo "Constant \n"; print_r($cons); 

			#generate table based on rule and constant
			$queries = array(); $j=0;
			foreach ($cons as $value) { 
				$test = $mgr->collectRules($predicate); //print_r($test); done
				$this->generateRef($test); 
				$queries[$j] = $q->ruleToQuery($test, $predicate, $value); print_r($queries[$j]); //done
				$j++;
			}
			// echo "Queries \n";
			// print_r($queries);


			#generate query for checking
			$check = array(); 
			$instance = array();
			$i=0;
			foreach ($cons as $constant) {
				$check[$i] = $q->countMatch($predicate, $constant);
				$instance[$i] = $this->getCurrentRow($constant);
				$i++;
			}

			#instance checking
			$idx = 0; $j=0;
			$result = array(); $x=0;
			while ($idx<sizeof($queries)) {
				foreach ($queries[$idx] as $table => $query) { //echo $query."\n";
					$q->createView($query, $table);
				}

				$stmt = $conn->prepare($check[$j]); // get instance to be tested
				$stmt->execute();
				$res = $stmt->fetch(); echo $instance[$j]."\n";
				echo "Result \n";
				if($res[0] == 0) {
					$result[$x] = "Instance ".$instance[$j]."violated business rule \n";
					$x++;
				} print_r($res);

				$j++;
				$idx++;
			}
			return $result;
		}
	
	}

?>
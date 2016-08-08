<?php
	
	class QueryGenerator {

		var $attributes;
		var $table;
		var $conditions;

		function getPredicate() {
			return $this->table;
		}

		function setPredicate($arg) {
			$this->table = $arg;
		}

		function getAttribute($index) {
			return $this->attributes[$index];
		}

		function getAttributes() {
			return $this->attributes;
		}

		function getNegasi() {
			return $this->negasi;
		}

		function setAttributes($attr) {
			$this->attributes = $attr;
		}

		function getCondition($index) {
			return $this->conditions[$index];
		}

		function getConditions() {
			return $this->conditions;
		}

		function setConditions($cond) {
			$this->conditions = $cond;	
		}

		function setNegasi($val) {
			$this->negasi = $val;
		}

		//Functions
		function getTableRef($bodies) {
			$rule = new Rule();
			$ref = array();

			$i = 0;
			foreach ($bodies as $body) {
				$current = $body->getPredicate();
				if(!in_array($current, $ref) && !$rule->isOperator($current)) { //check if element is already exist in array or a comparator
					if(!$rule->isNegation($body)) {
						$ref[$i] = $body->getPredicate();
						$i++;
					}
				}
			}

			return $ref;
		}

		function getProjection($head, $sub) {
			global $conn;

			$id = $head[0]->getRuleId();
			$res = array();
			$stmt = $conn->prepare("SELECT `isi_argumen` FROM `argumen_head` WHERE id_rule = $id");
			$stmt->execute();

			$i = 0;
			while($body = $stmt->fetch()) {
				//if(!empty($sub[$body['isi_argumen']])) {
					$attr = substr($sub[$body['isi_argumen']], strpos($sub[$body['isi_argumen']], ".") + 1); //get text after "."
					$res[$i] = $sub[$body['isi_argumen']]." AS ".$body['isi_argumen'];
					// echo $res[$i]."\n";
					$i++;
				//}
			}

			return $res;
		}

		// needed for performance optimization 
		function getOnProperties($bodies) {
			global $conn; //print_r($bodies);
			$predicate = $bodies[0]->getPredicate(); 

			$args = array();
			
			$i = 0;
			# get main predicate to be compared
			foreach ($bodies as $body) {
				if($body->getPredicate() == $predicate) {
					$args[$i] = $body->getContent();
					$i++;
				}
			}
			//print_r($args);
			// echo $predicate."\n";
			$res = array();
			$i = 0;
			# get attribute name associated to argument(s) name
			$stmt = $conn->prepare("SELECT `attr_name` FROM `reference` b INNER JOIN `ref_attribute` a ON b.id_ref = a.id_ref WHERE b.id_ref = '$predicate'");
			$stmt->execute();
			while($body = $stmt->fetch()) {

				$res[$args[$i]] = $body['attr_name'];
				$i++;
			} 
			$on = array();
			# get another predicate for comparator
			$i = 0;

			$rule = new Rule();
			$mgr = new RuleManager();
			foreach ($bodies as $body) {
				if(($body->getPredicate() != $predicate) && (in_array($body->getContent(), $args)) && !$rule->isOperator($body->getPredicate()) && !$rule->isNegation($body)) {
						if(!$rule->isIDB($predicate)) {
							if(!$rule->isIDB($body->getPredicate())) {
									$on[$i] = $predicate.".".$res[$body->getContent()]." = ".$body->getPredicate().".".$res[$body->getContent()];
									//echo $on[$i]."\n";
								}
								else { 
									$on[$i] = $predicate.".".$res[$body->getContent()]." = ".$body->getPredicate().".".$body->getContent();
								}
							}
						else {
							if(!$rule->isIDB($body->getPredicate())) {
									// print_r($substitution);
									$substitution = $mgr->getEDBAttributes($body->getPredicate(), $bodies);
									$on[$i] = $predicate.".".$body->getContent()." = ".$body->getPredicate().".".$substitution[$body->getContent()];
									// echo $res[$body->getContent()]."\n";
								}
								else {
									$on[$i] = $predicate.".".$body->getContent()." = ".$body->getPredicate().".".$body->getContent();
								}
							}
					$i++;
				}
			}

			// print_r($on);
			return $on;
		}

		function getSelection($bodies) {

			$mgr = new RuleManager();
			$rule = new Rule();
			$substitution = $mgr->substituteVar($bodies); //get variable substitute
			// print_r($bodies);
			$conditions = array(); //argument(s) for selection
			$i = 0; $idx = 0;

			while($i < sizeof($bodies)) {
				if($rule->isComparator($bodies[$i]->getPredicate())) {
					$args = "";
					foreach ($bodies[$i]->getContent() as $token) {
						//if(!empty($substitution[$token])) {
							if($rule->isVariable($token)) {
								$args = $args." ".$substitution[$token];
							}
							else {
								$args = $args." ".$token;
							}
						//}
					}
					$conditions[$idx] = $args;
					$idx++;
				}
				$i++;
			}
			// echo "This is condition \n";
			// print_r($conditions);
			return $conditions;
		}

		function getQueryVal($head, $bodies, $sub, $cons) {
			global $conn;

			$id = $head[0]->getRuleId();
			$res = array();
			$stmt = $conn->prepare("SELECT `isi_argumen` FROM `argumen_head` WHERE id_rule = $id");
			$stmt->execute();
			
			$knoww = array(); 
			while($body = $stmt->fetch()) {
				$arg = $body['isi_argumen'];
				$res[$arg] = $sub[$arg];
				$known[$arg] = 0;
			}

			$mgr = new RuleManager();
			$values = array(); $i=0;
			if(!empty($cons)) { //only executed when constant is provided
				$val = $mgr->getPreviousVal2($bodies); //get previous value if any
				$next = $mgr->getNextVal($bodies); //get next value if any

				foreach ($res as $arg => $attr) {
					if(!empty($cons[$arg])) {
						if($mgr->hasNext($bodies)) {
							if(!empty($next[$arg])) {
								$values[$i] = $attr." = ".$cons[$arg]."+".$next[$arg];
								$known[$arg] = 1;
								$i++;
							}
						}
					}
				}

				foreach ($res as $arg => $attr) {
					if(!empty($cons[$arg])) {
						if($mgr->hasPrevious($bodies)) {
							if(!empty($val[$arg])) {
								$values[$i] = $attr." = ".$cons[$arg]."-".$val[$arg];
								$i++;
							}
							else { 
								if($known[$arg] == 0) {
									$values[$i] = $attr." = ".$cons[$arg];
									$i++;
								}
							}
							
						}
						else {
							$values[$i] = $attr." = ".$cons[$arg];
							$i++;
						}
					}
				}
			}
			// print_r($values);
			return $values;
		}

		function getConstantVal($head, $sub, $cons) {
			global $conn;

			$id = $head[0]->getRuleId();
			$res = array();
			$stmt = $conn->prepare("SELECT `isi_argumen` FROM `argumen_head` WHERE id_rule = $id");
			$stmt->execute();
			
			while($body = $stmt->fetch()) {
				$arg = $body['isi_argumen'];
				$res[$arg] = $sub[$arg];
			}

			$values = array(); $i=0;
			if(!empty($cons)) { //only executed when constant is provided
				foreach ($res as $arg => $attr) {
					if(!empty($cons[$arg])) {
						$values[$i] = $arg." = ".$cons[$arg];
						$i++;
					}
				}
			}
			// print_r($values);
			return $values;

		}

		function getNegation($bodies) {
			global $conn;

			$predicate = $bodies[0]->getPredicate();
			$args = array();
			
			$i = 0;
			# get main predicate to be compared
			foreach ($bodies as $body) {
				if($body->getPredicate() == $predicate) {
					$args[$i] = $body->getContent();
					$i++;
				}
			}

			$res = array();
			$i = 0;
			# get attribute name associated to argument(s) name
			$stmt = $conn->prepare("SELECT `attr_name` FROM `reference` b INNER JOIN `ref_attribute` a ON b.id_ref = a.id_ref WHERE b.id_ref = '$predicate'");
			$stmt->execute();
			while($body = $stmt->fetch()) {

				$res[$args[$i]] = $body['attr_name'];
				$i++;
			}

			$negation = array(); $i=0;
			$neg_arg = array();

			$rule = new Rule();
			foreach ($bodies as $body) {
				if(($body->getPredicate() != $predicate) && (in_array($body->getContent(), $args)) && !$rule->isOperator($body->getPredicate()) && $rule->isNegation($body)) {

					$neg_arg[$i] = $body->getPredicate(); //get negated predicate name
					if(!$rule->isIDB($predicate)) {
						if(!$rule->isIDB($body->getPredicate())) {
								$negation[$i] = $predicate.".".$res[$body->getContent()]." = ".$body->getPredicate().".".$res[$body->getContent()];
								//echo $on[$i]."\n";
							}
							else {
								$negation[$i] = $predicate.".".$res[$body->getContent()]." = ".$body->getPredicate().".".$body->getContent();
							}
						}
					else {
						if(!$rule->isIDB($body->getPredicate())) {
								// print_r($substitution);
								$substitution = getEDBAttributes($body->getPredicate(), $bodies);
								$negation[$i] = $predicate.".".$body->getContent()." = ".$body->getPredicate().".".$substitution[$body->getContent()];
								// echo $res[$body->getContent()]."\n";
							}
							else {
								$negation[$i] = $predicate.".".$body->getContent()." = ".$body->getPredicate().".".$body->getContent();
							}
						}
					$i++;
				}
			}

			$args = $this->mergeNegation($neg_arg, $negation);
			$query = $this->negativeQuery($args);
			return $query;
		}

		function mergeNegation($predicate, $arg) { //merge conditon for negated predicate

			$negation = array(); 
			$i = 0;

			while($i<sizeof($arg)) {
				$temp = array();
				$neg_predicate = $predicate[$i];

				while ($neg_predicate == $predicate[$i]) {
					array_push($temp, $arg[$i]);
					if($i < sizeof($predicate)-1) {
						$i++;
					}
					else {
						$i = sizeof($predicate);
						break;
					}
				}

				$negation[$predicate[$i-1]] = $temp;
			}

			// print_r($negation);
			return $negation;
		}

		function negativeQuery($negation) { // generate negative query from argument(s)

			$neg_query = array(); $j=0;
		 	foreach ($negation as $predicate => $arg) {
		 		$i = 0;
		 		$neg_cond = "";
		 		while ($i<sizeof($arg)) {
		 			if($i<1) {
			 			$neg_cond = $neg_cond.$arg[$i];
			 		}
			 		else {
			 			$neg_cond = $neg_cond." AND ".$arg[$i];
			 		}
			 		$i++;
		 		}

		 		$neg_query[$j] = "NOT EXISTS (SELECT * FROM ".$predicate." WHERE ".$neg_cond.")";
		 		$j++;
		 	}
		 	return $neg_query;
		} 

		function generateQuery($predicate, $bodies, $cons) {

			//get head argument
			$mgr = new RuleManager();
			$head = $mgr->getHead($predicate);
			$sub = $mgr->substituteVar($bodies); 

			#query generator
		 	$from = $this->getTableRef($bodies);
		 	$select = $this->getProjection($head, $sub); //print_r($select);
		 	$join = $this->getOnProperties($bodies);
		 	$where = $this->getSelection($bodies);
		 	$negation = $this->getNegation($bodies);
		 	// print_r($join);
		 	// print_r($select);

		 	$tables = ""; //combine reference table(s)
		 	for($i=0; $i<sizeof($from); $i++) {
		 		if($i<1) {
		 			$tables = $tables.$from[$i];
		 		}
		 		else {
		 			$tables = $tables.", ".$from[$i];
		 		}
		 	}

		 	$attr = ""; //combine projection attribute
			for($i=0; $i<sizeof($select); $i++) {
		 		if($i<1) {
		 			$attr = $attr.$select[$i];
		 		}
		 		else {
		 			$attr = $attr.", ".$select[$i];
		 		}
		 	}

		 	$on = ""; //combine join attribute
			for($i=0; $i<sizeof($join); $i++) {
				
			 		if($i<1 && empty($negation)) {
			 			$on = $on.$join[$i];
			 		}
			 		else {
			 			$on = $on." AND ".$join[$i];
			 		}
		 	}

		 	$condition = ""; //combine selection condition
		 	for($i=0; $i<sizeof($where); $i++) {
		 		if(empty($join)) {
		 			$condition = $condition." ".$where[$i];	
		 		}
		 		else {
		 			$condition = $condition." AND ".$where[$i];
		 		}
		 	}

		 	$constant = ""; //combine input from user
		 	if(!empty($cons)) { //only executed when constant is defined
		 		$value = $this->getQueryVal($head, $bodies, $sub, $cons);

		 		if(empty($where) && empty($join) && empty($negation)) {
		 			$constant = $constant." ".$value[0];	
		 		}
		 		else {
		 			$constant = $constant." AND ".$value[0];
		 		}

		 		for($i=1; $i<sizeof($value); $i++) {
		 			$constant = $constant." AND ".$value[$i];
		 		}
		 	}
		 	// echo $constant."\n";

		 	$neg_query = ""; 
		 	for($i=0; $i<sizeof($negation); $i++) {
		 		if($i<1) {
		 			$neg_query = $neg_query.$negation[$i];
		 		}
		 		else {
		 			$neg_query = $neg_query." AND ".$negation[$i];
		 		}
		 	}

		 	$rule = new Rule();
	// WHERE NOT EXISTS (SELECT * FROM nr_lengkap WHERE nr.nim = nr_lengkap.X AND nr.semester = nr_lengkap.Y)
		 	$generate = "";
		 	if($rule->isMainRule($predicate)) {
		 		$generate = "SELECT ".$attr." FROM ".$tables." WHERE ".$neg_query." ".$on." ".$condition;	
		 	}
		 	else {
		 		if(empty($on) && empty($condition) && empty($constant) && empty($neg_query)) {
		 			$generate = "SELECT ".$attr." FROM ".$tables;
		 		}
		 		else {
		 			$generate = "SELECT ".$attr." FROM ".$tables." WHERE ".$neg_query." ".$on." ".$condition." ".$constant;
		 		}	
		 	}
		 	// echo ($generate)."\n";
		 	return $generate;
		}

		function ruleToQuery($bodies, $predicate, $cons) {
			$mgr = new RuleManager();
			$idb = $mgr->getIDBList($predicate);
			$idx = 0;
			$queries = array();

			$i = 0;
			$mgr = new RuleManager();
			while($i<sizeof($bodies)) {
				if($mgr->hasVariant($idb[$idx])) {
					$union = "";
					$predicate = $idb[$idx];
					for($j=$i; $j<=$mgr->numVariant($predicate)+$i-1; $j++) {
						//print_r($bodies[$j]);
						if($j == $i) {
							$union = $union.$this->generateQuery($predicate, $bodies[$j], $cons);	
						}
						else {
							$union = $union." UNION ".$this->generateQuery($predicate, $bodies[$j], $cons);	
						}
					}
					$queries[$predicate] = $union;			
					$i = $j-1;
				}
				else {
					//print_r($bodies);
					$queries[$idb[$idx]] = $this->generateQuery($idb[$idx], $bodies[$i], $cons);
				}
				$idx++;
				$i++;
			}
			// print_r($queries);
			return $queries;
		}

		function refToQuery($reference) { //create query for predicate reference

			$database = $reference->getDatabase();
			$table = $reference->getTablename();
			
			$attributes = ""; // get projection attribute
			$attr = $reference->getAttributes();
			for($i=0; $i<sizeof($attr); $i++) {
				if($i == 0) {
					$attributes = $attributes.$attr[$i];
				}
				else {
					$attributes = $attributes.", ".$attr[$i];
				}
			}

			$query = "SELECT ".$attributes." FROM ".$database.".".$table;

			return $query;
		}

		function createTempTable($query, $predicate) {
			global $conn;

			$stmt = $conn->prepare("DROP TEMPORARY TABLE IF EXISTS $predicate");
			$stmt->execute();

			$stmt = $conn->prepare("CREATE TEMPORARY TABLE $predicate AS $query");
			$stmt->execute();
			// var_dump($stmt);
		}

		function createView($query, $predicate) {
			global $conn;

			$stmt = $conn->prepare("CREATE OR REPLACE VIEW $predicate AS $query"); //print_r($stmt);
			$stmt->execute();
			// var_dump($stmt);
		}

		function checkingQuery($idb, $facts, $arg) {

			$i = 0;
			$condition = "";
			while ($i<sizeof($arg)) {
				if($i == 0) {
					$condition = $condition.$idb.".".$arg[$i]." = ".$facts.".".$arg[$i];
				}
				else {
					$condition = $condition." AND ".$idb.".".$arg[$i]." = ".$facts.".".$arg[$i];		
				}
				$i++;
			}
			
			$source = "SELECT * FROM $idb";
			$target = "(SELECT * FROM $facts WHERE $condition)";
			// $target = "SELECT * FROM $facts";
			$check = $source." WHERE NOT EXISTS ".$target;
			// echo $check."\n";
			return $check;

		}

		function countMatch($idb, $cons) {

			$mgr = new RuleManager();
			$bodies = $mgr->collectRules($idb);
			$head = $mgr->getHead($idb);
			$sub = $mgr->substituteVar(end($bodies));

			$constant = "";
			$value = $this->getConstantVal($head, $sub, $cons);
	 		for($i=0; $i<sizeof($value); $i++) {
	 			$constant = $constant." AND ".$value[$i];
	 		}

	 		$constant = substr($constant, 4);
			$query = "SELECT COUNT(*) FROM ".$idb;//." WHERE ".$constant;
			echo $query."\n";
			return $query;
		}

		function headQuery($rulehead, $id) { 
			global $conn;

			$queries = array();

			$stmt = $conn->prepare("SELECT MAX(id_aturan) FROM idb");
			$stmt->execute();
			$max = $stmt->fetch();

			//insert predicate head
			$rule_id = 1;
			if(!empty($max)) {
				$rule_id = $max[0]+1;
			}

			$predicate = "INSERT INTO idb(id_aturan, id_predikat) VALUES (".$rule_id.", ".$id.")";
			$queries[0] = $predicate;

			//insert argument head
			$args = $rulehead->getConditions();
			$i=0;
			while ($i<sizeof($args)) {
				$arg = "INSERT INTO argumen_head(id_rule, urutan, isi_argumen) VALUES (".$rule_id.", ".($i+1).", '".$args[$i+1]."')";
				$queries[$i+1] = $arg;
				$i++;
			}
			
			// print_r($queries);
			return $queries;
		}

		function bodyQuery($rulebody, $id, $order) { //insert rule body into database
			global $conn;

			$queries = array();

			$stmt = $conn->prepare("SELECT MAX(id_aturan) FROM idb");
			$stmt->execute();
			$max = $stmt->fetch();

			//insert predicate body
			$rule_id = 1;
			if(!empty($max)) {
				$rule_id = $max[0]+1;
			}

			$negasi = $rulebody->getNegasi();
			$predicate = "INSERT INTO body_idb(id_aturan, urutan_body, predikat, is_negasi) VALUES (".$rule_id.", ".$order.", ".$id.", '".$negasi."')";
			$queries[0] = $predicate;

			//insert argument body
			$args = $rulebody->getConditions();
			$i=0;
			while ($i<sizeof($args)) {
				$arg = "INSERT INTO argumen_body(id_aturan, urutan_body, urutan_argumen, isi_argumen) VALUES (".$rule_id.", ".$order.", ".($i+1).", '".$args[$i+1]."')";
				$queries[$i+1] = $arg;
				$i++;
			}
			// print_r($queries);
			return $queries;
		}

		function exprQuery($nested, $order) {
			global $conn;

			$e = new Expression();
			$queries = array();

			$stmt = $conn->prepare("SELECT MAX(id_aturan) FROM idb");
			$stmt->execute();
			$max = $stmt->fetch();

			//insert predicate body
			$rule_id = 1;
			if(!empty($max)) {
				$rule_id = $max[0]+1;
			}
			
			$parent = $e->findParent($nested); //determine parent node
			//echo $parent."\n";

			$stmt = $conn->prepare("SELECT id_predikat FROM predikat WHERE nama_predikat = '$parent'");
			$stmt->execute();
			$res = $stmt->fetch();
			$id = $res[0];

			$predicate = "INSERT INTO body_idb(id_aturan, urutan_body, predikat, is_negasi) VALUES ($rule_id, $order, $id, 'FALSE')";
			$queries[0] = $predicate;

			$body_arg = "INSERT INTO argumen_body(id_aturan, urutan_body, urutan_argumen,isi_argumen) VALUES ($rule_id, $order, 1, NULL)";
			$queries[1] = $body_arg;

			$i=0;
			while ($i<sizeof($nested)) {
				$node = $nested[$i]->getArg();
				$left = $nested[$i]->getLeft();
				$right = $nested[$i]->getRight();

				$arg = "";
				if(strpos($node, '\'') !== false) {
					$node2 = str_replace("'", "\'", $node);
					$arg = "INSERT INTO ekspresi(id_aturan, urutan_body, exp_id, argumen, leftnum, rightnum) VALUES (".$rule_id.", ".$order.", ".($i+1).", '".$node2."', ".$left.", ".$right.")";	
				}
				else {
					$arg = "INSERT INTO ekspresi(id_aturan, urutan_body, exp_id, argumen, leftnum, rightnum) VALUES (".$rule_id.", ".$order.", ".($i+1).", '".$node."', ".$left.", ".$right.")";
				}

				$queries[$i+2] = $arg;
				$i++;
			}
			
			// print_r($queries);
			return $queries;
		}

		//End of functions
	}	
	
?>
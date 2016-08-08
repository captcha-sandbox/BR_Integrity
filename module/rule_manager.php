<?php

	/**
	* 
	*/
	class RuleManager {
		
		var $rules;

		function collectRules($predicate) {

			$idb = $this->getIDBList($predicate); //get every idb which involve in corresponding rule
			// print_r($idb);

			$test = array();
			for ($i=0; $i<sizeof($idb); $i++) {
				$idx = sizeof($test);
				if($this->hasVariant($idb[$i])) {
					$temp = $this->getRuleBody($idb[$i]);
					foreach ($temp as $body) {
						$test[$idx] = $this->sortBody($body);
						$idx++;
					 } 
				}
				else { 
					$test[$idx] = $this->sortBody($this->getRuleBody($idb[$i])); //rule construction
				}
			}
			// print_r($test);
			return $test;
		}

		function collectVariable($predicate, $bodies) { //get all variable for a predicate

			$args = array(); $i = 0;
			foreach ($bodies as $body) {
				if($body->getPredicate() == $predicate) {
					$args[$i] = $body->getContent();
					$i++;
				}
			}
			return $args;
		}

		function getEDBAttributes($predicate, $bodies) { //get attribute(s) for corresponding EDB
			global $conn;

			$args = $this->collectVariable($predicate, $bodies);
			$res = array();
			$i = 0;
			
			$stmt = $conn->prepare("SELECT `attr_name` FROM `reference` b INNER JOIN `ref_attribute` a ON b.id_ref = a.id_ref WHERE b.id_ref = '$predicate'");
			$stmt->execute();
			while($body = $stmt->fetch()) {
				$res[$args[$i]] = $body['attr_name'];
				$i++;
			}

			return $res;
		}

		function getIDB($rule_id) {
			global $conn;

			$idb = array();
			$stmt = $conn->prepare("SELECT `nama_predikat` FROM `body_idb` b INNER JOIN `predikat` p ON b.predikat = p.id_predikat WHERE b.id_aturan = $rule_id AND p.kelompok_predikat = 'IDB'");
			$stmt->execute();
			
			$i = 0;
			while($edb = $stmt->fetch()) {
				$idb[$i] = $edb['nama_predikat'];
				$i++;
			}

			return $idb;
		}

		function getIDBList($predicate) {
			global $conn;

			//get head part of idb
			$stmt = $conn->prepare("SELECT id_aturan FROM idb i INNER JOIN predikat p ON i.id_predikat = p.id_predikat  WHERE nama_predikat = '$predicate'");
			$stmt->execute();
			// $rule = $stmt->fetch();
			// $rule_id = $rule[0];

			// $idb = getIDB($rule_id);
			// print_r($rule);
			$idb = array(); $i = 0;
			while ($rule = $stmt->fetch()) {
				$idb = $this->getIDB($rule['id_aturan']);
			}
			// print_r($idb);
			$list = array();

			array_push($list, $predicate);
			while(!empty($idb)) {
				$elmt = array_pop($idb); //get last element from idb array
				array_push($list, $elmt);
				$stmt = $conn->prepare("SELECT id_aturan FROM idb i INNER JOIN predikat p ON i.id_predikat = p.id_predikat WHERE nama_predikat = '$elmt'");
				$stmt->execute();

				$head = array(); $i=0;
				while ($id = $stmt->fetch()) {
					$head[$i] = $id['id_aturan'];
					$i++;
				}
				// print_r($head);
				while(!empty($head)) {// check if array is empty
					$head_elmt = array_pop($head);
					$temp = $this->getIDB($head_elmt); //get another idb predicate (if any)
					$idb = array_merge($idb, $temp);
				}
			}
			$reverse = array_reverse($list);
			// print_r($reverse);
			return $reverse;
		}

		function hasVariant($head) { //check if any rule has more than one statement 
			global $conn;

			//check how many rules that have similar head
			$stmt = $conn->prepare("SELECT COUNT(id_aturan) FROM idb i INNER JOIN predikat p ON i.id_predikat = p.id_predikat WHERE nama_predikat = '$head'");		
			$stmt->execute();
			$amount = $stmt->fetch();
			//echo $amount[0]."\n";
			if($amount[0] > 1) {
				return true;
			}
			else {
				return false;
			}
		}

		function numVariant($head) { //count how many variations exist for a rule 
			global $conn;

			//count how many rules that have similar head
			$stmt = $conn->prepare("SELECT COUNT(id_aturan) FROM idb i INNER JOIN predikat p ON i.id_predikat = p.id_predikat WHERE nama_predikat = '$head'");		
			$stmt->execute();
			$amount = $stmt->fetch();

			return $amount[0];
		}

		function getRuleBody($predicate) {
			global $conn;

			//get head part of idb
			$stmt = $conn->prepare("SELECT id_predikat FROM predikat WHERE nama_predikat = '$predicate'");
			$stmt->execute();
			$id = $stmt->fetch();
			$head = $id[0];

			$stmt = $conn->prepare("SELECT id_aturan FROM idb WHERE id_predikat = $head");
			$stmt->execute();
			
			$res = array();
			if(!$this->hasVariant($predicate)) { //only one rule has this head
				$rule_id = $stmt->fetch(); 
				$rule = $rule_id[0];
				$res = $this->getBody($rule);
				// $test = getIDBList($predicate); echo "IDB List \n"; print_r($test);		
			}
			else { //some rules have similar head
				$i = 0;
				while ($rule_id = $stmt->fetch()) {
					$rules[$i] = $rule_id['id_aturan'];
					$i++;
				}

				$i = 0;
				foreach ($rules as $rule) {
					$res[$i] = $this->getBody($rule);
					$i++;
				}
			}
			
			return $res; 
		}

		function sortBody($bodies) {
			for($i=1; $i<sizeof($bodies); $i++) {
				$key = $bodies[$i];
				$j = $i-1;
				while (($j>=0) && ((($key->getBodyOrder() < $bodies[$j]->getBodyOrder()) || (($key->getBodyOrder() <= $bodies[$j]->getBodyOrder()) && ($key->getArgOrder() < $bodies[$j]->getArgOrder()))))) {
					$bodies[$j+1] = $bodies[$j];
					$j--;
				}
				$params[$j+1] = $key;
				//print_r($bodies);
			}
			return $bodies;
		}

		function getBody($rule) {
			global $conn;

			$obj = new Rule();
			$res = array();
			$stmt = $conn->prepare("SELECT p.nama_predikat, is_negasi, a.urutan_body, urutan_argumen, isi_argumen FROM `body_idb` b, `argumen_body` a, `predikat` p WHERE p.id_predikat = b.predikat AND b.urutan_body = a.urutan_body AND a.id_aturan = $rule AND b.id_aturan = $rule");
			$stmt->execute();
			$i = 0;

			$expr = new Expression();
			while($body = $stmt->fetch()) {
				$rb = new RuleBody();
				$rb->setPredicate($body['nama_predikat']);
				$rb->setNegasi($body['is_negasi']);
				$rb->setBodyOrder($body['urutan_body']);
				$rb->setArgOrder($body['urutan_argumen']);

				if($obj->isComparator($body['nama_predikat'])) {
					$arg = $this->getExpression($rule, $body['urutan_body']);
					$rb->setContent($expr->prefixToInfix($arg));
				}
				else {
					$rb->setContent($body['isi_argumen']);	
				}
				
				$res[$i] = $rb;
				$i++;
			}
			return $res;
		}

		function getHead($predicate) {
			global $conn;

			//get head part of idb
			$stmt = $conn->prepare("SELECT id_predikat FROM predikat WHERE nama_predikat = '$predicate'");
			$stmt->execute();
			$id = $stmt->fetch();
			$head = $id[0];

			//get corresponding id for this head
			$stmt = $conn->prepare("SELECT id_aturan FROM idb WHERE id_predikat = $head");
			$stmt->execute();
			$rule_id = $stmt->fetch(); 
			$rule = $rule_id[0];

			//get head argument(s)
			$res = array();
			$stmt = $conn->prepare("SELECT id_rule, urutan, isi_argumen FROM `argumen_head` WHERE id_rule = $rule");
			$stmt->execute();
		  $i = 0;
			while($head_arg = $stmt->fetch()) {
				$rh = new RuleHead();
				$rh->setRuleId($head_arg['id_rule']);
				$rh->setPredicate($predicate);
				$rh->setArgOrder($head_arg['urutan']);
				$rh->setContent($head_arg['isi_argumen']);

				$res[$i] = $rh;
				$i++;
			} 

			return $res;
		}

		function getExpression($rule, $order) {
			global $conn;
			// echo $rule."\n";
			$res = array();
			$stmt = $conn->prepare("SELECT e.argumen FROM `body_idb` b, `ekspresi` e, `predikat` p WHERE p.id_predikat = b.predikat AND b.urutan_body = e.urutan_body AND e.id_aturan = $rule AND b.id_aturan = $rule AND e.urutan_body = $order ORDER BY leftnum ASC");
			$stmt->execute();

			$i=0;
			while ($expr = $stmt->fetch()) {
				$res[$i] = $expr['argumen'];
				$i++;
			}

			// print_r($res);
			return $res;
		}

		function substituteVar($bodies) {
			global $conn;

			$rule = new Rule();
			$known = array(); //array of variable that is already substituted
			$substitution = array(); //array of constant which substitute associated variable
			$i = 0;
			foreach ($bodies as $body) {
				if(!in_array($body->getContent(), $known) && $rule->isVariable($body->getContent())) {
					$known[$i] = $body->getContent();
					$order = $body->getArgOrder();
					$predicate = $body->getPredicate();

					if($rule->isIDB($body->getPredicate())) { //get reference for idb if any
						$substitution[$body->getContent()] = $predicate.".".$body->getContent();				
					}
					else {
						$stmt = $conn->prepare("SELECT `attr_name` FROM `reference` b INNER JOIN `ref_attribute` a ON b.id_ref = a.id_ref WHERE b.id_ref = '$predicate' AND a.order = $order");
						$stmt->execute();
						$result = $stmt->fetch();
						
						$substitution[$body->getContent()] = $predicate.".".$result[0]; //get substitution for variable(s)
					}
					$i++;
				}
			}
			// print_r($substitution);
			return $substitution;
		}
		
		function getPreviousVal2($bodies) {

			$on = array(); $j=0;
			while ($j<sizeof($bodies)) {
				if($bodies[$j]->getPredicate() == "previous") {
					$on[$bodies[$j]->getContent()] = $bodies[$j+1]->getContent();
					$j++;
				}
				$j++;
			}
			return $on;
		}

		function getNextVal($bodies) {
			$on = array(); $j=0;
			while ($j<sizeof($bodies)) {
				if($bodies[$j]->getPredicate() == "next") {
					$on[$bodies[$j]->getContent()] = $bodies[$j+1]->getContent();
					$j++;
				}
				$j++;
			}

			return $on;
		}

		function hasPrevious($body) { //check if operator previous is being used

			$predicates = array(); $i=0;
			foreach ($body as $rulebody) {
				$predicates[$i] = $rulebody->getPredicate();
				$i++;
			}

			if(in_array("previous", $predicates)) {
				return true;
			}
			else {
				return false;
			}			
	}

		function hasNext($body) { //check if operator previous is being used

			$predicates = array(); $i=0;
			foreach ($body as $rulebody) {
				$predicates[$i] = $rulebody->getPredicate();
				$i++;
			}

			if(in_array("next", $predicates)) {
				return true;
			}
			else {
				return false;
			}			
		}

		function validPredicate($predicate) {
			global $conn;

			$stmt = $conn->prepare("SELECT COUNT(*) FROM predikat WHERE nama_predikat = '$predicate'");
			$stmt->execute();
			$res = $stmt->fetch();

			if($res[0] != 0) {
				return true;
			}
			else {
				return false;
				echo $predicate."<br>";
			}
		}

		function validArguments($args, $predicate) {
			global $conn;

			$stmt = $conn->prepare("SELECT jumlah_argumen FROM predikat WHERE nama_predikat = '$predicate'");
			$stmt->execute();
			$res = $stmt->fetch();
			// print_r($args); print_r($res);
			if(sizeof($args) == $res[0]) {
				return true;
			}
			else {
				return false;
			}
		}

		function validHead($rulehead) {

			$predicate = $rulehead->getPredicate();
			$args = $rulehead->getConditions();

			if($this->validPredicate($predicate) && $this->validArguments($args, $predicate)) {
				return true;
			}
			else{
				return false;
			}
		}

		function validBody($rulebody) {

			$r = new Rule();
			$check = array(); $i=0;
			foreach ($rulebody as $body) { // check each predicate
				$predicate = $body->getPredicate();
				$args = $body->getConditions();

				if(!$r->isOperator($predicate)) {
					if($this->validPredicate($predicate) && $this->validArguments($args, $predicate)) {
					$check[$i] = 1;
					}
					else{
						$check[$i] = 0;
					}
					$i++;
				}
			}

			if(in_array(0, $check)) { // check cumulative result
				return false;
			}
			else {
				return true;
			}
		}

		function isRuleExist($predicate) {
			global $conn;

			$stmt = $conn->prepare("SELECT COUNT(*) FROM idb i INNER JOIN predikat p ON i.id_predikat = p.id_predikat WHERE nama_predikat = '$predicate'");
			$stmt->execute();

			$res = $stmt->fetch();
			if($res[0] != 0) {
				return true;
			}
			else {
				return false;
			}
		}

		function validRule($rulehead, $rule) {

			$p_head = $rulehead->getPredicate();
			if($this->isRuleExist($p_head)) {
				$res = $this->getRuleBody($p_head);
				// print_r($res); print_r($rulebody);
				$build = new Builder();
				$a = $build->buildRule($p_head); //existing rule(s)
				//$b = $this->collectPredicate($rulebody); //input rule
				
				// print_r($a); echo strcmp($a[1], $rule)."\n";
				$result = array();
				if(sizeof($a)>1) { //rule has more than one body
					$temp = 0; $i=0;
					while ($i<sizeof($a)) {
						if(strcmp($a[$i], $rule) == 0) {
							$result[$i] = "true";	
						}
						else {
							$result[$i] = "false";
						}
						$i++;
					}
				}
				else {
					// echo strcmp($a[0], $rule)."\n";
					if(strcmp($a[0], $rule) == 0) {
						$result[0] = "true";
					}
					else {
						$result[0] = "false";
					}
				}

				// print_r($result);
				if(in_array("true", $result)) {
					return false; 
				}
				else {
					return true;
				}
			}
			else {
				return true;
			}
		}

		function collectPredicate($rulebody) { // get all predicates involved in a rule

			$r = new Rule();
			$keys = array_keys($rulebody);
			$first = $keys[0];

			$predicates = array(); $i=0;
			if(is_array($rulebody[$first])) {
				$j=0;
				while ($j<sizeof($rulebody)) {
					$temp = array(); $idx=0; 
					foreach ($rulebody[$j] as $body) {
						$p =  $body->getPredicate();
						$neg = $body->getNegasi();
						if($neg == "TRUE") {
							$p = "~".$p;
						}
						
						if(!$r->isComparator($p) && !in_array($p, $temp)) {
							$temp[$idx] = $p;		
							$idx++;
						}
					}
					$predicates[$i] = $temp;
					$i++;
					$j++;
				}
			}
			else {
				foreach ($rulebody as $body) {
					$p =  $body->getPredicate();
					$neg = $body->getNegasi();
					if($neg == "TRUE") {
						$p = "~".$p;
					}
					
					if(!$r->isComparator($p) && !in_array($p, $predicates)) {
						$predicates[$i] = $p;	
						$i++;
					}
				}
			}

			// print_r($predicates);
			return $predicates; 
		}
	}

?>
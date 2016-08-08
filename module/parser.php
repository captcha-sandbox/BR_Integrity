<?php
	include "sql_connect.inc";

	class Parser {
		function identifyRule($rule) { //split rule head and rule body

			$delimiter1 = '/(\s+)[\s:-]+/';
			$delimiter2 = '/[\s,]+/';
			$temp = preg_split($delimiter1, $rule);
			$temp2 = explode(", ", $temp[1]);
			array_unshift($temp2, $temp[0]);
			// print_r($temp2);

			$mgr = new RuleManager();
			$head = $this->identifyHead($temp2);
			if($mgr->validHead($head)) {
				$queryhead = $this->insertHead($head);	
			}
			else {
				// print_r($head);
				?>
					<script language="javascript">
						alert("Predikat head belum terdefinisi / tidak sesuai");
						document.location="add_rule.php";
					</script>
				<?php
			}

			$body = $this->identifyBody($temp2);
			if($mgr->validBody($body))
			{
				$querybody = $this->insertBody($body);
			}
			else {
				?>
					<script language="javascript">
						alert("Predikat body belum terdefinisi / tidak sesuai");
						document.location="add_rule.php";
					</script>
				<?php
			}
			
			$expr = $this->identifyExp($temp2);
			$queryexpr = $this->insertExp($expr);

			// print_r($queryhead);
			if($mgr->validRule($head, $rule)) {
				foreach ($querybody as $query) {
					$i = 0;
					while($i<sizeof($query)) {
						array_push($queryhead, $query[$i]);
						$i++;
					}
				}

				foreach ($queryexpr as $query) {
					$i = 0;
					while($i<sizeof($query)) {
						array_push($queryhead, $query[$i]);
						$i++;
					}
				}
				return $queryhead;
			}
			else {
				?>
					<script language="javascript">
						alert("Aturan sudah terdefinisi");
						document.location="add_rule.php";
					</script>
				<?php
			}
			// insertData($queryhead);
			// print_r($querybody);
			// print_r($queryexpr);
			
		}

		function identifyHead($head) { //split predicate head and argument head

			$rulehead = $this->parseArgument($head[0]);
			// print_r($rulehead);
			return $rulehead;
		}

		function insertHead($rulehead) { //insert rule head into database
			global $conn;

			$predicate = $rulehead->getPredicate();
			$stmt = $conn->prepare("SELECT id_predikat FROM predikat WHERE nama_predikat = '$predicate'");
			$stmt->execute();
			$id = $stmt->fetch();

			$q = new QueryGenerator();
			$query = "";
			if(empty($id)) {
				echo "Predikat belum terdefinisi \n";
			}
			else {
				$query = $q->headQuery($rulehead, $id[0]);
			}

			// print_r($query);
			return $query;
		}

		function identifyBody($body) { //split predicate body and argument body

			$r = new Rule();
			$rulebody = array();
			for($i=1; $i<sizeof($body); $i++) {
				if(!$this->isExpression($body[$i])) {
					$rulebody[$i] = $this->parseArgument($body[$i]);
				}
			}
			// print_r($rulebody);
			return $rulebody;
		}

		function insertBody($rulebody) { //insert rule body into database
			global $conn;

			$ids = array(); $i=0; //print_r($rulebody);
			foreach ($rulebody as $body) {
				$predicate = $body->getPredicate();
				$stmt = $conn->prepare("SELECT id_predikat FROM predikat WHERE nama_predikat = '$predicate'");
				$stmt->execute();
				$id = $stmt->fetch();

				$ids[$i] = $id[0];
				$i++;
			}
			//print_r($ids);

			$q = new QueryGenerator();
			$queries = array(); $idx=0;
			for($j=0; $j<sizeof($ids); $j++) {
				if(empty($ids[$j])) {
					echo "Predikat belum terdefinisi \n";
				}
				else {
					$order = $j+1;
					$queries[$idx] = $q->bodyQuery($rulebody[$order], $ids[$j], $order);
					$idx++;
				}	
			}

			// print_r($queries);
			return $queries;
		}

		function isExpression($arg) { //check whether an argument is an expression or not

			$pattern = '/=|<>|>|<|<=|>=/';
			if(preg_match($pattern, $arg)) {
				return true;
			}
			else {
				return false;
			}
		}

		function identifyExp($body) {
			// print_r($body);
			$e = new Expression();
			$expression = array();
			for($i=1; $i<sizeof($body); $i++) {
				if($this->isExpression($body[$i])) {
					
					if(preg_match('/,/', $body[$i])) { //ommit comma behind expression
						$fix = str_replace(",", "", $body[$i]);
						$expression[$i] = $e->infixToPrefix($fix);
					}
					else {
						$expression[$i] = $e->infixToPrefix($body[$i]);
					}
					
				}
			}
			// print_r($expression);
			return $expression;
		}

		function insertExp($expr) { //insert expression into database

			$i=0;
			$e = new Expression();
			$nested = array();
			foreach ($expr as $arg) {
				$nested[$i] = $e->buildNestedElmt($arg);
				$i++;
			}

			$q = new QueryGenerator();
			$queries = array(); $idx=0;
			$order = key($expr);
			for($j=0; $j<sizeof($nested); $j++) {
				$queries[$idx] = $q->exprQuery($nested[$j], $order);
				$idx++; $order++;
			}	
			
			// print_r($queries);
			return $queries;
		}

		function insertData($queries) {
			global $conn;

			foreach ($queries as $query) {
				$stmt = $conn->prepare($query);
				$stmt->execute();
			}
		}

		function parseArgument($arg) {

			$q = new QueryGenerator();
			$r = new Rule();
			$attr = array();
			$cond = array();

			$regex_p = '/^.+?(?=\()/';
			$regex_c = '/\(([^)]+)\)/';
			$delimiter = '/[\s,]+/';

			preg_match($regex_p, $arg, $predicate);
			preg_match($regex_c, $arg, $conditions); 
			$temp = preg_split($delimiter, $conditions[1]); 

			$i=1;

			foreach ($temp as $arg) {
				if($r->isVariable($arg) || is_numeric($arg)) {
					$cond[$i] = $arg;
					$i++;
				}
				else {
					$attr[$i] = $arg;
					$i++;
				}
			}

			$q->setAttributes($attr);
			$q->setConditions($cond);
			
			if(preg_match('/~/', $predicate[0])) { //negation checking
				$q->setNegasi("TRUE");
				$q->setPredicate(substr($predicate[0], 1));
			}
			else {
				$q->setNegasi("FALSE");
				$q->setPredicate($predicate[0]);	
			}

			//echo($predicate[0]);
			// print_r($q);
			return $q;
		}

		function parseRule($arg) {

			$attr = array();
			$cond = array();
			$q = new Query();

			$regex_p = '/^.+?(?=\()/';
			$regex_c = '/\(([^)]+)\)/';
			$delimiter = '/[\s,]+/';

			preg_match($regex_p, $arg, $predicate);
			preg_match($regex_c, $arg, $conditions);
			$temp = preg_split($delimiter, $conditions[1]);
			//print_r($temp);
			$i=1;
			$key = "argumen_";
			foreach ($temp as $arg) {
					$cond[$key.$i] = $arg;
					$i++;
			}

			$q->setPredicate($predicate[0]);
			$q->setConditions($cond);

			//echo($predicate[0]);
			//print_r($temp);
			return $q;
		}

		function parseFormula($arg, $substitution) {

			$delimiter = '/[ ]+/';
			$temp = preg_split($delimiter, $arg);

			for($i=0; $i<sizeof($temp); $i++) {
				if(isVariable($temp[$i])) {
					$temp[$i] = $substitution[$temp[$i]];
				}
			}
			// print_r($temp);	
		}
	}
	
?>
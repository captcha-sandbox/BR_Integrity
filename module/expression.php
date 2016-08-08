<?php
	
	/**
	* 
	*/
	class Expression {
		
		var $id;
		var $arg;
		var $left;
		var $right;

		function getId() {
			return $this->id;
		}

		function getArg() {
			return $this->arg;
		}

		function getLeft() {
			return $this->left;
		}

		function getRight() {
			return $this->right;
		}

		function setId($num) {
			$this->id = $num;
		}

		function setArg($name) {
			$this->arg = $name;
		}

		function setLeft($num) {
			$this->left = $num;
		}

		function setRight($num) {
			$this->right = $num;
		}

		function findParent($nested) {
	 
			$parent = "";
			foreach ($nested as $node) {
				if($node->getLeft() == 1) {
					$parent = $node->getArg();
				}			
			}

			return $parent;		
		}
		
		function mergeOperator($tokenlist) {

			$result = array(); //print_r($tokenlist);
			$i=0; $idx = 0;
			while ($i<sizeof($tokenlist)) {
				if($tokenlist[$i] == '<') {
					if($tokenlist[$i+1] == '>' || $tokenlist[$i+1] == '=') {
						$result[$idx] = $tokenlist[$i].$tokenlist[$i+1];
						$i++;
					}
					else {
						$result[$idx] = $tokenlist[$i];
					}
				}
				elseif($tokenlist[$i] == '>') {
					if($tokenlist[$i+1] == '=') {
						$result[$idx] = $tokenlist[$i].$tokenlist[$i+1];
						$i++;
					}
					else {
						$result[$idx] = $tokenlist[$i];
					}
				}
				elseif($tokenlist[$i] == '\'') {
					$token = "'";
					$j = $i+1;
					while ($tokenlist[$j] != '\'') {
						//echo $tokenlist[$j]."\n";
						$token = $token.$tokenlist[$j];
						$j++; 
					}
					// $i = $i+$j;
					
					$result[$idx] = $token."'";
					$i = $j+1;
				}
				elseif(is_numeric($tokenlist[$i])) {
					$token = ""; //echo "Masuk \n";
					// $j = $i+1;
					while ($i<sizeof($tokenlist) && (is_numeric($tokenlist[$i]) || $tokenlist[$i] == "." || $tokenlist[$i] == ",")) {
						//if(!ctype_alpha($tokenlist[$i]) && !isComparator($tokenlist[$i])) { 
							$token = $token.$tokenlist[$i];
							$i++;
						//}
					}
					$i--;
					$result[$idx] = $token;
				}
				else {
					$result[$idx] = $tokenlist[$i];
				}

				$i++; $idx++;
			}
			// echo "Merge result \n";
			//print_r($result);
			return $result;
		}

		function infixToPrefix($expr) {

			//operator precedence
		 	$prec = array();
	    $prec["*"] = 3; $prec["/"] = 3; $prec["+"] = 2; $prec["-"] = 2; $prec["="] = 1;
	    $prec["<>"] = 1; $prec[">="] = 1; $prec["<="] = 1; $prec["<"] = 1; $prec[">"] = 1;
	    $prec[")"] = 0;

			$opstack = array();
			$prefixlist = array();
			$tokens = str_split($expr);
			$tokenlist = array_reverse($this->mergeOperator($tokens)); 

			// $tokenlist = array_reverse(explode(" ", $expr));

			foreach ($tokenlist as $token) {
				if(ctype_alnum($token) || is_numeric($token) || strpos($token, '\'') !== false || strpos($token, '.') !== false || strpos($token, ',') !== false) {
					array_unshift($prefixlist, $token);
				}
				elseif($token == ')') {
					array_push($opstack, $token);
				}
				elseif($token == '(') {
					$top = array_pop($opstack);
					while ($top != ')') {
						array_unshift($prefixlist, $top);
						$top = array_pop($opstack);
					}
				}
				else {
					while(!empty($opstack) && ($prec[end($opstack)] >= $prec[$token])) {
						$elmt = array_pop($opstack);
						array_unshift($prefixlist, $elmt);
						
					}
					array_push($opstack, $token);
				}
				// echo $token."\n";
			}

			while(!empty($opstack)) {
				$elmt = array_pop($opstack);
				array_unshift($prefixlist, $elmt);
			}
			// print_r($tokenlist);
			// print_r($prefixlist); echo "This is prefix \n";
			return $prefixlist;
		}

		function prefixToInfix($expr_arr) {

			$opstack = array();
			$infixlist = array();
			$temp = array();
			// $tokens = str_split($expr); 
			$tokenlist = array_reverse($expr_arr); //print_r($tokenlist);

			$i=0;
			while ($i<sizeof($tokenlist)) {
				if(ctype_alnum($tokenlist[$i]) || strpos($tokenlist[$i], '\'') !== false || strpos($tokenlist[$i], ',') !== false || strpos($tokenlist[$i], '.') !== false) {
					array_push($opstack, $tokenlist[$i]);
				}
				else {
					$elmt1 = array_pop($opstack);
					$elmt2 = array_pop($opstack);

					if($i == sizeof($tokenlist)-1) {
						$args = $elmt1.$tokenlist[$i].$elmt2;
					}
					else {
						$args = "(".$elmt1.$tokenlist[$i].$elmt2.")";
					}
					array_push($opstack, $args);			
				}
				$i++;
			}
			while(!empty($opstack)) {
				$elmt = array_pop($opstack);
				array_unshift($infixlist, $elmt);
			}

			// print_r($infixlist); 
			$result = $this->mergeOperator(str_split($infixlist[0]));
			return $result;
		}

		function buildNestedElmt($prefix) {

			$stack = array();
			$nested = array();
			$neighbor = 1; // identification for leaf / node

			$i=0;
			for($j=0; $j<sizeof($prefix); $j++) {
				$elmt = new Expression();
				// $neighbor++;
				if(ctype_alnum($prefix[$j])) {
					$elmt->setArg($prefix[$j]);
					$elmt->setLeft($neighbor); $neighbor++;
					$elmt->setRight($neighbor);
					
					$nested[$i] = $elmt;
					$i++;

					if(ctype_alnum($prefix[$j-1])) {
						$neighbor++;
						$op = array_pop($stack);
						$op->setRight($neighbor);
						
						$nested[$i] = $op;
						$i++;
					}
				}
				else {
					$elmt->setArg($prefix[$j]);
					$elmt->setLeft($neighbor);
					array_push($stack, $elmt);
				}
				$neighbor++;
				unset($elmt);
			}
			// echo sizeof($stack);
			while(!empty($stack)) {
				$op = array_pop($stack);
				$op->setRight($neighbor);
				
				$nested[$i] = $op;
				$neighbor++; $i++;
			}

			// print_r($nested);
			return $nested;
		}

	}
?>
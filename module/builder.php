<?php 
	
	/**
	* 
	*/
	class Builder {
		
		var $token;
		var $string;

		function buildRule($predicate) { //build rule body from existed data

			$mgr = new RuleManager();
			$head = $mgr->getHead($predicate);
			$bodies = $mgr->getRuleBody($predicate);
			// $expr = getRuleExpr($predicate);
			// print_r($bodies);
			$predicates = array();

			$p_head = $this->mergeHead($head); 
			// print_r($p_head);
			
			$i=0;
			if(is_array($bodies[0])) {
				foreach ($bodies as $body) {
					$predicates[$i] = $this->mergeBody($body);	
					$i++;
				}//print_r($predicates);
			}
			else {
				$predicates[$i] = $this->mergeBody($bodies);
			}
				
			// print_r($expr);

			$rule = array(); $idx=0;
			foreach ($predicates as $body) { //combine rule head and body
				$i=0; 
				$p_body = "";

				while ($i<sizeof($body)) {
					if ($i == 0) { 
						$p_body = $p_body.$body[$i];
					}
					else {
						$p_body = $p_body.", ".$body[$i];	
					}
					$i++;
				}

				$rule[$idx] = $p_head." :- ".$p_body;
				unset($p_body);
				$idx++;	
			}
			
		 	// print_r($rule);
		 	return $rule;
		}

		function mergeHead($head) {// $cons) {
			global $conn;  //print_r($bodies)."\n";

			$predicate = "";

			$i = 0; $j = 0;
			$obj = "";
			while ($i<sizeof($head)) {
				$p = $head[$i]->getPredicate();
				$q = ""; 
				$constant = "";

				if($i<sizeof($head)-1) {
					$q = $head[$i+1]->getPredicate();
				}

				$constant = $head[$i]->getContent();

				//if(!isComparator($p)) {
					if(strcmp($obj, $p) != 0) {
						$obj = $p;
						$predicate = $predicate.$obj."(".$constant;
						if(strcmp($p, $q) != 0) {// check if there is only one argument
							$predicate = $predicate.")";	
						}
					}
					else {
						//echo $p." ".$q."\n";
						$predicate = $predicate.",".$constant;
						if(strcmp($p, $q) != 0) {// check if there is no more argument
							$predicate = $predicate.")";	
						}
					}
				$i++;
			}
		
			//print_r($predicates);
			return $predicate;
		}

		function mergeBody($bodies) {// $cons) {
			global $conn;  //print_r($bodies)."\n";

			$predicate = "";
			$predicates = array();

			$i = 0; $j = 0;
			$obj = "";
			$r = new Rule();
			while ($i<sizeof($bodies)) { //print_r($bodies);
				$p = $bodies[$i]->getPredicate();		
				$q = "";
				$constant = "";

				if($i<sizeof($bodies)-1) {
					$q = $bodies[$i+1]->getPredicate();
				}

				// if(!isComparator($p)) {
				// 	$constant = $cons[$bodies[$i]->getArgOrder()-1];
				// }
				// else {
					$constant = $bodies[$i]->getContent();
				// }

				if(!$r->isComparator($p)) {
					if(strcmp($obj, $p) != 0) {
						$obj = $p;
						if($bodies[$i]->getNegasi() == "TRUE") {
							$predicate = $predicate."~".$obj."(".$constant;
						}
						else {
							$predicate = $predicate.$obj."(".$constant;
						}
						
						if(strcmp($p, $q) != 0) {// check if there is only one argument
							$predicate = $predicate.")";
							$predicates[$j] = $predicate;
							$j++;
							$predicate = "";	
						}
					}
					else {
						//echo $p." ".$q."\n";
						$predicate = $predicate.",".$constant;
						if(strcmp($p, $q) != 0) {// check if there is no more argument
							$predicate = $predicate.")";
							$predicates[$j] = $predicate;
							$j++;
							$predicate = "";	
						}
					}}
				else {
					$expr = "";
					$args = $bodies[$i]->getContent();
					foreach ($args as $operand) {
						$expr = $expr.$operand;
					}
					// echo $expr."\n";
					$predicates[$j] = $expr;
					$j++;
				}
				$i++;
			}
		
			//print_r($predicates);
			return $predicates;
		}		
	}

?>
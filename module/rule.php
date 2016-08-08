<?php
	
	/**
	* 
	*/
	class Rule {
		
		var $rule_id;
		var $head;
		var $body;

		function isVariable($arg) {
			return ctype_lower($arg);
		}

		function isComparator($arg) {
			if($arg == '=' OR $arg == '<>' OR $arg == '>=' OR $arg == '<=' OR $arg == '>' OR $arg == '<') {
				return true;
			}
			else {
				return false;
			}
		}

		function isArithmatic($arg) {
			if($arg == '+' OR $arg == '-' OR $arg == '*' OR $arg == '/') {
				return true;
			}
			else {
				return false;
			}	
		}

		function isMainRule($predicate) { //check whether a predicate is a main rule or not
			global $conn;

			$stmt = $conn->prepare("SELECT COUNT(*) FROM predikat p INNER JOIN br_statement br ON p.id_predikat = br.predikat WHERE p.nama_predikat = '$predicate'");
			$stmt->execute();

			$res = $stmt->fetch();
			if($res[0] > 0) {
				return true;
			}
			else {
				return false;
			}
		}

		function isOperator($predicate) {
			global $conn;

			$stmt = $conn->prepare("SELECT kelompok_predikat FROM predikat WHERE nama_predikat = '$predicate'");
			$stmt->execute();
			$res = $stmt->fetch();

			if($res[0] == "Operator") {
				return true;
			}
			else {
				return false;
			}
		}

		function isNegation($body) {

			if($body->isNegasi() == "TRUE") {
				return true;
			}
			else {
				return false;
			}
		}

		function isIDB($predicate) { //check whether the predicate is IDB or not
			global $conn;
			
			$stmt = $conn->prepare("SELECT `kelompok_predikat` FROM predikat WHERE nama_predikat = '$predicate'");
			$stmt->execute();
			$result = $stmt->fetch();

			if($result[0] == "IDB") {
				return true;
			}
			else {
				return false;
			}
		}
		
	}

?>
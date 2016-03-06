<?php
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "br_integrity";

	class BusinessRule {
		var $target;
		var $source;
		var $description;
		var $conditions;

		function getTarget() {
			return $this->target;
		}

		function getSource() {
			return $this->source;
		}

		function getDescription() {
			return $this->description;
		}

		function getConditions($rulename) {
			global $servername;
			global $username;
			global $database;
			global $password;

			$temp = array();
			$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $conn->prepare("SELECT cond_id FROM `condition` WHERE rule_name = '$rulename'");
			$stmt->execute();

			$i = 0;
			while ($result = $stmt->fetch()) {
				$cond1 = new Condition();
				$this->conditions[$i] = $cond1->getCondition($rulename, $result['cond_id']);
				unset($cond1);
				$i++;
			}

			//$temp[0] = $cond1->getCondition($rulename, $result[0]['cond_id']);
			//$temp[1] = $cond2->getCondition($rulename, $result[1]['cond_id']);

			//$this->conditions = $temp;
			$conn = null;
		}

		function showConditions() {
			return $this->conditions;
		}

		function getBusinessRule($rulename) {
			global $servername;
			global $username;
			global $database;
			global $password;

			$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
			echo "Connected successfully \n";
			
			$stmt = $conn->prepare("SELECT * FROM business_rule WHERE rule_name = '$rulename'");
			$stmt->execute();

			//$result = $stmt->fetchAll();
			while ($result = $stmt->fetch()) {
				$this->target = $result['target'];
				$this->source = $result['source'];
				$this->description = $result['description'];
			}
			
			$conn = null;
		}

		function setBusinessRule($br) {
			
		}
	}

	class Condition {

		var $cond_id;
		var $source;
		var $conj_type;
		var $ordered;
		var $parameters;

		function getConditionId() {
			return $this->cond_id;
		}

		function getSource() {
			return $this->source;
		}

		function getConjType() {
			return $this->conj_type;
		}

		function isOrdered() {
			return $this->ordered;
		}

		function showParameters() {
			return $this->parameters;
		}

		function getParameters($cond_id) {
			global $servername;
			global $username;
			global $database;
			global $password;

			$temp = array();
			$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $conn->prepare("SELECT param_id FROM `condition_param` WHERE cond_id = $cond_id");
			$stmt->execute();

			/*$result = $stmt->fetchAll();
			
			for($i=0; $i<$stmt->rowCount(); $i++) {
				$param = new Parameter();
				$this->parameters[$i] = $param->getParameter($cond_id, $result[$i]['param_id']);
				unset($param);
			}*/

			$i=0;
			while ($result = $stmt->fetch()) {
				$param = new Parameter();
				$this->parameters[$i] = $param->getParameter($cond_id, $result['param_id']);
				unset($param);
				$i++;
			}

			//$temp[0] = $cond1->getCondition($rulename, $result[0]['cond_id']);
			//$temp[1] = $cond2->getCondition($rulename, $result[1]['cond_id']);

			//$this->conditions = $temp;
			$conn = null;

		}

		function getCondition($rulename, $id) {
			global $servername;
			global $username;
			global $database;
			global $password;

			$temp = array();
			$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $conn->prepare("SELECT * FROM `condition` WHERE rule_name = '$rulename' AND cond_id = $id");
			$stmt->execute();

			//$result = $stmt->fetchAll();
			while($result = $stmt->fetch()) {
				$this->cond_id = $result['cond_id'];
				$this->source = $result['source'];
				$this->conj_type = $result['conj_type'];
				$this->ordered = $result['ordered'];
			}
			//echo $this->cond_id;
			//$this->parameters = $this->getParameter($this->cond_id);

			$conn = null;
			return $this;
		}

		function setCondition($cond) {

		}
	}

	class Parameter {

		var $param_id;
		var $cond_id;
		var $param_value;
		var $conj_type;
		var $ordered;

		function getParamId() {
			return $this->param_id;
		}

		function getConditionId() {
			return $this->cond_id;
		}

		function getParamValue() {
			return $this->param_value;
		}

		function getConjType() {
			return $this->conj_type;
		}

		function isOrdered() {
			return $this->ordered;
		}

		function getParameter($cond_id, $id) {
			global $servername;
			global $username;
			global $database;
			global $password;

			$temp = array();
			$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $conn->prepare("SELECT * FROM `condition_param` WHERE cond_id = '$cond_id' AND param_id = $id");
			$stmt->execute();

			//$result = $stmt->fetchAll();
			while($result = $stmt->fetch()) {
				$this->param_id = $result['param_id'];
				$this->cond_id = $result['cond_id'];
				$this->param_value = $result['param_value'];
				$this->conj_type = $result['conj_type'];
				$this->ordered = $result['ordered'];
			}
			$conn = null;
			return $this;
		}
	}

	class Table {

		var $name;
		var $alias;
		var $description;
		var $attributes;

		function getName() {
			return $this->name;
		}

		function getAlias() {
			return $this->alias;
		}

		function getDescription() {
			return $this->description;
		}

		function showAttributes() {
			return $this->attributes;
		}

		function getTable($tablename) {
			global $servername;
			global $username;
			global $database;
			global $password;

			$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $conn->prepare("SELECT * FROM `table` WHERE name = '$tablename'");
			$stmt->execute();

			//$result = $stmt->fetchAll();
			while($result = $stmt->fetch()) {
				$this->name = $result['name'];
				$this->alias = $result['alias'];
				$this->description = $result['description'];
				$this->attributes = $this->getAttributes($result['name']);	
			}

			$conn = null;
			return $this;
		}

		function getAttributes($tablename) {
			global $servername;
			global $username;
			global $database;
			global $password;

			$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $conn->prepare("SELECT attribute FROM `table_attributes` WHERE table_name = '$tablename'");
			$stmt->execute();

			$temp = array();
			//$result = $stmt->fetchAll();
			
			$i = 0;
			while ($result = $stmt->fetch()) {
				$temp[$i] = $result['attribute'];
				$i++;	
			}
			/*
			for($i=0; $i<$stmt->rowCount(); $i++) {
				$temp[$i] = $result[$i]['attribute'];
			}*/

			$conn = null;
			return $temp;
		}
	}
?>
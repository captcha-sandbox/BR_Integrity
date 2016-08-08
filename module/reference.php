<?php

	/**
	* 
	*/
	class Reference
	{
		var $database;
		var $tablename;
		var $attributes;

		function getDatabase() {
			return $this->database;
		}

		function getTablename() {
			return $this->tablename;
		}

		function getAttributes() {
			return $this->attributes;
		}

		function setDatabase($db) {
			$this->database = $db;
		}

		function setTablename($name) {
			$this->tablename = $name;
		}

		function setAttributes($attr) {
			$this->attributes = $attr;
		}
	}

?>
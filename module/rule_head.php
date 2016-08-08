<?php

	class RuleHead
	{
		
		var $rule_id;
		var $predicate;
		var $negasi;
		var $arg_order;
		var $content;

		function getRuleId() {
			return $this->rule_id;
		}

		function getPredicate() {
			return $this->predicate;
		}

		function setPredicate($pred) {
			$this->predicate = $pred;
		}

		function getArgOrder() {
			return $this->arg_order;
		}

		function setRuleId($id) {
			$this->rule_id = $id;
		}

		function setArgOrder($order) {
			$this->arg_order = $order;
		}

		function getContent() {
			return $this->content;
		}

		function setContent($content) {
			$this->content = $content;
		}
	}
	
?>
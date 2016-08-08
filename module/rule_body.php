<?php

	/**
	* 
	*/
	class RuleBody
	{
		var $predicate;
		var $negasi;
		var $body_order;
		var $arg_order;
		var $content;

		function getPredicate() {
			return $this->predicate;
		}

		function setPredicate($pred) {
			$this->predicate = $pred;
		}

		function getNegasi() {
			return $this->negasi;
		}

		function setNegasi($bool) {
			$this->negasi = $bool;
		}

		function getBodyOrder() {
			return $this->body_order;
		}

		function setBodyOrder($order) {
			$this->body_order = $order;
		}

		function getArgOrder() {
			return $this->arg_order;
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
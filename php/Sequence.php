<?php

 class Sequence{
	
	public $sequence;	
	private $limit;

		
	function __construct($j=500){
		$this->limit=$j;		
	}
	
	public function getLimit() {
		return $limit;
	}

	public function setLimit($limit) {
		$this->limit = $limit;
	}

	public function setSequence($st) {
		$this->sequence=$st;
	}
	
	public function getSequence() {
		return $this->sequence;
	}
	
	public function printSequence() {
		echo $this->sequence;
	}

}
?>
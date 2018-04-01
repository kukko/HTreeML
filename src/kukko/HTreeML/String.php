<?php
	namespace kukko\HTreeML;

	use kukko\HTreeML\ElementInterface;

	class String implements ElementInterface{
		private $string;
		public function __construct($string){
			$this->string=$string;
		}
		public function render(){
			return $this->string;
		}
	}
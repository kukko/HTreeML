<?php
	namespace HTreeML;

	class Node{
		private $tag;
		private $attributes;
		private $selfClosing;
		public function __construct($tag, $attributes=[], $selfClosing=false){
			$this->tag=$tag;
			$this->attributes=$attributes;
			$this->selfClosing=$selfClosing;
		}
		public function __get($attribute){
			return isset($this->attributes[$attribute])?$this->attributes[$attribute:null;
		}
		public function __set($attribute, $value){
			$previous=$this->attributes[$attribute];
			return ($this->attributes[$attribute]=$value)===$previous;
		}
		public function render(){
			$output="<".$this->tag;
			foreach ($this->attributes as $name => $value){
				$output.=" ".$name."=\"".((is_array($value) || is_object($value))?json_encode($value):$value)."\"";
			}
			if ($this->selfClosing){
				$output.=" />";
			}
			else{
				$output.=">";
			}
			if (!$this->selfClosing){
				$output.="</".$this->tag.">";
			}
			return $output;
		}
	}
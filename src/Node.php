<?php
	namespace HTreeML;

	use HTreeML\ElementInterface;
	use HTreeML\String;

	class Node implements ElementInterface{
		private $tag;
		private $attributes;
		private $selfClosing;
		private $children=[];
		private $strings=[];
		public function __construct($tag, $attributes=[], $selfClosing=false){
			$this->tag=$tag;
			$this->attributes=$attributes;
			$this->selfClosing=$selfClosing;
		}
		public function __get($attribute){
			return isset($this->attributes[$attribute])?$this->attributes[$attribute]:null;
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
				foreach ($this->children as $element){
					$output.=$element->render();
				}
				$output.="</".$this->tag.">";
			}
			return $output;
		}
		public function addElement(ElementInterface $element){
			$this->children[]=$element;
		}
		public function addString($string){
			$this->addElement(new String($string));
		}
		public function clearContent(){
			$this->children=[];
		}
		public function setContent(ElementInterface $element){
			$this->clearContent();
			$this->addElement($element);
		}
	}
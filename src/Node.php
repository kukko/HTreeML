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
			$alreadySetted=isset($this->attributes[$attribute]);
			if ($alreadySetted){
				$previous=$this->attributes[$attribute];
			}
			$this->attributes[$attribute]=$value;
			return (!$alreadySetted && $this->attributes[$attribute]===$value) || ($alreadySetted && ($this->attributes[$attribute])===$previous);
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
		public function __call($methodName, $arguments){
			if (strpos($methodName, "add")!==false && strlen($methodName)>3){
				$attributeName=substr($methodName, 3);
				$attributeName=isset($this->attributes[$attributeName])?$attributeName:(isset($this->attributes[lcfirst($attributeName)])?lcfirst($attributeName):$attributeName);
				if (isset($this->attributes[$attributeName])){
					if (is_array($this->attributes[$attributeName])){
						$this->attributes[$attributeName][]=$arguments[0];
					}
					else{
						$this->attributes[$attributeName].=" ".$arguments[0];
					}
				}
				else{
					$this->attributes[$attributeName]=$arguments[0];
				}
			}
			if (strpos($methodName, "insert")!==false && strlen($methodName)>6){
				$tagName=substr($methodName, 6);
				$this->addElement(new Node($tagName, isset($arguments[0]) && is_array($arguments[0])?$arguments[0]:[], isset($arguments[1])?$arguments[1]:false));
			}
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
		public function setContentString($string){
			$this->clearContent();
			$this->addString($string);
		}
	}
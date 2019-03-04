<?php

namespace Core\HTML;

/**
* Allows to generate forms quickly and easily
*/

class Form{

	/**
	* @var array : data used by form
	*/
	private $data;

	/**
	* @var string tag to surround form fields
	*/
	public $surround ='p';

	/**
	*Constructor taking an array of data used by the form as parameter
	* @param array $data
	*/
	public function __construct($data = array()){
		$this->data = $data;
	}

	/**
	* Surround html code with a tag
	* @param string
	* @return string
	*/
	protected function surround($html){
		return "<{$this->surround}>{$html}</{$this->surround}>";
	}

	/**
	* @param $index string : Index of the value to get
	* @return string
	*/
	protected function getValue($index){
		if(is_object($this->data)){
			return $this->data->$index;
		}
		return isset($this->data[$index]) ? $this->data[$index] : null;
	}

	/**
	* @param $name string
	* @param $label string
	* @param $options array
	* @return string
	*/
	public function input($name, $label, $options = []){
		$type = isset($options['type']) ? $options['type'] : 'text';
		return $this->surround('<input type="'.$type.'" name="'.$name.'" value="'.$this->getValue($name).'">');
	}

	/**
	* @return string
	*/
	public function submit(){
		return $this->surround('<button type="submit">Envoyer</button>');
	}

}
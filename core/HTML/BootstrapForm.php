<?php

namespace Core\HTML;

class BootstrapForm extends Form{

	/**
	* Surround html code with a tag
	* @param string
	* @return string
	*/
	protected function surround($html){
		return "<div class=\"form-group\">{$html}</div>";
	}

	/**
	* @param $name string
	* @param $label string
	* @param $options array
	* @return string
	*/
	public function input($name, $label, $required=false, $options = []){
		$type = isset($options['type']) ? $options['type'] : 'text';
		$rq = $required ? 'required' : '';
		$label = '<label>'.$label.'</label>';
		if($type === 'textarea'){
			$input = '<textarea name="'.$name.'" class="form-control"'. $rq.'>'.$this->getValue($name).'</textarea>';
			return $this->surround($label.$input);
		}
		elseif($type === 'hidden'){
			$input = '<input type="hidden" name="'.$name.'" value="ok" class="form-control">';
			return $this->surround($input);
		}
		else{
			$input = '<input type="'.$type.'" name="'.$name.'" value="'.$this->getValue($name).'" class="form-control"'. $rq.'>';
			return $this->surround($label.$input);
		}
	}



	/**
	* @param $name string
	* @param $label string
	* @param $options array
	* @return string
	*/
	public function select($name, $label, $options){
		$label = '<label>'.$label.'</label>';
		$input = '<select class="form-control" name="'.$name.'">';
		//var_dump($this->getValue($name));
		foreach ($options as $key => $value) {
			$attributes='';
			if($key == $this->getValue($name)){
				$attributes = 'selected';
			}
			$input .= "<option value='$key' $attributes>$value</option>";
		}
		$input .= '</select>';
		return $this->surround($label.$input);
	}

	/**
	* @param $label string
	* @param $options array
	* @return string
	*/
	public function checkbox($label, $options, $checked){
		$label = '<p>'.$label.'</p>';
		$inputs = '';
		$i=0;
		foreach ($options as $key => $value) { //emplacements 'emplacement_id','emplacement_slug

				$attributes='';
			foreach ($checked as $k => $v) { //emplacements qui ont l'id de la webcam dans la jonction

				if($v == $key){
					$attributes = 'checked';
				}

			}
		
			$inputs.= "<div class='form-check'>";
			$inputs.= "<input class='form-check-input' type='checkbox' name='checkbox-$i' value='$key' $attributes>";
			$inputs.= "<label class='form-check-label' for='checkbox-$i'>$value</label>";
			$inputs.= "</div>";
			$i++;
		}

		return $this->surround($label.$inputs);
	}

	/**
	* @return string
	*/
	public function submit(){
		return $this->surround('<button type="submit" class="btn btn-primary">Envoyer</button>');
	}
}

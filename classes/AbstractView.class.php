<?php

require_once 'HTML/Template/Flexy.php';
require_once 'classes/Utils.php';

abstract class AbstractView {
	
	var $template;
	var $options = array(
      'templateDir'   => 'templates/',
      'compileDir'    => 'templates/compiled/',
  	);
  	var $elements = array();
	
	public function AbstractView(){
		
	}
	
	public function getProperty($p_object, $p_property){
		$methods = explode(".",$p_property);
		$value = $p_object;
		foreach($methods as $method){
			$v_method = $method;
			$value = $value->$v_method;
		}
		
		return $value;
	}
	
	public function getFechaArgentina($object, $property){
		$fecha = $object->$property;
		
		return Utils::CambiaFormatoFecha($fecha);
		
	}
	
	public function setDisplayOptions(){
		// TODO: implementar el seteo de opciones del display, de ser necesario, dentro de cada clase
		// tiene que modificar y agregar cosas de los elements
	}
	
	public function getDisplay(){		
		$output = new HTML_Template_Flexy($this->options);
		$output->compile($this->template);	
		return $output->bufferedOutputObject($this, $this->elements);
	}
	
}
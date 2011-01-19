<?php

require_once 'AbstractView.class.php';


class Portada extends AbstractView {
	
	/**
	 * Constructor
	 * @return unknown_type
	 */
	
	var $content;
	
	public function Portada(){
		$this->template = "main.html";
	}
	
	public function setDisplayOptions($content){
		$this->content = $content;
	}
	
}

?>
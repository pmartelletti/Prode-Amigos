<?php

require_once 'AbstractView.class.php';
require_once 'Secciones.php';


class AdminView extends AbstractView {
	
	/**
	 * Constructor
	 * @return unknown_type
	 */
	public function AdminView(){
		$this->template = "main.html";
	}
	
	public function setDisplayOptions(){
		// manejo si el usuario es admin
	}
	
}

?>
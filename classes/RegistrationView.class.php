<?php

require_once 'AbstractView.class.php';


class RegistrationView extends AbstractView {
	
	public function RegistrationView(){
		$this->template = "registration.html";
	}
	
	public function setDisplayOptions(){
		//
	}
	
}

?>
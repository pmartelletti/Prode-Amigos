<?php

require_once 'AbstractView.class.php';


class LoginView extends AbstractView {
	
	
	public function LoginView(){
		$this->template = "login.html";
	}
	
	public function setDisplayOptions(){
	}
	
}

?>

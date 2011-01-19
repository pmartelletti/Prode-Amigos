<?php

require_once 'classes/Usuarios.php';
require_once 'classes/RegistrationView.class.php';
require_once 'classes/facebook-sdk/src/FacebookRequest.class.php';

class LoginController {
	
	public function LoginController(){
		
	}
	
	public function getView($view=""){
		
		switch ($view){
			case "registration":
				return $this->getRegistrationView();
				
			default:
				return $this->getDefaultView();
		} 
		
	}
	
	private function getRegistrationView(){
		$view = new RegistrationView();
		$view->setDisplayOptions();
		return $view->getDisplay();
	}
	
	private function getDefaultView(){
		$login = new LoginView();
		$login->setDisplayOptions();
		return $login->getDisplay();		
	}
	
	public function makeAsyncRequest($action){
		
		switch ($action){
			
			case "login":
				
				return $this->systemLogin();
				
			case "procesarRegistracion":
				$this->procesaRegistracion();
				return;
				
			default:

				return;
		}
		
	}
	
	private function procesaRegistracion(){
		// ver si vino la respuesta del servidor
		$fb_request = new FacebookRequest();
		$info = $fb_request->getRequestData();
		if( $fb_request->facebookRegister() ){
			echo "Registracion de facebook";
		} else {
			echo "Registración normal";
		}
		
		
	}
	
	private function systemLogin(){
		
		$usuario = new DataObjects_Usuarios();
		$usuario->setFrom($_POST);
		
		if( $usuario->find() > 0 ){
			$usuario->fetch();
			
			SessionVars::setUsuario($usuario->us_id);
			
			return json_encode(array("statusCode" => 100, "statusMsg" => "Bienvenido al sitio!"));
		} else {
			return json_encode(array("statusCode" => 200, "statusMsg" => "Usuario o password incorrecta."));	
		}
		
		
	}
}

?>
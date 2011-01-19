<?php

require_once 'classes/Usuarios.php';

class LoginController {
	
	public function LoginController(){
		
	}
	
	public function getView($view){
		
		switch ($view){
			case "loginView":
				return $this->getDefaultView();
				
			default:
				return ;
		} 
		
	}
	
	private function getDefaultView(){
		
		
		
	}
	
	public function makeAsyncRequest($action){
		
		switch ($action){
			
			case "login":
				
				return $this->systemLogin();
				
			default:
				
				return;
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
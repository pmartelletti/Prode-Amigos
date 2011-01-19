<?php

class SessionVars {
	
	public function SessionVars(){
		
	}
	
	public static function start(){
		session_start();
	} 
	
	public static function setUsuario($usuarioId){
		$_SESSION['usuarioId'] = $usuarioId;
	}
		
	public static function getUsuarioId(){
		return $_SESSION['usuarioId'];
	}
	
	public static function isUserLogged(){
		return isset($_SESSION['usuarioId']);
	}
	
	public static function logout(){
		unset( $_SESSION['usuarioId'] );
		session_destroy();
	}
	
}

?>
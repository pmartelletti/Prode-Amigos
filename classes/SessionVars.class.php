<?php

require_once 'classes/facebook-sdk/src/facebook.php';

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
	
	public static function facebookUser(){
		
		$facebook = new Facebook(array(
		  'appId'  => '124703570930710',
		  'secret' => '65bbcab7735438387d9e6ad80410cb93',
		  'cookie' => true,
		));
		
		$session = $facebook->getSession();
		
		// Session based API call.
		if ($session) {
		  try {
		    $uid = $facebook->getUser();
		    $me = $facebook->api('/me');
		    if($me){
		    	// BUSCO EL USUARIO CORRESPONDIENTE A ESE USUARIO FB
			    $usuario = DB_DataObject::factory("usuarios");
			    $usuario->us_fb_id = $uid;
			    
			    $usuario->find(true);
			    
			    $_SESSION['usuarioId'] = $usuario->us_id;
		    }		    
		  } catch (FacebookApiException $e) {
		    error_log($e);
		  }
		}
		
	}
	
	public static function isUserLogged(){
		return isset($_SESSION['usuarioId']);
		
	}
	
	public static function logout(){
		
		unset( $_SESSION['usuarioId'] );
		session_destroy();
		
		$facebook = new Facebook(array(
		  'appId'  => '124703570930710',
		  'secret' => '65bbcab7735438387d9e6ad80410cb93',
		  'cookie' => true,
		));
		
		$session = $facebook->getSession();
	
		$me = null;
		// Session based API call.
		if ($session) {
		  try {
		    $uid = $facebook->getUser();
		    $me = $facebook->api('/me');
		    
		  } catch (FacebookApiException $e) {
		    error_log($e);
		  }
		}
		
		$url = $facebook->getLogoutUrl(array("next" => "http://prode-amigos.com.ar"));
		if($me){
			header("Location:" . $url );
		} else {
			header("Location: index.php");
		}
	}
	
}

?>
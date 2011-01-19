<?php 
require_once 'DB/DataObject.php';
require_once 'classes/RankingView.class.php';
require_once 'classes/HomeView.class.php';
require_once 'classes/FixtureView.class.php';
require_once 'classes/RegistrationView.class.php';

class resultController {
	
	public function resultController(){
		
	}		
	public function getView($view) {				
		switch($view){			
			case "ranking":				
				return $this->getRankingView();		
					
			case "fixture":				
				return $this->getFixtureView();
				
			case "registration":
				return $this->getRegistrationView();
				
			case "loginView":
				return $this->getLoginView();
				
			default:				
				return $this->getHomeView();		
		}	
	}
	
	private function getFixtureView(){		
		$fixture = new FixtureView();		
		$fixture->setDisplayOptions();		
		return $fixture->getDisplay();	
	}		
	
	private function getRankingView(){		
		$ranking = new RankingView();		
		$ranking->setDisplayOptions();		
		return $ranking->getDisplay();	
	}		
	
	private function getHomeView(){		
		$home = new HomeView();		
		$home->setDisplayOptions();		
		return $home->getDisplay();	
	}		
	
	public function asynAction($action){				
		switch ($action){						
			case "realizarApuesta":				
				return $this->realizarApuesta();							
			case "logout":								
				SessionVars::logout();						
				return;
				
			case "login":
				return $this->systemLogin();
				
			case "procesarRegistracion":
				$this->procesaRegistracion();
				return;
				
			case "registration":
				return $this->getRegistrationView();
				
			case "loginView":
				return $this->getLoginView();
			case "validateEmail":
				return $this->validateEmail();
			
			default:								
				return;		
		}			
	}
	
	private function validateEmail(){
		$user = DB_DataObject::factory("usuarios");
		$user->us_login = $_GET['email'];
		
		$res = array();
		
		if(	$user->find() > 0 ){
			// el email ya está tomado por otro usuario
			$res["statusCode"] = 100;
		} else {
			// nigún usuario tomó el email que se pide
			$res["statusCode"] = 0;
		}
		
		return json_encode($res);
	}
	
	private function realizarApuesta(){				
		$apuesta = DB_DataObject::factory("apuestas");		
		$apuesta->ap_us_id = SessionVars::getUsuarioId();		
		$apuesta->ap_fecha_creacion = date("Y-m-d h:i:s");				
		foreach($_POST['ap_ganador'] as $id=>$ganador){						
			$apuesta->ap_par_id = (int)$id;			
			$apuesta->ap_ganador = $ganador;			
			if( !($apuesta->insert() )){				
				// hubo un error				
				return json_encode(array("statusCode" => 200, "statusMsg" => "Hubo un error al realizar su apuesta"));			
			}		
		}				
		return json_encode(array("statusCode" => 100, "statusMsg" => "Tu apuesta fue ingresada correctamente."));			
	}

	
	public function calculateResult(){
		
		$type = $_POST["type"];
		
		switch($type){
			
			case "posiciones":
				return;
			default: 
				return;
		}
	}
	
	
	private function getRegistrationView(){
		$view = new RegistrationView();
		$view->setDisplayOptions();
		return $view->getDisplay();
	}
	
	private function getLoginView(){
		$login = new LoginView();
		$login->setDisplayOptions();
		return $login->getDisplay();		
	}
	
	private function procesaRegistracion(){
		// ver si vino la respuesta del servidor
		$fb_request = new FacebookRequest();
		$info = $fb_request->getRequestData();
		$data = $info['registration'];
		
		if( $fb_request->facebookRegister() ){
			$usuario = DB_DataObject::factory("usuarios");
			$usuario->us_nombre = utf8_decode($data['name']);
			$usuario->us_login = $usuario->us_email = $data['email'];
			$usuario->us_fecha_alta = date("Y-m-d", $info['issued_at']);
			$usuario->us_fb_login = 1;
			$usuario->us_fb_id = $info['user_id'];
			
			$usuario->insert();
			
		} else {
			$usuario = DB_DataObject::factory("usuarios");
			$usuario->us_nombre = $data['name'];
			$usuario->us_login = $usuario->us_email = $data['mail'];
			$usuario->us_pass = $data['password'];
			$usuario->us_fecha_alta = date("Y-m-d", $info['issued_at']);
			
			$us_id = $usuario->insert();
			// seteo la sesión del usuario
			SessionVars::setUsuario($us_id);	
		}
		
		// redirijo al inicio
		header("Location: index.php");
		
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
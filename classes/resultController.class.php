<?php 
require_once 'DB/DataObject.php';require_once 'classes/RankingView.class.php';require_once 'classes/HomeView.class.php';require_once 'classes/FixtureView.class.php';
class resultController {
	
	public function resultController(){
		
	}		public function getView($view) {				switch($view){			case "ranking":				return $this->getRankingView();			case "fixture":				return $this->getFixtureView();			default:				return $this->getHomeView();		}	}		private function getFixtureView(){		$fixture = new FixtureView();		$fixture->setDisplayOptions();		return $fixture->getDisplay();	}		private function getRankingView(){		$ranking = new RankingView();		$ranking->setDisplayOptions();		return $ranking->getDisplay();	}		private function getHomeView(){		$home = new HomeView();		$home->setDisplayOptions();		return $home->getDisplay();	}		public function asynAction($action){				switch ($action){						case "realizarApuesta":				return $this->realizarApuesta();							case "logout":								SessionVars::logout();								header("Location: index.php");								return;							default:								return;		}			}		private function realizarApuesta(){				$apuesta = DB_DataObject::factory("apuestas");		$apuesta->ap_us_id = SessionVars::getUsuarioId();		$apuesta->ap_fecha_creacion = date("Y-m-d h:i:s");				foreach($_POST['ap_ganador'] as $id=>$ganador){						$apuesta->ap_par_id = (int)$id;			$apuesta->ap_ganador = $ganador;			if( !($apuesta->insert() )){				// hubo un error				return json_encode(array("statusCode" => 200, "statusMsg" => "Hubo un error al realizar su apuesta"));			}		}				return json_encode(array("statusCode" => 100, "statusMsg" => "Tu apuesta fue ingresada correctamente."));			}
	
	public function calculateResult(){
		
		$type = $_POST["type"];
		
		switch($type){
			
			case "posiciones":
				
				return;
				
			default: 
				
				return;
			
		}
		
		
	}
	
	
}

?>
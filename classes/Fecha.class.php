<?php

require_once 'classes/Fecha.php';
require_once 'classes/Partidos.class.php';
require_once 'classes/Apuestas.class.php';

class Fecha extends DataObjects_Fecha {
	
	public $puntosGanados;
	public $posicionFecha;
	
	public function Fecha(){
		
	}
	
	public function getListaFecha(){
		// me fijo si el usuario ya hizo su apuesta
		
		if( $this->usuarioHizoApuesta() ){
			// si hizo la apuesta, devuelvo la lista de partidos apuestas
			return $this->getListaPartidosApuestas();
		} else {
			// sino, devuelvo la lista de partidos para apostar
			return $this->getListaPartidos();
		}
				
	}
	
	public function setProperties(){
		$this->getPosicionEnFecha();
	}
	
	private function getPosicionEnFecha(){
		
		$apuesta = DB_DataObject::factory("apuestas");
		$apuesta->selectAdd();
		$apuesta->selectAdd(" ap_us_id, SUM(ap_puntaje) as ap_puntaje ");
		$apuesta->groupBy("ap_us_id");
		$apuesta->orderBy("ap_puntaje DESC");
		
		$partidos = DB_DataObject::factory("partidos");
		$partidos->par_fe_id = $this->fe_id;
		
		$apuesta->joinAdd($partidos);
		
		if( $apuesta->find() > 0 ){
			$pos = 1;
			while( $apuesta->fetch() ){
				if( $apuesta->ap_us_id == SessionVars::getUsuarioId() ){
					$this->posicionFecha = $pos;
					$this->puntosGanados = $apuesta->ap_puntaje;
				}
				$pos += 1 ;
			}
			
		}
		
	}
	
	public function getUsuariosPosicionesActual(){
		
		$apuesta = DB_DataObject::factory("apuestas");
		$apuesta->selectAdd();
		$apuesta->selectAdd(" ap_us_id, SUM(ap_puntaje) as ap_puntaje ");
		$apuesta->groupBy("ap_us_id");
		$apuesta->orderBy("ap_puntaje DESC");
		
		$partidos = DB_DataObject::factory("partidos");
		$partidos->par_fe_id = $this->fe_id;
		
		$apuesta->joinAdd($partidos);
		
		$res = array();
		
		if( $apuesta->find() > 0 ){
			$pos = 1;
			while( $apuesta->fetch() ){
				$apuesta->getLinks();
				$res[$pos] = clone( $apuesta);
				$pos++;
			}
		}
		
		return $res;
	}
	
	public function usuarioHizoApuesta(){
		
		// busco un partido de la fecha, y veo si hizo la apuesta correspondiente
		$partido = DB_DataObject::factory("partidos");
		$partido->par_fe_id = $this->fe_id;
		$partido->find(); $partido->fetch();
		
		$apuesta = DB_DataObject::factory("apuestas");
		$apuesta->ap_par_id = $partido->par_id;
		$apuesta->ap_us_id = SessionVars::getUsuarioId();
		
		if( $apuesta->find() > 0 ) return true;
		
		return false;
		
		
	}
	
	
	private function getListaPartidos(){
		
		$partidos = new Partidos();
		$partidos->par_fe_id = $this->fe_id;
		$partidos->find();
		
		$res = array();
		
		while( $partidos->fetch() ){
			$partidos->getLinks();
			$res[] = clone( $partidos );
		}
		return $res;
		
	}
	
	private function getListaPartidosApuestas(){
		
		$partidos = new Partidos();
		$partidos->par_fe_id = $this->fe_id;
		
		// apuestas
		$apuestas = new Apuestas();
		$apuestas->ap_us_id = SessionVars::getUsuarioId();
		$apuestas->joinAdd($partidos);
		$apuestas->find();
		$res = array();
		
		while( $apuestas->fetch() ){
			$apuestas->getLinks();
			$apuestas->_ap_par_id->getLinks();
			$res[] = clone( $apuestas);
		}
		
		return $res;
		
		
		
	}
	
}

?>

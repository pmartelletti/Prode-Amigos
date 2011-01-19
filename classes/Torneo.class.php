<?php

require_once 'classes/Torneo.php';

class Torneo extends DataObjects_Torneo {
	
	static private $estadosTorneo = array("A" => "ACTIVO", "P" => "PENDIENTE", "F" => "FINALIZADO");
	public $posicionTorneo;
	
	public static function getEstado($key){
		return Torneo::$estadosTorneo[$key];
	}
	
	public function Torneo() {
		
	}
	
	public static function getTorneoActual(){
		
		$torneo = DB_DataObject::factory("torneo");
		$torneo->to_estado = Torneo::getEstado("A");
		if( $torneo->find() > 0 ){
			$torneo->fetch();
			
			$torneoClass = new Torneo();
			$torneoClass->get( $torneo->to_id );
			$torneoClass->getPosicionTorneo();
			return $torneoClass;
			
		} else {
			// no hay torneo activo, ver como resuelvo esto
		}
		
	}
	
	public function getEquiposFixture($to_id = 0){
		
		$res = array();
		if($to_id == 0) $to_id = $this->to_id;
		
		$fechas = DB_DataObject::factory("fecha");
		$fechas->fe_to_id = $to_id;
		$fechas->orderBy("fe_nombre ASC");
		
		$partidos = DB_DataObject::factory("partidos");
		
		$partidos->joinAdd($fechas);
		
		$par = array();
		$impar = array();
		
		echo "Numero: " . $partidos->find();
		
		if( $partidos->find() > 0 ){
			$i = 1;
			while( $partidos->fetch() ){
				$partidos->getLinks();
				if( $i%2 == 0){
					$par[] = clone( $partidos );
				} else {
					$impar[] = clone( $partidos );
				}
			}
		}
		$res["par"] = $par;
		$res["impar"] = $impar;
		
		return $res;
		
	}
	
	public function getPosicionTorneo(){
		$apuesta = DB_DataObject::factory("apuestas");
		$apuesta->selectAdd();
		$apuesta->selectAdd(" ap_us_id, SUM(ap_puntaje) as ap_puntaje ");
		$apuesta->groupBy("ap_us_id");
		$apuesta->orderBy("ap_puntaje DESC");
		
		$partidos = DB_DataObject::factory("fecha");
		$partidos->fe_to_id = $this->to_id;
		
		$apuesta->joinAdd($partidos);
		
		if( $apuesta->find() > 0 ){
			$pos = 1;
			while( $apuesta->fetch() ){
				if( $apuesta->ap_us_id == SessionVars::getUsuarioId() ){
					$this->posicionTorneo = $pos;
				}
				$pos += 1 ;
			}
			
		}
	}
	
	public function getEquiposTorneo(){
		
		$fechas = DB_DataObject::factory("fecha");
		$fechas->fe_to_id = $this->to_id;
		
		$partidos = DB_DataObject::factory("partidos");
		
		$partidos->joinAdd($fechas);
		
		$apuestas = DB_DataObject::factory("apuestas");
		$apuestas->selectAdd();
		$apuestas->selectAdd(" ap_us_id, SUM(ap_puntaje) as ap_puntaje ");
		$apuestas->groupBy("ap_us_id");
		$apuestas->orderBy("ap_puntaje DESC");
		$apuestas->joinAdd($partidos);
		
		/*
		DB_DataObject::debugLevel(5);
		echo "Numero: " . $apuestas->find();
		*/
		
		$res = array();
		
		if( $apuestas->find() > 0 ){
			
			$pos = 1;
			while( $apuestas->fetch() ){
				$apuestas->getLinks();
				$res[$pos] = clone( $apuestas );
				$pos++;
			}
		}
		
		return $res;	
	}
	
	public function getFechaAnterior(){
		
		$actual = $this->getFechaActual();

		$fecha = DB_DataObject::factory("fecha");
		$fecha->fe_to_id = $this->to_id;
		$fecha->fe_nombre = $actual->fe_nombre - 1;
		if( $fecha->find() > 0 ){
			$fecha->fetch();
			
			$fechaClass = new Fecha();
			$fechaClass->get( $fecha->fe_id );
			$fechaClass->find(); $fechaClass->fetch();
			
			return $fechaClass;
		} else {
			// no hay fecha activa
			return null;
		}
	}
	
	public function getFechaActual(){
		
		$fecha = DB_DataObject::factory("fecha");
		$fecha->fe_to_id = $this->to_id;
		$fecha->fe_estado = "ACTIVA";
		if( $fecha->find() > 0 ){
			$fecha->fetch();
			
			$fechaClass = new Fecha();
			$fechaClass->get( $fecha->fe_id );
			$fechaClass->find(); $fechaClass->fetch();
			
			return $fechaClass;
		} else {
			// no hay fecha activa
			return null;
		}
	}
	
		
}
?>
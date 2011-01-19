<?php

require_once 'AbstractView.class.php';
require_once 'classes/Torneo.class.php';
require_once 'classes/Fecha.class.php';

class HomeView extends AbstractView {
	
	var $usuario;
	var $torneoActual;
	var $fecha_actual;
	var $fechaAnterior;
	var $listaPartidos;
	
	var $apuestaUsuario;
	
	public function HomeView(){
		$this->template = "home.html";
	}
	
	public function setDisplayOptions(){
		$usuario = DB_DataObject::factory("usuarios");
		$usuario->get( SessionVars::getUsuarioId() );
		$this->usuario = $usuario->us_nombre;
		
		// busco el torneo actual
		$this->torneoActual = Torneo::getTorneoActual();
		$this->fecha_actual = $this->torneoActual->getFechaActual();
		$this->fechaAnterior = $this->torneoActual->getFechaAnterior();
		$this->fechaAnterior->setProperties();
		
		$this->apuestaUsuario = $this->fecha_actual->usuarioHizoApuesta();
		
		// la lista de partidos de la fecha actual
		$this->listaPartidos = $this->fecha_actual->getListaFecha();
		
	}
	
	public function esApuesta($object, $apuesta){
		
		if( $object->ap_ganador == $apuesta ){
			return  true;
		}
		return false;
		
	}
	
}

?>
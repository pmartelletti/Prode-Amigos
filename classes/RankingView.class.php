<?php

require_once 'AbstractView.class.php';
require_once 'classes/Torneo.class.php';
require_once 'classes/Fecha.class.php';

class RankingView extends AbstractView {
	
	var $usuarioId;
	var $torneoActual;
	var $fechaAnterior;
	
	var $equiposFechaActual;
	var $equiposTorneo;
	
	public function RankingView(){
		$this->template = "ranking.html";
	}
	
	public function setDisplayOptions(){
		$this->usuarioId = SessionVars::getUsuarioId();
		
		// busco el torneo actual
		$this->torneoActual = Torneo::getTorneoActual();
		$this->fechaAnterior = $this->torneoActual->getFechaAnterior();
		
		// recolecto los equipos
		$this->equiposFechaActual = $this->fechaAnterior->getUsuariosPosicionesActual();
		$this->equiposTorneo = $this->torneoActual->getEquiposTorneo();
				
	}
	
}

?>
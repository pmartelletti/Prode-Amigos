<?php

require_once 'AbstractView.class.php';
require_once 'classes/Torneo.class.php';
require_once 'classes/Fecha.class.php';

class FixtureView extends AbstractView {
	
	var $usuarioId;
	var $torneoActual;
	var $fixturePar;
	var $fixtureImpar;
	
	var $fechaActual;
	
	
	public function FixtureView(){
		$this->template = "fixture.html";
	}
	
	public function setDisplayOptions(){
		$this->usuarioId = SessionVars::getUsuarioId();
		
		// busco el torneo actual
		$this->torneoActual = Torneo::getTorneoActual();
		// partidos
		$fixture = $this->torneoActual->getEquiposFixture();
		$this->fixtureImpar = $fixture['impar'];
		$this->fixturePar = $fixture['par'];
		
				
	}
	
	public function setFechaActual($fecha){
		$this->fechaActual = $fecha;
	}
	
}

?>
<?php


class Utils {
	
	static function CambiaFormatoFecha($fecha){
		
		// tener en cuenta si tiene la hora, con split de espacio
		$fechas = explode(" ", $fecha);
		
		if ( sizeof($fechas) == 1) {
			list($anio,$mes,$dia) = explode("-",$fecha); 
   			return $dia."-".$mes."-".$anio; 
		} else {
			
			list($anio,$mes,$dia) = explode("-",$fechas[0]); 
   			return $dia."-".$mes."-".$anio . " a las " . $fechas[1];
		}
	}
	
}
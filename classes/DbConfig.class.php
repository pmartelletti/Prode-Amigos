<?php

require_once 'PEAR.php';

class DbConfig {
	
	public static function setup(){
		$config = parse_ini_file('classes/configDB.ini',TRUE);
		foreach($config as $class=>$values) {
		    $options = &PEAR::getStaticProperty($class,'options');
		    $options = $values;
		}
	}
	
}
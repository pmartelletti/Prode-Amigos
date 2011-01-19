<?php

require_once 'classes/Portada.class.php';
require_once 'classes/LoginView.class.php';
require_once 'classes/SessionVars.class.php';
require_once 'classes/LoginController.class.php';
require_once 'classes/DbConfig.class.php';
require_once 'classes/resultController.class.php';

DbConfig::setup();
SessionVars::start();

$view = $_GET['view'];
$action = $_GET['action'];

$controller =  new resultController();

if( !(isset($action))){

	// acciones para la vista
	$portada = new Portada();
	
	if( SessionVars::isUserLogged() ){
		$content = $controller->getView($view);
		
	} else {
		$login = new LoginView();
		$login->setDisplayOptions();
		$content = $login->getDisplay();
	}
	
	$portada->setDisplayOptions($content);
	echo $portada->getDisplay();
	
} else{
	
	if( SessionVars::isUserLogged() ){
		echo $controller->asynAction($action);
		
	} else {
		$controller = new LoginController();
		echo $controller->makeAsyncRequest($action);
	}
}

?>

<?php

error_reporting(E_ERROR);

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

if( isset($action) ){

	echo $controller->asynAction($action);
	
} else{

	// si el usuario está logueado por facebook, entra por aca
	SessionVars::facebookUser();
		
	// acciones para la vista
	$portada = new Portada();
	
	if( SessionVars::isUserLogged() ){
		$content = $controller->getView($view);
		
	} else {
		if(!isset($view)) $view = "loginView";
		$content = $controller->getView($view);
		
	}
	
	$portada->setDisplayOptions($content);
	echo $portada->getDisplay();
		
}

?>

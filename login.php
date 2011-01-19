<?php

require_once 'classes/LoginView.class.php';

$login = new LoginView();
$login->setDisplayOptions();
echo $login->getDisplay();


?>
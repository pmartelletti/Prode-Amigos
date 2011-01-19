<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Ubuntu:regular,bold' rel='stylesheet' type='text/css'>
<link href="js/jquery-ui/css/smoothness/jquery-ui-1.8.7.custom.css" type="text/css" rel="stylesheet">

<script type="text/javascript" src="js/jquery-ui/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui/js/jquery-ui-1.8.5.custom.min.js"></script>
<script type="text/javascript" src="js/jquery-ui/js/jquery.form.js"></script>
<script type="text/javascript" src="js/jquery-ui/js/jquery.validate.js"></script>

<link href="css/blueprint/screen.css" type="text/css" rel="stylesheet">
<link href="css/general.css" type="text/css" rel="stylesheet">
<title>Pronóstico Deportivo - Liga de Amigos</title>
</head>
<body>
	<div class="container">
		
		<div id="header" class="span-24 last">
			<h1>Pronóstico Deportivo - Liga de Amigos</h1>
		</div>

		<div class="span-5" id="menu">
			<h4>Menu</h4>
			<ul class="menu">
				<li><a href="index.php">Home</a></li>
				<li>Datos del usuario</li>
				<li><a href="index.php?view=ranking">Ranking de usuarios</a></li>
				<li><a href="index.php?view=fixture">Resultados</a></li>
				<li><a href="index.php?action=logout">Cerrar Sesion</a></li>
			</ul>
		</div>
		
		<div id="content" class="span-19 last">
			<?php echo $t->content;?>			
		</div>
		
		<div id="footer" class="span-24 last">
			Pronóstico Deportivo - Liga de Amigos @ 2011 | Un proyecto de Pablo Martelletti | Contacto:  <code>pmartelletti at gmail.com</code>.
		</div>
		
	</div>
</body>
</html>

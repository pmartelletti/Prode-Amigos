<div>
	<h3>Registrarse a Prode-amigos</h3>
	<p>Para tener una mejor y m�s personalizada experiencia en nuestro sitio, es necesario que te 
	registres como usuario del sistema. Para ello, es necesario que llene el formulario a continuaci�n.
	En caso de tener cuenta en facebook, puede loguearse para que sus datos se completen autom�ticamente.</p>
	<!-- Uso la registracion de FACEBOOK para el sitio !-->
	<div id="fb-root"></div>
	<script src="http://connect.facebook.net/es_LA/all.js"></script>
	<script>
	 FB.init({ 
	    appId:'124703570930710', cookie:true, 
	    status:true, xfbml:true 
	 });
	 
	</script>
	<div style="text-align:center;">
		<fb:registration fields="[{'name':'name'}, {'name':'email', 'view':'prefilled'}, {'name':'mail', 'view': 'not_prefilled', 'type':'text', 'description':'Login Email'},  {'name':'password', 'view':'not_prefilled'}]" redirect-uri="http://prode-amigos.com.ar/index.php?action=procesarRegistracion">
  		</fb:registration>
	</div>
	
	
</div>
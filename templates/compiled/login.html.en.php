<script type="text/javascript">
	$(document).ready(function(){
		// proceso el login
		$("#sendLogin").button().click(function(){
			var datos = $("#loginForm").serializeArray();
			$.post("index.php?action=login", datos, function(response){
				var responseDiv = $("#response");
				if(response.statusCode == "100"){
					var respuesta = "<span class='ui-icon ui-icon-check'></span>" + response.statusMsg;
					responseDiv.addClass("success").html(respuesta);
					setTimeout('window.location = "index.php"',1000);
					 
				} else {
					var respuesta = "<span class='ui-icon ui-icon-alert'></span>" + response.statusMsg;
					responseDiv.addClass("error").html(respuesta);
				}
			}, "json");
		})
	});	
</script>

<div class="span-3">&nbsp;</div>
<div id="login" class="span-11 last">
	<form id="loginForm" action="#">
		<fieldset>
			<h4>Login del Usuario</h4>
			<p>
				<label for="us_login">Usuario: </label>
				<?php echo $this->elements['us_login']->toHtml();?>
			</p>
			
			<p>
				<label for="us_pass">Password: </label>
				<?php echo $this->elements['us_pass']->toHtml();?>
			</p>
			<p><?php echo $this->elements['sendLogin']->toHtml();?></p>
			
			<div id="response"></div>
		</fieldset>
	</form>
	
	<p>Todavía no tenés una cuenta? Registrate <a href="index.php?view=registration">acá!</a></p>
	
	<div id="fb-root"></div>
	<script src="http://connect.facebook.net/es_LA/all.js"></script>
	<script>
	 FB.init({ 
	    appId:'124703570930710', cookie:true, 
	    status:true, xfbml:true 
	 });
	 
	  // whenever the user logs in, we refresh the page
        FB.Event.subscribe('auth.login', function() {
			window.location = "http://prode-amigos.com.ar/";
        });
	 
	</script>
	<div style="text-align:center;">
		<p><b>También podés registrarte o loguearte usando tu cuenta de facebook:</b></p>
		
		<fb:login-button perms="user_birthday,user_hometown,user_location,publish_stream" registration-url="http://prode-amigos.com.ar/index.php?view=registration"></fb:login-button>
		

	</div>
</div>

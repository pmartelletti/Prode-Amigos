/**
 * @author pablo
 */

 $(document).ready(function(){
 	
	$("#formLogin").validate({
		errorElement: "span",
		rules: {
			us_seccion: "required",
			us_pass: "required"
		}, 
		submitHandler: function(form) {
				jQuery(form).ajaxSubmit({
					dataType: "json",
					success: validateLogin
				});
			}
		});
	
 });
 
 function validateLogin(output, statusText, xhr, $form){
	if(output.responseCode == 0) {
		showMessage("#message", output.response, "ui-state-highlight", "ui-icon-info");
		setTimeout('window.location = "index.php"', 2000);
	} else {
		showMessage("#message", output.response, "ui-state-error", "ui-icon-alert");
		$("#sec_nombre").select();
	}
	
 }
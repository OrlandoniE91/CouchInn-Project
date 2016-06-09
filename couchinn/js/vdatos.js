function validacion(){
	var input_contraseña = document.getElementById("contraseña");
	var input_confirmacion = document.getElementById("confpass");

	if (input_contraseña.value == input_confirmacion.value) {
		
		return true;
	
	} else {
		//$("#errors").text("La confirmacion no es igual a la contraseña").show();
		$("#errors").text("La confirmacion no es igual a la contrase\u00F1a").fadeIn( "slow" );
		return false;
	}
	
}

function validacionnueva(){
	var input_contraseñavieja = document.getElementById("viejacontrase\u00F1a");
	var input_contraseña = document.getElementById("contraseña");
	var input_confirmacion = document.getElementById("confpass");
	
	if(input_contraseñavieja.value == input_contraseña.value ){
		$("#errors").text("La contraseña nueva no puede ser igual a la contrase\u00F1a vieja").fadeIn( "slow" );
		return false;
		
		}
	
	if (input_contraseña.value == input_confirmacion.value) {
		
		return true;
	
	} else {
		$("#errors").text("La confirmacion no es igual a la contraseña").fadeIn( "slow" );
		return false;
	}
	
}
	
	
	
	
	
	


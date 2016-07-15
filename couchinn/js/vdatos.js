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

function validarFecha(){
	var fInicio = document.getElementById("inicio").value;
	var fFin = document.getElementById("fin").value;

	if (fInicio <= fFin) {		
		return true;	
	} else {
		$("#errors").text("Debe seleccionar una fecha de fin mayor a la de inicio.").fadeIn( "slow" );
		return false;
	}
}

function validarFecha2(){
	var fInicio = document.getElementById("inicio2").value;
	var fFin = document.getElementById("fin2").value;

	if (fInicio <= fFin) {		
		return true;	
	} else {
		$("#errors2").text("Debe seleccionar una fecha de fin mayor a la de inicio.").fadeIn( "slow" );
		return false;
	}
}
	
	
	
	
	
	


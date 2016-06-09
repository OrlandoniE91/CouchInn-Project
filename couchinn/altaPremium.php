<?php
if (isset($_POST['premiumForm'])){
	include("conexion.php");	
	$link=conectardb();
	$mail=$_POST["mail"];
	$fechaNew = new DateTime();
	$fecha = $fechaNew->format('Y-m-d');

// Valores "fantasma" del formulario.
	$nom=$_POST["nombre"];
	$ap=$_POST["apellido"];
	$numT=$_POST["numero"];
	$venc=$_POST["venc"];

	mysqli_query($link, "INSERT INTO premium (usuario, monto, fecha) VALUES ('$mail','50','$fecha')")
	or die("Problemas en el insert".mysqli_error($link)) ;

	mysqli_close($link);
	?>
	<script type="text/javascript"> 
	alert('Alta exitosa');
	document.location=("index.php");
	</script>

	<?php } else 
	header('Location:index.php');
	?>

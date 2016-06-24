<?php
include("conexion.php");	
$link=conectardb();
$fInicio=$_POST["fInicio"];
$fFin=$_POST["fFin"];
$usuario=$_POST["usuario"];
$idHospedaje=$_POST["idHospedaje"];

mysqli_query($link, "INSERT INTO solicitud (usuario, idHospedaje, estado, inicio, fin, ci, cd) values ('$usuario','$idHospedaje','Pendiente','$fInicio','$fFin', 0, 0)")
or die("Problemas en el select".mysqli_error($link)) ;

mysqli_close($link);
?>
<script type="text/javascript"> 
	alert('Solicitud enviada.');
	document.location=("index.php");
</script>


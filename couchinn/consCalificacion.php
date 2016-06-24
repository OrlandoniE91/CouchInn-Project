<?php
include("conexion.php");	
$link=conectardb();
$idSol=$_POST["idSol"];
$calificacion=$_POST["calificacion"];
$fechaNew = new DateTime();
$fecha = $fechaNew->format('Y-m-d');

mysqli_query($link, "UPDATE calificacion SET puntaje = '$calificacion', fecha = '$fecha', estado = 'Completa' WHERE id = '$idSol' ")
or die("Problemas en el select".mysqli_error($link));

mysqli_close($link);
?>
<script type="text/javascript"> 
	alert('¡Muchas gracias por tu tiempo!.');
	document.location=("index.php");
</script>


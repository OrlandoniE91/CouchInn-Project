<?php
include("conexion.php");	
$link=conectardb();
$idSol=$_POST["idSol"];
$calificacion=$_POST["calificacion"];
$fechaNew = new DateTime();
$fecha = $fechaNew->format('Y-m-d');


mysqli_query($link, "UPDATE calificacion SET puntaje = '$calificacion', fecha = '$fecha', estado = 'Completa' WHERE id = '$idSol' ")
or die("Problemas en el select".mysqli_error($link));
$consulta=mysqli_query($link,"SELECT * FROM calificacion WHERE id = '$idSol'");
$res=mysqli_fetch_array($consulta);
$idCalificado=$res['idCalificado'];
$idHospedaje=$res['idHospedaje'];
$consulta=mysqli_query($link,"SELECT puntaje FROM calificacion WHERE estado = 'Completa' AND idHospedaje = '$idHospedaje' AND idCalificado IN (SELECT idUsuario FROM hospedaje WHERE id = '$idHospedaje')");

$prom=0;
$cant=mysqli_num_rows($consulta);
if($cant !=0){
while($res=mysqli_fetch_array($consulta)){
	$prom+=$res[0];
	}
	$prom=$prom/$cant;
	$prom=round($prom,2);
mysqli_query($link, "UPDATE hospedaje SET calificacion='$prom' WHERE id = '$idHospedaje'");
}
mysqli_close($link);
?>
<script type="text/javascript"> 
	alert('¡Muchas gracias por tu tiempo!.');
	document.location=("perfil.php");
</script>


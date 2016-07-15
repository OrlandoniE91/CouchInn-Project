<?php
include("conexion.php");	
$link=conectardb();
$fInicio=$_POST["fInicio"];
$fFin=$_POST["fFin"];
$usuario=$_POST["usuario"];
$idHospedaje=$_POST["idHospedaje"];
$valida=mysqli_query($link,"SELECT * FROM solicitud WHERE idHospedaje = '$idHospedaje' AND estado = 'Aceptada' AND (('$fInicio' BETWEEN inicio AND fin) OR ('$fFin' BETWEEN inicio AND fin))");
if(mysqli_num_rows($valida) == 0){
		mysqli_query($link, "INSERT INTO solicitud (usuario, idHospedaje, estado, inicio, fin, ci, cd) values ('$usuario','$idHospedaje','Pendiente','$fInicio','$fFin', 0, 0)")
		or die("Problemas en el select".mysqli_error($link)) ;
}else{ ?>
	<script type="text/javascript"> 
	alert('El hospedaje ya esta reservado para esta fecha.');
	document.location=("index.php");
	</script>

	
<?php	}
mysqli_close($link);
?>
<script type="text/javascript"> 
	alert('Solicitud enviada.');
	document.location=("index.php");
</script>


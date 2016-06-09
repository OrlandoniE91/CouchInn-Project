<?php 
	include("../conexion.php");
	$database=conectardb();
	$id=$_GET["var"];

	$result=mysqli_num_rows(mysqli_query($database,"SELECT * FROM hospedaje WHERE tipoAlojamiento = '$id' "));
	if($result==0){
		mysqli_query($database,"DELETE FROM tipohospedaje WHERE  id='$id'");
		echo '<script> alert("Se ha borrado el tipo");
		window.location.href="../listadoTipos.php";</script>';
	}
	else{
		mysqli_query($database,"UPDATE tipoHospedaje SET enUso = 0 WHERE id='$id'");
		echo '<script> alert("Tipo de alojamiento en uso, borrado pendiente");
		window.location.href="../listadoTipos.php";</script>';

	}
	mysqli_close($database);

?>   
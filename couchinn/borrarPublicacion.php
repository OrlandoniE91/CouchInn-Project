<?php
include("conexion.php");
$db=conectardb();
$idHospedaje=$_GET['id'];//id de hospedaje

$fechaNew = new DateTime();
$fecha = $fechaNew->format('Y-m-d');

$cons=mysqli_fetch_array(mysqli_query($db,"SELECT * FROM hospedaje WHERE id='$idHospedaje'"));//se trae la tupla del hosp

$cantSol=mysqli_num_rows(mysqli_query($db,"SELECT * FROM solicitud WHERE ((idHospedaje='$idHospedaje') AND (estado='Aceptada') )"));//cantidadsol aceptadas
$idTipo=$cons['tipoAlojamiento'];
$cantHosp=mysqli_num_rows(mysqli_query($db,"SELECT * FROM hospedaje WHERE tipoAlojamiento='$idTipo'"));//hospedajes que usan este tipo de alojamiento


if ($cons['enMuestra'] == 1 ){//si es la primera vez que se lo quiere borrar
	if($cantSol == 0 ){
		mysqli_query($db,"DELETE FROM hospedaje WHERE id='$idHospedaje'");//si no tiene solicitudes se elimina del todo
		mysqli_query($db, "DELETE FROM imagen WHERE idHospedaje = '$idHospedaje' ");

		if($cantHosp  == 1){//si es el ultimo en usar un tipo de hosp
			$enUso=mysqli_fetch_array(mysqli_query($db,"SELECT * FROM tipohospedaje WHERE id='$idTipo'"));
			
		    if($enUso['enUso']== 0){//si estaba con baja logica(marcado en 0)
			   mysqli_query($db,"DELETE FROM tipohospedaje WHERE  id='$idTipo'");//baja fisica del tipo 
			}   
		}
	}
	else{
		mysqli_query($db,"UPDATE hospedaje SET enMuestra = 0 WHERE id='$idHospedaje'");
	}
	header('Location:perfil.php');

} 
else 
{
	//$numAceptadas=mysqli_num_rows(mysqli_query($db, "SELECT MAX(id) FROM solicitud WHERE idHospedaje = '$idHospedaje' AND estado = 'Aceptada' "));
	
	$ultimaSol=mysqli_fetch_array(mysqli_query($db, "SELECT MAX(fin) FROM solicitud WHERE idHospedaje = '$idHospedaje' AND estado = 'Aceptada' "));
	if ($ultimaSol[0] < $fecha){
		 mysqli_query($db, "DELETE FROM hospedaje WHERE id = '$idHospedaje' ");
	     mysqli_query($db, "DELETE FROM solicitud WHERE idHospedaje = '$idHospedaje' ");
		 mysqli_query($db, "DELETE FROM imagen WHERE idHospedaje = '$idHospedaje' ");

		if($cantHosp  == 1){//si es el ultimo en usar un tipo de hosp
			$enUso=mysqli_fetch_array(mysqli_query($db,"SELECT * FROM tipohospedaje WHERE id='$idTipo'"));
			
		    if($enUso['enUso']== 0){//si estaba con baja logica(marcado en 0)
			   mysqli_query($db,"DELETE FROM tipohospedaje WHERE  id='$idTipo'");//baja fisica del tipo 
			 }   
		}
		header('Location:perfil.php');
	}
	else{
		echo '<script> alert("Todavia no se puede borrar");
     window.location.href="perfil.php";</script>';
	}

	
}
?>
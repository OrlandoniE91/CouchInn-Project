<?php 
include("conexion.php");
$db=conectardb();
$id=$_GET["id"];
$idH=$_GET["idH"];
$query = mysqli_query($db, "SELECT * FROM solicitud WHERE id = '$id' ");
$aceptada = mysqli_fetch_array($query);
mysqli_query($db, "UPDATE solicitud SET estado = 'Rechazada' WHERE idHospedaje = '$idH' AND ((inicio BETWEEN '$aceptada[4]' AND '$aceptada[5]') 
	OR (fin BETWEEN '$aceptada[4]' AND '$aceptada[5]')) ");

mysqli_query($db,"UPDATE solicitud SET estado ='Aceptada' WHERE  id='$id'");
mysqli_close($db);
header('Location:perfil.php'); 
?>
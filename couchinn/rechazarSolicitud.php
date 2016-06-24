<?php 
include("conexion.php");
$db=conectardb();
$id=$_GET["id"];
mysqli_query($db,"UPDATE solicitud SET estado ='Rechazada' WHERE  id='$id'");
mysqli_close($db);
header('Location:perfil.php'); 
?>

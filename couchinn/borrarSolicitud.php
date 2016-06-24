<?php 
include("conexion.php");
$db=conectardb();
$id=$_GET["id"];
mysqli_query($db,"DELETE FROM solicitud WHERE id= '$id' ");
mysqli_close($db);
header('Location:perfil.php'); 
?>

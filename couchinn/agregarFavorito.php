<?php
include("conexion.php");
session_start();	
$link=conectardb();
$idUsuario = $_SESSION['id'];
$idHospedaje=$_GET["id"];	
mysqli_query($link, "INSERT INTO favorito (idUsuario, idHospedaje) VALUES ('$idUsuario', '$idHospedaje')");	
mysqli_close($link);
header("Location:post.php?id=".$idHospedaje);

?>



<?php
include("conexion.php");	
$link=conectardb();
$usuario=$_POST["usuario"];
$idComentario=$_POST["idC"];
$idHospedaje=$_POST["idH"];
$respuesta=$_POST["respuesta"];
$fecha = date('Y-m-d');

mysqli_query($link, "INSERT INTO respuesta (idComentario, respuesta, usuario, fecha) VALUES ('$idComentario', '$respuesta', '$usuario', '$fecha')" );	
mysqli_close($link);
header("Location: post.php?id=".$idHospedaje);
?>


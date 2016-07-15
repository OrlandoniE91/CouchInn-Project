<?php
include("conexion.php");	
$link=conectardb();
$usuario=$_POST["usuario"];
$idHospedaje=$_POST["idH"];
$comentario=$_POST["pregunta"];
$fecha = date('Y-m-d');

mysqli_query($link, "INSERT INTO comentario (idHospedaje, usuario, comentario, fecha) VALUES ('$idHospedaje', '$usuario', '$comentario', '$fecha')" );	
mysqli_close($link);
header("Location: post.php?id=".$idHospedaje);
?>


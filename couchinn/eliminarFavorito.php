<?php
include("conexion.php");
session_start();	
$link=conectardb();
$idFav=$_GET["idF"];
$idHospedaje = $_GET["idH"];	
mysqli_query($link, "DELETE FROM favorito WHERE id = '$idFav' ");	
mysqli_close($link);
header("Location:post.php?id=".$idHospedaje);

?>



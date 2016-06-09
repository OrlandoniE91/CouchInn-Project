<?php 
include("conexion.php");
$us=$_POST["usuario"];
$temporal=$_POST["temporal"];


$db=conectardb();
$consulta=mysqli_query($db,"UPDATE usuario SET pass='$temporal' WHERE mail='$us'");
mysqli_close($db);

header("location:index.php");






?>


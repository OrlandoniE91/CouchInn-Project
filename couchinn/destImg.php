<?php
include("conexion.php");
$link=conectardb();
if(!empty($_POST['imagen'])){//si se selecciono un valor
   $img=$_POST['imagen'];//imagen seleccionada
   mysqli_query($link,"UPDATE imagen SET destacada=1 WHERE id=$img"); 
   echo '<script> alert("se destaco una foto");
   window.location.href="index.php";</script>';
}
else{
	echo '<script> alert("Se pondra el logo por defecto");
   window.location.href="index.php";</script>';
}
   
?>
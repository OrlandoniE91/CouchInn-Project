<?php 
if (isset($_POST['altaTipo'])){
 include "conexion.php";
 $database=conectardb();
 mysqli_query($database,"SET NAMES 'utf8'");
 $nombre=$_POST["nombre"]; 
 $descripcion=$_POST["desc"];
 $bar = ucwords(strtolower($nombre));
 
 $consultaTipos=mysqli_num_rows(mysqli_query($database,"SELECT * FROM tipohospedaje WHERE nombre='$bar'"));

 if($consultaTipos==0){
   mysqli_query($database,"INSERT INTO tipohospedaje  VALUES (NULL, '$bar', '$descripcion', 1);");
   echo '<script> alert("Se dio de alta un nuevo tipo");
   window.location.href="altaHospedaje.php";</script>';
 }
 else{
  echo '<script> alert("Ya existe un tipo de alojamiento con ese nombre");
  window.location.href="formAgregarTipo.php";</script>';
  
}
mysqli_close($database);
} else 
header('Location:index.php');

?>   

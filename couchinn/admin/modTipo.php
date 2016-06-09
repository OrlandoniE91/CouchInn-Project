<?php 
if (isset($_POST['formModTipo'])){
 include("../conexion.php");
 $database=conectardb();
 $nombre=$_POST["nombre"]; 
 $descripcion=$_POST["desc"];
 $id=$_POST["id"];
 $bar = ucwords(strtolower($nombre));
 
 $consultaTipos=mysqli_num_rows(mysqli_query($database,"SELECT * FROM tipoHospedaje WHERE nombre='$bar' and id!='$id'"));
 
 if($consultaTipos==0){
   mysqli_query($database,"UPDATE  tipohospedaje SET  nombre ='$bar',
     descripcion= '$descripcion' WHERE  id='$id'");
   echo '<script> alert("Se modifico el tipo satisfactoriamente");
   window.location.href="../listadoTipos.php";</script>';
 }
 else{
  echo '<script> alert("Ya existe un tipo de alojamiento con ese nombre");
  window.location.href="../listadoTipos.php";</script>';
  
}
mysqli_close($database);
}else 
header('Location:../index.php');

?>   
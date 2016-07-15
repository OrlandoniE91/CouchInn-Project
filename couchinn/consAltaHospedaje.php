<?php
include("conexion.php");
$link=conectardb();
  $usuario = $_POST['id'];//obtengo el email
  
  $idUsuario=mysqli_query($link,"SELECT  * FROM usuario WHERE  mail='$usuario'");
  $us=mysqli_fetch_array($idUsuario);
  
  
  $titulo = ucwords(strtolower($_POST['titulo']));
  $descripcion=$_POST['desc'];
  $ciudad=ucwords(strtolower($_POST['ciudad']));
  $tipoHospedaje=$_POST['tHospedaje'];
  $capacidad=$_POST['capacidad'];

  $consulta=mysqli_query($link,"SELECT puntaje FROM calificacion WHERE idCalificado = '$us[0]' AND estado = 'Completa'");
  $prom=0;
  $cant=mysqli_num_rows($consulta);
  while($res=mysqli_fetch_array($consulta)){
  $prom+=$res[0];
  }
  $prom=$prom/$cant;
  $prom=round($prom,2);
  
  $cantTit=mysqli_num_rows(mysqli_query($link,"SELECT * FROM hospedaje WHERE titulo='$titulo'"));
  
  if($cantTit == 0){
     mysqli_query($link,"INSERT INTO hospedaje (titulo, descripcion, ciudad, tipoAlojamiento, capacidad, idUsuario, enMuestra, calificacion ) VALUES ('$titulo', '$descripcion', '$ciudad','$tipoHospedaje','$capacidad','$us[0]', 1, '$prom')");
     $ultID= mysqli_query($link,"SELECT MAX(id) FROM hospedaje"); //obtengo el ultimo hospedaje que se dio de alta
     $id=mysqli_fetch_array($ultID);
     if (!empty($_FILES["fotos"]["name"][0] )){ //pregunta si subio imagenes
       $cantidad= count($_FILES["fotos"]["tmp_name"]);//cantidad de fotos que se quieren subir 
	   echo $cantidad;
       for ($i=0; $i<$cantidad; $i++){
		  $nomImg=$_FILES["fotos"]["name"][$i];
		  mysqli_query($link,"INSERT INTO imagen(nombre, idHospedaje, destacada) VALUES ('$nomImg', '$id[0]', 0)");  
	      copy($_FILES['fotos']['tmp_name'][$i], "./img/".$_FILES['fotos']['name'][$i]);  			  
       }
     }
     header ('Location:destacar.php?var='.$id[0].'');
  }
  else{
     echo '<script> alert("Ya existe un titulo de alojamiento con ese nombre");
     window.location.href="altaHospedaje.php";</script>';
  } 
    
  	 
?>

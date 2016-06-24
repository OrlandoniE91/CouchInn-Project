<?php
include("conexion.php");
$link=conectardb();
 if (!empty($_FILES["fotos"]["name"][0] )){ //pregunta si subio imagenes
       $cantidad= count($_FILES["fotos"]["tmp_name"]);//cantidad de fotos que se quieren subir 
	   $id1=$_POST['id'];
       for ($i=0; $i<$cantidad; $i++){
		  $nomImg=$_FILES["fotos"]["name"][$i];
		  mysqli_query($link,"INSERT INTO imagen(nombre, idHospedaje, destacada) VALUES ('$nomImg', '$id1', 0)");  
	      copy($_FILES['fotos']['tmp_name'][$i], "./img/".$_FILES['fotos']['name'][$i]);  			  
       }
	   header ('Location:perfil.php');
  }
  else{
	  $id=$_POST["id"];
	  echo '<script> alert("No selecciono fotos");
     window.location.href="administrarF.php?id='.$id.'";</script>';
  }
?>	 
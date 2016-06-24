<?php
include("conexion.php");
$link=conectardb();
if(isset($_POST['destacar'])){//si presiono el destacar
   
  if(!empty($_POST['imagen'])){//si se selecciono un valor
    $idHosp=$_POST['id'];
	mysqli_query($link,"UPDATE imagen SET  destacada =0 WHERE  idHospedaje='$idHosp'");//pongo todos las imagenes =0
    $img=$_POST['imagen'];//imagen seleccionada
	mysqli_query($link,"UPDATE imagen SET  destacada =1 WHERE  id='$img'");
    echo '<script> alert("se destaco una foto");
    window.location.href="perfil.php";</script>';
  }
  else{
	 echo '<script> alert("No se realizo cambios en destacar");
     window.location.href="perfil.php";</script>';
  }
}  
else{
	if(!empty($_POST['borrar'])){
		$arraySel=$_POST['borrar'];
		foreach( $arraySel as $img ){
          mysqli_query($link,"DELETE FROM imagen WHERE  id='$img'");
        }  
		echo '<script> alert("se borro lo seleccionado");
        window.location.href="perfil.php";</script>';
	}
	else{
	  echo '<script> alert("no selecciono que borrar");
      window.location.href="perfil.php";</script>';
	}
}   
?>
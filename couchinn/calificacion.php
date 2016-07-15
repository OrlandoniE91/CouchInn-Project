<?php
include("conexion.php");
$link=conectardb();
session_start();
if(isset($_SESSION)){
	$idUsuario=$_SESSION['id'];
	$mail=$_SESSION['usuario'];
	$dia=new DateTime();
	$fechaActual=$dia -> format('Y-m-d');


//bloque para crear calificaciones de inquilinos.
$consulta=mysqli_query($link,"SELECT * FROM solicitud WHERE usuario = '$mail' AND fin < '$fechaActual' AND estado = 'Aceptada' AND ci = 0");
if(mysqli_num_rows($consulta) != 0){	
	while($res=mysqli_fetch_array($consulta)){
		$id=$res['id'];
		mysqli_query($link,"UPDATE solicitud SET ci = 1	WHERE  id = '$id'");
		$idHospedaje=$res['idHospedaje'];
		$hospedaje=mysqli_query($link,"SELECT idUsuario FROM hospedaje WHERE id ='$idHospedaje'");
		$idDueño=mysqli_fetch_array($hospedaje);
		$idD=$idDueño['idUsuario'];
		mysqli_query($link,"INSERT INTO calificacion (idCalifica, estado, idCalificado, idHospedaje) VALUES ('$idUsuario' , 'pendiente', '$idD', '$idHospedaje' )");	
	}
}
//bloque para crear calificaciones de dueños.
$consulta2=mysqli_query($link, "SELECT * FROM  hospedaje WHERE idUsuario='$idUsuario'");
while($hospedaje=mysqli_fetch_array($consulta2)){
      $idHospedaje=$hospedaje['id'];
      $sol=mysqli_query($link,"SELECT * FROM solicitud WHERE idHospedaje='$idHospedaje'  AND fin < '$fechaActual' AND estado = 'Aceptada' AND cd = 0");
      while($arrayS=mysqli_fetch_array($sol)){
	         $id=$arrayS['id'];
	         mysqli_query($link,"UPDATE solicitud SET  cd = 1 WHERE  id = '$id'");
			$usuario=$arrayS['usuario'];
			$query2=mysqli_query($link,"SELECT id FROM usuario WHERE mail = '$usuario'");
			$inquilino=mysqli_fetch_array($query2);
			$idInquilino=$inquilino['id'];
			mysqli_query($link,"INSERT INTO calificacion (idCalifica, idCalificado, estado, idHospedaje) VALUES ('$idUsuario', '$idInquilino', 'pendiente', '$idHospedaje')");
		}
	  }
} 
mysqli_close($link);
header("location:index.php");


?>

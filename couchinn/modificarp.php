<?php
	session_start();
	if(!isset($_SESSION['estado']))
		{
			header('Location:index.php');
		}
	include("conexion.php");
	$db=conectardb();
	$us=$_SESSION["usuario"];
	$tel=$_POST["telefono"];
	$calle=$_POST["calle"];
	$numero=$_POST["numero"];
	$piso=$_POST["piso"];
	$depto=$_POST["departamento"];
	$desc=$_POST["desc"];
	$lugar=$_POST["lugar"];
	if ($tel != ""){
	mysqli_query($db,"UPDATE  usuario SET  telefono ='$tel'
     WHERE  mail='$us'");
		}
	if ($calle != ""){
	mysqli_query($db,"UPDATE  usuario SET  calle ='$calle'
     WHERE  mail='$us'");
		}
	if ($numero!= ""){
	mysqli_query($db,"UPDATE  usuario SET  numero ='$numero'
     WHERE  mail='$us'");
		}
	if ($depto!= ""){
	mysqli_query($db,"UPDATE  usuario SET  dept ='$depto'
     WHERE  mail='$us'");
		}
	if ($piso != ""){
	mysqli_query($db,"UPDATE  usuario SET  piso='$piso'
     WHERE  mail='$us'");
		}
	if ($desc != ""){
	mysqli_query($db,"UPDATE  usuario SET  descripcion='$desc'
     WHERE  mail='$us'");
		}
	
	if ($lugar != ""){
	mysqli_query($db,"UPDATE  usuario SET  lugares='$lugar'
     WHERE  mail='$us'");
		}
	
		mysqli_close($db);

	 header("location:perfil.php");
	


?>

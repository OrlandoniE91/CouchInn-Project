<?php 
include("conexion.php");
session_start();
if(!isset($_SESSION['estado']))
		{
			header('Location:index.php');
		}	
$db=conectardb();
$us=$_SESSION['usuario'];
$consulta=mysqli_query($db,"SELECT * FROM usuario WHERE mail='$us'");
$res=mysqli_fetch_array($consulta);
$vieja=$_POST["vieja"];
$nueva=$_POST["pass"];
$conf=$_POST["confpass"];
if ($vieja == $res['pass']){ 
	 mysqli_query($db,"UPDATE  usuario SET  pass ='$nueva'
     WHERE  mail='$us'");
	 mysqli_close($db); ?>
	 <script type="text/javascript"> 
			alert('Contrase\u00F1a cambiada');
			document.location=("perfil.php");
  	</script>
	<?php
 } else {
	 mysqli_close($db);
	  ?>
	<script type="text/javascript"> 
			alert('La contrase\u00F1a vieja es incorrecta');
			document.location=("contrasena.php");
  	</script>


<?php
  }

?>

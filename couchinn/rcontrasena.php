
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<title>Couch Inn</title>
</head>
<body>
	<header>
		<?php include("barra.php") ?>	
	</header>

	<div class="main container">
		<?php include("loginModal.php") ?>

		<div class="container">
		<?php 
		$us=$_POST["email"];
		$db=conectardb();
		$consulta=mysqli_query($db,"SELECT * FROM usuario WHERE mail='$us'");
		$res=mysqli_fetch_array($consulta);
		mysqli_close($db);
		if($res == 0){ ?> 
				<p class="lead"> ESTE MAIL NO ES VALIDO VUELVA A INTENTARLO</p>
				<a href="recuperar.php" class="btn btn-warning" role="button">Volver</a>
				
	
	
	 <?php } else {
		 $temporal=(string)rand(); ?>
		 <p class="lead"> SU NUEVA CONTRASEÑA ES: <?PHP echo $temporal ?></p>
		 <p class="lead">PRESIONE CONTINUAR PARA VOLVER A INICIAR SESION CON SU NUEVA CONTRASEÑA O VOLVER PARA CANCELAR</p></br>
		  <p class="lead">CUANDO INICIE SESION DIRIJASE A MI PERFIL Y MODIFIQUE SU CONTRASEÑA EN CAMBIAR CONTRASEÑA</p></br>
		 
		 <form class="form-horizontal" method="post" action="actualizarcontrasena.php">
			<div class="form-group">
				<div class="col-md-7 ">
					<input type="hidden" name="usuario" value="<?php echo $us ?>" >
					<input type="hidden" name="temporal" value="<?php echo $temporal ?>" >
					<button type="submit" class="btn btn-primary" name="Continuar" >CONTINUAR</button>
					<a href="recuperar.php" class="btn btn-danger" role="button">VOLVER</a>
				</div>
			</div>
		</form>
		 
		 
		 <?php
		 
		}


	?>
		
	</div>
	<footer>
		
	</footer>
	<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/vdatos.js"> </script>
</body>
</html>

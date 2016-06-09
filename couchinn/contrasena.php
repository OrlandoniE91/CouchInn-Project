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
		
		<?php 
		if(!isset($_SESSION['estado']))
		{
			header('Location:index.php');
		} ?>
				
				<form class="form-horizontal" method="post" action="modcontrasena.php">
				
				<div class="form-group">
					<label for="viejacontraseña" class="control-label col-md-2">Contraseña vieja</label>
					<div class="col-md-5">
						<input type="password" class="form-control" name="vieja" id="viejacontraseña" placeholder="contraseña" required>
					</div>
				</div>
				
				<div class="form-group">
					<label for="nuevacontraseña" class="control-label col-md-2">Contraseña nueva</label>
					<div class="col-md-5">
						<input type="password" class="form-control" name="pass" id="contraseña" placeholder="contraseña" required>
					</div>
				</div>

				<div class="form-group">
					<label for="confpass" class="control-label col-md-2">Confirmacion</label>
					<div class="col-md-5">
						<input type="password" class="form-control" name="confpass" id="confpass" placeholder="confirmar contraseña" required>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-md-2 col-md-offset-2">
						<button type="submit" class="btn btn-primary" name="aceptar" onClick="return validacionnueva();" >Aceptar</button>
						<a href="perfil.php" class="btn btn-warning" role="button">Volver</a>
					</div>
				</div>

				
			</form>
			<div id="errors" class="alert alert-danger" hidden>	
			</div>

			<footer>

			</footer>
			<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
			<script type="text/javascript" src="js/bootstrap.min.js"></script>
			<script type="text/javascript" src="js/vdatos.js"> </script>
		</body>
		</html>


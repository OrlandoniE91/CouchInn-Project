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
		<div id="errors" class="alert alert-danger" hidden>		
			
		</div>
		<div class="container">
		<form class="form-horizontal" method="post" action="altaUsuario.php">
				<div class="form-group">
					<label for="email" class="control-label col-md-2">Email</label>
					<div class="col-md-5">
						<input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
					</div>
				</div>

				<div class="form-group">
					<label for="contraseña" class="control-label col-md-2">Password</label>
					<div class="col-md-5">
						<input type="password" class="form-control" name="pass" id="contraseña" placeholder="contraseña" required>
					</div>
				</div>

				<div class="form-group">
					<label for="confpass" class="control-label col-md-2">Confirmar password</label>
					<div class="col-md-5">
						<input type="password" class="form-control" name="confpass" id="confpass" placeholder="confirmar contraseña" required>
					</div>
				</div>

				<div class="form-group">
					<label for="nombre" class="control-label col-md-2">Nombre</label>
					<div class="col-md-5">
						<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required>
					</div>
				</div>

				<div class="form-group">
					<label for="apellido" class="control-label col-md-2">Apellido</label>
					<div class="col-md-5">
						<input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido" required>
					</div>
				</div>

				<div class="form-group">
					<label for="telefono" class="control-label col-md-2">Telefono</label>
					<div class="col-md-5">
						<input type="number" class="form-control" name="telefono" id="telefono" placeholder="Telefono" pattern="^\d{8}$" required>
					</div>
				</div>

				<div class="form-group">
					<label for="calle" class="control-label col-md-2">Calle</label>
					<div class="col-md-5">
						<input type="text" class="form-control" name="calle" id="calle" placeholder="Calle" required>
					</div>
				</div>

				<div class="form-group">
					<label for="numero" class="control-label col-md-2">Número</label>
					<div class="col-md-5">
						<input type="number" class="form-control" name="numero" id="numero" placeholder="Número" required>
					</div>
				</div>

				<div class="form-group">
					<label for="piso" class="control-label col-md-2">Piso</label>
					<div class="col-md-5">
						<input type="number" class="form-control" name="piso" id="piso" placeholder="Piso">
					</div>
				</div>

				<div class="form-group">
					<label for="departamento" class="control-label col-md-2">Departamento</label>
					<div class="col-md-5">
						<input type="text" class="form-control" name="departamento" id="departamento" placeholder="Departamento">
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-2 col-md-offset-2">
						<button type="submit" class="btn btn-primary" name="registrarse" onClick=" return validacion();" >Aceptar</button>
						<a href="index.php" class="btn btn-warning" role="button">Volver</a>
					</div>
				</div>
			</form>
		</div>

		
	</div>
	<footer>
		
	</footer>
	<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/vdatos.js"> </script>
</body>
</html>


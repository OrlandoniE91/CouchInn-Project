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
		<form class="form-horizontal" action="rcontrasena.php" method="post">
				<div class="form-group">
					<h3>Ingrese su email. Se le enviarán instrucciones para recuperar su contraseña.</h3>
					<label for="email" class="control-label col-md-2">Email</label>
					<div class="col-md-5">
						<input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-2 col-md-offset-2">
						<button type="submit" class="btn btn-primary">Aceptar</button>
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


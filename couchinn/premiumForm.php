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
		<?php 
		if(!isset($_SESSION['estado']))
		{
			header('Location:index.php');
		} ?>	
	</header>

	<div class="main container">
		<?php include("loginModal.php"); 
		$conexion = conectardb();
		$mail = $_SESSION['usuario'];			  
		?>

		<div class="container">
			<?php
			$resultU=mysqli_query($conexion,"SELECT * FROM premium WHERE usuario = '$mail'");
			if(mysqli_num_rows($resultU) ==  0 ){ ?>
			<form class="form-horizontal" action="altaPremium.php" method="post">
				<h3>Complete el siguiente formulario. Se aceptan todas las tarjetas de crédito.</h3>
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
					<label for="tipo" class="control-label col-md-2">Tipo de tarjeta</label>
					<div class="col-md-5">
						<select class="form-control" name="tipo" id="tipo" required>
							<option value="debito">Crédito</option>
							<option value="credito">Débito</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="numero" class="control-label col-md-2">Número de tarjeta</label>
					<div class="col-md-5">
						<input type="text" class="form-control" name="numero" id="numero" placeholder="Número" pattern="[0-1-2-3-4-5-6-7-8-9]{16}" title="El número de tarjeta debe ser de 16 caracteres" required>
					</div>
				</div>

				<div class="form-group">
					<label for="codigo" class="control-label col-md-2">Código de seguridad</label>
					<div class="col-md-5">
						<input type="password" class="form-control" name="codigo" id="codigo" placeholder="Código" pattern="[0-1-2-3-4-5-6-7-8-9]{3}" title="Debe ingresar al menos 3 caracteres numéricos" required>
					</div>
				</div>

				<div class="form-group">
					<label for="venc" class="control-label col-md-2">Vencimiento de la tarjeta</label>
					<div class="col-md-5">
						<input type="date" class="form-control" name="venc" id="venc" placeholder="Fecha de vencimiento" required>
					</div>
				</div>

				<input type="hidden" name="mail" value="<?php echo $_SESSION['usuario'] ?>">

				<div class="form-group">
					<div class="col-md-2 col-md-offset-2">
						<button type="submit" name="premiumForm" class="btn btn-primary">Aceptar</button>
						<a href="index.php" class="btn btn-warning" role="button">Volver</a>
					</div>
				</div>
			</form>
			<?php } else {?>
			<h3>Usted ya es un usuario premium.</h3>
			<?php }
			mysqli_close($conexion) ?>

		</div>

		
	</div>
	<footer>
		
	</footer>
	<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/vdatos.js"> </script>
</body>
</html>


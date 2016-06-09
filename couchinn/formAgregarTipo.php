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

		<div class="container"><form class="form-horizontal" action="agregarTipo.php" method="post">
			<div class="form-group">
				<label for="nombre" class="control-label col-md-2">Nombre</label>
				<div class="col-md-5">
					<input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" required>
				</div>
			</div>
			
			<div class="form-group">
				<label for="descripcion" class="control-label col-md-2">Descripción</label>
				<div class="col-md-5">
					<textarea class="form-control" id="descripcion" rows="10" name="desc" required></textarea>
				</div>
			</div>				
			
			<div class="form-group">
				<div class="col-md-2 col-md-offset-2">
					<button type="submit" class="btn btn-primary" name="altaTipo">Agregar</button>
					<a href="index.php" class="btn btn-warning" role="button">Volver</a>
				</div>
			</div>
		</form>	</div>
	</div>
	<footer>
		
	</footer>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-1.12.2.min.js"></script>
</body>
</html>


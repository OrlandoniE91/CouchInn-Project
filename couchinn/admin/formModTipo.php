<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	<title>Couch Inn</title>
</head>
<body>
	<header>
		<?php include("../barra.php") ?>	
	</header>

	<div class="main container">
	<?php $conexion = conectardb(); 
	$id = $_GET["var"];
	$result = mysqli_query($conexion, "SELECT * FROM tipoHospedaje WHERE id = '$id' ");
	$filasH = mysqli_fetch_array($result);
	$nombreViejo = $filasH[1];
	$descripcionVieja = $filasH['descripcion'];
	?>
	<div class="container">
		
		<form class="form-horizontal" action="modTipo.php" method="post">
			<div class="form-group">
				<label for="nombre" class="control-label col-md-2">Nuevo nombre</label>
				<div class="col-md-5">
					<input type="hidden" value="<?php echo $_GET["var"];?>" name="id"/>
					<input type="text" class="form-control" id="nombre" value="<?php echo $nombreViejo ?>" name="nombre" required>
				</div>
			</div>

			<div class="form-group">
				<label for="descripcion" class="control-label col-md-2">Descripci&oacute;n</label>
				<div class="col-md-5">
					<textarea class="form-control" id="descripcion" rows="10" name="desc" value="<?php echo $descripcionVieja ?>" required><?php echo $descripcionVieja ?></textarea>
				</div>
			</div>				

			<div class="form-group">
				<div class="col-md-2 col-md-offset-2">
					<button type="submit" class="btn btn-primary" name="formModTipo">Modificar</button>
					<a href="../listadoTipos.php" class="btn btn-warning" role="button">Cancelar</a>
				</div>
			</div>
		</form>	
	</div>
	</div>

	<footer>

	</footer>
	<script type="text/javascript" src="../js/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</body>
</html>







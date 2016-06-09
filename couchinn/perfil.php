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

	<div class="main container" style="padding-bottom:15px">
		<?php $link=conectardb();
		$us=$_SESSION['usuario'];
		$consulta=mysqli_query($link,"SELECT * FROM usuario WHERE mail = '$us'");
		$res=mysqli_fetch_array($consulta);
		?>
		
		<label for="email" class="control-label col-md-2">Email:</label>
		<p class="lead" id="email"><?php echo $res[1]; ?></p><br>
		<label for="nombre" class="control-label col-md-2">Nombre:</label>
		<p class="lead" id="nombre"><?php echo $res[3]; ?></p><br>
		<label for="apellido" class="control-label col-md-2">Apellido:</label>
		<p class="lead" id="apellido"><?php echo $res[4]; ?></p><br>
		<label for="telefono" class="control-label col-md-2">Telefono:</label>
		<p class="lead" id="telefono"><?php echo $res[5]; ?></p><br>
		<label for="direccion" class="control-label col-md-2">Direccion:</label>
		<p class="lead" id="direccion"><?php echo $res[6]; ?></p><br>
		<label for="numero" class="control-label col-md-2">Numero:</label>
		<p class="lead" id="numero"><?php echo $res[7]; ?></p><br>
		<label for="piso" class="control-label col-md-2">Piso:</label>
		<p class="lead" id="piso"><?php echo $res['piso']; ?></p><br>
		<label for="depto" class="control-label col-md-2">Departamento:</label>
		<p class="lead" id="depto"><?php echo $res['dept']; ?></p><br>
		<label for="desc" class="control-label col-md-2">Acerca de mi:</label>
		<p class="lead" id="desc"><?php echo $res['descripcion']; ?></p><br>
		<label for="lugar" class="control-label col-md-2">Lugares que quiero visitar:</label>
		<p class="lead" id="lugar"><?php echo $res['lugares']; ?></p><br>
		<form class="form-horizontal" method="post" action="modificarperfil.php">
			<div class="form-group">
				<div class="col-md-7 ">
					<button type="submit" class="btn btn-primary" name="modificar" >Modificar Perfil</button>
					<a href="contrasena.php" class="btn btn-danger" role="button">Modificar contraseña</a>
					<a href="index.php" class="btn btn-warning" role="button">Volver</a>
				</div>
			</div>
		</form></br>
			<a class="btn btn-primary" href="listadoTipos.php">Tipos de hospedaje</a>
			<a class="btn btn-primary" href="formAgregarTipo.php">Agregar tipo</a>
		<?php mysqli_close($link); ?>
	</div>
	
	<footer>

	</footer>
	<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>


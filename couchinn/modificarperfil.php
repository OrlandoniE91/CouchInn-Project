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
		<?php $link=conectardb();
		$us=$_SESSION['usuario'];
		$consulta=mysqli_query($link,"SELECT * FROM usuario WHERE mail = '$us'");
		$res=mysqli_fetch_array($consulta);
		 ?>
	<form class="form-horizontal" method="post" action="modificarp.php">
				
				

				<div class="form-group">
					<label for="telefono" class="control-label col-md-2">Telefono</label>
					<div class="col-md-5">
						<input type="number" class="form-control" name="telefono" id="telefono" placeholder="<?php echo $res[5]; ?>" pattern="^\d{8}$" >
					</div>
				</div>

				<div class="form-group">
					<label for="calle" class="control-label col-md-2">Calle</label>
					<div class="col-md-5">
						<input type="text" class="form-control" name="calle" id="calle" placeholder="<?php echo $res[6]; ?>" >
					</div>
				</div>

				<div class="form-group">
					<label for="numero" class="control-label col-md-2">Número</label>
					<div class="col-md-5">
						<input type="number" class="form-control" name="numero" id="numero" placeholder="<?php echo $res[7]; ?>" >
					</div>
				</div>

				<div class="form-group">
					<label for="piso" class="control-label col-md-2">Piso</label>
					<div class="col-md-5">
						<input type="number" class="form-control" name="piso" id="piso" placeholder="<?php echo $res['piso']; ?>">
					</div>
				</div>

				<div class="form-group">
					<label for="departamento" class="control-label col-md-2">Departamento</label>
					<div class="col-md-5">
						<input type="text" class="form-control" name="departamento" id="departamento" placeholder="<?php echo $res['dept']; ?>">
					</div>
				</div>
				 
				<div class="form-group">
					<label for="desc" class="control-label col-md-2">Acerca de mi:</label>
					<div class="col-md-5">
						<textarea  class="form-control" rows="5" name="desc" id="desc" placeholder="<?php echo $res['descripcion']; ?>"></textarea>
					</div>
				</div>
				
				<div class="form-group">
					<label for="lugar" class="control-label col-md-2">Lugares que quiero visitar:</label>
					<div class="col-md-5">
						<textarea  class="form-control" rows="5" name="lugar" id="lugar" placeholder="<?php echo $res['lugares']; ?>"></textarea>
					</div>
				</div>


				<div class="form-group">
					<div class="col-md-2 col-md-offset-2">
						<button type="submit" class="btn btn-primary" name="aceptar" >Aceptar</button>
						<a href="perfil.php" class="btn btn-warning" role="button">Volver</a>
					</div>
				</div>
			</form>
	<?php mysqli_close($link); ?>
	</div>
	
	<footer>

	</footer>
	<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>


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
			<form class="form-horizontal" method="post" action="consModHopedaje.php" enctype="multipart/form-data">
				<?php
				$id = $_GET['id']; 
				$link=conectardb();
				$consulta=mysqli_query($link,"SELECT * FROM hospedaje WHERE id = '$id'");
				$res=mysqli_fetch_array($consulta); 
				?>
				<input type="hidden" name="idHospedaje" value="<?php echo $id ?>">

				<div class="form-group">
					<label for="titulo" class="control-label col-md-2">Titulo</label>
					<div class="col-md-5">
						<input type="text" class="form-control" name="titulo" id="titulo" placeholder="<?php echo $res[1]; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="descripcion" class="control-label col-md-2">Descripción</label>
					<div class="col-md-5">
						<textarea class="form-control" id="descripcion" rows="10" name="desc" placeholder="<?php echo $res[2]; ?>"></textarea>
					</div>
				</div>		

				<div class="form-group">
					<label for="ciudad" class="control-label col-md-2">Ciudad</label>
					<div class="col-md-5">
						<input type="text" class="form-control" name="ciudad" id="ciudad" placeholder="<?php echo $res[3]; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="tipo" class="control-label col-md-2">Tipo</label>
					<div class="col-md-5">
					<select class="form-control" id="tipo" name="seleccionado">
							<?php $tipos=mysqli_query($link,"SELECT * FROM tipoHospedaje WHERE enUso = 1");
							while($lista=mysqli_fetch_array($tipos)){ 
								if ($lista[0] == $res[4]){
								?>
									<option  selected="selected" value="<?php echo $lista[0] ?>"> <?php echo $lista[1] ?></option>"; 
								<?php }else { ?>
									<option value="<?php echo $lista[0] ?>"> <?php echo $lista[1] ?></option>";
								<?php
								} 
							}
								?>                
							</select>
						</div>
						<!-- <a class="btn btn-primary" href="formAgregarTipo.php">Agregar tipo</a> -->
					</div>
					<div class="form-group">
						<label for="capacidad" class="control-label col-md-2">Capacidad</label>
						<div class="col-md-5">
							<input min="1" max="20" type="number"class="form-control" name="capacidad" id="capacidad"  placeholder="<?php echo $res[5]; ?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-2 col-md-offset-2">
							<button type="submit" class="btn btn-primary" name="registrarse" onClick=" return validacion();" >Modficar</button>
							<a href="perfil.php" class="btn btn-warning" role="button">Volver</a>
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

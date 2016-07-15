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
		<form class="form-horizontal" method="post" action="consAltaHospedaje.php" enctype="multipart/form-data">
		        <input type="hidden" value="<?php echo $_SESSION["usuario"];?>" name="id"/>
				
					<?php
				    $link=conectardb(); ?>
                   <div class="form-group">
					<label for="tHospedaje" class="control-label col-md-2">Tipo Hospedaje</label>
					<div class="col-md-5">
						<select class="form-control" name="tHospedaje" id="tHospedaje" required>
							<?php
							$registros=mysqli_query($link,"SELECT * FROM tipohospedaje WHERE enUso = 1")
							or die("Problemas en el select:".mysqli_error($link)); ?>
							<option value="">Seleccione un tipo</option>
							<?php while ($reg=mysqli_fetch_array($registros)){ ?>
								<option value="<?php echo $reg[0]; ?>"> <?php echo $reg[1]; ?></option>
							<?php } ?>
						</select>
					</div>
				    <a class="btn btn-primary" href="formAgregarTipo.php">Agregar tipo</a>
				</div>
				<div class="form-group">
					<label for="email" class="control-label col-md-2">Titulo</label>
					<div class="col-md-5">
						<input type="text" class="form-control" name="titulo" id="titulo" placeholder="Titulo" required>
					</div>
				</div>
                <div class="form-group">
				<label for="descripcion" class="control-label col-md-2">Descripción</label>
				<div class="col-md-5">
					<textarea class="form-control" id="descripcion" rows="10" name="desc" required></textarea>
				</div>
			   </div>		

				<div class="form-group">
					<label for="nombre" class="control-label col-md-2">Ciudad</label>
					<div class="col-md-5">
						<input type="text" class="form-control" name="ciudad" id="ciudad" placeholder="Ciudad" required>
					</div>
				</div>
				<div class="form-group">
					<label for="telefono" class="control-label col-md-2">Capacidad</label>
					<div class="col-md-5">
						<input min="1" max="20" type="number"class="form-control" name="capacidad" id="capacidad"   required>
					</div>
				</div>

				<div class="form-group">
					<label for="calle" class="control-label col-md-2">Fotos</label>
					<div class="col-md-5">
						<input class="form-control" type="file"  name="fotos[]" id="fotos" placeholder="Fotos"   multiple="true">
					</div>
				</div>

				

				<div class="form-group">
					<div class="col-md-2 col-md-offset-2">
						<button type="submit" class="btn btn-primary" name="registrarse" onClick=" return validacion();" >Publicar</button>
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

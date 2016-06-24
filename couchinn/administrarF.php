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

		<form method="post" class="form-horizontal" action="consAltaFotos.php" enctype="multipart/form-data">
			<input type="hidden" value="<?php echo $_GET["id"];?>" name="id"/>
			<div class="form-group">
				<label for="fotos" class="control-label col-md-2">Agregar fotos</label>
				<div class="col-md-5">
					<input type="file" class="form-control" name="fotos[]" id="fotos" placeholder="Fotos" multiple="true">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-2 col-md-offset-2">
					<button type="submit" class="btn btn-primary" name="nuevaF">Agregar nuevas fotos</button>
				</div>
			</div>
		</form>

		<?php
		$link=conectardb();
		$hosp=$_GET['id']; 
		$cantImg=mysqli_num_rows(mysqli_query($link,"SELECT * FROM imagen WHERE idHospedaje=$hosp")); //imagenes del hosp
		if($cantImg > 0){ ?>
		<table class="table table-responsive table-condensed table-bordered tablaPost">
			<tr>
				<th colspan="3" style="text-align:center">
					<h3>Borrar fotos o destacar foto (si borra una foto destacada sera reemplazada por el logo)</h3>
				</th>
			</tr>
			<form  method="post" action="borrarDestacar.php">
				<input type="hidden" value="<?php echo $_GET["id"];?>" name="id"/>
				<?php $img=mysqli_query($link,"SELECT * FROM imagen WHERE idHospedaje=$hosp");
				while($arrayImg=mysqli_fetch_array($img)){ ?>
				<tr>
					<td>
						<img  width="300" height="200" src="img/<?php echo $arrayImg['nombre'] ?>" >
					</td>
					<td style="vertical-align:middle">
						<input type="checkbox" name="borrar[]" value="<?php echo $arrayImg['id'] ?>">
					</td>
					<?php if($arrayImg['destacada'] == 1) {?>
					<td style="vertical-align:middle">
						<input name="imagen" type="radio" checked="checked" id="imagen" value="<?php echo $arrayImg['id'] ?>" />
					</td>
					<?php } else{?>
					<td style="vertical-align:middle">
						<input name="imagen" type="radio" id="imagen" value="<?php echo $arrayImg['id'] ?>" />
					</td>
					<?php } ?>			
					<?php } ?>	
				</tr>
				<tr col>
					<td>
						
					</td>
					<td>
						<button type="submit" class="btn btn-danger" name="Borrar">Borrar</button>
					</td>
					<td>
						<button type="submit" class="btn btn-primary" name="destacar">Destacar</button>
					</td>
				</tr>
				</form>
			</table>	
			<?php }?>
			<a href="perfil.php" class="btn btn-warning" role="button">Volver</a>
		</div>

		<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/vdatos.js"></script>
	</body>
	</html>
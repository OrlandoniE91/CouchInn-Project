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
	<div class="main container">
	<h1>
		<center>Seleccione la imagen que quiere que se muestre de su publicacion</center>
	</h1>
	<?php
	include("conexion.php");
	$link=conectardb();
	$hospNuevo=$_GET['var']; 
	$cantImg=mysqli_num_rows(mysqli_query($link,"SELECT * FROM imagen WHERE idHospedaje=$hospNuevo")); 
	if($cantImg > 0){ ?>
	<form  method="post" action="destImg.php">
		<div class="form-group">
			<div class="box">
		<?php $img=mysqli_query($link,"SELECT * FROM imagen WHERE idHospedaje=$hospNuevo");
		while($arrayImg=mysqli_fetch_array($img)){ ?>
			<div class="radio-inline">
				<img class="img-responsive" src="img/<?php echo $arrayImg['nombre'] ?>" > 
				<input name="imagen" type="radio" id="imagen" value="<?php echo $arrayImg['id'] ?>" />
			</div>
		<?php } ?>	
			</div>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary" name="destacar">Aceptar</button>
			<a href="index.php" class="btn btn-info" role="button">Mas adelante</a>
		</div>
	</form>	
</div>
<?php }
else{
		header ('Location:index.php');//si no subio imagenes se termina la operacion 
	}
	?>
	

	<footer>

	</footer>
	<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/vdatos.js"></script>
</body>
</html>
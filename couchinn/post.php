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
		<?php $link=conectardb();
		$id=$_GET['id'];
		$resultH=mysqli_query($link,"SELECT * FROM hospedaje WHERE id = '$id'");
		$filasH=mysqli_fetch_array($resultH);
		$resultU=mysqli_query($link,"SELECT * FROM usuario WHERE id = '$filasH[6]' ");
		$filasU = mysqli_fetch_array($resultU);
		?>
		<label for="titulo" class="control-label col-md-2">Título:</label>
		<p class="lead" id="titulo"><?php echo $filasH[1]; ?></p><br>
		<label for="descripcion" class="control-label col-md-2">Descripción:</label>
		<p class="lead" id="descripcion"><?php echo $filasH[2]; ?></p><br>
		<label for="apellido" class="control-label col-md-2">Ciudad:</label>
		<p class="lead" id="apellido"><?php echo $filasH[3]; ?></p><br>
		<label for="tipo" class="control-label col-md-2">Tipo de hospedaje:</label>
		<p class="lead" id="tipo"><?php echo $filasH[4]; ?></p><br>
		<label for="capacidad" class="control-label col-md-2">Capacidad:</label>
		<p class="lead" id="capacidad"><?php echo $filasH[5]; ?> personas</p><br>
		<label for="usuario" class="control-label col-md-2">Dueño:</label>
		<p class="lead" id="usuario"><?php echo $filasU[3]; ?> <?php echo $filasU[4]; ?></p><br>
		<form class="form-horizontal" method="post" action="#solicitud.php">
			<div class="form-group">
				<div class="col-md-2 col-md-offset-2">
					<button type="submit" class="btn btn-primary" name="solicitud" >Solicitar Hospedaje</button>
					<a href="index.php" class="btn btn-warning" role="button">Volver</a>
				</div>
			</div>
		</form>
		<?php 
		      $consulta = mysqli_query($link,"SELECT * FROM imagen WHERE idHospedaje = $id ");
		    			  
		          while ($fotos = mysqli_fetch_array($consulta)){
          	        ?>
				     <img src="imagenesDetalles.php?idfoto=<?php echo $fotos[0]; ?>&idhospedaje=<?php echo $filasH[0]; ?>" >
				 
			   <?php   }
			 
			      mysqli_query($link,"UPDATE imagen SET enMuestra=0 ");
             		  
			  
		      mysqli_close($link); ?>
	</div>
	
	<footer>

	</footer>
	<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>


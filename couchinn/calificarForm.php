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
		<?php include("loginModal.php"); 
		$idSol = $_GET['idSol'];
		?>	
		
		<div class="container">
			<h3>Por favor, califica al usuario para ayudar a mejorar la comunidad, sólo te tomará un momento.</h3>
			<form class="form-horizontal" method="post" action="consCalificacion.php" enctype="multipart/form-data">
				<input type="hidden" value="<?php echo $idSol?>" name="idSol"/>				

				<div class="form-group">
					<label for="calificacion" class="control-label col-md-2">Puntaje</label>
					<div class="col-md-5">
						<input type="range" min="1" max="10" list="steplist" name="calificacion" id="calificacion">
						<datalist id="steplist">
							<option value="1"></option>
							<option value="2"></option>
							<option value="3"></option>
							<option value="4"></option>
							<option value="5"></option>
							<option value="6"></option>
							<option value="7"></option>
							<option value="8"></option>
							<option value="9"></option>
							<option value="10"></option>							
						</datalist>
					</div>
				</div>			

				<div class="form-group">
					<div class="col-md-2 col-md-offset-2">
						<button type="submit" class="btn btn-primary" name="calificar" >Aceptar</button>
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

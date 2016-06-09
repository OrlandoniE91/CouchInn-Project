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
		<?php include("loginModal.php"); ?>
		<div class="container">
		<form action="subirFoto.php" method="POST" enctype="multipart/form-data">
			<label for="imagen">Imagen:</label>
			<input type="file" name="imagen" id="imagen" />
			<input type="submit" name="subir" value="Subir"/>
		</form>
		</div>


		<footer>

		</footer>
		<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
	</body>
	</html>


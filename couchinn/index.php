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
		<?php include("loginModal.php");
		$conexion = conectardb();		  
		$resultH=mysqli_query($conexion,"SELECT * FROM hospedaje WHERE tipoAlojamiento IN(SELECT id FROM tipoHospedaje WHERE enUso = 1)");
		?>
		<div class="row">
			<?php while($filasH = mysqli_fetch_array($resultH)) { 
				$resultU=mysqli_query($conexion,"SELECT * FROM usuario WHERE id = '$filasH[6]' ");
				$filasU = mysqli_fetch_array($resultU);
				?>
				<div class="col-sm-4">
					<div class="box">
						<?php
						if(isset($_SESSION['estado'])){
							$usuario = $_SESSION['usuario'];
							$conexion = conectardb();
							$result = mysqli_query($conexion, "SELECT * FROM premium WHERE usuario = '$usuario'");
							$premium = mysqli_fetch_array($result);
							if ($premium != 0) {?>
							<img class="img-responsive" src="imagen.php?id=<?php echo $filasH[0] ?>">
							<?php } else{ ?>
								<img src="img/logo.png" alt="Logo">
							<?php }
						}else{?>
							<img src="img/logo.png" alt="Logo">
						<?php } ?>
							<h3><?php echo $filasH[1]; ?></h3>
							<?php echo $filasU[3] ?> <?php echo $filasU[4]; ?></p>
							<a type="button" class="btn btn-sm btn-primary" href="post.php?id=<?php echo $filasH[0] ?>" style="margin-bottom:5px;" >Ver detalles</a>
					</div>
				</div>
						<?php } ?>
					</div>
					<?php 
					mysqli_close($conexion);
					?>
				</div>

				<footer>

				</footer>
				<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
				<script type="text/javascript" src="js/bootstrap.min.js"></script>
			</body>
			</html>


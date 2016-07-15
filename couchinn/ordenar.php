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
		
		if(isset($_POST['consulta']))
		{
			$consulta = $_POST['consulta'];
		}
		if(isset($_POST['calificacion']))
		{
			$where[] ="calificacion DESC";
		}
		if(isset($_POST['titulo']))
		{
			$where[] ="titulo";
		}
		if(isset($_POST['capacidad']))
		{
			$where[] ="capacidad";
		}
		
		if(isset ($where)){
			$query =$consulta."ORDER BY ".implode(" ,",$where);
			} else {
				$query = "SELECT * FROM hospedaje";
			}
			$resultH=mysqli_query($conexion,$query);
			$cantResult=mysqli_num_rows($resultH);
			$orden="ORDER BY calificacion"
			?>
			<div class="row">
				<div class="bg-info alertaC">
					<h3><?php echo $cantResult ?> resultados obtenidos.</h3>
					<a href="index.php" class="btn btn-success" role="button"><strong>Volver</strong></a>
				</div>
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
								if ($premium != 0) {
									$consulta = mysqli_query($conexion,"SELECT * FROM imagen WHERE idHospedaje = $filasH[0] AND destacada = 1");	
									$imagen = mysqli_fetch_array($consulta);
									if ($imagen != 0){?>
									<img class="img-responsive" src="img/<?php echo $imagen['nombre'] ?>">
									<?php } else { ?>
									<img src="img/logo.png" alt="Logo">
									<?php } 
								} else{ ?>
								<img src="img/logo.png" alt="Logo">
								<?php }
							}else{?>
							<img src="img/logo.png" alt="Logo">
							<?php } ?>
							<h3><?php echo $filasH[1]; ?></h3>
							<?php echo $filasU[3] ?> <?php echo $filasU[4]; ?></p>
							<p>Valoración: <?php echo $filasH['calificacion']; ?></p>
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



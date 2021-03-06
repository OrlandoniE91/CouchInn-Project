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
		
		if(isset($_POST['titulo']) && $_POST['titulo']!="")
		{
			$where[] = "titulo LIKE '%".$_POST['titulo']."%'";
		}
		if(isset($_POST['ciudad']) && $_POST['ciudad']!="")
		{
			$where[] = "ciudad LIKE '%".$_POST['ciudad']."%'";
		}
		if(isset($_POST['capacidad']) && $_POST['capacidad']!="")
		{
			$where[] = "capacidad LIKE '%".$_POST['capacidad']."%'";
		}
		if(isset($_POST['descripcion']) && $_POST['descripcion']!="")
		{
			$where[] = "descripcion LIKE '%".$_POST['descripcion']."%'";
		}
		if(isset($_POST['thospedaje']) && $_POST['thospedaje']!=" ")
		{
			$where[] = "tipoAlojamiento LIKE '%".$_POST['thospedaje']."%'";
		}
		if (isset($_POST['fechaInicio']) && $_POST['fechaInicio']!=" " && isset($_POST['fechaFin']) && $_POST['fechaFin']!=" ")
		{
			$fechaI=$_POST['fechaInicio'];
			$fechaF=$_POST['fechaFin'];
						
			$where[]="id NOT IN (SELECT idHospedaje FROM solicitud WHERE estado = 'Aceptada' AND (('$fechaI' BETWEEN inicio AND fin) OR ('$fechaF' BETWEEN inicio AND fin)))" ;
			
			
		}
		
		if(isset ($where)){
			$query = "SELECT * FROM hospedaje WHERE ".implode(" AND ",$where);
			} else {
				$query = "SELECT * FROM hospedaje";
			}
			$resultH=mysqli_query($conexion,$query);
			$cantResult=mysqli_num_rows($resultH);
			?>
			<div class="ordenar">
				<form class="form-horizontal" method="post" action="ordenar.php">
					<div class="form-group">
						<input type="hidden" name="consulta" id="consulta" value="<?php echo $query; ?>">
						<div style="text-align:center">
							<label class="checkbox-inline">
							<input type="checkbox" name="calificacion" id="inlineCheckbox1" value="option1"> Valoracion
							</label>
							<label class="checkbox-inline">
							<input type="checkbox" name="titulo" id="inlineCheckbox2" value="option2"> Titulo
							</label>
							<label class="checkbox-inline">
							<input type="checkbox" name="capacidad" id="inlineCheckbox3" value="option3"> Capacidad
							</label>
						</div>
					</div>
					<div class="form-group">
						<div style="text-align:center">
							<button type="submit" class="btn btn-primary btn-sm" name="aceptar">Ordenar</button>
						</div>
					</div>
				</form>
			</div>
			<div class="row">
				<div class="bg-info alertaC">
					<h3><?php echo $cantResult ?> resultados obtenidos.</h3>
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



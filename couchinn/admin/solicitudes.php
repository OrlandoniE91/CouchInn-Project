<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/styles.css">
		<title>Couch Inn</title>
	</head>

	<body style="margin-top:0;">
		<header>
			<?php
			session_start(); 
			if(!isset($_SESSION['estado']))
			{
			header('Location:../index.php');
			} ?>	
		</header>

		<div class="main container" style="padding-bottom:15px">
			<?php 
			include("../conexion.php");
			$db=conectardb();
			$fInicio=$_POST["fechaInicio"];
			$fFin=$_POST["fechaFin"];
			$query = mysqli_query($db, "SELECT * FROM solicitud WHERE fechaAceptada BETWEEN '$fInicio' AND '$fFin' AND estado = 'Aceptada' ORDER BY fechaAceptada DESC");
			?>
			<table class="table table-responsive table-condensed table-bordered tablaCalificacion">
				<tr>
					<th colspan="4" class="success">Solicitudes Aceptadas entre <?php echo $fInicio ?> y <?php echo $fFin ?></th>
				</tr>
				<?php if(mysqli_num_rows($query) != 0){ ?>
				<tr>
					<th>Usuario</th>
					<th>Hospedaje</th>
					<th>Dueño</th>
					<th>Fecha</th>
				</tr>
				<?php 
				while ($aceptadas=mysqli_fetch_array($query)){
					$hosp = mysqli_query($db, "SELECT * FROM hospedaje WHERE id = '$aceptadas[2]' ");
					$resultHosp = mysqli_fetch_array($hosp);
					$queryDueño = mysqli_query($db, "SELECT mail FROM usuario WHERE id = '$resultHosp[6]' ");
					$dueño = mysqli_fetch_array($queryDueño);
				?>
				<tr>
					<td><?php echo $aceptadas['usuario'] ?></td>
					<td><?php echo $resultHosp['titulo'] ?></td>
					<td><?php echo $dueño[0]; ?></td>
					<td><?php echo $aceptadas['fechaAceptada'] ?></td>
				</tr>
				<?php }?>
				<tr>
					<td colspan="4"><a href="../perfil.php" class="btn btn-success" role="button"><strong>Volver al perfil</strong></a></td>
				</tr>
				<?php } else { ?>
				<tr>
					<td>
						<strong>No se han encontrado solicitudes aceptadas en las fechas seleccionadas.</strong>
						<br>
						<a href="../perfil.php" class="btn btn-success" role="button"><strong>Volver al perfil</strong></a>
					</td>
				</tr>
				<?php } ?>
			</table>

			<?php mysqli_close($db); ?>
			<a href="../index.php" class="btn btn-warning volver" role="button"><strong>Home</strong></a>
			<script type="text/javascript" src="../js/jquery-1.12.4.min.js"></script>
			<script type="text/javascript" src="../js/bootstrap.min.js"></script>
			<script type="text/javascript" src="../js/vdatos.js"></script>
		</div>
	</body>
</html>

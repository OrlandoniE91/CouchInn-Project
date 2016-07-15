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
			$query = mysqli_query($db, "SELECT * FROM premium WHERE fecha BETWEEN '$fInicio' AND '$fFin' ");
			$monto = 0;
			?>
			<table class="table table-responsive table-condensed table-bordered tablaCalificacion">
				<tr>
					<th colspan="3" class="success">Ganancias obtenidas entre <?php echo $fInicio ?> y <?php echo $fFin ?></th>
				</tr>
				<?php if(mysqli_num_rows($query) != 0){ ?>
				<tr>
					<th>Usuario Premium</th>
					<th>Fecha</th>
					<th>Monto</th>
				</tr>
				<?php 
				while ($ganancias=mysqli_fetch_array($query)){
					$monto += $ganancias['monto'];
				?>
				<tr>
					<td><?php echo $ganancias['usuario'] ?></td>
					<td><?php echo $ganancias['fecha'] ?></td>
					<td>$<?php echo $ganancias['monto'] ?></td>
				</tr>
				<?php }?>
				<tr>
					<td></td>
					<td class="info">Total:</td>
					<td class="info">$<?php echo $monto ?></td>
				</tr>
				<tr>
					<td colspan="3"><a href="../perfil.php" class="btn btn-success" role="button"><strong>Volver al perfil</strong></a></td>
				</tr>
				<?php } else { ?>
				<tr>
					<td>
						<strong>No se han encontrado ganancias en las fechas seleccionadas.</strong>
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

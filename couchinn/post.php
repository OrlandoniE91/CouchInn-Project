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
		<?php 
		include("loginModal.php");
		$link=conectardb();
		$id=$_GET['id'];
		$resultH=mysqli_query($link,"SELECT * FROM hospedaje WHERE id = '$id' ");
		$filasH=mysqli_fetch_array($resultH);
		$resultT=mysqli_query($link, "SELECT * FROM tipohospedaje WHERE id = '$filasH[4]' ");
		$filasT= mysqli_fetch_array($resultT);
		$resultU=mysqli_query($link,"SELECT * FROM usuario WHERE id = '$filasH[6]' ");
		$filasU = mysqli_fetch_array($resultU);
		$consulta = mysqli_query($link,"SELECT * FROM imagen WHERE idHospedaje = '$id' "); ?>

			<div class="box">
		<?php while ($fotos = mysqli_fetch_array($consulta)){	?>
				<img class="img-responsive" src="img/<?php echo $fotos['nombre']?>" >
			<?php } ?>
			</div>
			<table class="table table-bordered tablaPost">
				<tr>
					<th>Título:</th>
					<td><?php echo $filasH[1]; ?></td>
				</tr>
				<tr>
					<th>Descripción:</th>
					<td><?php echo $filasH[2]; ?></td>
				</tr>
				<tr>
					<th>Ciudad:</th>
					<td><?php echo $filasH[3]; ?></td>
				</tr>
				<tr>
					<th>Tipo de hospedaje:</th>
					<td><?php echo $filasT[1]; ?></td>
				</tr>
				<tr>
					<th>Capacidad:</th>
					<td><?php echo $filasH[5]; ?> personas</td>
				</tr>
				<tr>
					<th>Dueño:</th>
					<td><?php echo $filasU[3]; ?> <?php echo $filasU[4]; ?></td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:center">
					<?php if(!isset($_SESSION['estado']) || ($filasU[1] == $_SESSION['usuario']) || ($filasH[7] == 0)){ ?>
						<a href="#solicitud" data-toggle="modal" class="disabled btn btn-primary">Solicitar Hospedaje</a>
					<?php } else {
						$usuario = $_SESSION['usuario'];
						?>
						<a href="#solicitud" data-toggle="modal" class="btn btn-primary">Solicitar Hospedaje</a>
					<?php } ?>	

					</td>
				</tr>
			</table>

			<a href="index.php" class="btn btn-warning" role="button">Volver</a>



			<?php mysqli_close($link); ?>   
		</div>

		<div class="modal fade" id="solicitud" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Indica la fecha de inicio y fin.</h4>
					</div>
					<div class="modal-body">
					<form action="altaSolicitud.php" method="post">
							<div class="form-group">
								<label for="inicio">Inicio</label>
								<input type="date" class="form-control" name="fInicio" min="<?php echo date('Y-m-d') ?>" id="inicio" required>
							</div>
							<div class="form-group">
								<label for="fin">Fin</label>
								<input type="date" class="form-control" name="fFin" min="<?php echo date('Y-m-d') ?>" id="fin" required>
							</div>
							<input type="hidden" name="idHospedaje" value="<?php echo $filasH[0] ?> ">
							<input type="hidden" name="usuario" value="<?php echo $usuario ?> ">
						
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" onClick="return validarFecha();">Aceptar</button>
						<button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
					</div>
					</form>
					<div id="errors" class="alert alert-danger" hidden>	
				</div>
			</div>
		</div>

		<footer>

		</footer>
		<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/vdatos.js"></script>
	</body>
	</html>


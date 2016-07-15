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
		$fecha = date('Y-m-d');
		$resultH=mysqli_query($link,"SELECT * FROM hospedaje WHERE id = '$id' ");
		$filasH=mysqli_fetch_array($resultH);
		$resultT=mysqli_query($link, "SELECT * FROM tipohospedaje WHERE id = '$filasH[4]' ");
		$filasT= mysqli_fetch_array($resultT);
		$resultU=mysqli_query($link,"SELECT * FROM usuario WHERE id = '$filasH[6]' ");
		$filasU = mysqli_fetch_array($resultU);
		$consulta = mysqli_query($link,"SELECT * FROM imagen WHERE idHospedaje = '$id' ");
		$calificacion=mysqli_query($link, "SELECT * FROM calificacion WHERE idCalificado = '$filasH[6]' AND estado = 'Completa' ");
		$cantC = mysqli_num_rows($calificacion); 
		$resultR = mysqli_query($link, "SELECT * FROM solicitud WHERE idHospedaje = '$filasH[0]' AND estado = 'Aceptada' AND fin > '$fecha' ");
		?>

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
				<th>Reputación:</th>

				<?php if ($cantC) { 										
					$puntaje = 0;
					$cant = 0;
					while($filasCal= mysqli_fetch_array($calificacion)){
						$puntaje += $filasCal['puntaje'];
						$cant += 1;
					}
					$total = $puntaje/$cant;
					?>							
					<td><?php echo round($total,2) ?></td>

					<?php } else {?>
					<td> - </td>
					<?php } ?>
				</tr>
				<tr>
					<th colspan="2" class="success" style="text-align:center">Reservas</th>
				</tr>
				<tr>
					<th style="text-align:center">Desde</th>
					<th style="text-align:center">Hasta</th>
				</tr>
				<?php while($reserva = mysqli_fetch_array($resultR)) {?>
				<tr>
					<td><?php echo $reserva['inicio']; ?></td>
					<td><?php echo $reserva['fin']; ?></td>
				</tr>
				<?php }?>			
				<tr>
					<td style="text-align:center">
						<?php if($filasH[7] == 0){ ?>
						<h3>¡Esta publicación ya no se encuentra disponible!</h3>
						<?php } if(!isset($_SESSION['estado']) || ($filasU[1] == $_SESSION['usuario']) || ($filasH[7] == 0)){ ?>
						<a href="#solicitud" data-toggle="modal" class="disabled btn btn-primary">Solicitar Hospedaje</a>
						<?php } else {
							$usuario = $_SESSION['usuario'];
							?>
							<a href="#solicitud" data-toggle="modal" class="btn btn-primary">Solicitar Hospedaje</a>
							<?php } ?>	

						</td>
						<td>
							<?php
							if(isset($_SESSION['estado'])){
								$idUsuario = $_SESSION['id'];				 
								$favorito = mysqli_query($link, "SELECT * FROM favorito WHERE idHospedaje = '$id' AND idUsuario = '$idUsuario' ");
								if ($fav = mysqli_fetch_array($favorito)){ ?>
								<a href="eliminarFavorito.php?idF=<?php echo $fav['id'] ?>&idH=<?php echo $id; ?>" class="btn btn-warning" role="button">Eliminar favorito</a>
								<?php } else{ ?>
								<a href="agregarFavorito.php?id=<?php echo $id; ?>" class="btn btn-info" role="button">Agregar favorito</a>

								<?php }
							}
							?>
						</td>
					</tr>
				</table>

				<hr>

				<!-- Comentarios  -->

				<!-- Cuadro de texto -->
				<?php if((isset($_SESSION['id'])) && ($_SESSION['id'] != $filasU['id'])){ ?>
				<form class="form-horizontal" method="post" action="comentar.php">
					<input type="hidden" name="usuario" value="<?php echo $_SESSION['usuario']; ?>">
					<input type="hidden" name="idH" value="<?php echo $filasH[0]; ?>">
					<div class="form-group">
						<label for="pregunta" class="control-label col-md-2">Pregunta:</label>
						<div class="col-md-7">
							<textarea  class="form-control" rows="5" name="pregunta" id="pregunta" placeholder="Escribe tu consulta" required></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-2 col-md-offset-2">
							<button type="submit" class="btn btn-primary btn-sm" name="aceptar" >Enviar</button>
						</div>
					</div>				
				</form>
				<?php } ?>

				<?php  
				$resultCom = mysqli_query($link, "SELECT * FROM comentario WHERE idHospedaje = '$id' ORDER BY fecha DESC, id DESC");
				// Preguntas
				if (($hayCom = mysqli_num_rows($resultCom)) != 0) { 
					while ($comentarios = mysqli_fetch_array($resultCom)){
						$resultRes = mysqli_query($link, "SELECT * FROM respuesta WHERE idComentario = '$comentarios[0]' ORDER BY fecha DESC");
						?>

						<div class="comentario" style="background-color: #99b3ff;">
							<blockquote>				
								<small><?php echo $comentarios['usuario'];?> - <?php echo $comentarios['fecha'] ?> </small>
								<p><?php echo  $comentarios['comentario']; ?></p>
							</blockquote>
						</div>
						<?php 
				// Respuestas
						if (($hayResp = mysqli_num_rows($resultRes)) != 0) { 
							$respuestas = mysqli_fetch_array($resultRes);

							?>
							<div class="col-sm-offset-1 comentario" style="background-color:#98e698;">
								<blockquote>
									<small><?php echo $respuestas['usuario'];?> - <?php echo $respuestas['fecha'] ?> </small>
									<p><?php echo $respuestas['respuesta']; ?></p>
								</blockquote>
							</div>
							<hr>
							<?php }else if (isset($_SESSION['estado']) && ($_SESSION['id'] == $filasH['idUsuario'])) { ?>
							<!-- <a href="#" class="btn btn-info btn-xs" role="button">Responder</a> -->

							<form class="form-horizontal" method="post" action="responder.php">
								<input type="hidden" name="usuario" value="<?php echo $_SESSION['usuario']; ?>">
								<input type="hidden" name="idC" value="<?php echo $comentarios[0]; ?>">
								<input type="hidden" name="idH" value="<?php echo $filasH[0]; ?>">
								<div class="form-group">
									<label for="respuesta" class="control-label col-md-2">Responde:</label>
									<div class="col-md-7">
										<textarea  class="form-control" rows="5" name="respuesta" id="respuesta" placeholder="Escribe tu respuesta" required></textarea>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-2 col-md-offset-2">
										<button type="submit" class="btn btn-primary btn-sm" name="aceptar" >Responder</button>
									</div>
								</div>				
							</form>
							<?php } } } ?>

							<a href="index.php" class="btn btn-warning volver" role="button"><strong>Home</strong></a>



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


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
			<?php 
			if(!isset($_SESSION['estado']))
			{
			header('Location:index.php');
			} ?>	
		</header>

		<div class="main container" style="padding-bottom:15px">
			<?php $link=conectardb();
			$us=$_SESSION['usuario'];
			$idUs=$_SESSION['id'];
			$fecha = date('Y-m-d');
			$consulta=mysqli_query($link,"SELECT * FROM usuario WHERE mail = '$us'");
			$res=mysqli_fetch_array($consulta);
			$resultSol=mysqli_query($link, "SELECT * FROM solicitud WHERE usuario = '$us' AND fin > '$fecha' ");
			if ($res[10] == 2){ ?>
			<div class="control-panel">
				<a href="listadoTipos.php" class="btn btn-warning col-md-4 col-md-offset-4" role="button">Administrar Tipos de Hospedaje</a><br>
				<hr>
				
				<div id="errors" class="alert alert-danger" hidden></div>

				<!--Ganancias entre dos fechas -->
				<form class="form-horizontal" method="post" action="admin/ganancias.php">
					<div class="form-group">
						<h3 class="col-md-7 col-md-offset-3">Ganancias entre dos fechas.</h3>
					</div>
				
					<div class="form-group">
						<label for="inicio" class="control-label col-md-3">Fecha de inicio</label>
						<div class="col-md-7">
							<input type="date" class="form-control" name="fechaInicio" id="inicio" required>
						</div>
					</div>
				
					<div class="form-group">
						<label for="fin" class="control-label col-md-3">Fecha de fin</label>
						<div class="col-md-7">
							<input type="date" class="form-control" name="fechaFin" id="fin" required>
						</div>
					</div>
				
					<div class="form-group">
						<div class="col-md-1 col-md-offset-5">
							<button type="submit" class="btn btn-primary" name="aceptar" onClick="return validarFecha();">Buscar</button>
						</div>
					</div>
				</form>

				<hr>

				<div id="errors2" class="alert alert-danger" hidden></div>

				<!--Solicitudes aceptadas entre dos fechas -->
				<form class="form-horizontal" method="post" action="admin/solicitudes.php">
					<div class="form-group">
						<h3 class="col-md-7 col-md-offset-3">Solicitudes aceptadas entre dos fechas.</h3>
					</div>
				
					<div class="form-group">
						<label for="inicio2" class="control-label col-md-3">Fecha de inicio</label>
						<div class="col-md-7">
							<input type="date" class="form-control" name="fechaInicio" id="inicio2" required>
						</div>
					</div>
				
					<div class="form-group">
						<label for="fin2" class="control-label col-md-3">Fecha de fin</label>
						<div class="col-md-7">
							<input type="date" class="form-control" name="fechaFin" id="fin2" required>
						</div>
					</div>
				
					<div class="form-group">
						<div class="col-md-1 col-md-offset-5">
							<button type="submit" class="btn btn-primary" name="aceptar" onClick="return validarFecha2();">Buscar</button>
						</div>
					</div>
				</form>
			</div>
			<?php } ?>
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#datos" aria-controls="datos" role="tab" data-toggle="tab"><strong>Mis Datos</strong></a></li>
				<li role="presentation"><a href="#publicaciones" aria-controls="publicaciones" role="tab" data-toggle="tab"><strong>Mis Publicaciones</strong></a></li>
				<li role="presentation"><a href="#solicitudes" aria-controls="solicitudes" role="tab" data-toggle="tab"><strong>Mis solicitudes enviadas</strong></a></li>
				<li role="presentation"><a href="#calificaciones" aria-controls="calificaciones" role="tab" data-toggle="tab"><strong>Calificaciones</strong></a></li>
				<li role="presentation"><a href="#historial" aria-controls="historial" role="tab" data-toggle="tab"><strong>Historial/Favoritos</strong></a></li>
			</ul>

			<!-- Secciones de perfil separadas en pestañas (Tabs) -->
			<div class="tab-content">

				<!-- Panel con datos personales -->
				<div role="tabpanel" class="tab-pane active" id="datos">
					<?php
					$calificacion=mysqli_query($link, "SELECT * FROM calificacion WHERE idCalificado = '$res[0]' AND estado = 'Completa' ");
					$cantC = mysqli_num_rows($calificacion); 
					?>
					<br>
					<table class="table table-responsive table-condensed table-bordered tablaPerfil">
						<tr>
							<th colspan="2" style="text-align:center" class="success">
								<h3>Mis datos</h3>
							</th>
						</tr>
						<tr>
							<th>Email:</th>
							<td><?php echo $res[1]; ?></td>
						</tr>
						<tr>
							<th>Nombre:</th>
							<td><?php echo $res[3]; ?></td>
						</tr>
						<tr>
							<th>Apellido:</th>
							<td><?php echo $res[4]; ?></td>
						</tr>
						<tr>
							<th>Telefono:</th>
							<td><?php echo $res[5]; ?></td>
						</tr>
						<tr>
							<th>Direccion:</th>
							<td><?php echo $res[6]; ?></td>
						</tr>
						<tr>
							<th>Numero:</th>
							<td><?php echo $res[7]; ?></td>
						</tr>
						<tr>
							<th>Piso:</th>
							<td><?php echo $res['piso']; ?></td>
						</tr>
						<tr>
							<th>Departamento:</th>
							<td><?php echo $res['dept']; ?></td>
						</tr>
						<tr>
							<th>Acerca de mi:</th>
							<td><?php echo $res['descripcion']; ?></td>
						</tr>
						<tr>
							<th>Lugares que quiero visitar:</th>
							<td><?php echo $res['lugares']; ?></td>
						</tr>
						<?php if ($cantC) { 										
						$puntaje = 0;
						$cant = 0;
						while($filasCal= mysqli_fetch_array($calificacion)){
						$puntaje += $filasCal['puntaje'];
						$cant += 1;
						}
						$total = $puntaje/$cant;
						?>
						<tr>
							<th>Reputación</th>
							<td><?php echo round($total,2) ?></td>
						</tr>
						<?php } ?>
						<tr>
							<td>
								<a class="btn btn-primary" href="modificarperfil.php">Modificar Perfil</a>
							</td>
							<td>
								<a class="btn btn-warning" href="contrasena.php" role="button">Cambiar contraseña</a>
							</td>
						</tr>
					</table>
				</div>

				<!-- Panel con mis publicaciones y sus solicitudes -->
				<div role="tabpanel" class="tab-pane" id="publicaciones">
					<?php $misHospedajes=mysqli_query($link, "SELECT * FROM hospedaje WHERE idUsuario = '$res[id]' ");
					while($filasmH=mysqli_fetch_array($misHospedajes)){
					$fotos = mysqli_query($link,"SELECT * FROM imagen WHERE idHospedaje = $filasmH[0] ");
					$resultT=mysqli_query($link, "SELECT * FROM tipohospedaje WHERE id = '$filasmH[4]' ");
					$filasT= mysqli_fetch_array($resultT);?>
					<div class="post">
						<div class="box">
							<?php while ($resultF = mysqli_fetch_array($fotos)){
							?>
							<img class="img-responsive" src="img/<?php echo $resultF['nombre']?>" >
							<?php   } ?>
						</div>

						<table class="table table-responsive table-condensed table-bordered tablaPost">
							<tr>
								<th colspan="2" style="text-align:center" class="info">
									<h3><?php echo $filasmH[1] ?></h3>
								</th>
							</tr>
							<tr>
								<th>Descripción:</th>
								<td><?php echo $filasmH[2]; ?></td>
							</tr>
							<tr>
								<th>Ciudad:</th>
								<td><?php echo $filasmH[3]; ?></td>
							</tr>
							<tr>
								<th>Tipo de Hospedaje:</th>
								<td><?php echo $filasT[1]; ?></td>
							</tr>
							<tr>
								<th>Capacidad:</th>
								<td><?php echo $filasmH[5]; ?></td>
							</tr>
							<tr>
								<td colspan="3">
									<a class="btn btn-info" href="administrarF.php?id=<?php echo $filasmH[0]?> ">Administrar fotos</a>
									<a class="btn btn-primary" href="formModHosp.php?id=<?php echo $filasmH[0]?> ">Modificar publicación</a>
									<?php if ($filasmH['enMuestra'] == 1){?>
									<a class="btn btn-danger" href="borrarPublicacion.php?id=<?php echo $filasmH[0]?>" role="button" onclick="return confirm('Se va a borrar la publicación. Si posee reservas pendientes, sólo se deshabilitará el ingreso de nuevas solicitudes ¿Continuar?')">Borrar publicación</a>
									<?php } else {?>
									<a class="btn btn-danger" href="borrarPublicacion.php?id=<?php echo $filasmH[0]?>" role="button" onclick="return confirm('Se va a borrar la publicación de la base de datos. ¿Continuar?')">Borrar publicación</a>
									<?php }?>
								</td>
							</tr>
						</table>

						<table class="table table-responsive table-condensed table-bordered tablaSolicitud">
							<tr>
								<th colspan="4" style="text-align:center" class="success">
									<h3>Solicitudes Recibidas</h3>
								</th>
							</tr>
							<?php
							$solicitudes=mysqli_query($link, "SELECT * FROM solicitud WHERE idHospedaje = '$filasmH[0]' AND estado != 'Rechazada' AND fin > '$fecha' ");
							while($filasSR=mysqli_fetch_array($solicitudes)){?>
							<tr>
								<th>
									<?php echo $filasSR[1]; ?>
								</th>
								<td>
									<?php echo $filasSR[3]; ?>
								</td>
								<td>
									Desde <?php echo $filasSR['inicio']; ?> hasta <?php echo $filasSR['fin']; ?>
								</td>
								<td>
									<?php if ($filasSR['estado'] == 'Aceptada'){ ?>
									<a href="aceptarSolicitud.php" class="btn btn-info disabled">Aceptar</a>
									<a href="rechazarSolicitud.php?id=<?php echo $filasSR[0] ?>" class="btn btn-danger disabled">Rechazar</a>
									<?php } else {?>
									<a href="aceptarSolicitud.php?id=<?php echo $filasSR[0] ?>&idH=<?php echo $filasmH[0] ?>" class="btn btn-info" onclick="return confirm('Se recharazán todas las solicitudes que coincidan con la fecha')">Aceptar</a>
									<a href="rechazarSolicitud.php?id=<?php echo $filasSR[0] ?>" class="btn btn-danger">Rechazar</a>
									<?php } ?>
								</td>
							</tr>
									<?php } ?>
						</table>
					</div>
					<?php } ?>
				</div>

				<!-- Panel con solicitudes enviadas -->
				<div role="tabpanel" class="tab-pane" id="solicitudes">
					<br>
					<table class="table table-responsive table-condensed table-bordered tablaSolicitud">
						<tr>
							<th colspan="4" style="text-align:center" class="warning">
								<h3>Mis solicitudes realizadas</h3>
							</th>
						</tr>
						<?php while($filasS=mysqli_fetch_array($resultSol)){ 
						$hospedajes=mysqli_query($link, "SELECT * FROM hospedaje WHERE id = '$filasS[2]' AND enMuestra = 1");
						$filasH=mysqli_fetch_array($hospedajes);?>
						<tr>
							<th>
								<?php echo $filasH[1]; ?>
							</th>
							<td>
								<?php echo $filasS[3]; ?>
							</td>
							<td>
								Desde <?php echo $filasS['inicio']; ?> hasta <?php echo $filasS['fin']; ?>
							</td>
							<td>
								<a href="post.php?id=<?php echo $filasS[2] ?>" class="btn btn-info">Ver publicación</a>
								<?php if ($filasS['estado'] == 'Aceptada'){ ?>
								<a href="borrarSolicitud.php" class="btn btn-danger disabled">Borrar</a>
								<?php } else {?>
								<a href="borrarSolicitud.php?id=<?php echo $filasS[0] ?>" class="btn btn-danger" onclick="return confirm('¿Desea eliminar la solicitud?')">Borrar</a>
								<?php } ?>
							</td>
						</tr>
						<?php } ?>
					</table>
				</div>

				<!-- Panel con calificaciones pendientes, dadas, y recibidas -->
				<div role="tabpanel" class="tab-pane" id="calificaciones">
					<br>
					<table class="table table-responsive table-condensed table-bordered tablaSolicitud">
						<tr>
							<th colspan="3" class="info">
								Calificaciones pendientes
							</th>
						</tr>
						<tr>
							<th>Usuario</th>
							<th>Hospedaje</th>
						</tr>
						<?php 
						$calificaciones=mysqli_query($link, "SELECT * FROM calificacion WHERE idCalifica = '$idUs' AND estado = 'pendiente' ");
						while ($filasCal=mysqli_fetch_array($calificaciones)){
						$hospedaje = mysqli_query($link, "SELECT * FROM hospedaje WHERE id = '$filasCal[6]' ");
						$nombreHospedaje = mysqli_fetch_array($hospedaje);
						$usuario = mysqli_query($link, "SELECT * FROM usuario WHERE id = '$filasCal[3]' ");
						$resUsuario = mysqli_fetch_array($usuario);
						?>
						<tr>
							<td><?php echo $resUsuario['mail'] ?></td>
							<td><?php echo $nombreHospedaje['titulo'] ?> <a href="post.php?id=<?php echo $nombreHospedaje[0] ?>" class="btn btn-info btn-xs">Ver publicación</a></td>
							<td><a href="calificarForm.php?idSol=<?php echo $filasCal[0]?>" role="button" class="btn btn-primary" >¡Califica!</a></td>
						</tr>
						<?php } ?>
					</table>

					<div class="col-md-6">
						<table class="table table-responsive table-condensed table-bordered tablaCalificacion">
							<tr>
								<th colspan="4" class="warning">Calificaciones recibidas</th>
							</tr>
							<tr>
								<th>Calificado por</th>
								<th>Hospedaje</th>
								<th>Puntaje</th>
								<th>Fecha</th>
							</tr>
							<?php 
							$calificacionesR=mysqli_query($link, "SELECT * FROM calificacion WHERE idCalificado = '$idUs' AND estado = 'Completa' ");
							while ($calR=mysqli_fetch_array($calificacionesR)){
							$hospedaje = mysqli_query($link, "SELECT * FROM hospedaje WHERE id = $calR[6]");
							$nombreHospedaje = mysqli_fetch_array($hospedaje); 
							$usuario = mysqli_query($link, "SELECT * FROM usuario WHERE id = '$calR[1]' ");
							$resUsuario = mysqli_fetch_array($usuario);
							?>
							<tr>
								<td><?php echo $resUsuario['mail'] ?></td>
								<td><?php echo $nombreHospedaje['titulo'] ?></td>
								<td><?php echo $calR['puntaje'] ?></td>
								<td><?php echo $calR['fecha'] ?></td>
							</tr>
							<?php } ?>
						</table>
					</div>

					<div class="col-md-6">
						<table class="table table-responsive table-condensed table-bordered tablaCalificacion">
							<tr>
								<th colspan="4" class="success">Calificaciones dadas</th>
							</tr>
							<tr>
								<th>Usuario</th>
								<th>Hospedaje</th>
								<th>Puntaje</th>
								<th>Fecha</th>
							</tr>
							<?php 
							$calificacionesD=mysqli_query($link, "SELECT * FROM calificacion WHERE idCalifica = '$idUs' AND estado = 'Completa' ");
							while ($calD=mysqli_fetch_array($calificacionesD)){
							$hospedaje = mysqli_query($link, "SELECT * FROM hospedaje WHERE id = $calD[6]");
							$nombreHospedaje = mysqli_fetch_array($hospedaje);
							$usuario = mysqli_query($link, "SELECT * FROM usuario WHERE id = '$calD[3]' ");
							$resUsuario = mysqli_fetch_array($usuario);
							?>
							<tr>
								<td><?php echo $resUsuario['mail'] ?></td>
								<td><?php echo $nombreHospedaje['titulo'] ?></td>
								<td><?php echo $calD['puntaje'] ?></td>
								<td><?php echo $calD['fecha'] ?></td>
							</tr>
							<?php } ?>
						</table>
					</div>
				</div>

				<!-- Panel con historial de hospedajes visitados y lista de favoritos -->
				<div role="tabpanel" class="tab-pane" id="historial">
					<br>
					<?php $resultFav = mysqli_query($link, "SELECT * FROM favorito WHERE idUsuario = '$idUs' "); 
					$resultVis = mysqli_query($link, "SELECT * FROM solicitud WHERE usuario = '$us' AND fin < '$fecha' AND estado = 'Aceptada' "); ?>

					<table class="table table-responsive table-condensed table-bordered tablaCalificacion">
						<tr>
							<th colspan="3" class="warning">Mis hospedajes favoritos</th>
						</tr>
						<tr>
							<th>Título</th>
						</tr>
						<?php 
						while ($filasFav=mysqli_fetch_array($resultFav)){
						$hospFav = mysqli_query($link, "SELECT * FROM hospedaje WHERE id = '$filasFav[2]' AND enMuestra = 1");
						$filasHFav = mysqli_fetch_array($hospFav);
						?>
						<tr>
							<td><?php echo $filasHFav['titulo'] ?></td>
							<td><a href="post.php?id=<?php echo $filasFav[2] ?>" class="btn btn-info btn-sm">Ver publicación</a></td>
						</tr>
						<?php } ?>
					</table>

					<table class="table table-responsive table-condensed table-bordered tablaCalificacion">
						<tr>
							<th colspan="4" class="success">Hospedajes Visitados</th>
						</tr>
						<tr>
							<th>Título</th>
							<th>Desde</th>
							<th>Hasta</th>
						</tr>
						<?php 
						while ($filasVis=mysqli_fetch_array($resultVis)){
						$hospVis = mysqli_query($link, "SELECT * FROM hospedaje WHERE id = '$filasVis[2]' ");
						$filasHVis = mysqli_fetch_array($hospVis);
						?>
						<tr>
							<td><?php echo $filasHVis['titulo'] ?></td>
							<td><?php echo $filasVis['inicio'] ?></td>
							<td><?php echo $filasVis['fin'] ?></td>
							<td><a href="post.php?id=<?php echo $filasVis[2] ?>" class="btn btn-info">Ver publicación</a></td>
						</tr>
						<?php } ?>
					</table>

				</div>

				<a href="index.php" class="btn btn-warning volver" role="button"><strong>Home</strong></a>
				<?php mysqli_close($link); ?>
			</div>

			<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
			<script type="text/javascript" src="js/bootstrap.min.js"></script>
			<script type="text/javascript" src="js/vdatos.js"></script>
		</div>
	</body>
</html>
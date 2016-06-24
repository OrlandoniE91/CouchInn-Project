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
		$consulta=mysqli_query($link,"SELECT * FROM usuario WHERE mail = '$us'");
		$res=mysqli_fetch_array($consulta);
		$resultSol=mysqli_query($link, "SELECT * FROM solicitud WHERE usuario = '$us'");
		if ($res[10] == 2){ ?>
			<a href="listadoTipos.php" class="btn btn-warning" role="button">Administrar Tipos de Hospedaje</a>
			<?php } ?>
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#datos" aria-controls="datos" role="tab" data-toggle="tab">Mis Datos</a></li>
				<li role="presentation"><a href="#publicaciones" aria-controls="publicaciones" role="tab" data-toggle="tab">Mis Publicaciones</a></li>
				<li role="presentation"><a href="#solicitudes" aria-controls="solicitudes" role="tab" data-toggle="tab">Mis solicitudes enviadas.</a></li>
				<li role="presentation"><a href="#calificaciones" aria-controls="calificaciones" role="tab" data-toggle="tab">Calificaciones.</a></li>
			</ul>

			<!-- Secciones de perfil separadas en pestañas (Tabs) -->
			<div class="tab-content">

				<!-- Panel con datos personales -->
				<div role="tabpanel" class="tab-pane active" id="datos">
					<?php
						$calificacion=mysqli_query($link, "SELECT * FROM calificacion WHERE idCalificado = '$res[0]' AND estado = 'Completa' ");
						$cantC = mysqli_num_rows($calificacion); 
					?>
					<table class="table table-responsive table-condensed table-bordered tablaPerfil">
						<tr>
							<th colspan="2" style="text-align:center">
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
										<th colspan="2" style="text-align:center">
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
												<th colspan="4" style="text-align:center">
													<h3>Solicitudes Recibidas</h3>
												</th>
											</tr>
											<?php
											$solicitudes=mysqli_query($link, "SELECT * FROM solicitud WHERE idHospedaje = '$filasmH[0]' AND estado != 'Rechazada' ");
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
												<table class="table table-responsive table-condensed table-bordered tablaSolicitud">
													<tr>
														<th colspan="4" style="text-align:center">
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

											<div role="tabpanel" class="tab-pane" id="calificaciones">

												<table class="table table-responsive table-condensed table-bordered tablaSolicitud">
													<tr>
														<th>Usuario</th>
														<th>Estado</th>
													</tr>
											<?php 
												$calificaciones=mysqli_query($link, "SELECT * FROM calificacion WHERE idCalifica = '$idUs' AND estado = 'pendiente' ");
												while ($filasCal=mysqli_fetch_array($calificaciones)){
													$usuario = mysqli_query($link, "SELECT * FROM usuario WHERE id = '$filasCal[3]' ");
													$resUsuario = mysqli_fetch_array($usuario);
											?>
													<tr>
														<td><?php echo $resUsuario['mail'] ?></td>
														<td><?php echo $filasCal['estado'] ?></td>
														<td><a href="calificarForm.php?idSol=<?php echo $filasCal[0]?>" role="button" class="btn btn-primary" >¡Califica este usuario!</a></td>
													</tr>
													
											<?php } ?>
												</table>
											</div>



														<a href="index.php" class="btn btn-warning" role="button">Volver</a>
														<?php mysqli_close($link); ?>
													</div>

													<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
													<script type="text/javascript" src="js/bootstrap.min.js"></script>
												</body>
												</html>


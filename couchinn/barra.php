		<?php
// Start the session
		session_start();
		include("conexion.php");
		if(isset($_SESSION['estado'])){
			$usuario = $_SESSION['usuario'];
			$conexion = conectardb();
			$result = mysqli_query($conexion, "SELECT * FROM premium WHERE usuario = '$usuario'");
			$premium = mysqli_fetch_array($result);
			mysqli_close($conexion);
		}
		?>

		<nav class="navbar navbar-default navbar-static-top navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php">CouchInn</a>
				</div>

				<div class="collapse navbar-collapse" id="navbar1">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#acercaDe" data-toggle="modal">Acerca De</a></li>
						<?php if(!isset($_SESSION['estado'])){ ?>
							<li><a href="#login" data-toggle="modal">Iniciar Sesión</a></li>
							<li><a href="registrarse.php">Registrarse</a></li>
							<?php  } else { 
								if ($premium == 0){?>
								<li><a type="button" class="btn btn-danger" href="premiumForm.php" style="color:white">¡Hazte Premium!</a></li>
								<?php } ?>
								<li><a type="button" class="btn btn-primary" href="altaHospedaje.php" style="color:white">¡Publica!</a></li>
								<li><a href="perfil.php">Mi perfil: <?php echo $_SESSION['usuario'] ?></a></li>
								<li><a href="logOff.php" onclick="return confirm('¿Salir?')">Cerrar Sesión</a></li>
								<?php } ?>		
							</ul>
						</div>
					</div>
				</nav>

				<div class="modal fade" id="acercaDe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel">¿Quiénes somos?</h4>
							</div>
							<div class="modal-body">
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
								cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
								proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
					</div>
				</div>

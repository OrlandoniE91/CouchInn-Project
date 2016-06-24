		<!-- Login Modal -->
		<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Iniciar Sesión</h4>
					</div>
					<div class="modal-body">
						<form action="logIn.php" method="post">
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" class="form-control" name="mail" id="mail" placeholder="Email" required>
							</div>
							<div class="form-group">
								<label for="pass">Password</label>
								<input type="password" class="form-control" name="pass" id="pass" placeholder="Password" required>
							</div>
							<div class="form-group">
								<a href="recuperar.php">¿Olvidó su contraseña?</a>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
							<button type="submit" class="btn btn-primary">Aceptar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
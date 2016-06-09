<?php

function conectardb(){
	$conexion=mysqli_connect('localhost', 'root','','couchinn')
		or die ('Error de conexión');
	return $conexion;
}
?>

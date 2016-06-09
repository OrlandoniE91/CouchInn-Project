<?php
include("conexion.php");
$conexion = conectardb();

//si la variable imagen no ha sido definida nos dara un advertencia.
$id = $_GET['id'];

if ($id > 0){
	//vamos a crear nuestra consulta SQL
	$consulta = mysqli_query($conexion,"SELECT imagen, tipo FROM imagen WHERE idHospedaje = $id AND destacada = 1") or die(mysql_error());
	$datos = mysqli_fetch_array($consulta);

	//ruta va a obtener un valor parecido a "imagenes/nombre_imagen.jpg" por ejemplo
	$imagen = $datos['imagen'];
	$tipo = $datos['tipo'];

	//ahora colocamos la cabeceras correcta segun el tipo de imagen
	header("Content-type: $tipo");

	echo $imagen;
}

?>
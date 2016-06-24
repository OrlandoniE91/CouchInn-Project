<?php
session_start();

class Sesion{

	function login($mail,$pas,$link){
		$query= "SELECT mail, pass, id
		FROM usuario
		WHERE ((mail = '$mail') AND (pass = '$pas'))";
		$res=mysqli_query($link,$query);
			if(mysqli_num_rows($res)==1){
				$id=mysqli_fetch_array($res);
				$id=$id['id'];
				$_SESSION['estado']="logueado" ;
				$_SESSION['usuario']= $mail ;
				$_SESSION['clave']=$pas;
				$_SESSION['id']=$id;
				header( "Location: calificacion.php" );				
			}else{
				echo '<script> alert("Usuario o contraseña incorrectos.")</script>';
				echo '<script> window.location="index.php";</script>';

			}
	}

	function logout(){
		session_destroy();
		header( "Location: calificacion.php" );
		
	}
}

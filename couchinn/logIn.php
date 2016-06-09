<?php
include("conexion.php");
include ("claseLogin.php");	
	$us=$_POST['mail'];
	$pas=$_POST['pass'];
	$login= new Sesion();
    $link=conectardb();
    $login -> login($us,$pas,$link);
?>

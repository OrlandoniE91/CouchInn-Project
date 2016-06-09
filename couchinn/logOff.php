<?php
include("claseLogin.php");
session_start();
$_SESSION = array();
$logout= new Sesion();
$logout->logout();
?>

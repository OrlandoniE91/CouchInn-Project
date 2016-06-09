<?php
if (isset($_POST['registrarse'])){
include("conexion.php");	
	$link=conectardb();
	$us=$_POST["email"];
	$pas=$_POST["pass"];
	$nombre=$_POST["nombre"];
	$apellido=$_POST["apellido"];
	$tel=$_POST["telefono"];
	$calle=$_POST["calle"];
	$num=$_POST["numero"];
	$piso=$_POST["piso"];
	$depto=$_POST["departamento"];
	$result=mysqli_query($link,"SELECT * FROM usuario WHERE mail='$us'");
	if(mysqli_num_rows($result) ==  0 ){
	 mysqli_query($link, "INSERT INTO usuario (mail, pass, nombre, apellido, telefono, calle, numero, dept, piso, idtipo) values ('$us','$pas','$nombre','$apellido','$tel','$calle','$num','$depto','$piso','1')")
 	 or die("Problemas en el select".mysqli_error($link)) ;
 	  
 	 mysqli_close($link);
 	 ?>
 	 <script type="text/javascript"> 
			alert('alta exitosa');
			document.location=("index.php");
  	</script>
    
   <?php } else { 
	    mysqli_close($link);
	   
	   ?> 
	    <script type="text/javascript"> 
			alert('este email ya esta siendo usado');
			document.location=("registrarse.php");
  	    </script>
	   
	 <?php  } } else 
	header('Location:index.php');?>

   <?php
   include("conexion.php");
   $db=conectardb();
   $id = $_POST["idHospedaje"];
   $titulo = ucwords(strtolower($_POST['titulo']));
   $descripcion=$_POST['desc'];
   $ciudad=ucwords(strtolower($_POST['ciudad']));  
   $capacidad=$_POST['capacidad'];
   $sel=$_POST['seleccionado'];
   
   $cantHosp=mysqli_num_rows(mysqli_query($db,"SELECT * FROM hospedaje WHERE titulo='$titulo' and id!='$id'"));

   if($cantHosp == 0 ){
      if ($titulo != ""){
        mysqli_query($db,"UPDATE hospedaje SET  titulo ='$titulo' WHERE  id='$id'");
      }
      if ($descripcion != ""){
        mysqli_query($db,"UPDATE hospedaje SET  descripcion ='$descripcion' WHERE  id='$id'");
      }
      if ($ciudad!= ""){
         mysqli_query($db,"UPDATE hospedaje SET  ciudad ='$ciudad' WHERE  id='$id'");
      }
      if ($sel != ""){
         mysqli_query($db,"UPDATE hospedaje SET  tipoAlojamiento ='$sel' WHERE  id='$id'");
      }
      if ($capacidad!= ""){
         mysqli_query($db,"UPDATE hospedaje SET  capacidad ='$capacidad' WHERE  id='$id'");
      }
  
       mysqli_close($db);

       header("location:perfil.php");
   }	   
   else{
     echo '<script> alert("Ya existe un titulo de alojamiento con ese nombre");
     window.location.href="formModHosp.php?id='.$id.'";</script>';
  } 	   
  ?>
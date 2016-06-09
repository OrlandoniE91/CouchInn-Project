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
   </header>

   <div class="main container">
      <?php include("loginModal.php");         
      $database=conectardb();
      $mail = $_SESSION['usuario'];
      $consultaTipos=(mysqli_query($database,"SELECT * FROM tipoHospedaje WHERE enUso = 1"));
      $usuario=(mysqli_query($database,"SELECT * FROM usuario WHERE mail = '$mail' "));
      $admin=mysqli_fetch_array($usuario); ?>
            <table class="table table-condensed table-hover table-bordered" style="background-color:white;width:50%">
                  <tr>
                     <th>Nombre</th>
                     <th>Descripción</th>
                     <?php if($admin['idTipo'] == 2) { ?>
                     <th style="text-align:center">Opciones</th>
                     <?php } ?>
                  </tr>
             <?php while ($arrayTipos=mysqli_fetch_array($consultaTipos)) {
               ?>
                  <tr>
                     <td><?php echo $arrayTipos[1]; ?></td>
                     <td><?php echo $arrayTipos[2]; ?></td>
                     <?php if($admin['idTipo'] == 2) { ?>
                     <td style="text-align:center">
                        <a type="button" class="btn btn-warning" href="admin/formModTipo.php?var=<?php echo $arrayTipos[0]; ?>"> Modificar</a>
                        <a type="button" class="btn btn-danger" name="formModTipo" onclick="return confirm('¿Desea borrar este tipo?')" href="admin/borrarTipo.php?var=<?php echo $arrayTipos[0] ?>" > Borrar</a>
                     </td>
                     <?php } ?>
                  </tr>
               <?php } ?>
            </table>
            <?php 
            mysqli_close($database);
            ?>
   </div>

   <footer>

   </footer>
         <script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
         <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>

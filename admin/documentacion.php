<?php

include('includes/adminheader.php');
include ('includes/adminnav.php');

if (isset($_SESSION['role'])) {
 $currentrole = $_SESSION['role'];
}
if ( $currentrole == 'user' OR $currentrole == 'administrador' ) {
 echo "<script> alert('Solo los Administradores pueden agregar Usuarios');
 window.location.href='./index.php'; </script>";
}
else {
 //ACCIONES
 
 if (isset($_POST['guardar_documento'])) {
  $archivo=$_FILES['archivo'];
  $guardar_pdf=$_FILES['archivo']['tmp_name'];
  $id_detalleD = $sqlconnection->real_escape_string($_POST['id_detalleD']);
  $estado_documentacion="si";
  $file=$archivo;
  $fileContent = file_get_contents($file['tmp_name']);
  $imgext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION) );
  $picture = $id_empresa."-".$file['name'];

  file_put_contents('./biblioteca/'.$picture, $fileContent);
  $documentos = "UPDATE detalle_documentacion SET archivo_detalle = '{$picture}',estado_documento='{$estado_documentacion}'  WHERE id_detalleD = '{$id_detalleD}'";

  if ($sqlconnection->query($documentos) === TRUE) {
   echo '<script>
   swal("Buen Trabajo!", "Se registro con exito", "success").then(function() {
    window.location.replace("documentacion.php");
    });

    </script>';
   } 

   else {
          //handle
    echo '<script>swal("ERROR!", "Lo sentimos ocurri贸 un error ", "error");</script>';
    echo $sqlconnection->error;
    
   }

  }
}

 ?>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
   <div class="container-fluid">
    <div class="row mb-2">
     <div class="col-sm-6">
      <h1>Documentación SG SST </h1> 
     </div>
     <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
       <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
       <li class="breadcrumb-item active">Documentación</li>
      </ol>
     </div>
    </div>
   </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
   <div class="container-fluid">
    <!--SOLO EL ROL SUPERADMINISTRADOR PUEDE ACCEDER A ESTA SESION -->
    <?php if($_SESSION['role'] == 'superadmin' || $_SESSION['role'] == 'admin' )  
   
    {
     //echo $id_empresa;
     ?>
         <div class="row">
      <?php 

      $comparar= "SELECT d.id_detalleD,d.archivo_detalle, d.id_documentacion_fk, d.id_empresa_fk,d.estado_documento,o.id_documentacion,o.nombre_documento,o.archivo_documento FROM detalle_documentacion d
      INNER JOIN documentacion o
      ON d.id_documentacion_fk=o.id_documentacion
      WHERE d.id_empresa_fk='{$id_empresa}'";
      if ($result = $sqlconnection->query($comparar)) {
       if ($result->num_rows > 0) {
        while($docu = $result->fetch_array(MYSQLI_ASSOC)) {
         $id_detalleD=$docu['id_detalleD'];
         $id_empresa=$docu['id_empresa'];
         $nombre_documento=$docu['nombre_documento'];
         $estado_documentacion=$docu['estado_documento'];
         $archivo_detalle=$docu['archivo_detalle'];
         if($estado_documentacion=="no"){ ?>
          <!-- left column -->
          <div class="col-md-4">
           <!-- general form elements -->
           <div class="card card-primary">
            <div class="card-header">
             <h4 class="card-title"><?php echo $nombre_documento; ?></h4>
             <hr>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="" method="POST" enctype="multipart/form-data">
             <div class="card-body">
              <div class="form-group">
               <label for="exampleInputEmail1">Subir Archivo</label>
               <input type="file" class="form-control" id="" name="archivo">
               <input type="hidden" class="form-control" id="" name="id_detalleD" value="<?php echo $id_detalleD ?> ">
              </div>
              
             </div>
             <!-- /.card-body -->

             <div class="card-footer">
              <button type="submit" class="btn btn-primary btn-block" name="guardar_documento">Guardar</button>
             </div>
            </form>
           </div>
           

          </div>
          <?php 
         }else{ ?>
          <!-- left column -->
          <div class="col-md-4">
           <!-- general form elements -->
           <div class="card card-success">
            <div class="card-header">
             <h4 class="card-title"><?php echo $nombre_documento; ?></h4>
             <hr>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="" method="POST" enctype="multipart/form-data">
             

             <div class="card-footer">
              <a class="btn btn-primary btn-block" href="./biblioteca/<?php echo $archivo_detalle?>"; target="_blank"> Descargar</a>
              
             </div>
            </form>
           </div>
           

          </div>
          <?php  
         }
        }
       }else{
        echo "Contactese con el administrador";
       }
      }else {
       echo $sqlconnection->error;
       echo "Error";
      }

      ?>
      
      <!-- /.col -->
     </div>


 </section>
 </div>
 <script type="text/javascript">
  $(document).ready(function(){
 if (window.history.replaceState) { // verificamos disponibilidad
  window.history.replaceState(null, null, window.location.href);
 }
}
</script>

<?php } include ('includes/adminfooter.php'); ?>

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
              <h1>Contratistas </h1> 
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                 <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                 <li class="breadcrumb-item active">Contratistas</li>
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
        <div class="col-lg-12">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-user-circle"></i>
                Lista Actual de Contratistas</div>
                <div class="card-body">
                    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Agregar Contratista
</button> <hr>



                    <table class="display table table-bordered text-center"  width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Identificación</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Dirección</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 

                            $contratistas = "SELECT id_contratista, nombre_contratista, apellido_contratista, direccion_contratista, correo_contratista, telefono_contratista, codigo_contratista, id_empresa_fk FROM contratista WHERE id_empresa_fk='{$id_empresa}' ";

                            if ($result = $sqlconnection->query($contratistas)) {

                                if ($result->num_rows == 0) {
                      //echo "<td colspan='4'>There are currently no staff.</td>";
                                }
                                while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                    ?>  
                                    <tr class="text-center">

                                        <td><?php echo $row['id_contratista']; ?></td>
                                        <td><?php echo $row['nombre_contratista']; ?></td>
                                        <td><?php echo $row['apellido_contratista']; ?></td>
                                        <td><?php echo $row['direccion_contratista']; ?></td>
                                        <td><?php echo $row['correo_contratista']; ?></td>
                                        <td><?php echo $row['telefono_contratista']; ?></td>
                                        
                                    </tr>

                                    <?php 
                                }

                            }
                            else {
                                echo $sqlconnection->error;
                                echo "Error";
                            }

                            ?>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>

          <!-- /.col -->
      </div>


  </section>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
 if (window.history.replaceState) { // verificamos disponibilidad
  window.history.replaceState(null, null, window.location.href);
}
}
</script>

<?php } include ('includes/adminfooter.php'); ?>

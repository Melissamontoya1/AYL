<?php 
 
include "includes/adminheader.php";
include "includes/adminnav.php";

if (isset($_GET['delete'])) {
    $the_user_id = $_GET['delete'];
    $EliminarUsuario = "DELETE FROM users WHERE id = {$the_user_id}";

    if ($sqlconnection->query($EliminarUsuario) === TRUE) {     
        echo '<script>
        swal("Buen Trabajo!", "Se Elimino con éxito", "success").then(function() {
            window.location.replace("users.php");
            });

            </script>';
            exit();
        }else {
            echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error ", "error");</script>';
            echo $sqlconnection->error;
        }
    }

    if (isset($_SESSION['role'])) {
        $currentrole = $_SESSION['role'];
    }
    if ( $currentrole == 'user') {
        echo "<script> alert('SOLO EL ADMINISTRADOR PUEDE VER USUARIOS');
        window.location.href='./index.php'; </script>";
    }
    else if ($currentrole == 'superadmin') {
        ?>

        
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Administrar Usuarios</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                                <li class="breadcrumb-item active">Usuarios</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                        
                            <div class="card mb-3">
                                <div class="card-header bg-navy">
                                    <i class="fas fa-user-circle"></i>
                                    Lista Actual de Usuarios <?php echo $nombre_empresa ?></div>
                                    <div class="card-body">
                                        <table class="display table table-bordered text-center"  width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Usuario</th>
                                                    <th>Nombres y Apellidos</th>
                                                    <th>Correo</th>
                                                    <th>Nombre Empresa</th>
                                                    <th>Rol</th>
                                                    <th>Eliminar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 

                                                $query = "SELECT 
                                                e.id_empresa, e.nombre_empresa, e.direccion_empresa, e.telefono_empresa, e.correo_empresa, e.gerente_empresa, e.cumple_gerente, e.logotipo_empresa, e.tipo_empresa, e.fecha_inicio, e.fecha_fin,e.cedula_gerente,e.siglas_empresa,e.estado_empresa, u.id, u.identificacion, u.username, u.firstname, u.lastname, u.email, u.password, u.role, u.id_empresa_fk 

                                                FROM empresa e 
                                                INNER JOIN users u
                                                ON e.id_empresa = u.id_empresa_fk";
                                                $select_users = mysqli_query($sqlconnection, $query);
                                                if (mysqli_num_rows($select_users) > 0 ) {
                                                    while ($row = mysqli_fetch_array($select_users)) {
                                                        $user_id = $row['id'];
                                                        $username = $row['username'];
                                                        $user_firstname = $row['firstname'];
                                                        $user_lastname = $row['lastname'];
                                                        $user_email = $row['email'];
                                                        $user_role = $row['role'];
                                                        $nombre_empresa = $row['nombre_empresa'];
                                                        echo "<tr>";
                                                        echo "<td>$user_id</td>";
                                                        echo "<td>$username</td>";
                                                        echo "<td>$user_firstname</td>";
                                                        echo "<td>$user_email</td>";
                                                        echo "<td>$nombre_empresa</td>";
                                                        echo "<td>$user_role</td>";
                                                        if($user_role=="superadmin"){
                                                            echo "<td><B>No se puede eliminar</B></td>";
                                                        }else{
                                                            echo "<td><a class='btn btn-danger' onClick=\"javascript: return confirm('¿Estás seguro de que deseas eliminar a este usuario?')\" href='users.php?delete=$user_id'><i  class='fa fa-trash-alt'></i></a></td>";
                                                        }
                                                        echo "</tr>";
                                                    }
                                                    ?>

                                                </tbody>
                                            </table>

                                            <?php 
                                        }

                                        if (isset($_GET['delete'])) {
                                            $the_user_id = $_GET['delete'];
                                            $query0 = "SELECT role FROM users WHERE id_usuario = '$the_user_id'";
                                            $result = pg_query($sqlconnection , $query0);
                                            if (pg_num_rows($result) > 0 ) {
                                                $row = pg_fetch_array($result);
                                                $id1 = $row['role'];
                                            }
                                            if ($id1 == 'superadmin') {
                                                echo "<script>swal('El Perfil Super Administrador no puede ser cambiado');</script>";
                                            }
                                            else {

                                                $query = "DELETE FROM users WHERE id_usuario = '$the_user_id'";

                                                $delete_query = pg_query($sqlconnection, $query);
                                                if (pg_affected_rows($delete_query) > 0 ) {
                                                    echo "<script>swal('Usuario borrado satisfactoriamente');
                                                    window.location.href= 'users.php';</script>";
                                                }
                                            }
                                        }



                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php 
                }
                else {
                    ?>

                    <div class="col-lg-12">
                        <div class="card mb-3">
                            <div class="card-header bg-navy">
                                <i class="fas fa-user-circle"></i>
                                Lista Actual de Usuarios <?php echo $nombre_empresa ?></div>
                                <div class="card-body">
                                    <table class="display table table-bordered text-center"  width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Identificacion</th>
                                                <th>Nombres y Apellidos</th>
                                                <th>Usuario</th>
                                                <th>Contraseña</th>
                                                <th>Rol</th>
                                                <th>Eliminar</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <?php 

                                            $query = "SELECT * FROM users WHERE id_empresa_fk='".$id_empresa."'";
                                            $select_users = mysqli_query($sqlconnection, $query);
                                            if (mysqli_num_rows($select_users) > 0 ) {
                                                while ($row = mysqli_fetch_array($select_users)) {
                                                   $identificacion = $row['identificacion'];
                                                   $user_id = $row['id'];
                                                   $username = $row['username'];
                                                   $user_firstname = $row['firstname'];
                                                   $user_lastname = $row['lastname'];
                                                   $user_email = $row['email'];
                                                   $user_role = $row['role'];
                                                   $password = $row['password'];
                                                   $identificacion = $row['identificacion'];

                                                   echo "<tr>";
                                                   echo "<td>$identificacion</td>";
                                                   echo "<td>$user_firstname</td>";
                                                   echo "<td>$username</td>";
                                                   echo "<td>$password</td>";
                                                   echo "<td>$user_role</td>";
                                                   echo "<td><a class='btn btn-danger' onClick=\"javascript: return confirm('¿Estás seguro de que deseas eliminar a este usuario?')\" href='users.php?delete=$user_id'><i  class='fa fa-trash-alt'></i></a></td>";
                                                   echo "</tr>";
                                               }
                                               ?>

                                           </tbody>
                                       </table>

                                       <?php 
                                   }
                                   ?>
                               </div>
                           </div>
                       </div>
                   </div>

               </section>
           </div>
           <?php

       }
       ?>


       <?php include ('includes/adminfooter.php');?>

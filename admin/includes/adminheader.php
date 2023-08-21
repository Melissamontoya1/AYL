<?php
include('connection.php');

session_start();
if (isset($_SESSION['role'])) {

}
else {
    echo "<script>alert('Necesitas ingresar primero');
    window.location.href='../index.php';</script>";	
}

$empresas = "SELECT 
e.id_empresa, e.nombre_empresa, e.direccion_empresa, e.telefono_empresa, e.correo_empresa, e.gerente_empresa, e.cumple_gerente, e.logotipo_empresa, e.tipo_empresa, e.fecha_inicio, e.fecha_fin,e.cedula_gerente,e.siglas_empresa,e.estado_empresa,e.registro_fotografico,e.firma_gerente, u.id, u.identificacion, u.username, u.firstname, u.lastname, u.email, u.password, u.role, u.id_empresa_fk,e.firma_representante,e.cedula_representante,e.nombre_representante

FROM empresa e 
INNER JOIN users u
ON e.id_empresa = u.id_empresa_fk
WHERE u.username='".$_SESSION['username']."'";

if ($result = $sqlconnection->query($empresas)) {

    if ($result->num_rows > 0) {

        while($rempresa = $result->fetch_array(MYSQLI_ASSOC)) {
            $id_empresa=$rempresa['id_empresa']; 
            $nombre_empresa=$rempresa['nombre_empresa']; 
            $direccion_empresa=$rempresa['direccion_empresa']; 
            $telefono_empresa=$rempresa['telefono_empresa']; 
            $correo_empresa=$rempresa['correo_empresa'];
            $gerente_empresa=$rempresa['gerente_empresa']; 
            $cumple_gerente=$rempresa['cumple_gerente']; 
            $logotipo_empresa=$rempresa['logotipo_empresa']; 
            $tipo_empresa=$rempresa['tipo_empresa']; 
            $fecha_inicio=$rempresa['fecha_inicio']; 
            $fecha_fin=$rempresa['fecha_fin'];
            $siglas_empresa=$rempresa['siglas_empresa']; 
            $estado_empresa=$rempresa['estado_empresa']; 
            $cedula_gerente=$rempresa['cedula_gerente']; 
            $rol=$rempresa['role'];
            $id_usuario=$rempresa['id'];
            $registro_fotografico=$rempresa['registro_fotografico'];
            $firma_gerente=$rempresa['firma_gerente'];
            $firma_representante=$rempresa['firma_representante'];
            $cedula_representante=$rempresa['cedula_representante'];
            $nombre_representante=$rempresa['nombre_representante'];

        }
    }else{
        echo $sqlconnection->error;
        echo "ERROR al mostrar las empresas";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SST</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="plugins/fullcalendar/main.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="plugins/ekko-lightbox/ekko-lightbox.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
   <!-- Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <!-- CONTENEDOR AGREGAR Y TABLA DE CONSULTA -->
    <script>

        $(function(){
                // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
                $("#adicional").on('click', function(){
                    $("#tabla tbody tr:eq(0)").clone().removeClass('fila-fija').appendTo("#tabla");
                });

                // Evento que selecciona la fila y la elimina 
                $(document).on("click",".eliminar",function(){
                    var parent = $(this).parents().get(0);
                    $(parent).remove();
                });
            });
        </script>
        <style>
            .module {
              width: 250px;
              margin: 0 0 1em 0;
              overflow: hidden;
          }

          .module p {
              margin: 0;
          }

          .line-clamp {
              display: -webkit-box;
              -webkit-line-clamp: 8;
              -webkit-box-orient: vertical;
          }
      </style>
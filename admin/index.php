<?php
include "includes/adminheader.php";
include ('includes/adminnav.php');
?>
<div class="wrapper">

  <!-- Preloader -->
<!--   <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Panel de control</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
              <li class="breadcrumb-item active">Información</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-md-4">
            <!-- small box -->
            <?php 
            if ($estado_empresa<>"Inactiva") { ?>
              <?php
              $query = "SELECT * FROM users WHERE id_empresa_fk='{$id_empresa}'";
              $result = mysqli_query($sqlconnection, $query) or die(mysqli_error($sqlconnection));
              $user_num = mysqli_num_rows($result);
              ?>
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?php  echo "{$user_num}"; ?></h3>

                  <p>Usuarios</p>
                </div>
                <div class="icon">
                  <i class="fas fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">Más informacíón<i class="fas fa-arrow-circle-right"></i></a>
              </div>


            <?php } ?>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-md-4">

            <!-- Earnings (Monthly) Card Example -->
            <?php 
            if ($estado_empresa=="Inactiva") {?>
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h6><?php echo $nombre_empresa ?></h6>

                  <p>Renueva la suscripción para seguir disfrutando de nuestros servicios.</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">Más informacíón <i class="fas fa-arrow-circle-right"></i></a>
              </div>
              <?php            
            }
            ?>

            <?php  
            if ($tipo_empresa=="Alquiler"){ ?>
             
              <?php 
              $fechaActual = date('Y-m-d'); 
              $datetime1 = date_create($fecha_fin);
              $datetime2 = date_create($fechaActual);
              $contador = date_diff($datetime1, $datetime2);
              $differenceFormat = '%a';



              ?>
              <?php if($fechaActual>$fecha_fin){ ?>
               <div class="small-box bg-danger">
                <div class="inner">


                  <h3><?php echo $contador->format($differenceFormat);?></h3>

                  <p>Dias en mora</p>
                </div>
                <div class="icon">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <a href="#" class="small-box-footer">Más informacíón <i class="fas fa-arrow-circle-right"></i></a>
              </div>

              <?php  
            }else{?>
              <div class="small-box bg-olive">
                <div class="inner">

                  <h3><?php echo $contador->format($differenceFormat);?></h3>

                  <p>Dias restantes</p>
                </div>
                <div class="icon">
                 <i class="fas fa-dollar-sign"></i>
               </div>
               <a href="#" class="small-box-footer">Más informacíón <i class="fas fa-arrow-circle-right"></i></a>
             </div>

           <?php  }
           ?>  
         </div>
       <?php } ?>

       <!-- ./col -->
       <div class="col-lg-3 col-6" hidden >
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
              
              <?php
              $queryc = "SELECT * FROM empresa_contratista WHERE id_empresa_fk='{$id_empresa}'";
              $resultc = mysqli_query($sqlconnection, $queryc) or die(mysqli_error($sqlconnection));
              $contratistas = mysqli_num_rows($resultc);
              ?>
            <h3><?php echo $contratistas ?></h3>

            <p>Contratistas</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">Más informacíón <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6" hidden>
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>65</h3>

            <p>Unique Visitors</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">Más informacíón <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
    <!-- ./col -->
  </div>
  <!-- /.row -->
  <!-- Main row -->
  <div class="row">
    <!-- Left col -->
    <section class="col-lg-7 connectedSortable" hidden>
      <!-- Custom tabs (Charts with tabs)-->

      <!-- Calendar -->
      <div class="card bg-navy">
        <div class="card-header border-0">

          <h3 class="card-title">
            <i class="far fa-calendar-alt"></i>
            Calendario de Actividades
          </h3>
          <!-- tools card -->
          <div class="card-tools">
            <!-- button with a dropdown -->
            <div class="btn-group">
              <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                <i class="fas fa-bars"></i>
              </button>
              <div class="dropdown-menu" role="menu">

                <a href="calendario.php" class="dropdown-item">Administrar Actividades</a>
              </div>
            </div>
            <button type="button" class="btn btn-info btn-sm" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-info btn-sm" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pt-0">
          <!--The calendar -->
          <div id="calendar" style="width: 100%"></div>
        </div>
        <!-- /.card-body -->
      </div>

    </section>
    <!-- /.Left col -->
    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-lg-5 connectedSortable">
     <!-- TO DO List -->
     <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="ion ion-clipboard mr-1"></i>
          <B>Documentación SST</B>
        </h3>

        <br>
        <?php 

        $comparar= "SELECT d.id_detalleD,d.archivo_detalle, d.id_documentacion_fk, d.id_empresa_fk,d.estado_documento,o.id_documentacion,o.nombre_documento,o.archivo_documento FROM detalle_documentacion d
        INNER JOIN documentacion o
        ON d.id_documentacion_fk=o.id_documentacion
        WHERE d.id_empresa_fk='{$id_empresa}'
        ";
        if ($result = $sqlconnection->query($comparar)) {
          if ($result->num_rows > 0) {
            while($docu = $result->fetch_array(MYSQLI_ASSOC)) {
              $id_detalleD=$docu['id_detalleD'];
              $id_empresa=$docu['id_empresa'];
              $nombre_documento=$docu['nombre_documento'];
              $estado_documentacion=$docu['estado_documento'];
              $archivo_detalle=$docu['archivo_detalle'];
              if($estado_documentacion=="no"){ ?>
                <p><button class="btn btn-warning"><i class="fas fa-exclamation-triangle "></i></button>  <?php echo $nombre_documento; ?></p><hr>
                <?php 
              }else{ ?>
                <p><button class="btn btn-success"><i class="fas fa-check-square"></i></button>   <?php echo $nombre_documento; ?></p><hr>
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


      </div>

      <!-- /.card-body -->
      <div class="card-footer clearfix">
       <a href="documentacion.php"><button type="button" class="btn btn-primary btn-block"><i class="fas fa-plus"></i> Más Detalles</button></a>

     </div>
   </div>



   <!-- /.card -->

   <!-- Map card -->
   <div class="card bg-gradient-primary" hidden>
    <div class="card-header border-0">
      <h3 class="card-title">
        <i class="fas fa-map-marker-alt mr-1"></i>
        Visitors
      </h3>
      <!-- card tools -->
      <div class="card-tools">
        <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
          <i class="far fa-calendar-alt"></i>
        </button>
        <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
      <!-- /.card-tools -->
    </div>
    <div class="card-body">
      <div id="world-map" style="height: 250px; width: 100%;"></div>
    </div>
    <!-- /.card-body-->
    <div class="card-footer bg-transparent">
      <div class="row">
        <div class="col-4 text-center">
          <div id="sparkline-1"></div>
          <div class="text-white">Visitors</div>
        </div>
        <!-- ./col -->
        <div class="col-4 text-center">
          <div id="sparkline-2"></div>
          <div class="text-white">Online</div>
        </div>
        <!-- ./col -->
        <div class="col-4 text-center">
          <div id="sparkline-3"></div>
          <div class="text-white">Sales</div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </div>
  </div>
  <!-- /.card -->

  <!-- solid sales graph -->
  <div class="card bg-gradient-info" hidden>
    <div class="card-header border-0">
      <h3 class="card-title">

        <i class="fas fa-th mr-1"></i>
        Sales Graph
      </h3>

      <div class="card-tools">
        <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
      <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
    </div>
    <!-- /.card-body -->
    <div class="card-footer bg-transparent">
      <div class="row">
        <div class="col-4 text-center">
          <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"
          data-fgColor="#39CCCC">

          <div class="text-white">Mail-Orders</div>
        </div>
        <!-- ./col -->
        <div class="col-4 text-center">
          <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"
          data-fgColor="#39CCCC">

          <div class="text-white">Online</div>
        </div>
        <!-- ./col -->
        <div class="col-4 text-center">
          <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"
          data-fgColor="#39CCCC">

          <div class="text-white">In-Store</div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.card-footer -->
  </div>
  <!-- /.card -->
  <div class="card" hidden>
    <div class="card-header">
      <h3 class="card-title">
        <i class="fas fa-chart-pie mr-1"></i>
        Sales
      </h3>
      <div class="card-tools">
        <ul class="nav nav-pills ml-auto">
          <li class="nav-item">
            <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
          </li>
        </ul>
      </div>
    </div><!-- /.card-header -->
    <div class="card-body">
      <div class="tab-content p-0">
        <!-- Morris chart - Sales -->
        <div class="chart tab-pane active" id="revenue-chart"
        style="position: relative; height: 300px;">
        <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
      </div>
      <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
        <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
      </div>
    </div>
  </div><!-- /.card-body -->
</div>


<!-- /.card -->
</section>
<!-- right col -->
</div>
<!-- /.row (main row) -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>


<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include "includes/adminfooter.php"; ?>
</body>
</html>

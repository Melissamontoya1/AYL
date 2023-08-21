 <?php

include('includes/adminheader.php');
include ('includes/adminnav.php');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper iframe-mode" data-widget="iframe" data-loading-screen="750">
    <div class="nav navbar navbar-expand navbar-white navbar-light border-bottom p-0">
      <div class="nav-item dropdown">
        <a class="nav-link bg-danger dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Cerrar </a>
        <div class="dropdown-menu mt-0">
          <a class="dropdown-item" href="#" data-widget="iframe-close" data-type="all">Cerrar Todo</a>
          <a class="dropdown-item" href="#" data-widget="iframe-close" data-type="all-other">Cerrar todo menos la pestaña actual</a>
        </div>
      </div>
      <a class="nav-link bg-light" href="#" data-widget="iframe-scrollleft"><i class="fas fa-angle-double-left"></i></a>
      <ul class="navbar-nav overflow-hidden" role="tablist"></ul>
      <a class="nav-link bg-light" href="#" data-widget="iframe-scrollright"><i class="fas fa-angle-double-right"></i></a>
      <a class="nav-link bg-light" href="#" data-widget="iframe-fullscreen"><i class="fas fa-expand"></i>Expandir</a>
    </div>
    <div class="tab-content">
      <div class="tab-empty">
        <h4 class="display-4">Agrega una pestaña solo dandole clic</h4>
      </div>
      <div class="tab-loading">
        <div>
          <h2 class="display-4">Cargando Información <i class="fa fa-sync fa-spin"></i></h2>
        </div>
      </div>
    </div>
  </div>
  
   <?php include ('includes/adminfooter.php');?>
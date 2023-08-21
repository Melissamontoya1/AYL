<?php

include('includes/adminheader.php');
include ('includes/adminnav.php');
include('includes/add.php');

if (isset($_SESSION['role'])) {
	$currentrole = $_SESSION['role'];
}
if ( $currentrole == 'user' OR $currentrole == 'administrador' ) {
	echo "<script> alert('Solo los Administradores pueden agregar Usuarios');
	window.location.href='./index.php'; </script>";
}
else {
	//ACCIONES

}
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Ciclos</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
						<li class="breadcrumb-item active">Ciclos</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">

			<div class="card col-md-12">
				<h3 class="text-success text-center"> En construcción </h3>
			</div>

		</div><!-- DIV QUE CIERRA EL CONTENEDOR DEL NAV -->
	</section>
</div>
<script type="text/javascript">
	$(document).ready(function(){
	if (window.history.replaceState) { // verificamos disponibilidad
		window.history.replaceState(null, null, window.location.href);
	}
}
</script>

<?php include ('includes/adminfooter.php');?>

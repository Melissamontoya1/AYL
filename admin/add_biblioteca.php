<?php

include('includes/adminheader.php');
include ('includes/adminnav.php');
include('guardar_excel.php');

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Agregar archivos a la Biblioteca</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
						<li class="breadcrumb-item active">Detalles</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<!-- general form elements -->
			<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Añadir Excel ó Word</h3>
				</div>
				<!-- /.card-header -->
				<!-- form start -->
				<form  id="edititemform" action="" method="POST" enctype="multipart/form-data">
					<div class="card-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Nombre Archivo</label>
							<input type="text" class="form-control" id="exampleInputEmail1" name="descripcion_archivo" placeholder="Descripcion del archivo">
						</div>
						<div class="form-group">
							<label for="inputPassword4">Tipo de Archivo</label>
							<select name="tipo_archivo" id="" class="form-control">
								<option value="word">Word</option>
								<option value="excel">Excel</option>
							</select>
						</div>
						<div class="form-group">
							<label for="inputPassword4">Seleccionar Archivo (Excel ó Word Configurado)</label>
							<input type="file" name="archivo" class="form-control" required>
						</div>

					</div>
					<!-- /.card-body -->

					<div class="card-footer">
					<button type="submit" form="edititemform" name="guardar_excel" class="btn btn-success btn-block">
									<i class="fas fa-2x fa-save"></i>
								Guardar Cambios</button>
					</div>
				</form>
			</div>

			<div>


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

<?php include ('includes/adminfooter.php');?>

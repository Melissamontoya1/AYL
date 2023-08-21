<?php 

include('includes/adminheader.php');
include ('includes/adminnav.php');


if (isset($_POST['correo_enviar'])) {
	$archivo_correo=$_FILES['archivo_correo']['name'];
	$guardar_pdf=$_FILES['archivo_correo']['tmp_name'];
	$titulo_correo=$_POST['titulo_correo'];
	$mensaje_correo=$_POST['mensaje_correo'];
	
	

	if ($archivo_correo =="") {
		$query = "INSERT INTO correos (titulo_correo,mensaje_correo) VALUES ('$titulo_correo','$mensaje_correo')";
		if ($sqlconnection->query($query) === TRUE) {
			include_once ('detalle_correo.php');
		}
		else {
			echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error ", "error");</script>';
		}
		
	}else{
		if (move_uploaded_file($guardar_pdf,'./archivos_correo/'.$archivo_correo )) {

			$query = "INSERT INTO correos (titulo_correo,mensaje_correo,archivo_correo) VALUES ('$titulo_correo','$mensaje_correo','$archivo_correo')";
			if ($sqlconnection->query($query) === TRUE) {
				include_once ('detalle_correo.php');
			}
			else {
				echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error ", "error");</script>';
			}

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
					<h1>Correos Masivos</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
						<li class="breadcrumb-item active">Enviar Correos</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">

			<!-- Page Heading -->
			<div class="row">

				<div class="col-md-3">
					<a href="#" class="btn btn-primary btn-block mb-3">Opciones</a>

					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Carpetas</h3>

							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse">
									<i class="fas fa-minus"></i>
								</button>
							</div>
						</div>
						<div class="card-body p-0">
							<ul class="nav nav-pills flex-column">
								<li class="nav-item active">
									<a href="#" class="nav-link">
										<i class="fas fa-inbox"></i> Nuevo Correo
										<span class="badge bg-primary float-right">0</span>
									</a>
								</li>
								<!-- <li class="nav-item">
									<a href="#" class="nav-link">
										<i class="far fa-envelope"></i> Correos Enviados
									</a>
								</li> -->
								
							</ul>
						</div>
						<!-- /.card-body -->
					</div>
		
					<!-- /.card -->
				</div>
				<!-- /.col -->
				<div class="col-md-9">
					<div class="card card-primary card-outline">
						<div class="card-header bg-navy">
							<h3 class="card-title">Enviar Correo a las Empresas</h3>
						</div>
						<!-- /.card-header -->
						<form role="form" method="POST" enctype="multipart/form-data" action="">
						<div class="card-body">
							<label for="">Titulo</label>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Ingrese el titulo " name="titulo_correo">
							</div>

							<div class="form-group">
								<label for="">Mensaje del Correo</label>
								<textarea id="compose-textarea" class="form-control" name="mensaje_correo"  style="height: 300px">

								</textarea>
							</div>
							<div class="form-group">
								<div class="btn btn-default btn-file">
									<i class="fas fa-paperclip"></i> Adjuntar Archivo
									<input type="file" class="form-control" name="archivo_correo">
								</div>
								<p class="help-block">Max. 32MB</p>
							</div>
						</div>
						<!-- /.card-body -->
						<div class="card-footer">

							<button type="submit" class="btn btn-success btn-block" name="correo_enviar"><i class="far fa-envelope"></i> Enviar Correo Electronico</button>


						</div>
					</form>
						<!-- /.card-footer -->
					</div>
					<!-- /.card -->
				</div>

			</div><!-- DIV QUE CIERRA EL CONTENEDOR DEL NAV -->
			<!-- MODAL PARA EDITAR ROL-->
		</section>
	</div>


	<?php include ('includes/adminfooter.php');?>
	
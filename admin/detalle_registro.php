<?php

include('includes/adminheader.php');
include ('includes/adminnav.php');





if (isset($_GET['id_registro_fk']) ) {
	$id_registro_fk = $sqlconnection->real_escape_string($_GET['id_registro_fk']);
	$detalle_registro = "SELECT  dr.id_detalle_registros,dr.id_registro_fk,dr.id_user_fk,dr.fotografia_detalle,r.id_registro,r.fecha_registro,r.descripcion_registro,u.id, u.identificacion, u.username, u.firstname, u.lastname, u.email, u.password, u.role, u.id_empresa_fk
	FROM detalle_registros dr
	INNER JOIN registros r 
	ON dr.id_registro_fk=r.id_registro
	INNER JOIN users u
	ON dr.id_user_fk = u.id WHERE dr.id_registro_fk='{$id_registro_fk}'
	";

	if ($result = $sqlconnection->query($detalle_registro)) {

		if ($result->num_rows > 0) {
			while($detaller = $result->fetch_array(MYSQLI_ASSOC)) {
				$id_detalle_registro=$detaller['id_detalle_registro'];
				$fecha_registro=$detaller['fecha_registro'];
				$descripcion_registro=$detaller['descripcion_registro'];
				$identificacion=$detaller['identificacion'];
				$firstname=$detaller['firstname'];
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
						<h1>Registro Fotografico</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
							<li class="breadcrumb-item active">Registro</li>
						</ol>
					</div>
				</div>
			</div><!-- /.container-fluid -->
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="container-fluid">
				<div class="row">





					<!-- Default box -->
					<div class="card card-solid">
						<div class="card-body">
							<div class="row">
								<div class="col-12 col-sm-6">
									<h3 class="d-inline-block d-sm-none">Registro fotografico realizado por</h3>
									<div class="col-12">
										<?php 

										if ($result = $sqlconnection->query($detalle_registro)) {

											if ($result->num_rows > 0) {
												$i=1;
												while($detaller = $result->fetch_array(MYSQLI_ASSOC)) {
													$fotografia_detalle=$detaller['fotografia_detalle'];
												}
												?>
												<div class="card img-responsive" style="max-width: 545px;
												max-height: 470px;">
												<img src="./registro_fotografico/<?php echo $fotografia_detalle ?>" class="product-image" alt="Product Image" style="max-width: 545px;
												max-height: 470px;">
												</div>
												<?php  
											}
										}


										?>
									</div>
									<div class="col-12 product-image-thumbs ">
										<?php 

										if ($result = $sqlconnection->query($detalle_registro)) {

											if ($result->num_rows > 0) {
												$i=1;
												while($detaller = $result->fetch_array(MYSQLI_ASSOC)) {
													$fotografia_detalle=$detaller['fotografia_detalle'];
													?>
													<div class="product-image-thumb <?php if($i==1) echo "active"; ?>">
														<img src="./registro_fotografico/<?php echo $fotografia_detalle ?>" alt="" >
													</div>


													<?php  
													$i++;
												}
											}
										}


										?>



									</div>

								</div>
								<div class="col-12 col-sm-6">
									<!-- DETALLES DEL REGISTRO -->
									<h5 class="my-3"><B>Realizado por :</B> <?php echo $identificacion ?> - <?php echo $firstname; ?> </h5>
									<hr>
									<h5><B>Código de registro :</B> <?php echo $id_registro_fk ?></h5>
									<hr>
									<h5><B>Fecha y Hora :</B> <?php echo $fecha_registro ?></h5>
									<!-- BOTON PARA DESCARGAR UN PDF DE LAS IMAGENES Y LA DESCRIPCION -->
									<div class="mt-4">
										<div class="btn btn-danger btn-lg btn-flat">
											<i class="fas fa-file-pdf fa-lg mr-2"></i>
											Descargar PDF
										</div>
									</div>
									<!-- DESCRIPCION Y ENVIO DEL REPORTE AL CORREO ELECTRONICO -->
									<div class="row mt-4">
										<nav class="w-100">
											<div class="nav nav-tabs" id="product-tab" role="tablist">
												<a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Descripcion del registro</a>
												<a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Enviar Información al correo</a>

											</div>
										</nav>
										<div class="tab-content p-3" id="nav-tabContent">
											<div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> <?php echo $descripcion_registro ?></div>
											<div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> 

											</div>

										</div>
									</div>


								</div>
							</div>

						</div>
						<!-- /.card-body -->
					</div>
				</div>

			</section>
		</div>
		<?php 
	}
	?>

	<?php include ('includes/adminfooter.php');?>

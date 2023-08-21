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
}
if (isset($_POST['logo'])) {
	$nombre_archivo=$_FILES['archivo']['name'];
	$guardar_img=$_FILES['archivo']['tmp_name'];

	if (move_uploaded_file($guardar_img,'img/'.$nombre_archivo )) {
		$updateItemQuery = "UPDATE empresa SET logotipo_empresa = '{$nombre_archivo}'  WHERE id_empresa = '{$id_empresa}'";

		if ($sqlconnection->query($updateItemQuery) === TRUE) {
			echo "<script>alert('Logo actualizado satisfactoriamente');
			window.location.href= 'empresa_personal.php';</script>";

		} 

		else {
        //handle
			echo "someting wong";
			echo $sqlconnection->error;
			echo $updateItemQuery;
		}
	}

}
// GUARDAR LA FIRMA DEL GERENTE
if (isset($_POST['firma_gerente'])) {
	$nombre_archivo2=$_FILES['archivo_gerente']['name'];
	$guardar_img2=$_FILES['archivo_gerente']['tmp_name'];

	if (move_uploaded_file($guardar_img2,'firmas/'.$nombre_archivo2 )) {
		$updateItemQuery2 = "UPDATE empresa SET firma_gerente = '{$nombre_archivo2}'  WHERE id_empresa = '{$id_empresa}'";

		if ($sqlconnection->query($updateItemQuery2) === TRUE) {
			echo '<script>
			swal("Buen Trabajo!", "La firma del Gerente se actualizo con exito", "success").then(function() {
				window.location.replace("empresa_personal.php");
				});

				</script>';
			}else {
        	//handle
				echo "someting wong";
				echo $sqlconnection->error;
				echo $updateItemQuery2;
			}
		}

	}
	// GUARDAR LA FIRMA DEL EL REPRESENTALTE LEGAL
	if (isset($_POST['firma_representante'])) {
		$nombre_archivo=$_FILES['archivo']['name'];
		$guardar_img=$_FILES['archivo']['tmp_name'];

		if (move_uploaded_file($guardar_img,'firmas/'.$nombre_archivo )) {
			$updateItemQuery3 = "UPDATE empresa SET firma_representante = '{$nombre_archivo}'  WHERE id_empresa = '{$id_empresa}'" ;

			if ($sqlconnection->query($updateItemQuery3) === TRUE) {
				echo '<script>
			swal("Buen Trabajo!", "La firma del Representante Legal se actualizo con exito", "success").then(function() {
				window.location.replace("empresa_personal.php");
				});

				</script>';
			} else {
        		//handle
				echo "someting wong";
				echo $sqlconnection->error;
				echo $updateItemQuery3;
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
						<h1>Empresa : <?php echo $nombre_empresa; ?></h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
							<li class="breadcrumb-item active">Administrar</li>
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
				{ ?>


					<div id="accordion">
						<div class="card">
							<div class="card-header" id="headingOne">
								<h5 class="mb-0">
									<button class="btn btn-primary btn-block text-left" data-toggle="collapse" data-target="#collapseOne"  aria-controls="collapseOne">
										<i class="fas fa-2x fa-building"></i>
										Datos de la Empresa
									</button>
								</h5>
							</div>

							<div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
								<div class="card-body">
									<form  id="edititemform" action="" method="POST">
										<div class="form-row border-bottom-info">
											<div class="form-group col-md-6">
												<input type="hidden" name="id_empresa" value="<?php echo $id_empresa ?>" class="form-control ">
												<label for="inputEmail4">Nombre Empresa</label>
												<input type="text" name="nombre_empresa" value="<?php echo $nombre_empresa ?>" class="form-control ">
											</div>
											<div class="form-group col-md-6">
												<label for="inputPassword4">Nit Empresa</label>
												<input type="text" name="id_empresa" value="<?php echo $id_empresa ?>" class="form-control">
											</div>
											<div class="form-group col-md-6">
												<label for="inputPassword4">Siglas Empresa</label>
												<input type="text" name="siglas_empresa" value="<?php echo $siglas_empresa ?>" class="form-control">
											</div>

											<div class="form-group col-md-6">
												<label for="inputAddress">Dirección</label>
												<input type="text" name="direccion_empresa" value="<?php echo $direccion_empresa ?>" class="form-control ">
											</div>
											<div class="form-group col-md-6">
												<label for="inputAddress2">Telefono </label>
												<input type="text" name="telefono_empresa" value="<?php echo $telefono_empresa ?>" class="form-control">
											</div>
											<div class="form-group col-md-6">
												<label for="inputAddress2">Correo </label>
												<input type="text" name="correo_empresa" value="<?php echo $correo_empresa ?>" class="form-control">
											</div>


										</div>
										<h4 class="m-2 font-weight-bold text-warning text-center">Datos del Gerente</h4>
										<div class="form-row border-bottom-success">
											<div class="form-group col-md-6">

												<label for="inputEmail4">Identificación</label>
												<input type="number" name="cedula_gerente" value="<?php echo $cedula_gerente ?>" class="form-control ">
											</div>
											<div class="form-group col-md-6">

												<label for="inputEmail4">Gerente</label>
												<input type="text" name="gerente_empresa" value="<?php echo $gerente_empresa ?>" class="form-control ">
											</div>
											<div class="form-group col-md-6">
												<label for="inputEmail4">Cumpleaños Gerente</label>
												<input type="date" name="cumple_gerente" value="<?php echo $cumple_gerente ?>" class="form-control ">	
											</div>
										</div>
										<h4 class="m-2 font-weight-bold text-warning text-center">Datos del Representante Legal</h4>
										<div class="form-row border-bottom-success">
											<div class="form-group col-md-6">

												<label for="inputEmail4">Identificación</label>
												<input type="number" name="cedula_representante" value="<?php echo $cedula_representante ?>" class="form-control ">
											</div>
											<div class="form-group col-md-6">

												<label for="inputEmail4">Representante Legal</label>
												<input type="text" name="nombre_representante" value="<?php echo $nombre_representante ?>" class="form-control ">
											</div>
											
										</div>
										<?php if ($tipo_empresa=="Alquiler") { ?>
											<h4 class="m-2 font-weight-bold text-warning text-center">Ciclo de Facturación</h4>

											<div class="form-row border-bottom-success">
												<div class="form-group col-md-6">
													<label for="inputEmail4">Tipo de Empresa</label>
													<input type="text" name="tipo_empresa" value="<?php echo $tipo_empresa ?>" class="form-control " readonly>
												</div>
												<div class="form-group col-md-6">
													<label for="inputEmail4">Fecha Inicial de Facturación</label>
													<input type="date" name="fecha_inicio" value="<?php echo $fecha_inicio ?>" class="form-control " readonly>
												</div>
												<div class="form-group col-md-6">
													<label for="inputEmail4">Fecha Final de Facturación</label>
													<input type="date" name="fecha_fin" value="<?php echo $fecha_fin ?>" class="form-control " readonly>
												</div>
												<div class="form-group col-md-6">

													<?php 

													$fechaActual = date('Y-m-d'); 
													$datetime1 = date_create($fecha_fin);
													$datetime2 = date_create($fechaActual);
													$contador = date_diff($datetime1, $datetime2);
													$differenceFormat = '%a';



													?>
													<?php if($fechaActual>$fecha_fin){ ?>
														<label for="inputEmail4">Días en Mora</label>	
														<h1 class="text-danger text-center"><?php echo $contador->format($differenceFormat);?></h1>
														<?php  
													}else{?>
														<label for="inputEmail4">Días en Restantes</label>	
														<h1 class="text-success text-center"><?php echo $contador->format($differenceFormat);?></h1>
													<?php  }
													?>	

												</div>

											</div>
										<?php } ?>

									</div>

									<button type="submit" form="edititemform" name="btnedit" class="btn btn-success btn-block"><i class="fas fa-2x fa-save"></i>&nbsp;Guardar Cambios</button>
								</form>
							</div>
						</div>
					</div>

				<?php }?>
				<!--  CAMBIAR LOGOTIPO -->
				<div class="card">
					<div class="card-header" id="headingTwo">
						<h5 class="mb-0">
							<button class="btn btn-info btn-block collapsed text-left" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								<i class="fas fa-2x fa-image"></i>
								Cambiar Logotipo
							</button>
						</h5>

					</div>
					<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
						<div class="card-body form-row">
							<div class="col-md-6">
								<?php
								if ($logo=="") {
									echo '
									<form action="" class="form-inline"  method="post" enctype="multipart/form-data">
									<input type="file" name="archivo" class="form-control">
									<input type="submit" name="logo" value="Enviar" class="btn btn-info form-inline">
									</form>
									';
								}else{
									echo '
									<p>Cambiar el logotipo</p>
									<form action="" class="form-inline"  method="post" enctype="multipart/form-data">
									<center>
									<div class="form-group ">

									<input type="file" name="archivo" class="form-control">
									<input type="submit" name="logo" value="Enviar" class="btn btn-info ">

									</div>
									</center>
									</form>
									';

								} 
								?>
							</div>
							<div class="col-md-6">
								<center>
									<img src="img/<?php echo $logotipo_empresa ?>" alt="Logotipo " width="150" class="text-center img-thumbnail">
								</center>
							</div>
						</div> 
					</div>
				</div>
				<div class="card">
					<div class="card-header" id="headingTh">
						<h5 class="mb-0">
							<button class="btn btn-info btn-block collapsed text-left" data-toggle="collapse" data-target="#collapseRL" aria-expanded="false" aria-controls="collapseRL">
								<i class="fas fa-2x fa-image"></i>
								Firma Gerente PNG
							</button>
						</h5>

					</div>
					<div id="collapseRL" class="collapse" aria-labelledby="headingTh" data-parent="#accordion">
						<div class="card-body form-row">
							<div class="col-md-6">
								<?php
								if ($firma=="") {
									echo '
									<form action="" class="form-inline"  method="post" enctype="multipart/form-data">
									<input type="file" name="archivo_gerente" class="form-control">
									<input type="submit" name="firma_gerente" value="Enviar" class="btn btn-info form-inline">
									</form>
									';
								}else{
									echo '
									<p>Cambiar el logotipo</p>
									<form action="" class="form-inline"  method="post" enctype="multipart/form-data">
									<center>
									<div class="form-group ">

									<input type="file" name="archivo_gerente" class="form-control">
									<input type="submit" name="firma_gerente" value="Enviar" class="btn btn-info ">

									</div>
									</center>
									</form>
									';

								} 
								?>
							</div>
							<div class="col-md-6">
								<center>
									<img src="firmas/<?php echo $firma_gerente ?>" alt="Firma Gerente " width="250" class="text-center img-thumbnail">
								</center>
							</div>
						</div> 
					</div>

				</div>
				<div class="card">
					<div class="card-header" id="headingTh">
						<h5 class="mb-0">
							<button class="btn btn-info btn-block collapsed text-left" data-toggle="collapse" data-target="#collapseTh" aria-expanded="false" aria-controls="collapseTh">
								<i class="fas fa-2x fa-image"></i>
								Firma Representante Legal PNG
							</button>
						</h5>

					</div>
					<div id="collapseTh" class="collapse" aria-labelledby="headingTh" data-parent="#accordion">
						<div class="card-body form-row">
							<div class="col-md-6">
							<?php
							if ($firma_representante=="") {
								echo '
								<form action="" class="form-inline"  method="post" enctype="multipart/form-data">
								<input type="file" name="archivo" class="form-control">
								<input type="submit" name="firma_representante" value="Enviar" class="btn btn-info form-inline">
								</form>
								';
							}else{
								echo '
								
								<form action="" class="form-inline"  method="post" enctype="multipart/form-data">
								<center>
								<div class="form-group ">

								<input type="file" name="archivo" class="form-control">
								<input type="submit" name="firma_representante" value="Enviar" class="btn btn-info ">

								</div>
								</center>
								</form>
								';

							} 
							?>
						</div> 
						<div class="col-md-6">
							<center>
								<img src="firmas/<?php echo $firma_representante ?>" alt="Firma Gerente " width="250" class="text-center img-thumbnail">
							</center>
						</div>
					</div>

				</div>
			</div> 
			<div>

			</div>

		</div><!-- DIV QUE CIERRA EL CONTENEDOR DEL NAV -->
	</section>
	<</div>
	<script type="text/javascript">
		$(document).ready(function(){
	if (window.history.replaceState) { // verificamos disponibilidad
		window.history.replaceState(null, null, window.location.href);
	}
}
</script>

<?php include ('includes/adminfooter.php');?>

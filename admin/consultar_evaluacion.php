<?php

include('includes/adminheader.php');
include ('includes/adminnav.php');
include('includes/add.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Consultar archivos de Evaluación</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
						<li class="breadcrumb-item active">Resultados</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="col-lg-12">
				
				<div class="px-2 py-2 bg-gradient-primary text-white text-center"><p>Aqui puedes consultar los archivos subidos a tus evaluaciones.</p></div>
			</div>
			<div class="col-lg-12">
				<div class="card mb-3">
					<div class="card-header bg-navy">
						<i class="fas fa-file-download"></i>
					Descarga lo que necesites</div>
					<div class="card-body">
						<table class="display table table-bordered text-center"  width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>Código</th>
									<th>Fecha</th>
									<th>Nombre Archivo</th>
									<th>Detalles</th>
									<th class="text-center">Descargar</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$empresas = "SELECT

								cre.id_creacion, cre.fecha_creacion, cre.id_empresa_fk, cre.id_users_fk,cre.nombre_asesor,cre.id_asesor,r.id_respuestas_e,r.nombre_respuesta,r.estado_respuesta,r.archivo_respuesta,r.id_creacion_fk,r.cod_archivo_e_fk
								FROM respuestas_evaluacion r
								INNER JOIN creacion cre
								ON r.id_creacion_fk=cre.id_creacion



								WHERE cre.id_empresa_fk='{$id_empresa}' AND r.estado_respuesta='Completo' " ;

								if ($result = $sqlconnection->query($empresas)) {

									if ($result->num_rows == 0) {
                      //echo "<td colspan='4'>There are currently no staff.</td>";
									}
									while($creacion = $result->fetch_array(MYSQLI_ASSOC)) {
										$id_respuesta_e = $creacion['id_respuestas_e'];
										$nombre_respuesta = $creacion['nombre_respuesta'];
										$fecha_creacion = $creacion['fecha_creacion'];
										$nombre_asesor = $creacion['nombre_asesor'];
										$archivo_respuesta = $creacion['archivo_respuesta'];
										$id_asesor = $creacion['id_asesor'];
										$timestamp = strtotime($fecha_creacion); 
										$newDate = date("m-d-Y", $timestamp );
										?>  
										<tr class="text-center">
											<td> <?php echo $id_respuesta_e ?> </td>
											<td> <?php echo $newDate ?></td>
											<td><?php echo $nombre_respuesta ?></td>
											<td><B>Asesor : </B><?php echo $nombre_asesor ?><br>
												<B>Cedula :</B> <?php echo $id_asesor ?>
											</td>
											<td><a href="./archivos/<?php echo $archivo_respuesta ?>" target="_blank"><button class="btn btn-success"><i class="fas fa-download"></i>  Descargar</button></a></td>

										</tr>

										<?php 
									}

								}else {
									echo $sqlconnection->error;
									echo "Error";
								}

								?>
							</tbody>
						</table>

					</div>

				</div>
			</div>
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

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
					<h1>Evaluaciónes 0312</h1>
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

			<div id="accordion">
				<div class="card">
					<div class="card-header" id="headingOne">
						<h5 class="mb-0">
							<button class="btn btn-primary btn-block text-left" data-toggle="collapse" data-target="#collapseOne"  aria-controls="collapseOne">
								<i class="fas fa-2x fa-list"></i>&nbsp;&nbsp;Realizar una nueva Evaluación
							</button>
						</h5>
					</div>

					<div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
						<div class="card-body row">
							<div class=" col-md-4 text-center">
								<div class="user-block">
									<img class="brand-image img-circle elevation-3" style="opacity: .8; width:50%; height: 50%;" src="img/<?php echo $logotipo_empresa ?>" alt="user image" >
									<br>
									<span class="username">
										<p><?php echo $nombre_empresa; ?></p>

									</span>

								</div>

							</div>
							<form  id="edititemform" action="" method="POST" class="col-md-8">

								<div class="form-row 6">

									<div class="form-group col-md-6">
										<label for="inputPassword4">Seleccione la fecha de Creación</label>
										<input type="date" name="fecha_creacion" class="form-control" required>
									</div>
									<div class="form-group col-md-6">
										<label for="inputPassword4">Seleccione la fecha de Finalizacion</label>
										<input type="date" name="fecha_fin_c" class="form-control" required>
									</div>
									<div class="form-group col-md-6">
										<label for="inputPassword4">Identificación Asesor</label>
										<input type="number" name="id_asesor" class="form-control" required>
									</div>
									<div class="form-group col-md-6">
										<label for="inputPassword4">Nombre Asesor</label>
										<input type="text" name="nombre_asesor" class="form-control" required>
									</div>
									<div class="form-group col-md-6">
										<label for="inputPassword4">Telefono Asesor</label>
										<input type="text" name="telefono_asesor" class="form-control" required>
									</div>
									<div class="form-group col-md-6">
										<label for="inputPassword4">Cargo Asesor</label>
										<input type="text" name="cargo_asesor" class="form-control" required>
									</div>

								</div>
								<button type="submit" form="edititemform" name="guardar_creacion" class="btn btn-success btn-block">
									<i class="fas fa-2x fa-save"></i>
								Guardar Cambios</button>
							</form>
						</div>
					</div>
				</div>



			</div> 
			<div>

				<div class="col-lg-12">
					<div class="card mb-3">
						<div class="card-header bg-navy">
							<i class="fas fa-user-circle"></i>
						Lista Actual de Evaluaciones</div>
						<div class="card-body">
							<table class="display table table-bordered text-center"  width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Codigo</th>
										<th>Fecha</th>
										<th>Creado por</th>
										<th>Asesorado por</th>
										<th class="text-center">Opciónes</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$idcreacion = "SELECT * FROM creacion WHERE id_empresa_fk='{$id_empresa}'  ";

									if ($creresult = $sqlconnection->query($idcreacion)) {

										if ($creresult->num_rows == 0) {
                      //echo "<td colspan='4'>There are currently no staff.</td>";
										}
										while($creacionresult = $creresult->fetch_array(MYSQLI_ASSOC)) {
											$id_creacion=$creacionresult['id_creacion'];


											$empresas = "SELECT e.id_evaluacion, e.fecha_evaluacion, e.id_item_estandar_fk, e.justificacion_evaluacion,  e.id_creacion_fk, e.estado_evaluacion, sum(e.porcentaje_evaluacion) AS porcentaje, i.id_item_estandar, i.indice_item_estandar, i.pregunta_item_estandar, i.valor_item_estandar, i.id_ciclo_fk, i.id_categoria_estandar_fk, i.id_subcategoria_estandar_fk,cre.id_empresa_fk,cre.id_creacion,cre.fecha_creacion,cre.id_users_fk,cre.nombre_asesor,cre.id_asesor,u.id,u.identificacion,u.firstname

											FROM evaluacion e
											INNER JOIN item_estandar i 
											ON e.id_item_estandar_fk=i.id_item_estandar  

											INNER JOIN creacion cre
											ON e.id_creacion_fk=cre.id_creacion 
											INNER JOIN users u
											ON cre.id_users_fk= u.id 
											WHERE  
											e.id_creacion_fk='{$id_creacion}'" ;

											if ($result = $sqlconnection->query($empresas)) {

												if ($result->num_rows == 0) {
                      //echo "<td colspan='4'>There are currently no staff.</td>";
												}
												while($creacion = $result->fetch_array(MYSQLI_ASSOC)) {
													?>  
													<tr class="text-center">

														<td><?php echo $creacion['id_creacion']; ?></td>
														<td><?php echo $creacion['fecha_creacion']; ?></td>
														<td>
															<?php echo $creacion['identificacion']; ?> <br>
															<?php echo $creacion['firstname']; ?>
														</td>
														<td>
															<?php echo $creacion['id_asesor']; ?> <br>
															<?php echo $creacion['nombre_asesor']; ?>
														</td>

														<td class="text-center">
															<a class="btn btn-success btn-block" href="detalles.php?id_creacion=<?php echo $creacion["id_creacion"] ?> "> <i class=" fas fa-check"></i>   Responder </a>
															<hr>
															<a href="editar_evaluacion.php?id_creacion=<?php echo $creacion["id_creacion"] ?> " title="Editar Evaluacion" class="btn btn-warning btn-block"> <i class=" fas fa-edit"></i>   Respuestas</a>
															<hr>
															<a href="resultados.php?id_creacion=<?php echo $creacion["id_creacion"] ?> " title="Resultados Evaluación" class="btn btn-info btn-block"> <i class=" fas fa-eye"></i>   Resultados</a>
															<hr>
															<a class="btn btn-danger btn-block" href="eliminar_evaluacion.php?id_creacion=<?php echo $creacion["id_creacion"] ?>"> <i class="fas fa-trash"></i> Eliminar</a>
														</td>
													</tr>

													<?php 
												}

											}



										}

									}
									else {
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

			<script type="text/javascript">
				$(document).ready(function(){
	if (window.history.replaceState) { // verificamos disponibilidad
		window.history.replaceState(null, null, window.location.href);
	}
});
</script>

<?php include ('includes/adminfooter.php');?>

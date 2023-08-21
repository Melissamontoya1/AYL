<?php

include('includes/adminheader.php');
include ('includes/adminnav.php');
include ('guardar_empleado.php');

if (isset($_SESSION['role'])) {
	$currentrole = $_SESSION['role'];
}


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Administrar Colaboradores</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
						<li class="breadcrumb-item active">Colaboradores</li>
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
								<i class="fas fa-2x fa-users"></i>
								Datos de los colaboradores
							</button>
						</h5>
					</div>
					<div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
						<div class="card-body">
							<form  id="edititemform" action="" method="POST">
								<div class="form-row border-bottom-success">
									<div class="form-group col-md-6">
										<label for="inputEmail4">Identificación </label>
										<input type="text" name="id_empleado" class="form-control" placeholder="Cedula Empleado" required>
									</div>
									<div class="form-group col-md-6">
										<label for="inputPassword4">Nombres</label>
										<input type="text" name="nombre_empleado" class="form-control" placeholder="Nombres del empleado" required>
									</div>
									<div class="form-group col-md-6">
										<label for="inputPassword4">Apellidos</label>
										<input type="text" name="apellido_empleado" class="form-control" placeholder="Apellidos Empleado" required>
									</div>
									<div class="form-group col-md-6">
										<label for="inputAddress">Dirección</label>
										<input type="text" name="direccion_empleado" class="form-control " placeholder="Dirección" required>
									</div>
									<div class="form-group col-md-6">
										<label for="inputAddress">Teléfono</label>
										<input type="text" name="telefono_empleado" class="form-control " placeholder="Telefono" required>
									</div>
									<div class="form-group col-md-6">
										<label for="inputAddress">Correo</label>
										<input type="text" name="correo_empleado" class="form-control " placeholder="Correo electronico" required>
									</div>
									<div class="form-group col-md-6">
										<label for="inputAddress">Cargo</label>
										<input type="text" name="cargo_empleado" class="form-control " placeholder="Cargo" required>
									</div>
									<div class="form-group col-md-6">
										<label for="inputAddress2">Tipo de Sangre </label>
										<input type="text" name="tipo_sangre" class="form-control" placeholder="O+" required>
									</div>
									<div class="form-group col-md-6">
										<label for="inputEmail4">Tipo de Riesgo </label>
										<select name="tipo_riesgo" id="" class="form-control">
											<option value="1">I</option>
											<option value="2">II</option>
											<option value="3">III</option>
											<option value="4">IV</option>
											<option value="5">V</option>
										</select>	
									</div>
									<div class="form-group col-md-6">
										<label for="inputEmail4">Tipo de Empleado </label>
										<select name="tipo_trabajador" id="" class="form-control">
											<option value="Directo">Directo</option>
											<option value="Indirecto">Indirecto</option>

										</select>	
									</div>
									<div class="form-group col-md-6">
										<label for="inputAddress2">Estado Empleado </label>
										<select name="estado_empleado" id="" class="form-control">
											<option value="Activo">Activo</option>
											<option value="Inactivo">Inactivo</option>

										</select>
									</div>

								</div>


							

							<button type="submit" form="edititemform" name="guardar_empleado" class="btn btn-primary btn-block">
								<i class="fas fa-2x fa-save"></i>
							Guardar Cambios</button>
						</form>
					</div>
				</div>
			</div>

		</div> 

	</div> 
	<div>

		<div class="col-lg-12">
			<div class="card mb-3">
				<div class="card-header">
					<i class="fas fa-user-circle"></i>
				Lista Actual de Empleados</div>
				<div class="card-body">
					<table class="display table table-bordered text-center"  width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Identificación</th>
								<th>Nombres</th>
								<th>Apellidos</th>
								<th>Dirección</th>
								<th>Teléfono</th>
								<th>Cargo</th>
								<th class="text-center">Opciónes</th>
							</tr>
						</thead>
						<tbody>
							<?php 

							$empleado = "SELECT id_empleado, nombre_empleado, apellido_empleado, cargo_empleado, direccion_empleado, telefono_empleado, tipo_sangre, tipo_riesgo, tipo_trabajador,id_empresa_fk FROM empleados WHERE id_empresa_fk='{$id_empresa}' ";

							if ($result = $sqlconnection->query($empleado)) {

								if ($result->num_rows == 0) {
                      //echo "<td colspan='4'>There are currently no staff.</td>";
								}
								while($rempleado = $result->fetch_array(MYSQLI_ASSOC)) {
									?>  
									<tr class="text-center">

										<td><?php echo $rempleado['id_empleado']; ?></td>
										<td><?php echo $rempleado['nombre_empleado']; ?></td>
										<td><?php echo $rempleado['apellido_empleado']; ?></td>
										<td><?php echo $rempleado['direccion_empleado']; ?></td>
										<td><?php echo $rempleado['telefono_empleado']; ?></td>
										<td><?php echo $rempleado['cargo_empleado']; ?></td>
										<td class="text-center">
											<a href="detalle_empleado.php?id_empleado=<?php echo $rempleado["id_empleado"] ?> "> <i class="btn btn-info fas fa-eye"></i></a>
											<a class="btn btn-danger" href="eliminar_empleado.php?id_empleado=<?php echo $rempleado["id_empleado"] ?>"> <i class="fas fa-trash"></i></a>
										</td>
									</tr>

									<?php 
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

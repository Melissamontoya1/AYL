<?php

include('includes/adminheader.php');
include ('includes/adminnav.php');





if (isset($_GET['id_empleado']) ) {
	$id_empleado = $sqlconnection->real_escape_string($_GET['id_empleado']);
	$empleado = "SELECT id_empleado, nombre_empleado, apellido_empleado, cargo_empleado, direccion_empleado, telefono_empleado, tipo_sangre, tipo_riesgo,estado_empleado ,tipo_trabajador,id_empresa_fk FROM empleados WHERE id_empresa_fk='{$id_empresa}' AND id_empleado='{$id_empleado}' ";

	if ($result = $sqlconnection->query($empleado)) {

		if ($result->num_rows > 0) {
			while($rempleado = $result->fetch_array(MYSQLI_ASSOC)) {
				$id_empleado=$rempleado['id_empleado'];
				$nombre_empleado =$rempleado['nombre_empleado'];
				$apellido_empleado=$rempleado['apellido_empleado'];
				$cargo_empleado =$rempleado['cargo_empleado'];
				$direccion_empleado=$rempleado['direccion_empleado'];
				$telefono_empleado =$rempleado['telefono_empleado'];
				$correo_empleado =$rempleado['correo_empleado'];
				$tipo_sangre=$rempleado['tipo_sangre'];
				$tipo_riesgo=$rempleado['tipo_riesgo'];
				$tipo_trabajador=$rempleado['tipo_trabajador'];
				$estado_empleado=$rempleado['estado_empleado'];
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
						<h1>Categorias</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
							<li class="breadcrumb-item active">Categorias</li>
						</ol>
					</div>
				</div>
			</div><!-- /.container-fluid -->
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="container-fluid">
				<h4 class="text-center text-primary"><B> <?php echo $nombre_empleado." ".$apellido_empleado." - " .$id_empleado ?> </B></h4>

				<div class="row">
					<form  id="edititemform" action="" method="POST">
						<div class="form-row border-bottom-success">
							<div class="form-group col-md-6">
								<label for="inputEmail4">Identificación </label>
								<input type="text" name="id_empleado" class="form-control" placeholder="Cedula Empleado" required value="<?php echo $id_empleado ?>">
							</div>
							<div class="form-group col-md-6">
								<label for="inputPassword4">Nombres</label>
								<input type="text" name="nombre_empleado" class="form-control" placeholder="Nombres del empleado" required value="<?php echo $nombre_empleado ?>">
							</div>
							<div class="form-group col-md-6">
								<label for="inputPassword4">Apellidos</label>
								<input type="text" name="apellido_empleado" class="form-control" placeholder="Apellidos Empleado" required value="<?php echo $apellido_empleado ?>">
							</div>
							<div class="form-group col-md-6">
								<label for="inputAddress">Dirección</label>
								<input type="text" name="direccion_empleado" class="form-control " placeholder="Dirección" required value="<?php echo $direccion_empleado ?>">
							</div>
							<div class="form-group col-md-6">
								<label for="inputAddress">Teléfono</label>
								<input type="text" name="telefono_empleado" class="form-control " placeholder="Telefono" required value="<?php echo $telefono_empleado ?>">
							</div>
							<div class="form-group col-md-6">
								<label for="inputAddress">Correo</label>
								<input type="text" name="correo_empleado" class="form-control " placeholder="Correo electronico" required value="<?php echo $correo_empleado ?>">
							</div>
							<div class="form-group col-md-6">
								<label for="inputAddress">Cargo</label>
								<input type="text" name="cargo_empleado" class="form-control " placeholder="Cargo" required value="<?php echo $cargo_empleado ?>">
							</div>
							<div class="form-group col-md-6">
								<label for="inputAddress2">Tipo de Sangre </label>
								<input type="text" name="tipo_sangre" class="form-control" placeholder="O+" required value="<?php echo $tipo_sangre ?>">
							</div>
							<div class="form-group col-md-6">
								<label for="inputEmail4">Tipo de Riesgo </label>
								<select name="tipo_riesgo" id="" class="form-control">
									<option selected value="<?php echo $tipo_riesgo ?>"><?php echo $tipo_riesgo ?></option>
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
									<option selected value="<?php echo $tipo_trabajador ?>"><?php echo $tipo_trabajador ?></option>
									<option value="Directo">Directo</option>
									<option value="Indirecto">Indirecto</option>

								</select>	
							</div>
							<div class="form-group col-md-6">
								<label for="inputAddress2">Estado Empleado </label>
								<select name="estado_empleado" id="" class="form-control">
									<option selected value="<?php echo $estado_empleado ?>"><?php echo $estado_empleado ?></option>
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
		</section>
	</div>

	<?php 
}
?>
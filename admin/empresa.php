<?php

include('includes/adminheader.php');
include ('includes/adminnav.php');
include ('includes/control_empresas.php');

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
		$updateItemQuery = "UPDATE empresa SET logotipo_empresa = '{$nombre_archivo}'  WHERE id_empresa = '".$id_empresa['id_empresa']."'";

		if ($sqlconnection->query($updateItemQuery) === TRUE) {
			echo "<script>alert('Logo actualizado satisfactoriamente');
			window.location.href= 'empresa.php';</script>";

		} 

		else {
        //handle
			echo "someting wong";
			echo $sqlconnection->error;
			echo $updateItemQuery;
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
					<h1>Empresas Registradas</h1>
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
			<?php if($_SESSION['role'] == 'superadmin')  
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
											<input type="hidden" name="id_empresa" class="form-control ">
											<label for="inputEmail4">Nombre Empresa</label>
											<input type="text" name="nombre_empresa" class="form-control" placeholder="Ingrese el nombre de la Empresa" required>
										</div>
										<div class="form-group col-md-6">
											<label for="inputPassword4">NIT </label>
											<input type="text" name="id_empresa" class="form-control" placeholder="Ingrese el Nit" required>
										</div>
										<div class="form-group col-md-6">
											<label for="inputPassword4">Siglas</label>
											<input type="text" name="siglas_empresa" class="form-control" placeholder="Ingrese las siglas de la empresa" required>
										</div>
										<div class="form-group col-md-6">
											<label for="inputAddress">Dirección</label>
											<input type="text" name="direccion_empresa" class="form-control " placeholder="Dirección" required>
										</div>
										<div class="form-group col-md-6">
											<label for="inputAddress2">Telefono </label>
											<input type="text" name="telefono_empresa" class="form-control" placeholder="Telefono" required>
										</div>
										<div class="form-group col-md-6">
											<label for="inputAddress2">Correo </label>
											<input type="email" name="correo_empresa" class="form-control" placeholder="Correo electronico" required>
										</div>


									</div>
									<h4 class="m-2 font-weight-bold text-warning text-center">Información Empresa</h4>
									<div class="form-row border-bottom-success">
										<div class="form-group col-md-6">

											<label for="inputEmail4">Actividad Económica</label>
											<input type="text" name="actividad_empresa" class="form-control" >
										</div>

										<div class="form-group col-md-6">
											<label for="inputEmail4">Codigo CIIU </label>
											<input type="text" name="codigo_ciiu_empresa"  class="form-control ">	
										</div>	
										<div class="form-group col-md-6">
											<label for="inputEmail4"> ARL  </label>
											<input type="text" name="codigo_arl_empresa"  class="form-control ">	
										</div>	
										<div class="form-group col-md-6">
											<label for="inputEmail4">Tipo de Riesgo </label>
											<select name="riesgo_empresa" id="" class="form-control">
												<option value="1">I</option>
												<option value="2">II</option>
												<option value="3">III</option>
												<option value="4">IV</option>
												<option value="5">V</option>
											</select>	
										</div>	

									</div>
									<h4 class="m-2 font-weight-bold text-warning text-center">Datos del Gerente</h4>
									<div class="form-row border-bottom-success">
										<div class="form-group col-md-6">

											<label for="inputEmail4">Identificación Gerente</label>
											<input type="text" name="cedula_gerente" class="form-control" placeholder="Cedula Gerente">
										</div>
										<div class="form-group col-md-6">

											<label for="inputEmail4">Gerente</label>
											<input type="text" name="gerente_empresa" class="form-control" placeholder="Nombre Completo del Gerente">
										</div>
										<div class="form-group col-md-6">
											<label for="inputEmail4">Cumpleaños Gerente</label>
											<input type="date" name="cumple_gerente"  class="form-control ">	
										</div>	
									</div>
									<?php if ($tipo_empresa=="Alquiler") { ?>
										<h4 class="m-2 font-weight-bold text-warning text-center">Ciclo de Facturación</h4>

										<div class="form-row border-bottom-success">
											<div class="form-group col-md-6">
												<label for="inputEmail4">Tipo de Empresa</label>
												<select name="tipo_empresa" id="" class="form-control">
													<option value="Cliente">Cliente</option>
													<option value="Alquiler">Alquiler</option>
													<option value="Venta">Venta</option>
												</select>
											</div>
											<div class="form-group col-md-6">
												<label for="inputEmail4">Estado Empresa</label>
												<select name="estado_empresa" id="" class="form-control">
													<option value="Activa">Activa</option>
													<option value="Inactiva">Inactiva</option>
												</select>
											</div>
											<div class="form-group col-md-6">
												<label for="inputEmail4">Fecha Inicial de Facturación</label>
												<input type="date" name="fecha_inicio" class="form-control " >
											</div>
											<div class="form-group col-md-6">
												<label for="inputEmail4">Fecha Final de Facturación</label>
												<input type="date" name="fecha_fin"  class="form-control " >
											</div>


										</div>
										<h4 class="m-2 font-weight-bold text-warning text-center">Programas Adiccionales </h4>
										<div class="form-row border-bottom-success">
											<div class="form-group col-md-6">
												<label for="inputEmail4">Registro Fotografico</label>
												<select name="registro_fotografico" id="" class="form-control">
													<option value="si">Si</option>
													<option value="no">No</option>

												</select>
											</div>
										</div>

									<?php } ?>

								</div>

								<button type="submit" form="edititemform" name="guardar_empresa" class="btn btn-success btn-block">
									<i class="fas fa-2x fa-save"></i>&nbsp;
								Guardar Cambios</button>
							</form>
						</div>
					</div>
				</div>

			<?php }?>

		</div> 
		<div>

			<div class="col-lg-12">
				<div class="card mb-3">
					<div class="card-header bg-navy">
						<i class="fas fa-list-alt"></i>
					Lista Actual de Empresas</div>
					<div class="card-body">
						<table class="display table table-bordered text-center"  width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>NIT</th>
									<th>Nombre</th>
									<th>Direccion</th>
									<th>Telefono</th>
									<th>Correo</th>
									<th class="text-center">Opciónes</th>
								</tr>
							</thead>
							<tbody>
								<?php 

								$empresas = "SELECT * FROM empresa ORDER BY id_empresa DESC ";

								if ($result = $sqlconnection->query($empresas)) {

									if ($result->num_rows == 0) {
                      //echo "<td colspan='4'>There are currently no staff.</td>";
									}
									while($rempresa = $result->fetch_array(MYSQLI_ASSOC)) {
										?>  
										<tr class="text-center">

											<td><?php echo $rempresa['id_empresa']; ?></td>
											<td><?php echo $rempresa['nombre_empresa']; ?></td>
											<td><?php echo $rempresa['direccion_empresa']; ?></td>
											<td><?php echo $rempresa['telefono_empresa']; ?></td>
											<td><?php echo $rempresa['correo_empresa']; ?></td>


											<td class="text-center">
												<a href=""><i class="btn btn-info fas fa-eye"></i></a>
												<a class="btn btn-danger" href="deleteitem.php?itemID=<?php echo $menuItemRow["itemID"] ?>&menuID=<?php echo $menuRow["menuID"] ?>"> <i class="fas fa-trash"></i></a>
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

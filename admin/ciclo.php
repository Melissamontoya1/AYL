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
					<h1>Información Ciclos</h1>
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
			<!--SOLO EL ROL SUPERADMINISTRADOR PUEDE ACCEDER A ESTA SESION -->
			<?php if($_SESSION['role'] == 'superadmin' || $_SESSION['role'] == 'admin' )  
			{ ?>


				<div id="accordion">
					<div class="card">
						<div class="card-header" id="headingOne">
							<h5 class="mb-0">
								<button class="btn btn-primary btn-block text-left" data-toggle="collapse" data-target="#collapseOne"  aria-controls="collapseOne">
									<i class="bi bi-arrow-repeat"></i>
									Agregar Ciclo
								</button>
							</h5>
						</div>

						<div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
							<div class="card-body">
								<form  id="cicloform" action="" method="POST">
									<div class="form-row">
										<div class="form-group col-md-12">
											<label for="inputEmail4">Nombre Ciclo</label>
											<input type="text" name="nombre_ciclo" class="form-control" placeholder="Escribe el nombre del ciclo Ej: PLANEAR">
										</div>

									</div>
									<button type="submit" form="cicloform" name="ciclo" class="btn btn-success btn-block"><i class="fas fa-2x fa-save"></i>&nbsp;Guardar Cambios</button>
								</form>
							</div>
						</div>
					</div>

				<?php }?>
			</div> 
			<div>

				<div class="card">
					<div class="card-header bg-navy">
						<i class="fas fa-list-alt"></i>
					Lista Actual de Ciclos </div>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="" class="table display table-bordered table-striped">
							<thead>
								<tr>
									<th>Numero Ciclo</th>
									<th>Nombre</th>
									<th class="text-center">Editar</th>
									<th class="text-center">Eliminar</th>
								</tr>
							</thead>
							<tbody>
								<?php 

								$ciclo = "SELECT * FROM ciclo  ";

								if ($result = $sqlconnection->query($ciclo)) {

									if ($result->num_rows == 0) {
                      //echo "<td colspan='4'>There are currently no staff.</td>";
									}
									while($cicloresul = $result->fetch_array(MYSQLI_ASSOC)) {
										?>  
										<tr class="text-center">

											<td><?php echo $cicloresul['id_ciclo']; ?></td>
											<td><?php echo $cicloresul['nombre_ciclo']; ?></td>



											<td class="text-center">
												<a href=""><i class="btn btn-warning fas fa-edit"></i></a>

											</td>
											<td>
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
					<!-- /.card-body -->
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

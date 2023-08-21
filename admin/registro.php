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
					<h1>Agregar Archivos</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
						<li class="breadcrumb-item active">Evidencias</li>
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
						<h2 class="mb-0">
							<button class="btn btn-primary btn-block text-left" data-toggle="collapse" data-target="#collapseOne"  aria-controls="collapseOne">
								<i class="fas fa-camera-retro" style="font-size: 2em;"></i>&nbsp;&nbsp;
								Subir Fotografias
							</button>
						</h2>
					</div>

					<div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
						<div class="card-body">
							<form action="files.php" method="post" enctype="multipart/form-data" id="filesForm">
								<div class="col-md-12 col-md-offset-12">
									<textarea id="compose-textarea" class="form-control" name="descripcion_registro" style="height: 10em;"></textarea>
									<input class="form-control" type="file" name="file[]" multiple>
									<br>
									<button type="button" onclick="subir()" class="btn btn-success btn-block form-control " > <i class="fas fa-2x fa-save"></i> Cargar</button>
									
								</div>
							</form>
						</div>
					</div>	
				</div>
			</div> 

			<div class="col-lg-12">
				<div class="card mb-3">
					<div class="card-header bg-navy
">
						<i class="fas fa-camera-retro"></i>
					Registro Fotografico</div>
					<div class="card-body">
						<table class="display table table-bordered text-center"  width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>Cod Registro</th>
									<th>Fecha y Hora</th>
									<th>Descripcion</th>
									<th>Registrado Por</th>
									<th>Ver Registro</th>
									<th class="text-center">Editar</th>
									<th class="text-center">Eliminar</th>
								</tr>
							</thead>
							<tbody>
								<?php 

								$detalle_registro = "SELECT  dr.id_detalle_registros,dr.id_registro_fk,dr.id_user_fk,dr.fotografia_detalle,r.id_registro,r.fecha_registro,r.descripcion_registro,u.id, u.identificacion, u.username, u.firstname, u.lastname, u.email, u.password, u.role, u.id_empresa_fk
								FROM detalle_registros dr
								INNER JOIN registros r 
								ON dr.id_registro_fk=r.id_registro
								INNER JOIN users u
								ON dr.id_user_fk = u.id GROUP BY dr.id_registro_fk
								";

								if ($result = $sqlconnection->query($detalle_registro)) {

									if ($result->num_rows == 0) {
                      //echo "<td colspan='4'>There are currently no staff.</td>";
									}
									while($fotoresul = $result->fetch_array(MYSQLI_ASSOC)) {
										?>  
										<tr class="text-center">

											<td><?php echo $fotoresul['id_registro']; ?></td>
											<td><?php echo $fotoresul['fecha_registro']; ?></td>
											<td><?php echo $fotoresul['descripcion_registro']; ?></td>
											<td><?php echo $fotoresul['firstname']; ?></td>
											<td><a class="btn btn-success" href="detalle_registro.php?id_registro_fk=<?php echo $fotoresul["id_registro_fk"] ?>"> <i class="fas fa-eye"></i> Ver</a></td>
											<td class="text-center">
												<a href=""><i class="btn btn-warning fas fa-edit"></i></a>
											</td>
											<td class="text-center">
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

	</section>
</div>
<script type="text/javascript">
	$(document).ready(function(){
	if (window.history.replaceState) { // verificamos disponibilidad
		window.history.replaceState(null, null, window.location.href);
	}
});
</script>
<script type="text/javascript">

	function subir()
	{

		var Form = new FormData($('#filesForm')[0]);
		$.ajax({

			url: "files.php",
			type: "post",
			data : Form,
			processData: false,
			contentType: false,
			success: function(data)
			{
				swal("Buen Trabajo!", "Se registro con éxito", "success").then(function() {
					window.location.replace("registro.php");
				});
			}
		});
	}

</script>

<?php include ('includes/adminfooter.php');?>

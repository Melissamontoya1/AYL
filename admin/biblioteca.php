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
	<section class="content-header ">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Descargar archivos de la Biblioteca</h1>
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
			<!--SOLO EL ROL SUPERADMINISTRADOR PUEDE ACCEDER A ESTA SESION -->
			<?php if($_SESSION['role'] == 'superadmin' || $_SESSION['role'] == 'admin' )  
			{ ?>
				
				

				<div>

					<div class="col-lg-12">
						<div class="card mb-3">
							<div class="card-header bg-navy">
								<i class="fas fa-list-alt"></i>
							Lista Actual de Archivos</div>
							<div class="card-body">
								<table class="display table table-bordered text-center"  width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>#</th>
											<th>Subcategoria</th>
											<th>Inidice Item</th>
											<th>Nombre Item</th>
											<th>Nombre Archivo</th>
											<th>Descargar</th>
											<?php   if ($rol=="superadmin") {?>
												<th class="text-center" >Editar</th>
												<th class="text-center" >Eliminar</th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php 

										$ciclo = "SELECT i.id_item_estandar, i.indice_item_estandar, i.pregunta_item_estandar, i.valor_item_estandar, i.id_ciclo_fk, i.id_categoria_estandar_fk, i.id_subcategoria_estandar_fk,i.verificacion_estandar, c.id_ciclo, c.nombre_ciclo, ct.id_categoria_estandar, ct.nombre_categoria_estandar, ct.porcentaje_categoria_estandar, s.id_subcategoria_estandar, s.nombre_subcategoria_estandar, s.porcentaje_subcategoria_estandar,a.cod_archivo_e, a.nombre_archivo_e, a.archivo_e, a.id_item_estandar_fk,a.tipo_archivo_e

										FROM item_estandar i 
										INNER JOIN ciclo c
										ON i.id_ciclo_fk = c.id_ciclo
										INNER JOIN categoria_estandar ct
										ON i.id_categoria_estandar_fk = ct.id_categoria_estandar
										INNER JOIN subcategoria_estandar s
										ON i.id_subcategoria_estandar_fk = s.id_subcategoria_estandar
										INNER JOIN archivos_evaluacion a
										ON i.id_item_estandar = a.id_item_estandar_fk ";

										if ($result = $sqlconnection->query($ciclo)) {

											if ($result->num_rows == 0) {
                      //echo "<td colspan='4'>There are currently no staff.</td>";
											}
											while($cicloresul = $result->fetch_array(MYSQLI_ASSOC)) {
												$id_archivo=$cicloresul['cod_archivo_e'];
												$indice_item_estandar=$cicloresul['indice_item_estandar'];
												$descripcion_archivo=$cicloresul['nombre_archivo_e'];
												$archivo=$cicloresul['archivo_e'];
												$tipo_archivo=$cicloresul['tipo_archivo_e'];
												$pregunta_item_estandar=$cicloresul['pregunta_item_estandar'];
												$nombre_subcategoria_estandar=$cicloresul['nombre_subcategoria_estandar'];
												
												?>  
												<tr class="text-center">

													<td><?php echo $id_archivo; ?></td>
													<td><?php echo $nombre_subcategoria_estandar; ?></td>
													<td><?php echo $indice_item_estandar; ?></td>
													<td><?php echo $pregunta_item_estandar; ?></td>
													<td><?php echo $descripcion_archivo; ?></td>

													<td class="text-center">
														<?php if ($tipo_archivo=="excel"){?>
															<a class="btn  btn-success" href="./archivos_word/ejemplo.php?nombre_archivo=<?php echo $archivo?>"; target="_blank"><i class="fas fa-file-excel"></i></a>
															<?php  

														}else{?>
															<a class="btn  btn-primary" href="./archivos_word/ejemplo.php?nombre_archivo=<?php echo $archivo?>"; target="_blank"><i class="fas fa-file-word"></i></a>
															<?php 
														} 
														?>

													</td>
													<?php   if ($rol=="superadmin") {?>


														<td>
															<?php  echo"
															<a class='btn btn-warning' href='#archi' data-toggle='modal'  data-id_archivo='".$id_archivo."' data-descripcion_archivo='".$descripcion_archivo."' >
															<i class='fas fa-edit'></i></a>";
															?>

														</td>
														<td>
															<button class="btn btn-danger"><i class="fa fa-trash"></i></button>
														</td>
													<?php } ?>
													
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
			<?php  } ?>
		</div><!-- DIV QUE CIERRA EL CONTENEDOR DEL NAV -->

		<!-- MODAL PARA EDITAR Estado-->
		<div class="modal fade" id="archi" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="addItemModalLabel">Editar Archivos</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form  action="editar_archivo.php" method="post" enctype="multipart/form-data" >
							<div class="form-row">
								<div class="form-group col-md-12">
									<label for="inputEmail4">Nombre Archivo</label>
									<input type="text" class="form-control" name="descripcion_archivo" id="descripcion_archivo" >
									<input type="hidden" class="form-control" name="id_archivo" id="id_archivo" >
								</div>
								<div class="form-group col-md-12">
									<label for="inputEmail4">Tipo Archivo</label>
									<select name="tipo_archivo" id="" class="form-control">
										<option selected value="#">Selecione una opcion</option>
										<option value="word">Word</option>
										<option value="excel">Excel</option>
									</select>
								</div>
								<div class="form-group col-md-12 mb-3">
									<label for="inputEmail4">Archivo</label>
									<input class="form-control" type="file" name="archivo" >
								</div>
							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
								<button type="submit" class="btn btn-success" name="editar_archivo">Editar</button>
							</div>
						</form>
					</div>
				</div>	
			</div>
		</div>
	</section>
</div>
<script type="text/javascript">


	$('#archi').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget); // Button that triggered the modal
          var id_archivo = button.data('id_archivo'); // Extraer información de datos- * atributos
          var descripcion_archivo = button.data('descripcion_archivo');
          
          //AGREGAR LOS DATOS CAPURADOS AL MODAL
          var modal = $(this);
          modal.find('.modal-body #id_archivo').val(id_archivo);
          modal.find('.modal-body #descripcion_archivo').val(descripcion_archivo);
          
          
      });

  </script>
  <?php include ('includes/adminfooter.php');?>




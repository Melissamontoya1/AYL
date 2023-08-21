<?php

include('includes/adminheader.php');
include ('includes/adminnav.php');
include('mas_archivos.php');

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
$id_item_estandar=$_GET['id_item_estandar'];
$item_estandar = "SELECT 
i.id_item_estandar, i.indice_item_estandar, i.pregunta_item_estandar, i.valor_item_estandar, i.id_ciclo_fk, i.id_categoria_estandar_fk, i.id_subcategoria_estandar_fk,i.verificacion_estandar, c.id_ciclo, c.nombre_ciclo, ct.id_categoria_estandar, ct.nombre_categoria_estandar, ct.porcentaje_categoria_estandar, s.id_subcategoria_estandar, s.nombre_subcategoria_estandar, s.porcentaje_subcategoria_estandar,a.cod_archivo_e, a.nombre_archivo_e, a.archivo_e, a.id_item_estandar_fk,a.tipo_archivo_e

FROM item_estandar i 
INNER JOIN ciclo c
ON i.id_ciclo_fk = c.id_ciclo
INNER JOIN categoria_estandar ct
ON i.id_categoria_estandar_fk = ct.id_categoria_estandar
INNER JOIN subcategoria_estandar s
ON i.id_subcategoria_estandar_fk = s.id_subcategoria_estandar
INNER JOIN archivos_evaluacion a
ON i.id_item_estandar = a.id_item_estandar_fk
WHERE i.id_item_estandar='{$id_item_estandar}'
";
if ($result = $sqlconnection->query($item_estandar)) {

	if ($result->num_rows == 0) {
                      //echo "<td colspan='4'>There are currently no staff.</td>";
	}
	while($itemresult = $result->fetch_array(MYSQLI_ASSOC)) {
		$id_item_estandar=$itemresult['id_item_estandar'];
		$indice_item_estandar=$itemresult['indice_item_estandar'];
		$pregunta_item_estandar=$itemresult['pregunta_item_estandar'];
		$valor_item_estandar=$itemresult['valor_item_estandar'];
		$id_ciclo_fk=$itemresult['id_ciclo_fk'];
		$id_categoria_estandar_fk=$itemresult['id_categoria_estandar_fk'];
		$id_subcategoria_estandar_fk=$itemresult['id_subcategoria_estandar_fk'];
		$porcentaje_subcategoria_estandar=$itemresult['porcentaje_subcategoria_estandar'];
		$nombre_ciclo=$itemresult['nombre_ciclo'];
		$nombre_categoria_estandar=$itemresult['nombre_categoria_estandar'];
		$nombre_subcategoria_estandar=$itemresult['nombre_subcategoria_estandar'];
		$verificacion_estandar=$itemresult['verificacion_estandar'];
		$nombre_archivo_e=$itemresult['nombre_archivo_e'];
	}
}


?>  

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-12 text-center bg-navy">
					<h1 class="pb-1"><?php echo $indice_item_estandar."-".$pregunta_item_estandar; ?></h1>
				</div>
				<div class="col-sm-12 text-justify">
					<table style="width:100%" class="table table-bordered">
						<tr>
							<th><B>CICLO : </B></th>
							<td><?php echo $nombre_ciclo; ?></td>
						</tr>
						<tr>
							<th><B>CATEGORIA : </B>:</th>
							<td><?php echo $nombre_categoria_estandar; ?></td>
						</tr>
						<tr>
							<th><B>SUBCATEGORIA : </B>:</th>
							<td><?php echo $nombre_subcategoria_estandar; ?></td>
						</tr>
						<tr>
							<th><B>MODO VERIFICACIÓN : </B></th>
							<td><?php echo $verificacion_estandar; ?></td>
						</tr>
					</table>	
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
						<form  id="formitem" action="" method="POST" enctype="multipart/form-data">
						<div class="form-group col-md-12">
							<input type="hidden" value="<?php echo $id_item_estandar ?>" name="id_item_estandar">
							<label for="">Añadir más archivos de verificación</label>
							<table class="table pt-2"  id="tabla">
								<tr class="fila-fija ">

									<td class="col-md-4"><input type="text" name="nombre_archivo[]" class="form-control" placeholder="Nombre del archivo que debe adjuntar">
									</td>	
									<td class=" col-md-2">
										<select name="tipo_archivo_e[]" id="" class="form-control">
											<option value="word">Word</option>
											<option value="excel">Excel</option>
											<option value="guia">Guia</option>
										</select>
									</td>
									<td class="col-md-4">
										<input type="file" name="archivo_e[]" class="form-control" >
									</td>	

									<td class="eliminar col-md-2">
										<input type="button" class="btn btn-danger"  value="Menos -"/>
									</td>
								</tr>
							</table>
							<button id="adicional" name="adicional" type="button" class="btn btn-warning col-md-6"> <i class="fas fa-plus"></i> Agregar mas archivos</button>
						</div>
						<button type="submit" form="formitem" name="mas_archivos" class="btn btn-success btn-block"><i class="fas fa-2x fa-save"></i>&nbsp;Guardar Cambios</button>
						</form>
					</div>

				<?php }?>
			</div> 
			<div>

				<div class="col-lg-12">
					<div class="card mb-3">
						<div class="card-header bg-navy">
							<i class="fas fa-list-alt"></i>
						Lista de Archivos </div>

						<div class="card-body">
							<table class="display table table-bordered text-center"  width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Cod</th>
										<th>Nombre Archivo</th>
										<th>Descargar</th>
										<th class="text-center">Eliminar</th>

									</tr>
								</thead>
								<tbody>
									<?php 



									if ($result = $sqlconnection->query($item_estandar)) {

										if ($result->num_rows == 0) {
                      //echo "<td colspan='4'>There are currently no staff.</td>";
										}
										while($itemresult = $result->fetch_array(MYSQLI_ASSOC)) {
											$id_item_estandar=$itemresult['id_item_estandar'];
											$indice_item_estandar=$itemresult['indice_item_estandar'];
											$pregunta_item_estandar=$itemresult['pregunta_item_estandar'];
											$valor_item_estandar=$itemresult['valor_item_estandar'];

											$id_ciclo_fk=$itemresult['id_ciclo_fk'];
											$id_categoria_estandar_fk=$itemresult['id_categoria_estandar_fk'];
											$id_subcategoria_estandar_fk=$itemresult['id_subcategoria_estandar_fk'];
											$porcentaje_subcategoria_estandar=$itemresult['porcentaje_subcategoria_estandar'];
											$nombre_ciclo=$itemresult['nombre_ciclo'];
											$nombre_categoria_estandar=$itemresult['nombre_categoria_estandar'];
											$nombre_subcategoria_estandar=$itemresult['nombre_subcategoria_estandar'];
											$verificacion_estandar=$itemresult['verificacion_estandar'];
											$nombre_archivo_e=$itemresult['nombre_archivo_e'];
											$cod_archivo_e=$itemresult['cod_archivo_e'];
											$archivo_e=$itemresult['archivo_e'];
											$tipo_archivo_e=$itemresult['tipo_archivo_e'];

											?>  
											<tr class="text-justify">

												<td><?php echo $cod_archivo_e; ?></td>
												<td><?php echo $nombre_archivo_e; ?>		</td>
												<td>
													

													<?php 
													switch ($tipo_archivo_e) {
														case "word": ?>
														<a class="btn  btn-primary" href="./archivos_word/descarga.php?nombre_archivo=<?php echo $archivo_e?>" target="_blank" title="Descargar Plantilla">	
															<i class="fas fa-cloud-download-alt"></i>
														</a>
														<?php  
														break;
														case "excel": ?>
														<a class="btn  btn-success" href="./archivos_word/descarga.php?nombre_archivo=<?php echo $archivo_e?>"; target="_blank"><i class="fas fa-file-excel"></i></a>
														<?php 
														break;
														case "guia": ?>
														<a class="btn  btn-danger" href="./archivos_evaluacion/<?php echo $archivo_e?>"; target="_blank"><i class="fas fa-file-pdf"></i></a>
														<?php  
														break;
														default: ?>
														<a class="btn  btn-primary" href="./archivos_word/descarga.php?nombre_archivo=<?php echo $archivo_e?>" target="_blank" title="Descargar Plantilla">	<i class="fas fa-cloud-download-alt"></i>
														</a>
														<?php  
													}
													?>
												</td>
												<td>
													<a class="btn btn-danger" href="delete_archivo.php?cod_archivo_e=<?php echo $cod_archivo_e; ?>">
														<i class="fas fa-trash"></i></a>
													</td>
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

			</div><!-- DIV QUE CIERRA EL CONTENEDOR DEL NAV -->
		</section>
	</div>
	<div class="modal fade" id="editItemModalMesa" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addItemModalLabel">Editar Archivo </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="editar_mesa1" action="" method="POST" >

						<div class="form-group col-md-6">
							<label class="col-form-label">Nombre Archivo:</label>
							<input type="text" required="required" id="numero_mesa" class="form-control" name="numero_mesa" placeholder="Numero Mesa" >
						</div>

						<div class=" col-md-6">
							<center><label class="">Estado:</label></center>
							<select class="form-control" name="estado_mesa" id="estado_mesa">
								<option value="Habilitada">Habilitada</option>
								<option value="Deshabilitada">Deshabilitada</option>
							</select>
						</div>
						<div class=" col-md-6">
							<input type="hidden" required="required" id="id_mesa" class="form-control" name="id_mesa" >
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					<button type="submit" form="editar_mesa1" class="btn btn-success" name="editMesa">Editar</button>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
	if (window.history.replaceState) { // verificamos disponibilidad
		window.history.replaceState(null, null, window.location.href);
	}
}
</script>

<?php include ('includes/adminfooter.php');?>

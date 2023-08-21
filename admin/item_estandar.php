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
					<h1>Información Item Estandar</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
						<li class="breadcrumb-item active">Subir Archivos</li>
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
									Agregar Item Estandar
								</button>
							</h5>
						</div>

						<div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
							<div class="card-body">
								<form  id="cicloform" action="" method="POST" enctype="multipart/form-data">
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="inputEmail4">Indice </label>
											<input type="text" name="indice_item_estandar" class="form-control" placeholder="Indice del Item">
										</div>
										<div class="form-group col-md-6">
											<label for="inputEmail4">Pregunta</label>
											<input type="text" name="pregunta_item_estandar" class="form-control" placeholder="Pregunta del Item">

										</div>
										<div class="form-group col-md-6">
											<label for="inputEmail4">Valor Intem Estandar</label>
											<input type="text" name="valor_item_estandar" class="form-control" placeholder="Valor del Item Ej: 0.5">

										</div>

										<div class="form-group col-md-6">
											<label for="inputEmail4">Ciclo</label>
											<select class="form-control input-sm id_cliente_fk" name="id_ciclo_fk">

												<?php
												$sql_vendedor=mysqli_query($sqlconnection,"select * from ciclo order by id_ciclo");
												while ($rw=mysqli_fetch_array($sql_vendedor)){
													$id_ciclo=$rw["id_ciclo"];
													$nombre_ciclo=$rw["nombre_ciclo"];
													?>
													<option value="<?php echo $id_ciclo?>" name="id_ciclo_fk" class="id_cliente_fk"><?php echo $id_ciclo." - ".$nombre_ciclo?></option>
													<?php
												}
												?>
											</select>

										</div>
										<div class="form-group col-md-6">
											<label for="inputEmail4">Categoría</label>
											<select class="form-control input-sm " name="id_categoria_estandar_fk">

												<?php
												$sql_vendedor=mysqli_query($sqlconnection,"select * from categoria_estandar order by id_categoria_estandar");
												while ($rw=mysqli_fetch_array($sql_vendedor)){
													$id_categoria_estandar=$rw["id_categoria_estandar"];
													$nombre_categoria_estandar=$rw["nombre_categoria_estandar"];
													?>
													<option value="<?php echo $id_categoria_estandar?>" name="id_categoria_estandar_fk" ><?php echo $id_categoria_estandar." - ".$nombre_categoria_estandar; ?></option>
													<?php
												}
												?>
											</select>

										</div>
										<div class="form-group col-md-12">
											<label for="inputEmail4">Subategoría</label>
											<select class="form-control input-lg" name="id_subcategoria_estandar_fk"  rows="3">

												<?php
												$sql_vendedor=mysqli_query($sqlconnection,"select * from subcategoria_estandar order by id_subcategoria_estandar");
												while ($rw=mysqli_fetch_array($sql_vendedor)){
													$id_subcategoria_estandar=$rw["id_subcategoria_estandar"];
													$nombre_subcategoria_estandar=$rw["nombre_subcategoria_estandar"];
													?>
													<option value="<?php echo $id_subcategoria_estandar?>" name="id_subcategoria_estandar_fk" ><?php echo $id_subcategoria_estandar." - ".$nombre_subcategoria_estandar; ?></option>
													<?php
												}
												?>
											</select>

										</div>
										<div class="form-group col-md-12">
											<label for="inputEmail4">Modo de Verificación</label>
											<textarea name="verificacion_estandar" id="compose-textarea" cols="30" rows="10" class="form-control"></textarea>

										</div>
										<div class="form-group col-md-12">
											<label for=""> Archivos de Verificación</label>
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

									</div>
									<button type="submit" form="cicloform" name="item" class="btn btn-success btn-block"><i class="fas fa-2x fa-save"></i>&nbsp;Guardar Cambios</button>
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
						Lista Actual de Item Estandar </div>
						<div class="col-lg-12">
							<?php 
							$categoria_e = "SELECT SUM(valor_item_estandar) as valor
							FROM item_estandar";

							if ($result = $sqlconnection->query($categoria_e)) {

								if ($result->num_rows > 0) {
									while($itemporcentaje = $result->fetch_array(MYSQLI_ASSOC)) {
										$valor=$itemporcentaje['valor'];

									}
								}

							}
							$peso_item = "SELECT SUM(porcentaje_subcategoria_estandar) as porcentaje_subcategoria
							FROM subcategoria_estandar";

							if ($result = $sqlconnection->query($peso_item)) {

								if ($result->num_rows > 0) {
									while($porcentajec = $result->fetch_array(MYSQLI_ASSOC)) {
										$porcentaje=$porcentajec['porcentaje_subcategoria'];
									}
								}

							}
							?>
							<table class="table table-bordered text-center"  width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Valor</th>
										<th>Peso</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?php echo $valor; ?> %</td>
										<td><?php echo $porcentaje; ?>%</td>
									</tr>
								</tbody>
							</table>

						</div>
						<div class="card-body">
							<table class="display table table-bordered text-center"  width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Indice</th>
										<th>Pregunta</th>
										<th>Valor</th>
										<th>Peso</th>
										<th>Detalles del Item</th>
										<th>Modo de Verificación</th>
										<th class="text-center">Editar</th>
										<th class="text-center">Eliminar</th>

									</tr>
								</thead>
								<tbody>
									<?php 

									$item_estandar = "SELECT 
									i.id_item_estandar, i.indice_item_estandar, i.pregunta_item_estandar, i.valor_item_estandar, i.id_ciclo_fk, i.id_categoria_estandar_fk, i.id_subcategoria_estandar_fk,i.verificacion_estandar, c.id_ciclo, c.nombre_ciclo, ct.id_categoria_estandar, ct.nombre_categoria_estandar, ct.porcentaje_categoria_estandar, s.id_subcategoria_estandar, s.nombre_subcategoria_estandar, s.porcentaje_subcategoria_estandar

									FROM item_estandar i 
									INNER JOIN ciclo c
									ON i.id_ciclo_fk = c.id_ciclo
									INNER JOIN categoria_estandar ct
									ON i.id_categoria_estandar_fk = ct.id_categoria_estandar
									INNER JOIN subcategoria_estandar s
									ON i.id_subcategoria_estandar_fk = s.id_subcategoria_estandar

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


											?>  
											<tr class="text-justify">

												<td><?php echo $indice_item_estandar; ?></td>
												<td><?php echo $pregunta_item_estandar; ?></td>
												<td><?php echo $valor_item_estandar; ?> %</td>
												<td><?php echo $porcentaje_subcategoria_estandar; ?> %</td>
												<td>
													<B>CICLO : </B><?php echo $nombre_ciclo; ?><br>
													<B>CATEGORIA : </B><?php echo $nombre_categoria_estandar; ?> <br>
													<B>SUBCATEGORIA : </B><?php echo $nombre_subcategoria_estandar; ?> 
												</td>
												<td class="module line-clamp"><?php echo $verificacion_estandar; ?> </td>
												<td class="text-center">
													<a href="editar_item.php?id_item_estandar=<?php echo $id_item_estandar; ?>"><i class="btn btn-warning fas fa-edit"></i></a>
												</td>
												<td>
													<a class="btn btn-danger" href="deleteitem.php?id_item_estandar=<?php echo $id_item_estandar; ?>">
														<i class="fas fa-trash"></i></a>
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

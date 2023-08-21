<?php

include('includes/adminheader.php');
include ('includes/adminnav.php');
include ('guardar_respuesta.php');


if (isset($_GET['id_creacion']) ) {
	$id_creacion = $sqlconnection->real_escape_string($_GET['id_creacion']);
	?>
	  <div class="content-wrapper">
	<h4 class="text-center text-warning">Código Evaluación <?php echo $id_creacion ?> </h4>
	<div class="container-fluid">
		<div class="row">
			<?php  
			$porcentajeciclo = "SELECT * FROM  ciclo ";

			if ($resultciclo = $sqlconnection->query($porcentajeciclo)) {

				if ($resultciclo->num_rows > 0) {
					while($nombrec = $resultciclo->fetch_array(MYSQLI_ASSOC)) {
						$nombre_ciclo=$nombrec['nombre_ciclo'];
						?>

						<div class="col-md-3">
							<div class="card border-left-primary shadow ">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<?php
											$porcentaje1='0';
											$suma1 = "SELECT e.id_evaluacion, e.fecha_evaluacion, e.id_item_estandar_fk, e.justificacion_evaluacion, e.id_creacion_fk, e.estado_evaluacion, sum(e.porcentaje_evaluacion) AS porcentaje, i.id_item_estandar, i.indice_item_estandar, i.pregunta_item_estandar, i.valor_item_estandar, i.id_ciclo_fk, i.id_categoria_estandar_fk, i.id_subcategoria_estandar_fk,
											c.id_ciclo, c.nombre_ciclo

											FROM evaluacion e
											INNER JOIN item_estandar i 
											ON e.id_item_estandar_fk=i.id_item_estandar  
											INNER JOIN ciclo c
											ON i.id_ciclo_fk = c.id_ciclo
											WHERE c.nombre_ciclo='{$nombre_ciclo}' AND e.estado_evaluacion='completo'
											";
											if ($result1 = $sqlconnection->query($suma1)) {

												if ($result1->num_rows > 0) {
													while($ciclo = $result1->fetch_array(MYSQLI_ASSOC)) {
														$porcentaje2=$ciclo['porcentaje'];
													}
												}
											}
											$porcentaje=$porcentaje1+$porcentaje2;
											?>
											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
												<?php echo $nombre_ciclo ?></div>
												<div class="h5 mb-0 font-weight-bold text-gray-800">
													<h2 class="text-success"><?php  echo $porcentaje; ?> %</h2>
												</div>

											</div>
											<div class="col-auto">
												<i class="fas fa-circle-notch fa-spin fa-2x text-gray-300"></i>
											</div>
										</div>
									</div>
								</div>
							</div>

						<?php }}} ?>

					</div>
				</div>
					<div class="card-header p-2">
							<ul class="nav nav-pills">
								<?php 
								$estado_evaluacion="completo";
								$comprobar = "SELECT * FROM  ciclo ";

								if ($result1 = $sqlconnection->query($comprobar)) {

									if ($result1->num_rows > 0) {
										$i=0;
										while($ciclo = $result1->fetch_array(MYSQLI_ASSOC)) {
											$nombre_ciclo=$ciclo['nombre_ciclo'];
											?>
											<li class="nav-item"><a class="nav-link " href="#m<?php echo $nombre_ciclo  ?>" data-toggle="tab"><?php echo $nombre_ciclo ?></a></li>
											<?php
										}
									}
								}
							}

							?>

						</ul>
					</div><!-- /.card-header -->
					<div class="tab-content ">
						<?php 

						if ($result33 = $sqlconnection->query($comprobar)) {

							if ($result33->num_rows == 0) {
								echo "<h2>No hay datos.</h2>";
							}
                               //CONTADOR PARA QUE EL PRIMER SLIDER SEA EL ACTIVO
							$i=0;
							while($filam = $result33->fetch_array(MYSQLI_ASSOC)) {
								$nombre_ciclo=$filam['nombre_ciclo'];

								?>

								<div class="col-md-12 <?php if($i==1) echo "active"; ?> tab-pane" id="m<?php echo $nombre_ciclo  ?>">
									
									<h5 class="text-center"><B><i class="fas fa-list"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $nombre_ciclo ?></B></h5>
									<hr>
									<table class="display table table-bordered text-center"  width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>Indice</th>
												<th>Pregunta</th>
												<th>porcentaje</th>
												<th>Detalles del Ítem</th>
												<th>Justificación</th>
												<th>Responder</th>

											</tr>
										</thead>
										<tbody>
											<?php  
											$evaluar= "SELECT
											e.id_evaluacion, e.fecha_evaluacion, e.porcentaje_evaluacion, e.id_item_estandar_fk, e.justificacion_evaluacion,e.id_creacion_fk, e.estado_evaluacion,
											cre.id_creacion, cre.fecha_creacion, cre.id_empresa_fk, cre.id_users_fk,
											i.id_item_estandar, i.indice_item_estandar, i.pregunta_item_estandar, i.valor_item_estandar, i.id_ciclo_fk, i.id_categoria_estandar_fk, i.id_subcategoria_estandar_fk,i.verificacion_estandar,
											c.id_ciclo, c.nombre_ciclo, ct.id_categoria_estandar, ct.nombre_categoria_estandar, ct.porcentaje_categoria_estandar, s.id_subcategoria_estandar, s.nombre_subcategoria_estandar, s.porcentaje_subcategoria_estandar

											FROM evaluacion e
											INNER JOIN creacion cre
											ON e.id_creacion_fk=cre.id_creacion
											INNER JOIN item_estandar i 
											ON e.id_item_estandar_fk=i.id_item_estandar  
											INNER JOIN ciclo c
											ON i.id_ciclo_fk = c.id_ciclo
											INNER JOIN categoria_estandar ct
											ON i.id_categoria_estandar_fk = ct.id_categoria_estandar
											INNER JOIN subcategoria_estandar s
											ON i.id_subcategoria_estandar_fk = s.id_subcategoria_estandar
											WHERE e.id_creacion_fk='{$id_creacion}' AND cre.id_empresa_fk='{$id_empresa}' AND e.estado_evaluacion='{$estado_evaluacion}' AND c.nombre_ciclo='{$nombre_ciclo}' ";
											if ($result = $sqlconnection->query($evaluar)) {

												if ($result->num_rows > 0) {
													while($item = $result->fetch_array(MYSQLI_ASSOC)) {
														$id_evaluacion=$item['id_evaluacion'];
														$id_creacion=$item['id_creacion'];
														$id_item_estandar=$item['id_item_estandar'];
														$pregunta_item_estandar=$item['pregunta_item_estandar'];
														$indice_item_estandar=$item['indice_item_estandar'];
														$nombre_subcategoria_estandar=$item['nombre_categoria_estandar'];
														$nombre_categoria_estandar=$item['nombre_subcategoria_estandar'];
														$valor_item_estandar=$item['valor_item_estandar'];
														$verificacion_estandar=$item['verificacion_estandar'];
														$archivo_evaluacion=$item['archivo_evaluacion'];
														$justificacion_evaluacion=$item['justificacion_evaluacion'];
														?>


														<tr class="text-center">
															<td><?php echo $indice_item_estandar ?></td>
															<td><?php echo $pregunta_item_estandar ?></td>
															<td><?php echo $valor_item_estandar; ?> %</td>
															<td>
																<B>CICLO : </B><?php echo $nombre_ciclo; ?><br>
																<B>CATEGORIA : </B><?php echo $nombre_categoria_estandar; ?> <br>
																<B>SUBCATEGORIA : </B><?php echo $nombre_subcategoria_estandar; ?> 
															</td> 
															<td><?php echo $justificacion_evaluacion; ?> </td>

															<td>
																
																<a class="btn btn-warning btn-block" href="respuesta.php?id_evaluacion=<?php echo $id_evaluacion ?>&id_item_estandar=<?php echo $id_item_estandar ?>&id_creacion=<?php echo $id_creacion ?> "> Editar </a>
																
																
															</td>
														</tr>

													<?php }}}?>
												</tbody>
											</table>
										</div>
										<?php $i++;
									}
								} ?>
							</div>
						</section>
					</div>
			
							<div class="modal fade" id="respuesta" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="addItemModalLabel">Formulario de Respuesta</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="alert alert-danger text-justify" role="alert" >
												<p class="text-center ">Si no cuentas con un archivo de respuesta, por favor justifique la respuesta. <br>
													Recuerda que puedes encontrar formatos en nuestro <a href="gestor.php">Gestor de Archivos</a> o subir los tuyos </p>
												</div>
												<form id="editar_mesa1" action="" method="POST" enctype="multipart/form-data">
													<p for="" class="text-center" id="pregunta_item_estandar"></p>
													<div class="form-group col-md-12">
														<label class="col-form-label">Justificación</label>

														<textarea class="form-control" name="justificacion_evaluacion" id="" cols="30" rows="10"></textarea>
													</div>

													<div class=" col-md-12">
														<label class="col-form-label">Archivo</label>
														<input type="file" id="archivo" class="form-control" name="archivo_evaluacion"  >

													</div>
													<div class=" col-md-6">
														<input type="hidden" required="required" id="id_item_estandar" class="form-control" name="id_item_estandar_fk" >
														<input type="hidden" required="required" id="id_creacion" class="form-control" name="id_creacion_fk" >
														<input type="hidden" required="required" id="valor_item_estandar" class="form-control" name="porcentaje_evaluacion" >
													</div>
												</form>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
												<button type="submit" form="editar_mesa1" class="btn btn-success" name="respuesta_evaluacion">Enviar</button>
											</div>
										</div>
									</div>
								</div>



								<script>
									$('#respuesta').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget); // Button that triggered the modal

          var id_item_estandar = button.data('id_item_estandar'); // Extract info from data-* attributes
          var pregunta_item_estandar = button.data('pregunta_item_estandar');
          var id_creacion = button.data('id_creacion');
          var valor_item_estandar = button.data('valor_item_estandar');
          

          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          var modal = $(this);
          modal.find('.modal-body #id_item_estandar').val(id_item_estandar);
          modal.find('.modal-body #pregunta_item_estandar').val(pregunta_item_estandar);
          modal.find('.modal-body #id_creacion').val(id_creacion);
          modal.find('.modal-body #valor_item_estandar').val(valor_item_estandar);
          var objetivo = document.getElementById('pregunta_item_estandar');
          objetivo.innerHTML = pregunta_item_estandar;

      });
  </script>
  <?php include ('includes/adminfooter.php');?>
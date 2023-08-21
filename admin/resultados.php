<?php

include('includes/adminheader.php');
include ('includes/adminnav.php');
include ('guardar_respuesta.php');


if (isset($_GET['id_creacion']) ) {
	$id_creacion = $sqlconnection->real_escape_string($_GET['id_creacion']);
	?>

	<script type="text/javascript">
		google.charts.load("current", {packages:["corechart"]});
		google.charts.setOnLoadCallback(drawChart);
		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				['Ciclo', 'Porcentaje'],
				<?php  
				$porcentajeeva = "SELECT * FROM  ciclo ";

				if ($resultevaluacion = $sqlconnection->query($porcentajeeva)) {

					if ($resultevaluacion->num_rows > 0) {
						while($nombrec = $resultevaluacion->fetch_array(MYSQLI_ASSOC)) {
							$id_ciclo=$nombrec['id_ciclo'];
							$suma2 = "SELECT e.id_evaluacion, e.fecha_evaluacion, e.id_item_estandar_fk, e.justificacion_evaluacion, e.id_creacion_fk, e.estado_evaluacion, sum(e.porcentaje_evaluacion) AS resultado_evaluacion, i.id_item_estandar, i.indice_item_estandar, i.pregunta_item_estandar, i.valor_item_estandar, i.id_ciclo_fk, i.id_categoria_estandar_fk, i.id_subcategoria_estandar_fk,
							c.id_ciclo, c.nombre_ciclo,
							cre.id_empresa_fk,cre.id_creacion,cre.fecha_creacion,cre.id_users_fk

							FROM evaluacion e
							INNER JOIN item_estandar i 
							ON e.id_item_estandar_fk=i.id_item_estandar  
							INNER JOIN ciclo c
							ON i.id_ciclo_fk = c.id_ciclo
							INNER JOIN creacion cre
							ON cre.id_creacion = e.id_creacion_fk
							WHERE c.id_ciclo='{$id_ciclo}' AND e.estado_evaluacion='completo' AND e.id_creacion_fk='{$id_creacion}' AND cre.id_empresa_fk='{$id_empresa}'
							";
							if ($result3 = $sqlconnection->query($suma2)) {

								if ($result3->num_rows > 0) {
									while($reva = $result3->fetch_array(MYSQLI_ASSOC)) {

										echo "['".$reva['nombre_ciclo']."', ".$reva['resultado_evaluacion']."],";

									}
								}
							}
						}
					}
				} ?>

				]);

			var options = {
				title: 'Grafico 1',
				is3D: true,
			};

			var chart = new google.visualization.PieChart(document.getElementById('grafico'));
			chart.draw(data, options);

			document.getElementById('variable').value=chart.getImageURI();
		}
	</script>
	<script type="text/javascript">
		google.charts.load('current', {'packages':['bar']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				['CICLO', 'Maximo', 'Obtenido'],
				<?php  
				$sumaciclo = "SELECT * FROM  ciclo ";

				if ($resultciclo = $sqlconnection->query($sumaciclo)) {

					if ($resultciclo->num_rows > 0) {
						while($nombreci = $resultciclo->fetch_array(MYSQLI_ASSOC)) {
							$id_ciclo=$nombreci['id_ciclo'];
							$sumaciclo = "SELECT e.id_evaluacion, e.fecha_evaluacion, e.id_item_estandar_fk, e.justificacion_evaluacion, e.id_creacion_fk,SUM(if(e.estado_evaluacion='completo',e.porcentaje_evaluacion,0)) resultado_evaluacion, i.id_item_estandar, i.indice_item_estandar, i.pregunta_item_estandar, SUM(i.valor_item_estandar) AS resultado_ciclo, i.id_ciclo_fk, i.id_categoria_estandar_fk, i.id_subcategoria_estandar_fk,
							c.id_ciclo, c.nombre_ciclo,
							cre.id_empresa_fk,cre.id_creacion,cre.fecha_creacion,cre.id_users_fk

							FROM evaluacion e
							INNER JOIN item_estandar i 
							ON e.id_item_estandar_fk=i.id_item_estandar  
							INNER JOIN ciclo c
							ON i.id_ciclo_fk = c.id_ciclo
							INNER JOIN creacion cre
							ON cre.id_creacion = e.id_creacion_fk
							WHERE c.id_ciclo='{$id_ciclo}'  AND e.id_creacion_fk='{$id_creacion}' AND cre.id_empresa_fk='{$id_empresa}'
							";
							if ($result33 = $sqlconnection->query($sumaciclo)) {

								if ($result33->num_rows > 0) {

									while($fila2 = $result33->fetch_array(MYSQLI_ASSOC)) {

										echo "['".$fila2['nombre_ciclo']."',".$fila2['resultado_ciclo'].", ".$fila2['resultado_evaluacion']."],";

									}
								}
							}
						}
					}
				} ?>

				]);

			var options = {
				chart: {
					title: 'Desarrollo por Ciclo PHVA (%) ',
				}
			};

			var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
			chart.draw(data, google.charts.Bar.convertOptions(options));
			document.getElementById('barra').value=chart.getImageURI();
		}
	</script>
	<script type="text/javascript">
		google.charts.load('current', {'packages':['bar']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				['CATEGORIAS', 'Maximo', 'Obtenido'],
				<?php  
				$sumaCategoria = "SELECT * FROM  categoria_estandar ";

				if ($resultCa = $sqlconnection->query($sumaCategoria)) {

					if ($resultCa->num_rows > 0) {
						while($nombreca = $resultCa->fetch_array(MYSQLI_ASSOC)) {
							$id_categoria_estandar=$nombreca['id_categoria_estandar'];
							$porcentajeC=$nombreca['porcentaje_categoria_estandar'];
							$Categoria = "SELECT e.id_evaluacion, e.fecha_evaluacion, e.id_item_estandar_fk, e.justificacion_evaluacion, e.id_creacion_fk,SUM(if(e.estado_evaluacion='completo',e.porcentaje_evaluacion,0)) resultado_item, i.id_item_estandar, i.indice_item_estandar, i.pregunta_item_estandar,i.valor_item_estandar, i.id_ciclo_fk, i.id_categoria_estandar_fk, i.id_subcategoria_estandar_fk,
							c.id_categoria_estandar,c.nombre_categoria_estandar,c.porcentaje_categoria_estandar,
							cre.id_empresa_fk,cre.id_creacion,cre.fecha_creacion,cre.id_users_fk

							FROM evaluacion e
							INNER JOIN item_estandar i 
							ON e.id_item_estandar_fk=i.id_item_estandar  
							INNER JOIN categoria_estandar c
							ON i.id_categoria_estandar_fk = c.id_categoria_estandar
							INNER JOIN creacion cre
							ON cre.id_creacion = e.id_creacion_fk
							WHERE  e.id_creacion_fk='{$id_creacion}' AND cre.id_empresa_fk='{$id_empresa}' AND c.id_categoria_estandar='{$id_categoria_estandar}'
							";
							if ($result4 = $sqlconnection->query($Categoria)) {

								if ($result4->num_rows > 0) {

									while($fila2 = $result4->fetch_array(MYSQLI_ASSOC)) {

										echo "['".$fila2['nombre_categoria_estandar']."',".$porcentajeC.", ".$fila2['resultado_item']."],";

									}
								}
							}
						}
					}
				} ?>

				]);

			var options = {
				chart: {
					title: 'Desarrollo por Estandar (%) ',
				}
			};

			var chart = new google.charts.Bar(document.getElementById('estandar'));

			chart.draw(data, google.charts.Bar.convertOptions(options));
			document.getElementById('barra_estandar').value=chart.getImageURI();
		}
	</script>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Resultados  Evaluación <?php echo $id_creacion ?></h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
							<li class="breadcrumb-item active">Resultado</li>
						</ol>
					</div>
				</div>
			</div><!-- /.container-fluid -->
		</section>

		<!-- Main content -->
		<section class="content">
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
													$suma1 = "SELECT e.id_evaluacion, e.fecha_evaluacion, e.id_item_estandar_fk, e.justificacion_evaluacion,  e.id_creacion_fk, e.estado_evaluacion, sum(e.porcentaje_evaluacion) AS porcentaje, i.id_item_estandar, i.indice_item_estandar, i.pregunta_item_estandar, i.valor_item_estandar, i.id_ciclo_fk, i.id_categoria_estandar_fk, i.id_subcategoria_estandar_fk,
													c.id_ciclo, c.nombre_ciclo,cre.id_empresa_fk,cre.id_creacion,cre.fecha_creacion,cre.id_users_fk

													FROM evaluacion e
													INNER JOIN item_estandar i 
													ON e.id_item_estandar_fk=i.id_item_estandar  
													INNER JOIN ciclo c
													ON i.id_ciclo_fk = c.id_ciclo
													INNER JOIN creacion cre
													ON cre.id_creacion = e.id_creacion_fk
													WHERE c.nombre_ciclo='{$nombre_ciclo}' AND estado_evaluacion='completo' AND e.id_creacion_fk='{$id_creacion}' AND  cre.id_empresa_fk='{$id_empresa}'
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

								<?php  }}} ?>
								<?php 

								$ciclo = "SELECT SUM(porcentaje_evaluacion) AS total FROM evaluacion WHERE id_creacion_fk='{$id_creacion}' AND estado_evaluacion='completo' ";

								if ($result = $sqlconnection->query($ciclo)) {

									if ($result->num_rows == 0) {
                      //echo "<td colspan='4'>There are currently no staff.</td>";
									}
									while($cicloresul = $result->fetch_array(MYSQLI_ASSOC)) {
										$acum=$cicloresul['total'];

									}

								}
								else {
									echo $sqlconnection->error;
									echo "Error";
								}
								?>
								<hr>
								<div class="pt-3 col-md-6">
									<div class="card border-left-success shadow ">
										<div class="card-body">
											<div class="row no-gutters align-items-center">
												<div class="col mr-2">
													<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
														Total Completado
													</div>
													<div class="h5 mb-0 font-weight-bold text-gray-800">
														<h2 class="text-success"><?php  echo $acum; ?> %</h2>
													</div>

												</div>
												<div class="col-auto">
													<i class="fas fa-circle-notch fa-spin fa-2x text-gray-300"></i>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="pt-3 col-md-6">
									<div class="card border-left-success shadow ">
										<div class="card-body">
											<div class="row no-gutters align-items-center">
												<div class="col mr-2">
													<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
														Criterios de Evaluacion
													</div>
													<?php 
													if ($acum<60) {
														echo '<div class="h5 mb-0 bg-danger ">
														<center>
														<h2 >CRITICO</h2>
														</center>
														</div>';
													}
													if ($acum>=60 && $acum<=85) {
														echo '<div class="h5 mb-0 bg-warning ">
														<center>
														<h2 >MODERADAMENTE ACEPTABLE</h2>
														</center>
														</div>';
													}
													if ($acum>85) {
														echo '<div class="h5 mb-0 bg-success ">
														<center>
														<h2>ACEPTABLE</h2>
														</center>
														</div>';
													}
													?>
												</div>
												<div class="col-auto pt-3">
													<!-- Large modal -->
													<button type="button" class="btn btn-success " data-toggle="modal" data-target=".bd-example-modal-lg">Ayuda</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								

								
								<form method="post" id="hacer_pdf" action="plantilla.php" class="col-md-12" target="_blank">
									<div class="row">
										<div class="col-md-6">
											<div class="card shadow mb-4">
												<!-- div donde se mostrará el gráfico -->
												<div id="grafico" style="width: 100%; height: 500px;" ></div>

											</div>
										</div>

										<div class="col-md-6">

											<!-- Area Chart -->
											<div class="card shadow mb-4">
												<div id="columnchart_material" style="width: 600px; height: 500px;"></div>
											</div>
										</div>

										<div class="col-md-12">

											<!-- Area Chart -->
											<div class="card shadow mb-4">
												<div id="estandar" style="width: 100%; height: 500px;"></div>
											</div>
										</div>

										<div class="col-md-12">
											<!-- esta variable contendrá la imagen más adelante -->
											<input type="hidden" name="variable" id="variable" >
											<input type="hidden" name="barra" id="barra" >
											<input type="hidden" name="barra_estandar" id="barra_estandar" >
											
											<input type="hidden" name="id_creacion" value="<?php echo $id_creacion ?>">
											<input type="hidden" name="id_empresa" value="<?php echo $id_empresa ?>" >
											<!-- Boton para enviar la variable -->

											<input type="submit" value="Generar PDF" class="btn btn-primary btn-block"/>
										</div>
									</div>
								</form>
							</div>
						</div>
					</section>
				</div>
				<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Tabla de Resultados</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<table class="table table-bordered col-md-12  ">
									<thead class="bg-primary">
										<th>Criterio</th>
										<th>Valoracion</th>
										<th class="text-center">Accion</th>
									</thead>
									<tbody>
										<tr>
											<td>Si el puntaje obtenido <B>es menor al 60%</B></td>
											<td class="bg-danger"><B>CRÍTICO</B></td>
											<td><B>1.</B> Realizar y tener a disposición del Ministerio del Trabajo un Plan de Mejoramiento de inmediato. <br>
												<B>2.</B> Enviar a la respectiva Administradora de Riesgos Laborales a la que se encuentre afiliada el empleador o contratante, un reporte de avances en el termino maximo de tres (3) meses despues de realizada la autoevaluacion de estandares Minimos. <br>
												<B>3.</B> Seguimiento anual y plan de visita a la empresa con valoracion critica, por parte del Ministerio del trabajo.</td>
											</tr>
											<tr>
												<td>Si el puntaje obtenido está <B>entre el 60 y 85%</B></td>
												<td class="bg-warning"><B>MODERADAMENTE ACEPTABLE</B></td>
												<td><B>1.</B> Realizar y tener a disposición del Ministerio del Trabajo un Plan de Mejoramiento. <br>
													<B>2.</B> Enviar a la Administradora de Riesgos Laborales un reporte de avances en el termino maximo de seis (6) meses despues de realizada la autoevaluacion de Estandares Minimos. <br>
													<B>3.</B> Plan de visita por parte del Ministerio del trabajo.</td>
												</tr>
												<tr>
													<td>Si el puntaje obtenido <B>es mayor a 85%</B></td>
													<td class="bg-success"><B>ACEPTABLE</B> </td>
													<td><B>1.</B> Mantener la calificación y evidencias a disposición del Ministerio del Trabajo, e incluir en el Plan de Anual de Trabajo las mejoras que se establezcan de acuerdo con la evaluacion.</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>

					<?php } ?>
					

					<?php include ('includes/adminfooter.php');?>
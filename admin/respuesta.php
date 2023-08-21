<?php

include('includes/adminheader.php');
include ('includes/adminnav.php');
include ('guardar_respuesta.php');


if (null !==($_GET['id_item_estandar'] && $_GET['id_evaluacion'] && $_GET['id_creacion']) ) {
	$id_item_estandar = $sqlconnection->real_escape_string($_GET['id_item_estandar']);
	$id_evaluacion = $sqlconnection->real_escape_string($_GET['id_evaluacion']);
	$id_creacion = $sqlconnection->real_escape_string($_GET['id_creacion']);
	$evaluar= "SELECT
	e.id_evaluacion, e.fecha_evaluacion, e.porcentaje_evaluacion, e.id_item_estandar_fk, e.justificacion_evaluacion, e.id_creacion_fk, e.estado_evaluacion,
	cre.id_creacion, cre.fecha_creacion, cre.id_empresa_fk, cre.id_users_fk,
	i.id_item_estandar, i.indice_item_estandar, i.pregunta_item_estandar, i.valor_item_estandar, i.id_ciclo_fk, i.id_categoria_estandar_fk, i.id_subcategoria_estandar_fk,i.verificacion_estandar,i.verificacion_estandar,c.id_ciclo, c.nombre_ciclo, ct.id_categoria_estandar, ct.nombre_categoria_estandar, ct.porcentaje_categoria_estandar, s.id_subcategoria_estandar, s.nombre_subcategoria_estandar, s.porcentaje_subcategoria_estandar,a.cod_archivo_e,a.nombre_archivo_e,a.archivo_e,a.id_item_estandar_fk

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
	INNER JOIN archivos_evaluacion a
	ON a.id_item_estandar_fk = e.id_item_estandar_fk
	
	WHERE  cre.id_empresa_fk='{$id_empresa}' AND cre.id_creacion='{$id_creacion}' AND i.id_item_estandar='{$id_item_estandar}'  ";
	if ($result = $sqlconnection->query($evaluar)) {

		if ($result->num_rows > 


			0) {
			while($item = $result->fetch_array(MYSQLI_ASSOC)) {
				$id_evaluacion=$item['id_evaluacion'];
				$id_item_estandar=$item['id_item_estandar'];
				$pregunta_item_estandar=$item['pregunta_item_estandar'];
				$indice_item_estandar=$item['indice_item_estandar'];
				$nombre_subcategoria_estandar=$item['nombre_categoria_estandar'];
				$nombre_categoria_estandar=$item['nombre_subcategoria_estandar'];
				$valor_item_estandar=$item['valor_item_estandar'];
				$verificacion_estandar=$item['verificacion_estandar'];
				$id_creacion=$item['id_creacion'];
				$verificacion_estandar=$item['verificacion_estandar'];

			}
			
		}
	}else {
		echo $sqlconnection->error;
		echo "Error";
	}
	?>

	

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-10">
						<h4>Item <?php echo $pregunta_item_estandar ?></h4>
					</div>
					<div class="col-sm-2">
						<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal"><i class="far fa-question-circle"></i>	Ayuda</button>
					</div>
					
				</div>
			</div><!-- /.container-fluid -->
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="container-fluid">
				
				<div class="form-row">
					<div class="form-group col-md-12">
						<h3 class="text-center"><B>Modo de verificación</B></h3>
						<a href="detalles.php?id_creacion=<?php echo $id_creacion ?> "><button class="btn btn-primary btn-block"> Regresar a la Evaluacion</button></a>
						<p class="text-justify"><?php echo $verificacion_estandar; ?> </p>
						<form id="editar_mesa1" action="" method="POST" enctype="multipart/form-data" class="formularioRespuesta">
							<div class="icheck-primary">
								<input type="checkbox" id="justificar" class="justificar" />
								<label for="justificar">Justificación</label>
							</div>
							<p for="" class="text-center" id="pregunta_item_estandar"></p>
							

							<div class="col-md-12 archivos">
								<?php 

								$archivos = "SELECT * FROM archivos_evaluacion WHERE id_item_estandar_fk='{$id_item_estandar}'  ";

								if ($result = $sqlconnection->query($archivos)) {

									if ($result->num_rows == 0) {
                      //echo "<td colspan='4'>There are currently no staff.</td>";
									}
									while($cicloresul = $result->fetch_array(MYSQLI_ASSOC)) {
										$cod_archivo_e=$cicloresul['cod_archivo_e'];
										$nombre_archivo_e=$cicloresul['nombre_archivo_e']; 
										$archivo_e=$cicloresul['archivo_e'];
										$tipo_archivo_e=$cicloresul['tipo_archivo_e']; 
										
										?>  
										<h6><B><?php echo $nombre_archivo_e ?></B></h6><br>
										<input type="hidden" id="archivo" class="form-control" name="cod_archivo_e[]"  value="<?php echo $cod_archivo_e ?>">
										<input type="hidden" id="archivo" class="form-control" name="nombre_archivo[]"  value="<?php echo $nombre_archivo_e ?>">
										<input type="file" id="archivo" class="form-control rearchivo" name="archivo_evaluacion[]"  required>
										<?php if($tipo_archivo_e=='word'){ ?>
											<label for="" class="pt-3">Descargar Plantilla </label>

											<a class="btn  btn-info" href="./archivos_word/descarga.php?nombre_archivo=<?php echo $archivo_e?>" target="_blank" title="Descargar Plantilla"><i class="fas fa-cloud-download-alt"></i></a>
											<br>
											<?php  

										}else{ ?>
											<label for="" class="pt-3">Descargar Guia </label>
											<a class="btn  btn-info" href="./archivos_evaluacion/<?php echo $archivo_e?>" target="_blank" title="Descargar Plantilla"><i class="fas fa-cloud-download-alt"></i></a>

											<?php 
										}
									}
								} ?>
								<input type="hidden" id="archivo" class="form-control" name="id_item_estandar"  value="<?php echo $id_item_estandar ?>">
								<input type="hidden" id="archivo" class="form-control" name="id_creacion"  value="<?php echo $id_creacion ?>">
							</div>
							<div class="row pt-2" id="FormularioJustificacion">
								<div class="form-group col-md-6 pt-2" >
									<h6><B>Escribir Justificacion : Evidencia/Observación</B></h6><br>
									<textarea class="form-control" name="justificacion_evaluacion" id="" cols="30" rows="5"></textarea>
								</div>
								<div class="form-group col-md-6 pt-2" >
									<h6><B>Plan de Acción (Actividades)</B></h6><br>
									<textarea class="form-control" name="plan_accion" id="" cols="30" rows="5"></textarea>
								</div>
								<div class="form-group col-md-6 pt-2" >
									<h6><B>Responsable</B></h6><br>
									<textarea class="form-control" name="responsable" id="" cols="30" rows="5"></textarea>
								</div>
								<div class="form-group col-md-6 pt-2" >
									<h6><B>Fecha Cumplimiento</B></h6><br>
									<input type="date" class="form-control" name="fecha_cumplimiento">
								</div>
							</div>
							
							<div class="form-group col-md-12 pt-2">
								<button type="submit" form="editar_mesa1" class="btn btn-success btn-block" name="respuesta_evaluacion">Enviar Respuesta</button>
							</div>
						</form>
					</div>
					
				</div>
			</div>
		</section>
	</div>
	<?php  
}
?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><B>Instrucciones</B></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<div class="row">
					<img src="imagenes/pregunta.png" alt="..." class="img-fluid col-md-2 text-center" >
					<p class="col-md-9 text-justify">Hola, <?php echo $_SESSION['firstname']; ?> sigue esta guia para dar respuesta a este <B>Item</B></p>
					<img src="imagenes/adjunto.png" alt="..." class="col-md-2 pt-5 text-center" height="100">
					<p class="col-md-9 text-justify"> Puedes descargar los archivos que te sugerimos para dar respuesta al <B>Item</B>, los cuales estan previamente diligenciados con los datos de la empresa,tambien puedes subir tus propios archivos </p>
					<img src="imagenes/subir.png" alt="..." class="col-md-2 pt-4 text-center" height="70">
					<p class="col-md-9 text-justify"> Cuando tengas listos los archivos debes adjuntarlos en su casilla correspondiente, esta cuenta con el nombre del archivo.</p>
					<img src="imagenes/escritura.png" alt="..." class="col-md-2 pt-1 text-center" height="70">
					<p class="col-md-9 text-justify">Si no cuentas con los documentos para darle respuesta al <B>Item</B> puedes escribir la justificacion</p>

				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i>      Cerrar</button>

			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$("#FormularioJustificacion").hide();
		$(".formularioRespuesta").on("change", "input.justificar", function () {
			if( $(this).is(':checked') ){
        // Hacer algo si el checkbox ha sido seleccionado

				swal("Justificación", "Escribe una justificación para cumplir con este item", "success");
				$(".archivos").hide();
				$("#FormularioJustificacion").show();
				$('.rearchivo').removeAttr("required");
			} else {
        // Hacer algo si el checkbox ha sido deseleccionado

				swal("Adjuntar Archivos", "Adjunta los archivos, correspondientes de cada item", "success");
				$("#FormularioJustificacion").hide();
				$(".archivos").show();


			}
		})
	});
</script>
<?php include ('includes/adminfooter.php');?>


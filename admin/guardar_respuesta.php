<?php 

if (isset($_POST['respuesta_evaluacion'])) {
	$justificacion_evaluacion = $sqlconnection->real_escape_string($_POST['justificacion_evaluacion']);
	$id_item_estandar_fk = $sqlconnection->real_escape_string($_POST['id_item_estandar']);
	$id_creacion_fk = $sqlconnection->real_escape_string($_POST['id_creacion']);
	$respondio="si";
	$fecha_evaluacion=date('Y-m-d');

	if (empty($justificacion_evaluacion )) {
		//GUARDAR LA JUSTIFICACION
		$updateItemQuery = "UPDATE evaluacion SET justificacion_evaluacion='',plan_accion='',responsable='',fecha_cumplimiento=''
		WHERE id_creacion_fk = '{$id_creacion_fk}' AND id_item_estandar_fk='{$id_item_estandar_fk}'";

		if ($sqlconnection->query($updateItemQuery) === TRUE) {
			//si
		}else{
			echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error ", "error");</script>';
			echo $sqlconnection->error;
			echo $sqlconnection->error;
		}
		$items1 = ($_POST['nombre_archivo']);
		$items2 = ($_POST['cod_archivo_e']);
		//$items4 = $id_creacion_fk;
		$files_post = $_FILES['archivo_evaluacion'];
		$files = array();
		$file_count = count($files_post['name']);
		$file_keys = array_keys($files_post);

		for ($i=0; $i < $file_count; $i++) 
		{ 
			foreach ($file_keys as $key) 
			{
				$files[$i][$key] = $files_post[$key][$i];


			}
		}
		foreach ($files as $fileID => $file)
		{
				    //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
			$item1 = current($items1);
			$item2 = current($items2);
			
			//$item4 = $items4;

			
				    ////// ASIGNARLOS A VARIABLES ///////////////////
			$nombre_archivo_e= (($item1 !== false) ? $item1 : ", &nbsp;");
			$cod_archivo_e= (($item2 !== false) ? $item2 : ", &nbsp;");
			
			//echo $nombre_archivo_e. $cod_archivo_e . $id_creacion_fk;

			if ($file['name'] != null) {
				    ///////// QUERY DE INSERCIÓN ////////////////////////////
				$fileContent = file_get_contents($file['tmp_name']);
				$imgext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION) );
				$picture = rand(1000 , 1000000) .$file['name'];

				file_put_contents('./archivos/'.$picture, $fileContent);
				$estado_respuesta="Completo";
				$registro_detalle1 = "UPDATE respuestas_evaluacion SET  archivo_respuesta = '{$picture}',estado_respuesta='{$estado_respuesta}'
				WHERE  nombre_respuesta='{$nombre_archivo_e}' AND id_creacion_fk='{$id_creacion_fk}' AND cod_archivo_e_fk ='{$cod_archivo_e}'";

				if ($sqlconnection->query($registro_detalle1) === TRUE) {
					?>
			<script>
				swal("Buen Trabajo!", "Se registro la justificacion con exito", "success").then(function() {
					window.location.replace("detalles.php?id_creacion=<?php echo $id_creacion_fk ?> ");
				});

			</script>
			<?php  
				} else {
											//handle
					echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error ", "error");</script>';
					echo $sqlconnection->error;
					echo $sqlconnection->error;
				}
			}else{
				$estado_incompleto="Incompleto";
				$registro_detalle1 = "UPDATE respuestas_evaluacion SET  estado_respuesta='{$estado_incompleto}'
				WHERE nombre_respuesta='{$nombre_archivo_e}' AND id_creacion_fk='{$id_creacion_fk}' AND cod_archivo_e_fk ='{$cod_archivo_e}'";

				if ($sqlconnection->query($registro_detalle1) === TRUE) {
					?>
			<script>
				swal("Buen Trabajo!", "Se registraron los archivos con exito", "success").then(function() {
					window.location.replace("detalles.php?id_creacion=<?php echo $id_creacion_fk ?> ");
				});

			</script>
			<?php  
				} else {
											//handle
					echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error ", "error");</script>';
					echo $sqlconnection->error;
					echo $sqlconnection->error;
				}
			}
			
		    // Up! Next Value
			$item1 = next( $items1 );
			$item2 = next( $items2 );
	    // Check terminator
			if($item1 === false && $item2 === false  ) break;

		}
		
	}else{
		$plan_accion = $sqlconnection->real_escape_string($_POST['plan_accion']);
		$responsable = $sqlconnection->real_escape_string($_POST['responsable']);
		$fecha_cumplimiento = $sqlconnection->real_escape_string($_POST['fecha_cumplimiento']);
		//GUARDAR LA JUSTIFICACION
		$updateItemQuery = "UPDATE evaluacion SET  fecha_evaluacion='{$fecha_evaluacion}',justificacion_evaluacion='{$justificacion_evaluacion}',respondio='{$respondio}',estado_evaluacion='completo', plan_accion='{$plan_accion}', responsable ='{$responsable}',fecha_cumplimiento='{$fecha_cumplimiento}'
		WHERE id_creacion_fk = '{$id_creacion_fk}' AND id_item_estandar_fk='{$id_item_estandar_fk}'";

		if ($sqlconnection->query($updateItemQuery) === TRUE) {
			?>
			<script>
				swal("Buen Trabajo!", "Se registro la justificacion con exito", "success").then(function() {
					window.location.replace("detalles.php?id_creacion=<?php echo $id_creacion_fk ?> ");
				});

			</script>
			<?php  
		}else{
			echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error ", "error");</script>';
			echo $sqlconnection->error;
			echo $sqlconnection->error;
		}


	}

}


?>
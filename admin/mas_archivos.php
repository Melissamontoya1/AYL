<?php 

if (isset($_POST['mas_archivos'])) {
	
	$id_item_estandar_fk = $_POST['id_item_estandar'];
	$nombre_archivo = $_POST['nombre_archivo'];
	$tipo_archivo = $_POST['tipo_archivo_e'];
	$files_post = $_FILES['archivo_e'];
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
		$item3 = current($nombre_archivo);
		$item4 = current($tipo_archivo);

		$nombre_archivo_e =(( $item3 !== false) ? $item3 : ", &nbsp;");
		$tipo_archivo_e =(( $item4 !== false) ? $item4 : ", &nbsp;");
		$fileContent = file_get_contents($file['tmp_name']);

							//$imgext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION) );
		$picture = $file['name'];

		file_put_contents('./archivos_evaluacion/'.$picture, $fileContent);

		$registro_detalle1 = "INSERT INTO archivos_evaluacion (nombre_archivo_e,archivo_e,id_item_estandar_fk,tipo_archivo_e)
		VALUES ('{$nombre_archivo_e}','{$picture}','{$id_item_estandar_fk}','{$tipo_archivo_e}')";

		if ($sqlconnection->query($registro_detalle1) === TRUE) {
			echo "LISTO";
		} else {
											//handle
			echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error ", "error");</script>';
			echo $sqlconnection->error;
			echo $sqlconnection->error;
		}

		$item3 = next( $nombre_archivo );


				    // Check terminator
		if($item3 === false && $item4 === false) break;
	}
}

?>
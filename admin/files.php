<?php

include('includes/adminheader.php');
$descripcion_registro= $sqlconnection->real_escape_string($_POST['descripcion_registro']);
$registro_guardado = "INSERT INTO registros (descripcion_registro)
VALUES ('{$descripcion_registro}')";

if ($sqlconnection->query($registro_guardado) === TRUE) {
	$id_registro_fk = mysqli_insert_id($sqlconnection);
	echo $id_registro_fk;
} else {
					//handle
	echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error ", "error");</script>';
	echo $sqlconnection->error;
	echo $sqlconnection->error;
}

$files_post = $_FILES['file'];

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
	$fileContent = file_get_contents($file['tmp_name']);

	$imgext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION) );
	$picture = rand(1000 , 1000000) .$file['name'].'.'.$imgext;

	file_put_contents('./registro_fotografico/'.$picture, $fileContent);

	$registro_detalle1 = "INSERT INTO detalle_registros (id_registro_fk,id_user_fk,fotografia_detalle)
	VALUES ('{$id_registro_fk}','{$id_usuario}','{$picture}')";

	if ($sqlconnection->query($registro_detalle1) === TRUE) {
		echo "LISTO";
	} else {
					//handle
		echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error ", "error");</script>';
		echo $sqlconnection->error;
		echo $sqlconnection->error;
	}


}


?>
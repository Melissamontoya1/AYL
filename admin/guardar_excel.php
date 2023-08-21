<?php 

if (isset($_POST['guardar_excel'])) {
	$archivo_excel=$_FILES['archivo']['name'];
	$guardar_pdf=$_FILES['archivo']['tmp_name'];
	$descripcion_archivo = $sqlconnection->real_escape_string($_POST['descripcion_archivo']);
	$tipo_archivo=$sqlconnection->real_escape_string($_POST['tipo_archivo']);

	if (move_uploaded_file($guardar_pdf,'./biblioteca/'.$archivo_excel )) {
	$excel = "INSERT INTO archivos(descripcion_archivo,archivo, tipo_archivo) VALUES ('{$descripcion_archivo}','{$archivo_excel}','{$tipo_archivo}')";

	if ($sqlconnection->query($excel) === TRUE) {
		echo '<script>
		swal("Buen Trabajo!", "Se registro con éxito", "success").then(function() {
			window.location.replace("add_biblioteca.php");
			});

			</script>';
		} 

		else {
					//handle
			echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error ", "error");</script>';
			echo $sqlconnection->error;
			echo $sqlconnection->error;
		}
}
}
?>
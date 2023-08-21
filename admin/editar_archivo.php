<?php 

include('includes/adminheader.php');
include ('includes/adminnav.php');
if(isset($_POST['editar_archivo'])) {
	$archivo_excel=$_FILES['archivo']['name'];
	$guardar_pdf=$_FILES['archivo']['tmp_name'];
	$archivov = $_FILES['archivo'];
	$id_archivo = $sqlconnection->real_escape_string($_POST['id_archivo']);
	$descripcion_archivo = $sqlconnection->real_escape_string($_POST['descripcion_archivo']);
	$tipo_archivo=$sqlconnection->real_escape_string($_POST['tipo_archivo']);

	if ($archivov == 0) {

		$updateItemQuery = "UPDATE archivos SET  descripcion_archivo='{$descripcion_archivo}',tipo_archivo='{$tipo_archivo}' WHERE id_archivo = '{$id_archivo}' ";

		if ($sqlconnection->query($updateItemQuery) === TRUE) {
			echo '<script>
			swal("Buen Trabajo!", "Se registro con éxito", "success").then(function() {
				window.location.replace("biblioteca.php");
				});

				</script>';

			}else {
				//handle
				echo "Error al guardar los datos";
				echo $sqlconnection->error;
				echo $updateItemQuery;
			}




	}else{
		$conarchivo = "SELECT * FROM archivos WHERE id_archivo='{$id_archivo}' ";

		if ($result2 = $sqlconnection->query($conarchivo)) {

			if ($result2->num_rows > 0) {
				while($fila = $result2->fetch_array(MYSQLI_ASSOC)) {
					$archivo_eliminado=$fila['archivo'];
				}
				unlink('./biblioteca/'.$archivo_eliminado);
			}
			
		}
		if (move_uploaded_file($guardar_pdf,'./biblioteca/'.$archivo_excel )) {
			$updateItemQuery = "UPDATE archivos SET  descripcion_archivo='{$descripcion_archivo}',tipo_archivo='{$tipo_archivo}',archivo='{$archivo_excel}' WHERE id_archivo = '{$id_archivo}' ";

			if ($sqlconnection->query($updateItemQuery) === TRUE) {
				echo '<script>
				swal("Buen Trabajo!", "Se registro con éxito", "success").then(function() {
					window.location.replace("biblioteca.php");
					});

					</script>';

				}else {
				//handle
					echo "Error al guardar los datos";
					echo $sqlconnection->error;
					echo $updateItemQuery;
				}
			}
			
		}
	}

	?>
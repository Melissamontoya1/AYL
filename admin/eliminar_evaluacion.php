<?php 

include('includes/adminheader.php');
if (isset($_GET['id_creacion'])) {

	$id_creacion = $sqlconnection->real_escape_string($_GET['id_creacion']);
	

	$deleteItemQuery = "DELETE FROM creacion WHERE id_creacion = {$id_creacion} ";

	if ($sqlconnection->query($deleteItemQuery) === TRUE) {
		$deleteItemQuery = "DELETE FROM evaluacion WHERE id_creacion_fk = {$id_creacion} ";

		if ($sqlconnection->query($deleteItemQuery) === TRUE) {
			echo '<script>
			swal("Buen Trabajo!", "Se registro con éxito", "success").then(function() {
				window.location.replace("evaluacion.php");
				});

				</script>';
			} 

			else {
				//handle
				echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error ", "error");</script>';
				echo $sqlconnection->error;

			}
		} 

		else {
				//handle
			echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error ", "error");</script>';
			echo $sqlconnection->error;

		}
	}

?>
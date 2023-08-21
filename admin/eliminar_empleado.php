<?php 

include('includes/adminheader.php');
if (isset($_GET['id_empleado'])) {

	$id_empleado = $sqlconnection->real_escape_string($_GET['id_empleado']);
	

	$deleteItemQuery = "DELETE FROM empleados WHERE id_empleado = {$id_empleado} ";

	if ($sqlconnection->query($deleteItemQuery) === TRUE) {
		echo '<script>
			swal("Buen Trabajo!", "Se registro con éxito", "success").then(function() {
				window.location.replace("empleados.php");
				});

				</script>';
	} 

	else {
				//handle
		echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error ", "error");</script>';
		echo $sqlconnection->error;

	}
}

?>
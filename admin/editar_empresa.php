<?php

include('includes/adminheader.php');
include ('includes/adminnav.php');
$id_empresa=$_POST['id_empresa'];
$nombre_empresa=$_POST['nombre_empresa'];
$direccion_empresa=$_POST['direccion_empresa'];
$telefono_empresa=$_POST['telefono_empresa'];
$correo_empresa=$_POST['correo_empresa'];


	$updateEmpresa = "UPDATE empresa SET nombre_empresa = '{$nombre_empresa}', direccion_empresa = '{$direccion_empresa}', telefono_empresa = '{$telefono_empresa}', correo_empresa = '{$correo_empresa}' WHERE id_empresa = '{$id_empresa}'";

	if ($sqlconnection->query($updateEmpresa) === TRUE) {
		echo '<script>
			swal("Buen Trabajo!", "Se editaron lo datos con éxito", "success").then(function() {
				window.location.replace("empresa_personal.php");
				});

				</script>';

	} 

	else {
        	//handle
		echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error ", "error");</script>';
		echo $sqlconnection->error;
		echo $updateEmpresa;
	}

include('includes/adminfooter.php');
?>
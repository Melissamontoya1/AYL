<?php 

if (isset($_POST['guardar_empleado'])) {
	
	$id_empleado = $sqlconnection->real_escape_string($_POST['id_empleado']);
	$nombre_empleado = $sqlconnection->real_escape_string($_POST['nombre_empleado']);
	$apellido_empleado = $sqlconnection->real_escape_string($_POST['apellido_empleado']);
	$cargo_empleado = $sqlconnection->real_escape_string($_POST['cargo_empleado']);
	$direccion_empleado = $sqlconnection->real_escape_string($_POST['direccion_empleado']);
	$telefono_empleado = $sqlconnection->real_escape_string($_POST['telefono_empleado']);
	$correo_empleado = $sqlconnection->real_escape_string($_POST['correo_empleado']);
	$tipo_sangre = $sqlconnection->real_escape_string($_POST['tipo_sangre']);
	$tipo_riesgo = $sqlconnection->real_escape_string($_POST['tipo_riesgo']);
	$tipo_trabajador = $sqlconnection->real_escape_string($_POST['tipo_trabajador']);
	$estado_empleado = $sqlconnection->real_escape_string($_POST['estado_empleado']);
	
	$usuario = "INSERT INTO empleados (id_empleado, nombre_empleado, apellido_empleado, cargo_empleado, direccion_empleado, telefono_empleado,correo_empleado, tipo_sangre, tipo_riesgo, tipo_trabajador, estado_empleado, id_empresa_fk)
	VALUES ('{$id_empleado}','{$nombre_empleado}','{$apellido_empleado}','{$cargo_empleado}','{$direccion_empleado}','{$telefono_empleado}','{$correo_empleado}','{$tipo_sangre}','{$tipo_riesgo}','{$tipo_trabajador}','{$estado_empleado}','{$id_empresa}')";

	if ($sqlconnection->query($usuario) === TRUE) {
		echo '<script>
		swal("Buen Trabajo!", "Se registro con éxito", "success").then(function() {
			window.location.replace("empleados.php");
			});

			</script>';
		} else {
					//handle
			echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error ", "error");</script>';
			echo $sqlconnection->error;
			echo $sqlconnection->error;
		}

	}



?>
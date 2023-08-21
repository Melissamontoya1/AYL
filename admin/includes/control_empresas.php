<?php 
if (isset($_POST['guardar_empresa'])) {
	$id_empresa= $sqlconnection->real_escape_string($_POST['id_empresa']);
	$nombre_empresa= $sqlconnection->real_escape_string($_POST['nombre_empresa']);
	$direccion_empresa= $sqlconnection->real_escape_string($_POST['direccion_empresa']);
	$telefono_empresa= $sqlconnection->real_escape_string($_POST['telefono_empresa']);
	$correo_empresa= $sqlconnection->real_escape_string($_POST['correo_empresa']);
	$gerente_empresa= $sqlconnection->real_escape_string($_POST['gerente_empresa']);
	$cumple_gerente= $sqlconnection->real_escape_string($_POST['cumple_gerente']);
	
	$tipo_empresa= $sqlconnection->real_escape_string($_POST['tipo_empresa']);
	$fecha_inicio= $sqlconnection->real_escape_string($_POST['fecha_inicio']);
	$fecha_fin=$sqlconnection->real_escape_string($_POST['fecha_fin']);
	$estado_empresa= $sqlconnection->real_escape_string($_POST['estado_empresa']);
	$siglas_empresa= $sqlconnection->real_escape_string($_POST['siglas_empresa']);
	$cedula_gerente= $sqlconnection->real_escape_string($_POST['cedula_gerente']);

	$actividad_economica= $sqlconnection->real_escape_string($_POST['actividad_economica']);
	$codigo_ciiu_empresa= $sqlconnection->real_escape_string($_POST['codigo_ciiu_empresa']);
	$codigo_arl_empresa= $sqlconnection->real_escape_string($_POST['codigo_arl_empresa']);
	$riesgo_empresa= $sqlconnection->real_escape_string($_POST['riesgo_empresa']);
	$registro_fotografico= $sqlconnection->real_escape_string($_POST['registro_fotografico']);
	$username="admin_".$siglas_empresa;
	$pass="cambiar";
	$password = password_hash("$pass" , PASSWORD_DEFAULT);
	$role="admin";

	$addStaffQuery = "INSERT INTO empresa (id_empresa,nombre_empresa, siglas_empresa,direccion_empresa, telefono_empresa, correo_empresa, gerente_empresa, cumple_gerente,cedula_gerente, tipo_empresa, fecha_inicio, fecha_fin, estado_empresa,actividad_empresa,codigo_ciiu_empresa, codigo_arl_empresa,riesgo_empresa,registro_fotografico)
	VALUES ('{$id_empresa}','{$nombre_empresa}','{$siglas_empresa}','{$direccion_empresa}','{$telefono_empresa}','{$correo_empresa}','{$gerente_empresa}','{$cumple_gerente}','{$cedula_gerente}','{$tipo_empresa}','{$fecha_inicio}','{$fecha_fin}','{$estado_empresa}','{$actividad_empresa}','{$codigo_ciiu_empresa}','{$codigo_arl_empresa}','{$riesgo_empresa}','{$registro_fotografico}')";

	if ($sqlconnection->query($addStaffQuery) === TRUE) {
		$usuario = "INSERT INTO users (identificacion, username, firstname, email, password, role, id_empresa_fk)
		VALUES ('{$cedula_gerente}','{$username}','{$gerente_empresa}','{$correo_empresa}','{$password}','{$role}','{$id_empresa}')";

		if ($sqlconnection->query($usuario) === TRUE) {
			$comparar= "SELECT * FROM documentacion ";
			if ($result = $sqlconnection->query($comparar)) {
				if ($result->num_rows > 0) {
					while($docu = $result->fetch_array(MYSQLI_ASSOC)) {
						$id_documentacion_fk=$docu['id_documentacion'];
						$estado="no";
						$query_docu = "INSERT INTO detalle_documentacion(id_documentacion_fk, id_empresa_fk, estado_documento) VALUES ('$id_documentacion_fk','$id_empresa','$estado')";
						if ($sqlconnection->query($query_docu) === TRUE) {
							echo '<script>
							swal("Buen Trabajo!", "Se registro con éxito", "success").then(function() {
								window.location.replace("empresa.php");
								});

								</script>';

							}
							else {
								echo "<script>swal('Ocurrio un error, inténtalo nuevamente');</script>";
							}
						}
					}
				}else {
					echo $sqlconnection->error;
					echo "Error";
				}

			} else {
					//handle
				echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error ", "error");</script>';
				echo $sqlconnection->error;
		
			}

		}

	} 



?>
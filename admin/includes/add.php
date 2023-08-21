	<?php 

	if (isset($_POST['ciclo'])) {

		$nombre_ciclo = $sqlconnection->real_escape_string($_POST['nombre_ciclo']);



		$agregarciclo = "INSERT INTO ciclo (nombre_ciclo) VALUES ('{$nombre_ciclo}')";

		if ($sqlconnection->query($agregarciclo) === TRUE) {
			echo '<script>
			swal("Buen Trabajo!", "Se registro con éxito", "success").then(function() {
				window.location.replace("ciclo.php");
				});

				</script>';
			} 

			else {
						//handle
				echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error ", "error");</script>';
				echo $sqlconnection->error;

			}

		}
		if (isset($_POST['categoria'])) {

			$nombre_categoria_estandar = $sqlconnection->real_escape_string($_POST['nombre_categoria_estandar']);
			$porcentaje_categoria_estandar = $sqlconnection->real_escape_string($_POST['porcentaje_categoria_estandar']);

			$addcategoria = "INSERT INTO categoria_estandar (nombre_categoria_estandar,porcentaje_categoria_estandar) VALUES ('{$nombre_categoria_estandar}','{$porcentaje_categoria_estandar}')";

			if ($sqlconnection->query($addcategoria) === TRUE) {
				echo '<script>
				swal("Buen Trabajo!", "Se registro con éxito", "success").then(function() {
					window.location.replace("categoria.php");
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
			if (isset($_POST['subcategoria'])) {

				$nombre_subcategoria_estandar = $sqlconnection->real_escape_string($_POST['nombre_subcategoria_estandar']);
				$porcentaje_subcategoria_estandar = $sqlconnection->real_escape_string($_POST['porcentaje_subcategoria_estandar']);

				$addsubcategoria = "INSERT INTO subcategoria_estandar (nombre_subcategoria_estandar,porcentaje_subcategoria_estandar) VALUES ('{$nombre_subcategoria_estandar}','{$porcentaje_subcategoria_estandar}')";

				if ($sqlconnection->query($addsubcategoria) === TRUE) {
					echo '<script>
					swal("Buen Trabajo!", "Se registro con éxito", "success").then(function() {
						window.location.replace("subcategoria.php");
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
				if (isset($_POST['item'])) {

					$indice_item_estandar= $sqlconnection->real_escape_string($_POST['indice_item_estandar']);
					$pregunta_item_estandar= $sqlconnection->real_escape_string($_POST['pregunta_item_estandar']);
					$valor_item_estandar= $sqlconnection->real_escape_string($_POST['valor_item_estandar']);
					$id_ciclo_fk= $sqlconnection->real_escape_string($_POST['id_ciclo_fk']);
					$id_categoria_estandar_fk= $sqlconnection->real_escape_string($_POST['id_categoria_estandar_fk']);
					$id_subcategoria_estandar_fk= $sqlconnection->real_escape_string($_POST['id_subcategoria_estandar_fk']);
					$verificacion_estandar= $sqlconnection->real_escape_string($_POST['verificacion_estandar']);
					
					$estado_item="Activo";

					$additemestandar = "INSERT INTO item_estandar (indice_item_estandar, pregunta_item_estandar, valor_item_estandar, id_ciclo_fk, id_categoria_estandar_fk, id_subcategoria_estandar_fk,verificacion_estandar,estado_item) VALUES ('{$indice_item_estandar}','{$pregunta_item_estandar}','{$valor_item_estandar}','{$id_ciclo_fk}','{$id_categoria_estandar_fk}','{$id_subcategoria_estandar_fk}','{$verificacion_estandar}','{$estado_item}')";

					if ($sqlconnection->query($additemestandar) === TRUE) {
						$id_item_estandar_fk = mysqli_insert_id($sqlconnection);
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
						echo '<script>
						swal("Buen Trabajo!", "Se registro con éxito", "success").then(function() {
							window.location.replace("item_estandar.php");
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

					if (isset($_POST['guardar_creacion'])) {

						$fecha_creacion = $sqlconnection->real_escape_string($_POST['fecha_creacion']);
						$id_asesor = $sqlconnection->real_escape_string($_POST['id_asesor']);
						$nombre_asesor = $sqlconnection->real_escape_string($_POST['nombre_asesor']);
						$fecha_fin_c = $sqlconnection->real_escape_string($_POST['fecha_fin_c']);
						$estado_creacion="En Proceso";
						$telefono_asesor = $sqlconnection->real_escape_string($_POST['telefono_asesor']);
						$cargo_asesor = $sqlconnection->real_escape_string($_POST['cargo_asesor']);

						$addcreacion = "INSERT INTO creacion (fecha_creacion,fecha_fin_c,id_asesor, nombre_asesor, cargo_asesor,telefono_asesor,id_empresa_fk,id_users_fk,estado_creacion) VALUES ('{$fecha_creacion}','{$fecha_fin_c}','{$id_asesor}','{$nombre_asesor}','{$cargo_asesor}','{$telefono_asesor}','{$id_empresa}','{$id_usuario}','{$estado_creacion}')";

						if ($sqlconnection->query($addcreacion) === TRUE) {
							$ultimo_id = mysqli_insert_id($sqlconnection); 
							echo $ultimo_id;
							$evaluar = "SELECT * FROM item_estandar  ";

							if ($result1 = $sqlconnection->query($evaluar)) {

								if ($result1->num_rows > 0) {

									while($creacion = $result1->fetch_array(MYSQLI_ASSOC)) {
										$id_item_estandar_fk=$creacion['id_item_estandar'];
										$valor_item_estandar=$creacion['valor_item_estandar'];
										$estado_evaluacion="incompleto";
										$respondio="no";

										$ingresar = "INSERT INTO evaluacion (fecha_evaluacion,porcentaje_evaluacion,id_item_estandar_fk,id_creacion_fk,estado_evaluacion,respondio) VALUES ('{$fecha_creacion}',$valor_item_estandar,$id_item_estandar_fk,$ultimo_id,'{$estado_evaluacion}','{$respondio}' )";

										if ($sqlconnection->query($ingresar) === TRUE) {
											$id_evaluacion = mysqli_insert_id($sqlconnection);

											echo '<script>
											swal("Buen Trabajo!", "Se registro con éxito", "success").then(function() {
												window.location.replace("evaluacion.php");
												});

												</script>';

											} //CIERRA INSERT DE LA EVALUACION



										}
										$respuesta = "SELECT * FROM archivos_evaluacion  ";

										if ($result18 = $sqlconnection->query($respuesta)) {

											if ($result18->num_rows > 0) {

												while($fila_archivo = $result18->fetch_array(MYSQLI_ASSOC)) {

													$cod_archivo_e_fk=$fila_archivo['cod_archivo_e'];
													$nombre_respuesta=$fila_archivo['nombre_archivo_e'];
													$estado_respuesta="Incompleto";

													$ingresar_respuesta = "INSERT INTO respuestas_evaluacion (nombre_respuesta,estado_respuesta,id_creacion_fk,cod_archivo_e_fk) VALUES ('{$nombre_respuesta}','{$estado_respuesta}',$ultimo_id,$cod_archivo_e_fk)";
													if ($sqlconnection->query($ingresar_respuesta) === TRUE) {
														echo '<script>
														swal("Buen Trabajo!", "Se registro con éxito", "success").then(function() {
															window.location.replace("evaluacion.php");
															});

															</script>';

														}else {
						//handle
															echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error ", "error");</script>';
															echo $sqlconnection->error;
															echo $sqlconnection->error;
														}
													}
												}	
											}//CIERRA EL SELECT DE LA EVALUACION 

										}

									}
								}else {
						//handle
									echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error ", "error");</script>';
									echo $sqlconnection->error;
									echo $sqlconnection->error;
								}

						}//CIERRA LA CREACION

						?>



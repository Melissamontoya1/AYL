 <?php 

 include('includes/adminheader.php');
 include ('includes/adminnav.php');
 if (isset($_POST['guardar_resultado'])) {
 	$items1 = ($_POST['id_item_estandar_fk']);
 	$items2 = ($_POST['tipo_riesgo']);
 	while(true) {
  //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
 		$item1 = current($items1);
 		$item2 = current($items2);
  ////// ASIGNARLOS A VARIABLES ///////////////////
 		$id_item_estandar_fk= (($item1 !== false) ? $item1 : ", &nbsp;");
 		$tipo_riesgo= $item2;
 		
            //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
 		$valores='("'.$tipo_riesgo.'","'.$id_item_estandar_fk.'"),';

            //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
 		$valoresQ= substr($valores, 0, -1);

            ///////// QUERY DE INSERCIÓN ////////////////////////////
 		$sql = "INSERT INTO resultados_evaluacion (tipo_riesgo_resultado, id_item_estandar_fk) 
 		VALUES $valoresQ";

 		$sqlconnection->query($sql);
  // Up! Next Value
 		$item1 = next($items1);
  // Check terminator
 		if($item1 === false) break;
 	}
 }
 ?>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 	<!-- Content Header (Page header) -->
 	<section class="content-header">
 		<div class="container-fluid">
 			<div class="row mb-2">
 				<div class="col-sm-6">
 					<h1>Estandares Minimos</h1>
 				</div>
 				<div class="col-sm-6">
 					<ol class="breadcrumb float-sm-right">
 						<li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
 						<li class="breadcrumb-item active">Configurar</li>
 					</ol>
 				</div>
 			</div>
 		</div><!-- /.container-fluid -->
 	</section>

 	<!-- Main content -->
 	<section class="content">
 		<div class="container-fluid">
 			<div class="row">
 				<div class="col-md-8">
 					<h4>Configurar Resultados</h4>



 					<?php 

 					$comprobar = "SELECT * FROM  ciclo ";

 					if ($result1 = $sqlconnection->query($comprobar)) {

 						if ($result1->num_rows > 0) {
 							while($ciclo = $result1->fetch_array(MYSQLI_ASSOC)) {
 								$nombre_ciclo=$ciclo['nombre_ciclo'];
 								?>

 								<div class="card-header">
 									<i class="fas fa-list"></i>
 									<?php echo $nombre_ciclo ?></div>
 									<div class="card-body">

 										<table id="source" class="display table table-bordered text-center"  width="100%" cellspacing="0">
 											<thead>
 												<tr>
 													<th>#</th>
 													<th>Indice</th>
 													<th>Pregunta</th>
 													<th>Detalles del Item</th>
 													<th>Agregar</th>

 												</tr>
 											</thead>
 											<tbody>
 												<?php  
 												$evaluar= "SELECT 
 												i.id_item_estandar, i.indice_item_estandar, i.pregunta_item_estandar, i.valor_item_estandar, i.id_ciclo_fk, i.id_categoria_estandar_fk, i.id_subcategoria_estandar_fk,i.verificacion_estandar, c.id_ciclo, c.nombre_ciclo, ct.id_categoria_estandar, ct.nombre_categoria_estandar, ct.porcentaje_categoria_estandar, s.id_subcategoria_estandar, s.nombre_subcategoria_estandar, s.porcentaje_subcategoria_estandar

 												FROM item_estandar i 
 												INNER JOIN ciclo c
 												ON i.id_ciclo_fk = c.id_ciclo
 												INNER JOIN categoria_estandar ct
 												ON i.id_categoria_estandar_fk = ct.id_categoria_estandar
 												INNER JOIN subcategoria_estandar s
 												ON i.id_subcategoria_estandar_fk = s.id_subcategoria_estandar
 												WHERE c.nombre_ciclo='{$nombre_ciclo}'";
 												if ($result = $sqlconnection->query($evaluar)) {

 													if ($result->num_rows > 0) {
 														while($itemresult = $result->fetch_array(MYSQLI_ASSOC)) {
 															$id_item_estandar=$itemresult['id_item_estandar'];
 															$indice_item_estandar=$itemresult['indice_item_estandar'];
 															$pregunta_item_estandar=$itemresult['pregunta_item_estandar'];
 															$valor_item_estandar=$itemresult['valor_item_estandar'];

 															$id_ciclo_fk=$itemresult['id_ciclo_fk'];
 															$id_categoria_estandar_fk=$itemresult['id_categoria_estandar_fk'];
 															$id_subcategoria_estandar_fk=$itemresult['id_subcategoria_estandar_fk'];
 															$porcentaje_subcategoria_estandar=$itemresult['porcentaje_subcategoria_estandar'];
 															$nombre_ciclo=$itemresult['nombre_ciclo'];
 															$nombre_categoria_estandar=$itemresult['nombre_categoria_estandar'];
 															$nombre_subcategoria_estandar=$itemresult['nombre_subcategoria_estandar'];
 															$verificacion_estandar=$itemresult['verificacion_estandar'];
 															?>


 															<tr class="text-center">
 																<td class="id"><input type="number" value="<?php echo $id_item_estandar ?>"  class="form-control" readonly name="id_item_estandar_fk[]"></td>
 																
 																<td class="indice"><?php echo $indice_item_estandar ?></td>
 																<td class="cantidad"><?php echo $pregunta_item_estandar ?></td>

 																<td class="stock">
 																	<B>CICLO : </B><?php echo $nombre_ciclo; ?><br>
 																	<B>CATEGORIA : </B><?php echo $nombre_categoria_estandar; ?> <br>
 																	<B>SUBCATEGORIA : </B><?php echo $nombre_subcategoria_estandar; ?> 
 																</td> 




 																<td>
 																	<button onclick="add(this)" class="btn btn-primary btn-block">
 																		Agregar
 																	</button>



 																</td>
 															</tr>

 														<?php }
 													}
 												}?>
 											</tbody>
 										</table>

 									</div>
 									<?php

 								}
 							}
 						}


 						?>


 					</div>
 					<div class="col-md-4">
 						<h4>Items Seleccionados</h4>
 						<div class="table-responsive">
 							<form action="" method="POST" >

 								<label>Selecciona el Tipo de Riesgo</label>
 								<select name="tipo_riesgo[]" id="" class="form-control">
 									<option value="1">I</option>
 									<option value="2">II</option>
 									<option value="3">III</option>
 									<option value="4">IV</option>
 									<option value="5">V</option>
 								</select>
 								<table id="carrito" class="table table-bordered table-hover text-center">
 									<thead>
 										<tr>
 											<th class="id">#</th>
 											<th class="indice">Indice</th>
 											<th class="cantidad">Pregunta</th>
 											<th class="quitar">Acciones</th>
 										</tr>
 									</thead>
 									<tbody>
 									</tbody>
 								</table>
 								<button type="submit" class="btn btn-success btn-block" name="guardar_resultado">Guardar </button>
 							</form>
 						</div>
 					</div>
 					<!-- /.col -->
 				</div>
 				<!-- /.row -->
 			</div><!-- /.container-fluid -->
 		</section>
 		<!-- /.content -->
 	</div>
 	<script>
 		function add(element) {
 			var fila = element.parentNode.parentNode,
 			id = fila.querySelector('.id').cloneNode(true),
 			indice = fila.querySelector('.indice').cloneNode(true),
 			cantidad = fila.querySelector('.cantidad').cloneNode(true),

 			nueva_fila=document.createElement('tr');
 			nueva_fila.appendChild(id);
 			nueva_fila.appendChild(indice);
 			nueva_fila.appendChild(cantidad);
 			const button = document.createElement('button'); 
 			button.type = 'button'; 
 			button.innerText = 'X'; 
 			button.className = 'btn btn-danger deleteBtn';
 			
 			nueva_fila.appendChild(button);
 			var carrito =document.getElementById('carrito');

 			carrito.querySelector('tbody').appendChild(nueva_fila);


 		}
 		$(document).on('click','.deleteBtn', function(event){
 			event.preventDefault();
 			$(this).closest('tr').remove();
 		});
 	</script>
 	<?php include ('includes/adminfooter.php');?>

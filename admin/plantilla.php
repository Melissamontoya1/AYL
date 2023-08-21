<?php
include('includes/connection.php');

require('fpdf/fpdf.php');
date_default_timezone_set('America/Bogota');
class PDF extends FPDF
{

	function Header()
	{
		$this->SetFillColor(253, 135,39);
		$this->Rect(0,0, 300, 40, 'F');
		$this->SetY(25);
		$this->SetFont('Arial', 'B', 30);
		$this->SetTextColor(255,255,255);
		$this->Write(5, 'Reporte de Resultados');
		 // Salto de línea
		$this->Ln(20);
	}

	function Footer()
	{
      // Posición: a 1,5 cm del final
		$this->SetY(-15);
    // Arial italic 8
		$this->SetFont('Arial','I',8);
    // Número de página
		$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
	}


}
$id_creacion=$_POST['id_creacion'];
$id_empresa=$_POST['id_empresa'];


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(60,10,utf8_decode('Plan de Mejora'),0,1,'C');
 	 // Salto de línea
$pdf->Ln(10);


//CUERPO DE LA TABLA
$pdf->SetFillColor(233, 229, 235);//color de fondo rgb
$pdf->SetDrawColor(61, 61, 61);//color de linea  rgb
$pdf->SetFont('Arial','',10);


$evaluar= "SELECT
e.id_evaluacion, e.fecha_evaluacion, e.porcentaje_evaluacion, e.id_item_estandar_fk, e.justificacion_evaluacion,e.id_creacion_fk,e.estado_evaluacion,e.plan_accion,e.responsable,e.fecha_cumplimiento,
cre.id_creacion, cre.fecha_creacion, cre.id_empresa_fk, cre.id_users_fk,
i.id_item_estandar, i.indice_item_estandar, i.pregunta_item_estandar, i.valor_item_estandar, i.id_ciclo_fk, i.id_categoria_estandar_fk, i.id_subcategoria_estandar_fk,i.verificacion_estandar,
c.id_ciclo, c.nombre_ciclo, ct.id_categoria_estandar, ct.nombre_categoria_estandar, ct.porcentaje_categoria_estandar, s.id_subcategoria_estandar, s.nombre_subcategoria_estandar, s.porcentaje_subcategoria_estandar

FROM evaluacion e
INNER JOIN creacion cre
ON e.id_creacion_fk=cre.id_creacion
INNER JOIN item_estandar i 
ON e.id_item_estandar_fk=i.id_item_estandar  
INNER JOIN ciclo c
ON i.id_ciclo_fk = c.id_ciclo
INNER JOIN categoria_estandar ct
ON i.id_categoria_estandar_fk = ct.id_categoria_estandar
INNER JOIN subcategoria_estandar s
ON i.id_subcategoria_estandar_fk = s.id_subcategoria_estandar
WHERE e.id_creacion_fk='{$id_creacion}' AND cre.id_empresa_fk='{$id_empresa}' AND e.estado_evaluacion='completo'  ";
if ($result = $sqlconnection->query($evaluar)) {

	if ($result->num_rows > 0) {
		while($item = $result->fetch_array(MYSQLI_ASSOC)) {
			$id_evaluacion=$item['id_evaluacion'];
			$id_creacion=$item['id_creacion'];
			$id_item_estandar=$item['id_item_estandar'];
			$pregunta_item_estandar=$item['pregunta_item_estandar'];
			$indice_item_estandar=$item['indice_item_estandar'];
			$valor_item_estandar=$item['valor_item_estandar'];
			$verificacion_estandar=$item['verificacion_estandar'];
			$archivo_evaluacion=$item['archivo_evaluacion'];
			$justificacion_evaluacion=$item['justificacion_evaluacion'];
			$nombre_ciclo=$item['nombre_ciclo'];
			$nombre_categoria_estandar=$item['nombre_categoria_estandar'];
			$nombre_subcategoria_estandar=$item['nombre_subcategoria_estandar'];
			$plan_accion=$item['plan_accion'];
			$responsable=$item['responsable'];
			$fecha_cumplimiento=$item['fecha_cumplimiento'];


			if($justificacion_evaluacion<>""){
				$pdf->MultiCell(190,10,utf8_decode('ITEM : '.$indice_item_estandar.'-'.$pregunta_item_estandar),0,1,'C');
				$pdf->MultiCell(190,10,utf8_decode('CICLO : '.$nombre_ciclo),0,1,'C');
				$pdf->MultiCell(190,10,utf8_decode('CATEGORIA : '.$nombre_categoria_estandar),0,1,'C');
				$pdf->MultiCell(190,10,utf8_decode('SUBCATEGORIA : '.$nombre_subcategoria_estandar),0,1,'C');

				$pdf->MultiCell(190,10,utf8_decode('PORCENTAJE : '.$valor_item_estandar.'%'),0,1,'C');
				$pdf->MultiCell(190,10,utf8_decode('EVIDENCIAS/OBSERVACIONES : '.$justificacion_evaluacion),0,1,'C');
				$pdf->MultiCell(190,10,utf8_decode('PLAN ACCIÓN (ACTIVIDADES) : '.$plan_accion),0,1,'C');
				$pdf->MultiCell(190,10,utf8_decode('RESPONSABLE : '.$responsable),0,1,'C');
				$pdf->MultiCell(190,10,utf8_decode('FECHA (PLAZO CUMPLIMIENTO) : '.$fecha_cumplimiento),0,1,'C');
				$pdf->Ln(10);
			}
		}
	}
}
$pdf->AddPage();
$pdf->Ln(10);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(60,10,utf8_decode('Archivos de Respuesta'),0,1,'C');
 	 // Salto de línea
$pdf->Ln(10);
//CUERPO DE LA TABLA
$pdf->SetFillColor(233, 229, 235);//color de fondo rgb
$pdf->SetDrawColor(61, 61, 61);//color de linea  rgb
$pdf->SetFont('Arial','',10);
$empresas = "SELECT

cre.id_creacion, cre.fecha_creacion, cre.id_empresa_fk, cre.id_users_fk,cre.nombre_asesor,cre.id_asesor,r.id_respuestas_e,r.nombre_respuesta,r.estado_respuesta,r.archivo_respuesta,r.id_creacion_fk,r.cod_archivo_e_fk
FROM respuestas_evaluacion r
INNER JOIN creacion cre
ON r.id_creacion_fk=cre.id_creacion
WHERE cre.id_empresa_fk='{$id_empresa}' AND r.estado_respuesta='Completo' " ;

if ($result = $sqlconnection->query($empresas)) {

	if ($result->num_rows == 0) {
                      //echo "<td colspan='4'>There are currently no staff.</td>";
	}
	while($creacion = $result->fetch_array(MYSQLI_ASSOC)) {
		$id_respuesta_e = $creacion['id_respuestas_e'];
		$nombre_respuesta = $creacion['nombre_respuesta'];
		$fecha_creacion = $creacion['fecha_creacion'];
		$nombre_asesor = $creacion['nombre_asesor'];
		$archivo_respuesta = $creacion['archivo_respuesta'];
		$id_asesor = $creacion['id_asesor'];
		$timestamp = strtotime($fecha_creacion); 
		$newDate = date("m-d-Y", $timestamp );
		$pdf->MultiCell(190,10,utf8_decode('ARCHIVO : '.$nombre_respuesta),0,1,'C');
		$pdf->Cell(190, 10, 'Descargar', 1, 1,'C', false, './archivos/'.$archivo_respuesta);
		$pdf->Ln(10);
	}
}


// Primera forma de hacerlo
$pdf->AddPage();


// Segunda forma de hacerlo
// $pdf=new FPDF('P','mm',array(100,200));
// $pdf->AddPage();


$grafico=$_POST['variable'];

$img = explode(',',$grafico,2)[1];
$pic = 'data://text/plain;base64,'. $img;
$pdf->image($pic, 20,50,200,0,'png');


$pdf->Output();
?>
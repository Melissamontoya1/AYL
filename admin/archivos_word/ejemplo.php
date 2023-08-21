<?php
session_start();
$nombre_archivo = $_GET['nombre_archivo'];
include_once('tbs_class.php'); 
include_once('plugins/tbs_plugin_opentbs.php'); 
include('../includes/connection.php');
$TBS = new clsTinyButStrong; 
$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); 
    //Parametros

$empresas = "SELECT 
e.id_empresa, e.nombre_empresa, e.direccion_empresa, e.telefono_empresa, e.correo_empresa, e.gerente_empresa, e.cumple_gerente, e.logotipo_empresa, e.tipo_empresa, e.fecha_inicio, e.fecha_fin,e.firma_gerente, u.id, u.identificacion, u.username, u.firstname, u.lastname, u.email, u.password, u.role, u.id_empresa_fk 

FROM empresa e 
INNER JOIN users u
ON e.id_empresa = u.id_empresa_fk
WHERE u.username='".$_SESSION['username']."'";

if ($result = $sqlconnection->query($empresas)) {

    if ($result->num_rows > 0) {

        while($rempresa = $result->fetch_array(MYSQLI_ASSOC)) {
            $id_empresa=$rempresa['id_empresa']; 
            $nombre_empresa=$rempresa['nombre_empresa']; 
            $direccion_empresa=$rempresa['direccion_empresa']; 
            $telefono_empresa=$rempresa['telefono_empresa']; 
            $correo_empresa=$rempresa['correo_empresa'];
            $gerente_empresa=$rempresa['gerente_empresa']; 
            $cumple_gerente=$rempresa['cumple_gerente']; 
            $logotipo_empresa=$rempresa['logotipo_empresa']; 
            $tipo_empresa=$rempresa['tipo_empresa']; 
            $fecha_inicio=$rempresa['fecha_inicio']; 
            $firma_gerente_empresa=$rempresa['firma_gerente']; 
        }
    }else{
        echo $sqlconnection->error;
        echo "ERROR al mostrar las empresas";
    }
}
    //Cargando template
$template = '../archivos_evaluacion/'.$nombre_archivo;
$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8);
    //Escribir Nuevos campos
$fecha=date('Y-m-d');
$logotipo='../img/'.$logotipo_empresa;
$TBS->MergeField('datos.nit_empresa', $id_empresa);
$TBS->MergeField('datos.nombre_empresa', $nombre_empresa);
$TBS->MergeField('datos.fecha', $fecha);
$TBS->MergeField('datos.gerente_empresa', $gerente_empresa);
$TBS->VarRef['x'] = $logotipo;
$firma_gerente='../firmas/'.$firma_gerente_empresa;
$TBS->VarRef['f'] = $firma_gerente;


$subfile_lst = $TBS->PlugIn(OPENTBS_GET_HEADERS_FOOTERS);
foreach ($subfile_lst as $subfile) {
  $TBS->PlugIn(OPENTBS_SELECT_FILE, $subfile);
  $TBS->MergeField('datos.nombre_empresa', $nombre_empresa);
  $TBS->MergeField('datos.fecha', $fecha);

}

$TBS->PlugIn(OPENTBS_DELETE_COMMENTS);

$save_as = (isset($_POST['save_as']) && (trim($_POST['save_as'])!=='') && ($_SERVER['SERVER_NAME']=='localhost')) ? trim($_POST['save_as']) : '';
$output_file_name = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $template);
if ($save_as==='') {
    $TBS->Show(OPENTBS_DOWNLOAD, $output_file_name); 
    exit();
} else {
    $TBS->Show(OPENTBS_FILE, $output_file_name);
    exit("File [$output_file_name] has been created.");
}
?>
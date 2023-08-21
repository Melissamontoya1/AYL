<?php 
include('includes/connection.php');
$empresas = "SELECT 
e.id_empresa, e.nombre_empresa, e.direccion_empresa, e.telefono_empresa, e.correo_empresa, e.gerente_empresa, e.cumple_gerente, e.logotipo_empresa, e.tipo_empresa, e.fecha_inicio, e.fecha_fin, u.id, u.identificacion, u.username, u.firstname, u.lastname, u.email, u.password, u.role, u.id_empresa_fk 

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



        }
    }else{
        echo $sqlconnection->error;
        echo "ERROR al mostrar las empresas";
    }
}
?>	
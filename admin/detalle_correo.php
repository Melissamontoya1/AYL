<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'mail/autoload.php';

$mail = new PHPMailer(true);


	$mail->SMTPDebug = SMTP::DEBUG_SERVER;
	$mail->isSMTP();
	$mail->Host = 'mail.aylasesoriasintegrales.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'info@aylasesoriasintegrales.com';
	$mail->Password = 'ayl@2022';
	$mail->SMTPSecure = 'ssl';
	$mail->Port = 465;

	$mail->setFrom('info@aylasesoriasintegrales.com', 'A&L Asesorias Integrales');

$empresas = "SELECT * FROM empresa ";

if ($result = $sqlconnection->query($empresas)) {

    if ($result->num_rows > 0) {

        while($rempresa = $result->fetch_array(MYSQLI_ASSOC)) {
            $correo_empresa=$rempresa['correo_empresa'];
			$mail->addAddress($correo_empresa, );
		}
	}
	
    //$mail->addCC('yumemogu@gmail.com');
    if ($archivo_correo=="") {
    	
    }else{
    	$mail->addAttachment('archivos_correo/'.$archivo_correo, $archivo_correo);
    }

	

	$mail->isHTML(true);
	$mail->Subject =  $titulo_correo;
	$mail->Body =  $mensaje_correo;
	$mail->send();

	echo 'Correo enviado';
	echo "<script> 
	window.location.href='./correo_enviado.php'; </script>";

}else{  echo $sqlconnection->error;
        echo "ERROR al enviar el correo";
    }
?>
<?php
//primera forma de hacerlo
ini_set('display_errors', 1);
error_reporting(E_ALL);
//require_once('../WS/nusoap.php');
require_once('src/nusoap.php');

function servicioWebCorreoV1($correo_destino1,$subjectV1, $bodyV1){

$serverURL = 'http://11.34.41.160/ewsExchange/';
$serverScript = 'servicioMandarCorreo.asmx';
$metodoALlamar = 'ServicioEnviarCorreoV1';

$body = $bodyV1;

// Crear un cliente de NuSOAP para el WebService
$cliente = new nusoap_client("$serverURL/$serverScript?wsdl", 'wsdl');
// Se pudo conectar?
$error = $cliente->getError();
if ($error) {
 echo '<pre style="color: red">' . $error  . '</pre>';
 echo '<p style="color:red;'>htmlspecialchars($cliente->getDebug(), ENT_QUOTES).'</p>';
 die();
}
// 1. Llamar a la funcion getRespuesta del servidor
$result = $cliente->call(
 "$metodoALlamar", // Funcion a llamar                                                                                                                                                                                    
 array('to1' => "$correo_destino1" , 'from' => 'Sistema', 'subject' => "$subjectV1", 'body' => "$body"), // Parametros pasados a la funcion
 "uri:$serverURL/$serverScript", // namespace
 "uri:$serverURL/$serverScript/$metodoALlamar" // SOAPAction
); 

if ($cliente->fault) {
	echo 'Fallo';
	print_r($result);
} else {	
    // Chequea errores
	$err = $cliente->getError();
	if ($err) {	
    	// Muestra el error
		echo 'Error' . $err ;
	} else {	
    	// Muestra el resultado
		echo 'Resultado';
		print_r ($result);
	   }
    }
}

$correo_institucional1="alejandro.carrera@imss.gob.mx";
$correo_institucional2="alan.ramirezh@imss.gob.mx";
$subjectV1 = "Solicitud de Bienes de Consumo con el número de folio:";

$mensaje='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="http://www.w3.org/1999/xhtml"> 
          <head>
              <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
          </head>
          <body> 
          <span>Se ha registrado la solicitud de viaticos con folio : </span>
          </body>
          </html>';

//exit();          
servicioWebCorreoV1($correo_institucional1,$subjectV1, $mensaje);
servicioWebCorreoV1($correo_institucional2,$subjectV1, $mensaje);

?>
<?php

// Incorporar la biblioteca nusoap al script, incluyendo nusoap.php (ver imagen de estructura de archivos)
require_once('src/nusoap.php');
// Modificar la siguiente linea con la direccion en la cual se aloja este script
$miURL = 'http://localhost/nusoap-master/';
$server = new soap_server();
$server->configureWSDL('ws_orlando', $miURL);
$server->wsdl->schemaTargetNamespace=$miURL;


/*
 * Ejemplo 1: getRespuesta es una funcion sencilla que recibe un parametro y retorna el mismo
 * con un string anexado
 */
$server->register('getRespuesta', // Nombre de la funcion
 array('parametro' => 'xsd:string'), // Parametros de entrada
 array('return' => 'xsd:string'), // Parametros de salida
 $miURL);
 
function getRespuesta($parametro){
 return new soapval('return', 'xsd:string', 'soy servidor y devuelvo: '.$parametro);
}

// Las siguientes 2 lineas las aporto Ariel Navarrete. Gracias Ariel
if ( !isset( $HTTP_RAW_POST_DATA ) )
    $HTTP_RAW_POST_DATA = file_get_contents( 'php://input' );

$server->service($HTTP_RAW_POST_DATA);
?>

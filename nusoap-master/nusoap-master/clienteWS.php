<?php
// Incluimos la biblioteca de NuSOAP (la misma que hemos incluido en el servidor, ver la ruta que le especificamos)
require_once('src/nusoap.php');
// Crear un cliente apuntando al script del servidor (Creado con WSDL) - 
// Las proximas 3 lineas son de configuracion, y debemos asignarlas a nuestros parametros
$serverURL = 'http://localhost/nusoap-master/';
$serverScript = 'serverWS.php';
$metodoALlamar = 'getRespuesta';

// Crear un cliente de NuSOAP para el WebService
$cliente = new nusoap_client("$serverURL/$serverScript?wsdl");

//$cliente->setEndpoint('http://127.0.0.1/WS/nusoap_server_ej1.php');
//$cliente->soap_defencoding = 'UTF-8';
//$cliente->decode_utf8 = FALSE;
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
 array('parametro' => 'Orlando'), // Parametros pasados a la funcion
 "uri:$serverURL/$serverScript", // namespace
 "uri:$serverURL/$serverScript/$metodoALlamar" // SOAPAction
);
// Verificacion que los parametros estan ok, y si lo estan. mostrar rta.
if ($cliente->fault) {
 echo '<b>Error: ';
 print_r($result);
 var_dump($result);
 echo '</b>';
} else {
 $error = $cliente->getError();
 if ($error) {
 echo '<b style="color: red">Error: ' . $error . '</b>';
 } else {
 echo 'Respuesta: '.$result;
 //var_dump($result);
 }
}

?>

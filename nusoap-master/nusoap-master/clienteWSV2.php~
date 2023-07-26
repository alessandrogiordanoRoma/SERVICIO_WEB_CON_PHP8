<?php
// Incluimos la biblioteca de NuSOAP (la misma que hemos incluido en el servidor, 
//ver la ruta que le especificamos)
require_once('src/nusoap.php');
// Crear un cliente apuntando al script del servidor (Creado con WSDL) - 
// Las proximas 3 lineas son de configuracion, y debemos asignarlas a nuestros parametros
$location = "http://172.16.23.113/WSConsVigGpoFamComXNssService/WSConsVigGpoFamComXNss?WSDL";

$request= '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:vig="http://vigenciaderechos.imss.gob.mx/">
   <soapenv:Header/>
   <soapenv:Body>
      <vig:getInfo>
         <!--Optional:-->
         <nss>2001840792</nss>
         <!--Optional:-->
         <Cpid>62</Cpid>
      </vig:getInfo>
   </soapenv:Body>
</soapenv:Envelope>';

print("Resquest : <br>");
print("<pre>".htmlentities($request)."</pre>");

$action = "getInfo";
$headers = [
    'Method: POST',
    'Connection: Keep-Alive',
    'User-Agent: PHP-SOAP-CURL',
    'Content-Type: text/xml; charset=utf-8',
    'SOAPAction: getInfo',
];

//Segun Documentacion
$ch = curl_init($location);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

$response = curl_exec($ch);
$err_status = curl_errno($ch);

print("Resquest : <br>");
print("<pre>".$response."</pre>");

print_r($response);
echo('<pre>');
var_dump($response);
echo('</pre>');
?>

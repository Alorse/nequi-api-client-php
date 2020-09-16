<?php
/*
 * @description Cliente con las funciones para consumir el API
 * @author michel.lugo@pragma.com.co, jomgarci@bancolombia.com.co
 */
include 'awsSigner.php';

$host = "api.sandbox.nequi.com";  
$channel = 'PQR03-C001';

/**
 * Encapsula el consumo del servicio de validacion de cliente del API y retorna la respuesta del servicio
 */
function validateClient($clientId, $phoneNumber, $value) {
  $servicePath = "/payments/v1/-services-paymentservice-generatecodeqr";
  $body = getBodyValidateClient($GLOBALS['channel'], $clientId, $phoneNumber, $value);
  $response = makeSignedRequest($GLOBALS['host'], $servicePath, 'POST', $body);  
  if(json_decode($response) == null){
    return $response;
  }else{
    return json_decode($response);
  }
}
/**
 * Forma el cuerpo para consumir el servicio de validación de cliente del API
 */
function getBodyValidateClient($channel, $clientId, $phoneNumber, $value){
  $messageId =  substr(strval((new DateTime())->getTimestamp()), 0, 9);
  return array(
    "RequestMessage"  => array(
      "RequestHeader"  => array (
        "Channel" => $channel,
        "RequestDate" => gmdate("Y-m-d\TH:i:s\\Z"),
        "MessageID" => $messageId,
        "ClientID" => $clientId,
        "Destination"=> [
          "ServiceName"=> "PaymentsService",
          "ServiceOperation"=> "generateCodeQR",
          "ServiceRegion"=> "C001",
          "ServiceVersion"=> "1.0.0"
        ]
      ),
      "RequestBody"  => array (
        "any" => array (
          "generateCodeQRRQ" => array (
            "code" => "NIT_2",
            "value" => $value,
            "reference1" => "",
            "reference2" => "",
            "reference3" => "",
            )
        )
      )
    )
  );
}

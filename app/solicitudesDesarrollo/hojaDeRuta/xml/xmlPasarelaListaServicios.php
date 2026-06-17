<?php
header ('content-type: text/xml');

$codigoUnidad = $_POST['codigoUnidad'];
$fecha1       = $_POST['fecha1'];

$curl = curl_init();

//$codigoUnidad = "460";
//$fecha1 = "02-03-2010";

$postfields = "codigoUnidad=".$codigoUnidad."&fecha1=".$fecha1;


curl_setopt($curl, CURLOPT_URL,
	'http://proservipol.carabineros.cl/xml/xmlServicios/xmlListaServicios.php');

//curl_setopt($curl, CURLOPT_HEADER, 0);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($curl, CURLOPT_POST, 1); //por metodo post


curl_setopt($curl, CURLOPT_POSTFIELDS, $postfields);
 //sigue los header("Location:")

curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
$data = curl_exec($curl);

echo $data;

curl_close($curl);
?>
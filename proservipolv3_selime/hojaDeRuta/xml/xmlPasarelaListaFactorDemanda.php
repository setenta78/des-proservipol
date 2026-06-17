<?php
header ('content-type: text/xml');

//$codigoUnidad = $_POST['codigoUnidad'];

$curl = curl_init();

//$codigoUnidad = "460";

$postfields = "";


curl_setopt($curl, CURLOPT_URL,
	'http://proservipol.carabineros.cl/xml/xmlFactorDemanda/xmlListaFactorDemanda.php');

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
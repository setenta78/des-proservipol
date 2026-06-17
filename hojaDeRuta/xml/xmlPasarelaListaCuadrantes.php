<?php
header ('content-type: text/xml');

$codigoUnidad = $_POST['codigoUnidad'];

$curl = curl_init();

//$codigoUnidad = "460";

$postfields = "codigoUnidad=".$codigoUnidad;


curl_setopt($curl, CURLOPT_URL,
	'http://proservipol.carabineros.cl/xml/xmlCuadrantes/xmlListaCuadrantes.php');

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
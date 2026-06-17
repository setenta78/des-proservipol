<?php
header ('content-type: text/xml');

$codigoPadre = $_POST['codigoPadre'];

$curl = curl_init();

//$codigoPadre = "0";

$postfields = "codigoPadre=".$codigoPadre;


curl_setopt($curl, CURLOPT_URL,
	'http://proservipol.carabineros.cl/hojaDeRuta/xml/xmlArbolUnidad.php');

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
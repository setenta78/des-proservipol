<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbArmas.class.php");
	require("../../objetos/arma.class.php");
		
	$serieArma = $_POST['serieArma'];
		
	//$serieArma = "1234567";
		
	$objArmas = new dbArmas;
	$objArmas->buscaDatosArmaPorSerie($serieArma, &$arma);
	$cantidad = count($arma);
	if ($cantidad > 0){
		echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
		echo "<root>";
		echo "<arma>";
	   	echo "<codigo>".$arma->getCodigo()."</codigo>";
		echo "</arma>";
		echo "</root>";
	} else {
		echo "VACIO";
	}
 ?>
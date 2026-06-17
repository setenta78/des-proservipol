<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
	require("../../baseDatos/dbArmas.class.php");
	require("../../objetos/arma.class.php");
				
	$codigoArma	= $_POST['codigoArma'];
	
	$arma = new arma;
	$arma->setCodigo($codigoArma);
	
	$objDBArmas = new dbArmas;
	$resultado = $objDBArmas->dejarDisponible($arma, $fecha);
	//$resultado = 1;
			
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
?>
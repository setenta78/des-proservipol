<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbLicenciaMedica.class.php");
	require("../../objetos/unidad.class.php");
	
	session_start();
	$codigoUnidad		= $_SESSION['USUARIO_CODIGOUNIDAD'];
	$objLicencia = new dbLicencia;
	$objLicencia->reparticionCodigo($codigoUnidad, &$unidades);
	
	$cantidad = count($unidades);
  if ($cantidad > 0){
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i < $cantidad; $i++){
   		echo "<unidad>";
   			echo "<codigo>".$unidades[$i]->getCodigoUnidad()."</codigo>";
	 		echo "</unidad>";
		}
		echo "</root>";
	} else {
		echo "VACIO";
	}
?>
<?
	header ('content-type: text/xml');
	include("../configuracionBDPersonalFicha.php"); 
	require("../../baseDatos/dbLicenciaMedica.class.php");
	require("../../objetos/unidad.class.php");
	
	$codigoUnidad	= $_POST['codigoUnidad'];
	$objLicencia = new dbLicencia;
	$objLicencia->reparticionDescripcion($codigoUnidad, &$unidades);
	$cantidad = count($unidades);
	
	if ($cantidad > 0){
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i < $cantidad; $i++){
	   	echo "<unidad>";
	   		echo "<descripcion>".$unidades[$i]->getDescripcionUnidad()."</descripcion>";
		 	echo "</unidad>";
 		}
		echo "</root>";
	} else {
		echo "VACIO";
	}
?>
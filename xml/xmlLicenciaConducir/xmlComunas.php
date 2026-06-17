<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 	
	require("../../baseDatos/dbComunas.class.php");
	require("../../objetos/comuna.class.php");
	
	//$codigoRegion = $_POST['codigoClase'];
	//$claseOrganizacion = 0;
	
	$objDbComunas = new dbComunas;
	$objDbComunas->listarComunas($region, &$comunas);
	$cantidad = count($comunas);
	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<codigoComuna>".$comunas[$i]->getCodigoComuna()."</codigoComuna>";
   		echo "<descripcionComuna>".$comunas[$i]->getDescripcionComuna()."</descripcionComuna>";
 	}
	echo "</root>";
 ?>
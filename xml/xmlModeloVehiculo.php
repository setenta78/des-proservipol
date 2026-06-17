<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbModeloVehiculo.class.php");
	require("../../objetos/modeloVehiculo.class.php");
	require("../../objetos/marcaVehiculo.class.php");

	$marca = $_POST["marca"];
	
	//$marca = "003";
		
	$objModelo = new dbModeloVehiculo;
	$objModelo->listaModelosVehiculos($marca, &$modelos);
	$cantidad = count($modelos);
	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<modelo>";
   		echo "<codigoMarca>".$modelos[$i]->getMarca()->getCodigo()."</codigoMarca>";
   		echo "<descripcionMarca>".$modelos[$i]->getMarca()->getDescripcion()."</descripcionMarca>";
   		echo "<codigoModelo>".$modelos[$i]->getCodigo()."</codigoModelo>";
   		echo "<descripcionModelo>".$modelos[$i]->getDescripcion()."</descripcionModelo>";
	 	echo "</modelo>";
 	}
	echo "</root>";
 ?>
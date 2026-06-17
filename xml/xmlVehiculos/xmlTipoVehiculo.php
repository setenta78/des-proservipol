<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbTipoVehiculo.class.php");
	require("../../objetos/tipoVehiculo.class.php");
		
	$objTipo = new dbTipoVehiculo;
	$objTipo->listaTipoVehiculos(&$tipos);
	$cantidad = count($tipos);
	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<tipo>";
   		echo "<codigo>".$tipos[$i]->getCodigo()."</codigo>";
   		echo "<descripcion>".$tipos[$i]->getDescripcion()."</descripcion>";
	 	echo "</tipo>";
 	}
	echo "</root>";
 ?>
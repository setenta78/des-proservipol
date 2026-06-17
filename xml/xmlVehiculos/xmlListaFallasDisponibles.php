<?
	header ('content-type: text/xml');
  include("../configuracionBD4.php"); 
	require("../../baseDatos/dbFallaVehiculo.class.php");
	require("../../objetos/fallaVehiculo.class.php");
	
	$objFalla = new dbFallaVehiculo;
	$objFalla->listaFallaVehiculo(&$fallas);
	$cantidad = count($fallas);
	
  echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  echo "<root>";
  for ($i=0; $i<$cantidad; $i++){
  	echo "<falla>";
  	echo "<codigo>".$fallas[$i]->getCodigo()."</codigo>";
  	echo "<descripcion>".$fallas[$i]->getDescripcion()."</descripcion>";
	 	echo "</falla>";
 	}
	echo "</root>";
?>
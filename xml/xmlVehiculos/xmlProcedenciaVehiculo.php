<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbProcedenciaVehiculo.class.php");
	require("../../objetos/procedenciaVehiculo.class.php");
		
	$objProcedencia = new dbProcedenciaVehiculo;
	$objProcedencia->listaProcedimientoVehiculos(&$procedencias);
	$cantidad = count($procedencias);
	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<procedencia>";
   		echo "<codigo>".$procedencias[$i]->getCodigo()."</codigo>";
   		echo "<descripcion>".$procedencias[$i]->getDescripcion()."</descripcion>";
	 	echo "</procedencia>";
 	}
	echo "</root>";
 ?>
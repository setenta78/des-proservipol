<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbVehiculos.class.php");
	require("../../objetos/vehiculoEstadoHistorico.class.php");
	require("../../objetos/estadoVehiculo.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/vehiculo.class.php");

	$vehiculoId = $_POST['vehiculoId'];
	//$vehiculoId = 15906;
	
			
	$objEstadoHistorico = new dbVehiculos;
	$objEstadoHistorico->listaEstadoHistoricoVehiculo($vehiculoId, &$listaHistoricoEstados);
	$cantidad = count($listaHistoricoEstados);
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		
   		$fechaPaso 		= explode("-",$listaHistoricoEstados[$i]->getFecha());
   		$fechaMostrar   = $fechaPaso[2] . "/" . $fechaPaso[1] . "/" . $fechaPaso[0];
   		
   		echo "<estadoHistorico>";
   		echo "<fecha>".$fechaMostrar."</fecha>";
   		echo "<unidad>".$listaHistoricoEstados[$i]->getUnidad()->getDescripcionUnidad()."</unidad>";
   		echo "<estado>".$listaHistoricoEstados[$i]->getEstado()->getDescripcion()."</estado>";
	 	echo "</estadoHistorico>";
 	}
	echo "</root>";
 ?>
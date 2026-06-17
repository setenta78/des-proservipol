<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
	require("../../baseDatos/dbVehiculos.class.php");
	require("../../objetos/vehiculo.class.php");
	require("../../objetos/tipoVehiculo.class.php");
	require("../../objetos/marcaVehiculo.class.php");
	require("../../objetos/modeloVehiculo.class.php");
	require("../../objetos/procedenciaVehiculo.class.php");
	require("../../objetos/estadoVehiculo.class.php");
		
	$unidad 	  	= $_POST['codigoUnidad'];
	$vehiculoBuscar = $_POST['vehiculoBuscar'];
	
	//$sentidoOrden 	= $_POST['codigoUnidad'];
	//$camporOrden  	= $_POST['codigoUnidad'];
	$tipoEstado	  	= "0,1,4";
	
	$unidad = "2960"; 
		
	$objVehiculos = new dbVehiculos;
	$objVehiculos->listaTotalVehiculos($unidad, $vehiculoBuscar, $camporOrden, $sentidoOrden, $tipoEstado, &$vehiculos);
	$cantidad = count($vehiculos);
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<vehiculo>";
   		echo "<codigo>".$vehiculos[$i]->getCodigoVehiculo()."</codigo>";
   		echo "<tipo>".$vehiculos[$i]->getTipoVehiculo()->getDescripcion()."</tipo>";
   		echo "<marca>".$vehiculos[$i]->getModeloVehiculo()->getMarca()->getDescripcion()."</marca>";
   		echo "<modelo>".$vehiculos[$i]->getModeloVehiculo()->getDescripcion()."</modelo>";
   		echo "<estado>".$vehiculos[$i]->getEstadoVehiculo()->getDescripcion()."</estado>";
   		echo "<patente>".$vehiculos[$i]->getPatente()."</patente>";
   		echo "<numeroInstitucional>".$vehiculos[$i]->getNumeroInstitucional()."</numeroInstitucional>";
   		echo "<bcu>".$vehiculos[$i]->getNumeroBCU()."</bcu>";
   		echo "<procedencia>".$vehiculos[$i]->getProcedencia()->getDescripcion()."</procedencia>";
	 	echo "</vehiculo>";
 	}
	echo "</root>";
 ?>
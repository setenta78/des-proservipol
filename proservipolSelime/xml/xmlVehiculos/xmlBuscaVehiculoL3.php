<?
	header ('content-type: text/xml');
	include("../configuracionBDL3.php"); 
	require("../../baseDatos/dbVehiculos.class.php");
	require("../../objetos/vehiculo.class.php");
	require("../../objetos/tipoVehiculo.class.php");
	require("../../objetos/marcaVehiculo.class.php");
	require("../../objetos/modeloVehiculo.class.php");
	require("../../objetos/procedenciaVehiculo.class.php");
	require("../../objetos/unidad.class.php");
		
	$bcuVehiculo  = $_POST['codigoVehiculo'];
	
	//$bcuVehiculo = "04010106589";
		
	$objVehiculos = new dbVehiculos;
	$objVehiculos->buscaVehiculoL3($bcuVehiculo, &$vehiculo);
	
	$cantidad = count($vehiculo);
	if ($cantidad > 0){    
		echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
		echo "<root>";
		echo "<vehiculo>";
	   	echo "<tipo>".$vehiculo->getTipoVehiculo()->getCodigo()."</tipo>";
	   	echo "<marca>".$vehiculo->getModeloVehiculo()->getMarca()->getCodigo()."</marca>";
	   	echo "<modelo>".$vehiculo->getModeloVehiculo()->getCodigo()."</modelo>";
	   	echo "<patente>".$vehiculo->getPatente()."</patente>";
	   	echo "<numeroInstitucional>".$vehiculo->getNumeroInstitucional()."</numeroInstitucional>";
	   	echo "<numeroBCU>".$vehiculo->getNumeroBCU()."</numeroBCU>";
	   	echo "<procedencia>".$vehiculo->getProcedencia()->getCodigo()."</procedencia>";
	   	echo "<fabricacion>".$vehiculo->getAnnoFabricacion()."</fabricacion>";
	   	echo "</vehiculo>";
		echo "</root>";
	} else {
		echo "VACIO";
	}
 ?>
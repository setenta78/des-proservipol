<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbVehiculos.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/tipoVehiculo.class.php");
	require("../../objetos/vehiculosUnidad.class.php");
				
	$unidad 		= $_POST['codigoUnidad'];
	$fecha1 		= $_POST['fecha1'];
	$tipoVehiculo	= $_POST['tipoVehiculo'];
	$tipoUnidad 	= $_POST['tipoUnidad'];
	$inicio 		= $_POST['inicio'];  

	//$unidad 		= 2340;
	////////$fecha1 	= "22-01-2010";
	//$tipoVehiculo 	= "430";
	//$tipoUnidad 	= "destacamento";
	//$inicio 		= "1";
		
	$fechaPaso 		= explode("-",$fecha1);
   	$fechaBuscar1   = $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];
	
	$objVehiculos = new dbVehiculos;
	$objVehiculos->listaCantidadVehiculos($unidad, $tipoUnidad, $tipoVehiculo, $fechaBuscar1, $inicio, &$vehiculosUnidad);
	$cantidad = count($vehiculosUnidad);
	if ($vehiculosUnidad != ""){		
	  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	  	echo "<root>";
	   	for ($i=0; $i<$cantidad; $i++){
	   		echo "<vehiculos>";
	   		echo "<codUnidad>".$vehiculosUnidad[$i]->getUnidad()->getCodigoUnidad()."</codUnidad>";
	   		echo "<desUnidad>".$vehiculosUnidad[$i]->getUnidad()->getDescripcionUnidad()."</desUnidad>";
	   		echo "<codTipoVehiculo>".$vehiculosUnidad[$i]->getTipoVehiculo()->getCodigo()."</codTipoVehiculo>";
	   		echo "<desTipoVehiculo>".$vehiculosUnidad[$i]->getTipoVehiculo()->getDescripcion()."</desTipoVehiculo>";
	   		echo "<cantidadVehiculos>".$vehiculosUnidad[$i]->getCantidadVehiculos()."</cantidadVehiculos>";
	   		echo "<cantidadActivos>".$vehiculosUnidad[$i]->getCantidadActivos()."</cantidadActivos>";
	   		echo "<cantidadMantencion>".$vehiculosUnidad[$i]->getCantidadMantencion()."</cantidadMantencion>";
	   		echo "<cantidadReparacion>".$vehiculosUnidad[$i]->getCantidadReparacion()."</cantidadReparacion>";
	   		echo "<cantidadProcesoBaja>".$vehiculosUnidad[$i]->getCantidadProcesoBaja()."</cantidadProcesoBaja>";
	   		echo "<cantidadTribunal>".$vehiculosUnidad[$i]->getCantidadTribunal()."</cantidadTribunal>";
	   		echo "</vehiculos>";
	 	}
		echo "</root>";
	} else {
		echo "VACIO";
	}
?>
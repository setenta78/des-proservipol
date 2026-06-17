<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbVehiculos.class.php");
	require("../../objetos/vehiculo.class.php");
	require("../../objetos/tipoVehiculo.class.php");
	require("../../objetos/marcaVehiculo.class.php");
	require("../../objetos/modeloVehiculo.class.php");
	require("../../objetos/procedenciaVehiculo.class.php");
	require("../../objetos/estadoVehiculo.class.php");
	
	$unidad 	  	= $_POST['codigoUnidad'];
	$fechaServicio  = $_POST['fechaServicio'];
	$tipoServicio   = $_POST['tipoServicio'];
	$correlativo	= $_POST['correlativo'];
	$horaInicio		= $_POST['horaInicio'];
	$horaTermino	= $_POST['horaTermino'];
	
	$fechaPaso 		= explode("-",$fechaServicio);
	$fechaBuscar  	= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	
	if($horaInicio >= $horaTermino)	$horaTermino = "24:00";
	
	$objVehiculos = new dbVehiculos;
	$objVehiculos->listaVehiculosDisponibles($unidad, $fechaBuscar, $tipoServicio, $horaInicio, $horaTermino, $correlativo, &$vehiculos);
	$cantidad = count($vehiculos);
	if ($cantidad > 0){
	  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	  	echo "<root>";
	   	for ($i=0; $i<$cantidad; $i++){
	   		if($vehiculos[$i]->getUltimoKilometraje() == ""){
	   			$kmFinal = 0;
	   		}
	   		else{
	   			$kmFinal = $vehiculos[$i]->getUltimoKilometraje();
	   		}
	   		echo "<vehiculo>";
	   		echo "<codigo>".$vehiculos[$i]->getCodigoVehiculo()."</codigo>";
	   		echo "<tipo>".$vehiculos[$i]->getTipoVehiculo()->getDescripcion()."</tipo>";
	   		echo "<patente>".$vehiculos[$i]->getPatente()."</patente>";
	   		echo "<kmFinal>".$kmFinal."</kmFinal>";
			echo "<indicaKm>".$vehiculos[$i]->getTipoVehiculo()->getIndicaKM()."</indicaKm>";
	   		echo "<numeroInstitucional>".$vehiculos[$i]->getNumeroInstitucional()."</numeroInstitucional>";
	   		echo "</vehiculo>";
	 	}
		echo "</root>";
	} else {
		echo "SIN DATOS";
	}
?>
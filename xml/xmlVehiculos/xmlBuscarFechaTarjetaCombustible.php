<?
	header ('content-type: text/xml');
	include("../configuracionBD4Mysqli.php");
	require("../../baseDatos/dbVehiculos.class.php");
	require("../../objetos/tarjetaCombustible.class.php");

	$codigoVehiculo	= $_POST['codigoVehiculo'];
	$fecha			= $_POST['fecha'];
	
	$fechaPaso		= explode("-",$fecha);
	$fechaDesde		= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	
	$tarjetaCombustible = new tarjetaCombustible;
	$tarjetaCombustible->setCodigoVehiculo($codigoVehiculo);
	$tarjetaCombustible->setFechaDesde($fechaDesde);
	
	$objDBVehiculos = new dbVehiculos;
	$resultado = $objDBVehiculos->buscarFechaTarjetaCombustible($tarjetaCombustible);
	if($resultado){
		echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
		echo "<root>";
		echo "<resultado>".$resultado."</resultado>";
		echo "</root>";
	}
	else{
		echo "";
	}
?>
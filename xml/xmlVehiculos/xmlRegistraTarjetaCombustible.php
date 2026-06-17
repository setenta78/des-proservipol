<?
	header ('content-type: text/xml');
	include("../configuracionBD4Mysqli.php");
	require("../../baseDatos/dbVehiculos.class.php");
	require("../../objetos/tarjetaCombustible.class.php");
	
	$codigoVehiculo	= $_POST['codigoVehiculo'];
	$nroTarjeta		= $_POST['nroTarjeta'];
	$nroTarjetaDV	= $_POST['nroTarjetaDV'];
	$fecha			= $_POST['fecha'];
	$archivo		= $_POST['archivo'];
	$validado		= $_POST['validado'];
	$codFuncionario	= $_POST['codFuncionario'];
	
	$fechaPaso		= explode("-",$fecha);
	$fechaDesde		= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	
	$tarjetaCombustible = new tarjetaCombustible;
	$tarjetaCombustible->setCodigoVehiculo($codigoVehiculo);
	$tarjetaCombustible->setNroTarjeta($nroTarjeta);
	$tarjetaCombustible->setNroTarjetaDV($nroTarjetaDV);
	$tarjetaCombustible->setFechaDesde($fechaDesde);
	$tarjetaCombustible->setArchivo($archivo);
	$tarjetaCombustible->setValidado($validado);
	$tarjetaCombustible->setCodFuncionarioRegistra($codFuncionario);
	
	$objDBVehiculos = new dbVehiculos;
	$resultado = $objDBVehiculos->registrarTarjetaCombustible($tarjetaCombustible);
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
	echo "<resultado>".$resultado."</resultado>";
	echo "</root>";
?>
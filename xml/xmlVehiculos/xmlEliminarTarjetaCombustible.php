<?
	header ('content-type: text/xml');
	include("../configuracionBD4Mysqli.php");
	require("../../baseDatos/dbVehiculos.class.php");
	require("../../objetos/tarjetaCombustible.class.php");
	
	$codigoVehiculo	= $_POST['codigoVehiculo'];
	$nroTarjeta		= $_POST['nroTarjeta'];
	$nroTarjetaDV	= $_POST['nroTarjetaDV'];
	
	$tarjetaCombustible = new tarjetaCombustible;
	$tarjetaCombustible->setCodigoVehiculo($codigoVehiculo);
	$tarjetaCombustible->setNroTarjeta($nroTarjeta);
	$tarjetaCombustible->setNroTarjetaDV($nroTarjetaDV);

	$objDBVehiculos = new dbVehiculos;
	$resultado = $objDBVehiculos->eliminarTarjetaCombustible($tarjetaCombustible);
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
	echo "<resultado>".$resultado."</resultado>";
	echo "</root>";
?>
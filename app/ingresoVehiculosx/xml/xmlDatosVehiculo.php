<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
	require("../db/dbVehiculos.class.php");
	$bcuVehiculo 	= $_POST['bcuVehiculo'];
	$objVehiculos = new dbVehiculos;
	$objVehiculos->buscaDatosVehiculo($bcuVehiculo, &$cantidad);
	if ($cantidad > 0){
		echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
		echo "<root>";
		echo "<cantidad>".$cantidad."</cantidad>";
		echo "</root>";
	} else {
		echo "VACIO";
	}
?>
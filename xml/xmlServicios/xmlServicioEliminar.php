<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbServicios.class.php");
	require("../../objetos/servicio.class.php");
	require("../../objetos/unidad.class.php");
		
	$codUnidad 				= $_POST['codigoUnidad'];
	$correlativo			= $_POST['correlativo'];
	
	$unidad = new unidad;
	$unidad->setCodigoUnidad($codUnidad);
	
	$servicio = new servicio;
	$servicio->setUnidad($unidad);
	$servicio->setCorrelativo($correlativo);
	
	$objDBServicios = new dbServicios;
	$resultado = $objDBServicios->deleteServicio($servicio);
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
	
 ?>
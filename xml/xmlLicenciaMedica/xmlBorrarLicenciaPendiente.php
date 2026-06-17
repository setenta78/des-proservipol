<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbLicenciaMedica.class.php");
	require("../../objetos/licenciaMedica.class.php");
	require("../../objetos/servicio.class.php");
	require("../../objetos/unidad.class.php");
	
	$correlativo 	= $_POST['correlativo'];
	$unidad 			= $_POST['unidad'];
	$funcionario	= $_POST['funcionario'];
	
	$correlativos = explode(",", $correlativo);
	$unidades			= explode(",", $unidad);
	
	$servicio = new licenciaMedica;
	$servicio->setUnidad($unidades);
	$servicio->setCodigoFuncionario($funcionario);
	$servicio->setCorrelativo($correlativos);
	
	$objDBservicios = new dbLicencia;
	$resultado = $objDBservicios->BorrarLicenciaPendiente($servicio);
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  echo "<root>";
  echo "<resultado>".$resultado."</resultado>";
  echo "</root>"; 
?>
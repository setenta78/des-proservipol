<?
	header ('content-type: text/xml');
	include("configuracionBD2.php");
	require("../db/dbFechas.class.php");
	require("../objetos/fecha.class.php");
	
	$codigo			= $_POST['codigoFuncionario'];
	$correlativo	= $_POST['correlativo'];
	$fechaAux		= explode("-",$_POST['fechaDesde']);
	$fechaDesde 	= $fechaAux[2] . "-" . $fechaAux[1] . "-" . $fechaAux[0];
	
	$fecha = new Fecha;
	$fecha->setCodigoFuncionario($codigo);
	$fecha->setFechaD($fechaDesde);
	$fecha->setCorrelativo($correlativo);
	$fecha->setCargo("");
	$fecha->setUnidad("");
	$fecha->setDias("");
	
	$objDFechas = new dbFechas;
	$resultado = $objDFechas->deleteFecha($fecha);
	$fecha->setCorrelativo($correlativo-1);
	$resultado = $objDFechas->updateFecha($fecha);
	$resultado = $objDFechas->updateUnidad($fecha);
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
	echo "<resultado>".$resultado."</resultado>";
	echo "</root>";
?>
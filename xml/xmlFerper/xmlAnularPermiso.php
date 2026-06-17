<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbFerper.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/escalafon.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/cargo.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/ferper.class.php");
  require("../../objetos/servicio.class.php");
	require("../../objetos/tipoServicio.class.php");
	require("../../objetos/tipoServicioExtraordinario.class.php");
	
	session_start();
	$accion 					= $_POST['accion'];
	
	$codFun	= $_POST['codigoFuncionario'];
	$rut 		= $_POST['rut'];
	$folio 	= $_POST['folio'];
	$dias		= $_POST['dias'];
	$unidad	=	$_POST['unidadFuncionario'];
	$estado	= $_POST['estado'];
	$listaCorrelativo	= $_POST['correlativo'];
	
	$funcionario = new ferper;
	$funcionario->setCodigoFuncionario($codFun);
	$funcionario->setFolio($folio);
	$funcionario->setRutFuncionario($rut);
	$funcionario->setUnidad($unidad);
	$funcionario->setCorrelativo($listaCorrelativo);
	$funcionario->setEstadoPermiso($estado);
	
	$objDBFuncionarios = new dbFerper;
	$resultado = $objDBFuncionarios->AnularPermiso($funcionario);
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  echo "<root>";
  echo "<resultado>".$resultado."</resultado>";
  echo "</root>";
?>
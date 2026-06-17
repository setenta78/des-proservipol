<?
	header ('content-type: text/xml');
	include("../../inc/configV4.inc.php");
	include("../../baseDatos/Conexion.class.php");
	include("../baseDatos/dbCertificacion.php");
	
	$unidad         	= $_POST['unidad'];
	$codFuncionario		= $_POST['codFuncionario'];
	$funValida			= $_POST['funValida'];
	$ip					= $_POST['ip'];
	$motivo				= $_POST['motivo'];
	$horaVal			= $_POST['horaVal'];
	$fechaServicios		= explode("-",$_POST['fechaServ']);
	$fechaServ			= $fechaServicios[2]."-".$fechaServicios[1]."-".$fechaServicios[0];
	$fechaValidacion	= explode("-",$_POST['fechaVal']);
	$fechaVal			= $fechaValidacion[2]."-".$fechaValidacion[1]."-".$fechaValidacion[0];
	
	$objDBCertificacion	= new dbCertificacion;
	$resultado 			= $objDBCertificacion->desvalidar($unidad, $codFuncionario, $fechaServ, $fechaVal, $horaVal, $motivo, $funValida, $ip);
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
	echo "<resultado>".$resultado."</resultado>";
	echo "</root>";

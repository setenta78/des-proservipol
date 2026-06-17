<?
	header ('content-type: text/xml');
	include("../../inc/configV4.inc.php");
	include("../../baseDatos/Conexion.class.php");
	include("../baseDatos/dbCertificacion.php");
	
	$unidad         = $_POST['unidad'];
	$codFuncionario = $_POST['codFuncionario'];
	$fechaServicios = explode("-",$_POST['fecha']);
	$fecha 					= $fechaServicios[2]."-".$fechaServicios[1]."-".$fechaServicios[0];
	
	$objDBCertificacion	= new dbCertificacion;
	$resultado 					= $objDBCertificacion->validar($unidad, $codFuncionario, $fecha, $ip);
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
	echo "<resultado>".$resultado."</resultado>";
	echo "</root>";

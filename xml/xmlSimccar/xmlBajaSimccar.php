<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbSimccar.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/simccar.class.php");
	require("../../objetos/estadoRecurso.class.php");
	
	session_start();
	$codigoUnidad = $_SESSION['USUARIO_CODIGOUNIDAD'];
	$codigoSimccar	= $_POST['codigoSimccar'];
	$fechaActual	= $_POST['fechaMovimiento'];
	
	$fechaPaso 			= explode("-",$fechaActual);
	$fechaMovimiento = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	
	$unidad = new unidad;
	$unidad->setCodigoUnidad($codigoUnidad);
	$unidad->setDescripcionUnidad("");
	
	$estado = new estadoRecurso;
	$estado->setCodigo('100');
	$estado->setDescripcion("BAJA");
	
	$simccar = new simccar;
	$simccar->setCodigoSimccar($codigoSimccar);
	$simccar->setEstadoSimccar($estado);
	$simccar->setUnidad($unidad);
	
	$objDBSimccar = new dbSimccar;
	$resultado = $objDBSimccar->updateEstadoSimmcar($simccar, $fechaMovimiento);
	$resultado = $objDBSimccar->bajaSimccar($simccar, $motivo, $fechaMovimiento);
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  echo "<root>";
  echo "<resultado>".$resultado."</resultado>";
  echo "</root>";
?>
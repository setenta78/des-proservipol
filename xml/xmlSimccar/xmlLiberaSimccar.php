<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbSimccar.class.php");
	require("../../objetos/simccar.class.php");
	require("../../objetos/seccion.class.php");
	require("../../objetos/estadoRecurso.class.php");	
	require("../../objetos/unidad.class.php");	
	
	session_start();
	$codigoUnidad	= $_SESSION['USUARIO_CODIGOUNIDAD'];
	$codigoSimccar	= $_POST['codigoSimccar'];
	$fechaActual	= $_POST['fechaMovimiento'];
	$reemplazo       = "";
	
	$fechaPaso 			= explode("-",$fechaActual);
	$fechaMovimiento  	= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	
	$estado = new estadoRecurso;
	$estado->setCodigo(3500);
	$estado->setDescripcion("");
	$estado->setReemplazo($reemplazo);
	
	$unidad = new unidad;
	$unidad->setCodigoUnidad($codigoUnidad);
	$unidad->setDescripcionUnidad("");
	
  $seccion = new seccion;
	$seccion->setCodigo("");
	$seccion->setDescripcion("");
	
	$unidadAgregado = new unidad;
	$unidadAgregado->setCodigoUnidad($codigoUnidadAgregado);
	$unidadAgregado->setDescripcionUnidad("");
	
	$simccar = new simccar;
	$simccar->setCodigoSimccar($codigoSimccar);
	$simccar->setEstadoSimccar($estado);
	$simccar->setUnidad($unidad);
	$simccar->setUnidadAgregado($unidadAgregado);
	$simccar->setReemplazoSimccar($estado);
	$simccar->setSeccion($seccion);
	
	$objDBSimccar = new dbSimccar;
	$resultado = $objDBSimccar->dejarDisponible($simccar, $fechaMovimiento);
	$resultado = $objDBSimccar->updateEstadoSimccar($simccar, $fechaMovimiento);
	$resultado = $objDBSimccar->insertEstadoSimccar($simccar, $fechaMovimiento);
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
 	echo "<root>";
  echo "<resultado>".$resultado."</resultado>";
 	echo "</root>";
?>
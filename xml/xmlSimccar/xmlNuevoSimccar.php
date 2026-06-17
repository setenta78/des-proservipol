<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbSimccar.class.php");
	require("../../objetos/simccar.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/estadoRecurso.class.php");
  require("../../objetos/seccion.class.php");
	
	session_start();
  $codigoSimccar				= $_POST['codigoSimccar'];
	$unidadUsuario				= $_POST['unidadUsuario'];
  $codigoUsuario				= $_POST['codigoUsuario'];
  $mes									= $_POST['mes'];
  $fecha 								= $_POST['fecha'];
  $codigoEstado	  			= $_POST['estado'];
  $fechaNuevoEstado	  	= $_POST['fechaNuevoEstado'];
  $codigoUnidadAgregado	= $_POST['codigoUnidadAgregado'];
  $codigo								= $_POST['codigo'];
  $codigoSecccion				= $_POST['seccion'];
  
  $unidad = new unidad;
	$unidad->setCodigoUnidad($unidadUsuario);
	$unidad->setDescripcionUnidad("");
	
	$unidadAgregado = new unidad;
	$unidadAgregado->setCodigoUnidad($codigoUnidadAgregado);
	$unidadAgregado->setDescripcionUnidad("");
 	
	$estado = new estadoRecurso;
	$estado->setCodigo($codigoEstado);
	$estado->setDescripcion("");
 	
  $seccion = new seccion;
	$seccion->setCodigo($codigoSecccion);
	$seccion->setDescripcion("");
	
	$simccar= new simccar;
	$simccar->setCodigoSimccar($codigoSimccar);
  $simccar->setSerieSimccar($codigoUsuario);
  $simccar->setTarjetaSimccar($mes);
  $simccar->setImei($fecha);
  $simccar->setEstadoSimccar($estado);
	$simccar->setUnidad($unidad);
	$simccar->setUnidadAgregado($unidadAgregado);
	$simccar->setSeccion($seccion);
	
	$objDBSimccar = new dbSimccar;
	$idNuevo = $objDBSimccar->nuevoSimccar($simccar);
	$simccar->setCodigoSimccar($idNuevo);
	
	if ($fechaNuevoEstado != ""){
		$fechaPaso 		= explode("-",$fechaNuevoEstado);
   	$fechaIngresar  = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
		$resultado = $objDBSimccar->insertEstadoSimccar($simccar, $fechaIngresar);
	}
					
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  echo "<root>";
  echo "<resultado>".$resultado."</resultado>";
  echo "</root>";
?>
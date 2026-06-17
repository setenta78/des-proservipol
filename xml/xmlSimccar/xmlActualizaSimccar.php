<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbSimccar.class.php");
	require("../../objetos/simccar.class.php");
	require("../../objetos/estadoRecurso.class.php");
	require("../../objetos/unidad.class.php");
  require("../../objetos/seccion.class.php");
	
	$codigo								= $_POST['codigo'];	
	$codigoEstado	  			= $_POST['estado'];
  $fechaNuevoEstado	  	= $_POST['fechaNuevoEstado'];
	$numeroBCU						= $_POST['numeroBCU'];
	$codigoUnidadAgregado	= $_POST['codigoUnidadAgregado'];
  $verificar     				= $_POST['verificar'];
	$verificaOculto 			= $_POST['verificaOculto'];
	$origen        				= $_POST['origen'];
	$reemplazo       			= $_POST['reemplazo'];
	$tarjeta							= $_POST['tarjeta'];
	$imei									= $_POST['imei'];
	$marca								= $_POST['marca'];
	$modelo								= $_POST['modelo'];
	$anno									= $_POST['anno'];
  $codigoSecccion				= $_POST['seccion'];
	
	session_start();
	$codigoUnidad = $_SESSION['USUARIO_CODIGOUNIDAD'];
  
	$unidad = new unidad;
	$unidad->setCodigoUnidad($codigoUnidad);
	$unidad->setDescripcionUnidad("");
	
	$unidadAgregado = new unidad;
	$unidadAgregado->setCodigoUnidad($codigoUnidadAgregado);
	$unidadAgregado->setDescripcionUnidad("");
	
	$estado = new estadoRecurso;
	$estado->setCodigo($codigoEstado);
	$estado->setReemplazo($reemplazo);
	$estado->setDescripcion("");
 	
  $seccion = new seccion;
	$seccion->setCodigo($codigoSecccion);
	$seccion->setDescripcion("");
		
	$simccar = new simccar;
	$simccar->setCodigoSimccar($codigo);
	$simccar->setEstadoSimccar($estado);
	$simccar->setUnidad($unidad);
	$simccar->setUnidadAgregado($unidadAgregado);
	$simccar->setOrigen($origen);
	$simccar->setVerifica($verificar);
	$simccar->setTarjetaSimccar($tarjeta);
	$simccar->setImei($imei);
	$simccar->setMarca(STRTOUPPER($marca));
	$simccar->setModelo(STRTOUPPER($modelo));
	$simccar->setAnno($anno);
	$simccar->setReemplazoSimccar($estado);
	$simccar->setSeccion($seccion);
	
	$objDBSimccar = new dbSimccar;
	$resultado = $objDBSimccar->updateSimccar($simccar);
	
	if ($fechaNuevoEstado != ""){
		$fechaPaso 		= explode("-",$fechaNuevoEstado);
   	$fechaIngresar  = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
		$resultado = $objDBSimccar->updateEstadoSimccar($simccar, $fechaIngresar);
		$resultado = $objDBSimccar->insertEstadoSimccar($simccar, $fechaIngresar);
		$resultado = $objDBSimccar->updateSimccar($simccar);
	}elseif($fechaNuevoEstado == "" || $verificaOculto == "NO"){
		$resultado = $objDBSimccar->updateSimccar($simccar);
		$resultado = $objDBSimccar->updateEstadoSimccar($simccar, "");
	}
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  echo "<root>";
  echo "<resultado>".$resultado."</resultado>";
  echo "</root>";
?>
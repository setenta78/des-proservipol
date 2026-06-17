<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbSimccar.class.php");
	require("../../objetos/simccar.class.php");
	require("../../objetos/estadoRecurso.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/tipoAnimal.class.php");
  require("../../objetos/seccion.class.php");
	
	session_start();
	$codigoUnidad			= $_SESSION['USUARIO_CODIGOUNIDAD'];
	$codigo2		= $_POST['codigo2'];
	
	$codigoEstado2	  		= $_POST['estado2'];
  $fechaNuevoEstado2	  	= $_POST['fechaNuevoEstado2'];
	
	$numeroBCU2				= $_POST['numeroBCU2'];
	$codigoUnidadAgregado	= $_POST['codigoUnidadAgregado'];
	
  $verificar     = $_POST['verificar'];
	$verificaOculto = $_POST['verificaOculto'];
	$origen        = $_POST['origen'];
  $codigoSecccion				= $_POST['seccion'];
	
	$reemplazo       = "";
	$tarjeta2=$_POST['tarjeta2'];
	$imei2=$_POST['imei2'];
	$marca2=$_POST['marca2'];
	$modelo2=$_POST['modelo2'];
	$anno2=$_POST['anno2'];
  $codigoUnidad			= $_SESSION['USUARIO_CODIGOUNIDAD'];
  
	$unidad = new unidad;
	$unidad->setCodigoUnidad($codigoUnidad);
	$unidad->setDescripcionUnidad("");
	
	$unidadAgregado = new unidad;
	$unidadAgregado->setCodigoUnidad($codigoUnidadAgregado);
	$unidadAgregado->setDescripcionUnidad("");
  
	$estado = new estadoRecurso;
	$estado->setCodigo($codigoEstado2);
	$estado->setDescripcion("");
	$estado->setReemplazo($reemplazo);
	
  $seccion = new seccion;
	$seccion->setCodigo($codigoSecccion);
	$seccion->setDescripcion("");
	
	$simccar = new simccar;
	$simccar->setCodigoSimccar($codigo2);
	$simccar->setEstadoSimccar($estado);
	$simccar->setUnidad($unidad);
	$simccar->setUnidadAgregado($unidadAgregado);
	$simccar->setOrigen($origen);
	$simccar->setVerifica($verificar);
	$simccar->setTarjetaSimccar($tarjeta2);
	$simccar->setImei($imei2);
	$simccar->setMarca(STRTOUPPER($marca2));
	$simccar->setModelo(STRTOUPPER($modelo2));
	$simccar->setAnno($anno2);
	$simccar->setReemplazoSimccar($estado);
	$simccar->setSeccion($seccion);
	
	$objDBSimccar = new dbSimccar;
	$resultado = $objDBSimccar->updateSimccar2($simccar);
	
	if ($fechaNuevoEstado2 != ""){
		$fechaPaso 		= explode("-",$fechaNuevoEstado2);
   	$fechaIngresar  = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
		$resultado = $objDBSimccar->updateEstadoSimccar2($simccar, $fechaIngresar);
		$resultado = $objDBSimccar->insertEstadoSimccar2($simccar, $fechaIngresar);
	}
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  echo "<root>";
  echo "<resultado>".$resultado."</resultado>";
  echo "</root>";
?>
<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbVehiculos.class.php");
	require("../../objetos/vehiculo.class.php");
	require("../../objetos/estadoRecurso.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/lugarReparacion.class.php");
	require("../../objetos/fallaVehiculo.class.php");
	require("../../objetos/seccion.class.php");
	require("../../objetos/clasificacionCitacion.class.php");

	session_start();
	$codigoUnidad	= $_SESSION['USUARIO_CODIGOUNIDAD'];
	$codigoVehiculo	= $_POST['codigoVehiculo'];
	$fechaActual	= $_POST['fechaMovimiento'];
	
	$fechaPaso			= explode("-",$fechaActual);
	$fechaMovimiento	= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	
	$estado = new estadoRecurso;
	$estado->setCodigo(3500);
	$estado->setDescripcion("");
	
	$unidad = new unidad;
	$unidad->setCodigoUnidad($codigoUnidad);
	$unidad->setDescripcionUnidad("");
	
	$unidadAgregado = new unidad;
	$unidadAgregado->setCodigoUnidad($codigoUnidadAgregado);
	$unidadAgregado->setDescripcionUnidad("");
	
	$lugarDeReparacion = new lugarReparacion;
	$lugarDeReparacion->setCodigo("0");
	$lugarDeReparacion->setDescripcion("");
	
	$tipoFalla = new fallaVehiculo;
	$tipoFalla->setCodigo($codigoTipoFalla);
	$tipoFalla->setDescripcion("");
	
	$clasificacionCitacion = new clasificacionCitacion;
	$clasificacionCitacion->setCodigo("NULL");
	$clasificacionCitacion->setDescripcion("");

	$seccion = new seccion;
	$seccion->setCodigo("0");
	$seccion->setDescripcion("");
	
	$vehiculo = new vehiculo;
	$vehiculo->setCodigoVehiculo($codigoVehiculo);
	$vehiculo->setUnidad($unidad);
	$vehiculo->setEstadoVehiculo($estado);
	$vehiculo->setDocumentoEstado($numeroDocumento);
	$vehiculo->setUnidadAgregado($unidadAgregado);
	$vehiculo->setLugarReparacion($lugarDeReparacion);
	$vehiculo->setTipoFallaVehiculo($tipoFalla);
	$vehiculo->setSeccion($seccion);
	$vehiculo->setClasificacionCitacion($clasificacionCitacion);
	
	$objDBVehiculos = new dbVehiculos;
	$resultado = $objDBVehiculos->dejarDisponible($vehiculo, $fechaMovimiento);
	$resultado = $objDBVehiculos->updateEstadoVehiculo($vehiculo, $fechaMovimiento);
	$resultado = $objDBVehiculos->insertEstadoVehiculo($vehiculo, $fechaMovimiento);

	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
	echo "<resultado>".$resultado."</resultado>";
	echo "</root>";
?>
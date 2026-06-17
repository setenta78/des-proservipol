<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbVehiculos.class.php");
	require("../../objetos/vehiculo.class.php");
	require("../../objetos/tipoVehiculo.class.php");
	require("../../objetos/marcaVehiculo.class.php");
	require("../../objetos/modeloVehiculo.class.php");
	require("../../objetos/procedenciaVehiculo.class.php");
	require("../../objetos/estadoVehiculo.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/lugarReparacion.class.php");
	require("../../objetos/seccion.class.php");
	require("../../objetos/estadoRecurso.class.php");
	require("../../objetos/clasificacionCitacion.class.php");
	
	$codigoVehiculo			= $_POST['codigoVehiculo'];
	$patente				= $_POST['patente'];
	$numeroInstitucional	= $_POST['numeroInstitucional'];
	$codigoProcedencia		= $_POST['procedencia'];
	$codigoTipoVehiculo		= $_POST['tipoVehiculo'];
	$codigoMarca			= $_POST['marca'];
	$codigoModelo			= $_POST['modelo'];
	$codigoEstado			= $_POST['estado'];
	$fechaNuevoEstado		= $_POST['fechaEstado'];
	$numeroDocumento		= $_POST['numeroDocumento'];
	$numeroBCU				= $_POST['numeroBCU'];
	$codigoLugarReparacion	= $_POST['lugarReparacion'];
	$sec					= $_POST['seccion'];
	$annoFabricacion		= $_POST['anno'];  
	$validaAnno				= $_POST['valida'];  
	
	session_start();
	$codigoUnidad			= $_SESSION['USUARIO_CODIGOUNIDAD'];

	$unidad = new unidad;
	$unidad->setCodigoUnidad($codigoUnidad);
	$unidad->setDescripcionUnidad("");
	
	$unidadAgregado = new unidad;
	$unidadAgregado->setCodigoUnidad($codigoUnidadAgregado);
	$unidadAgregado->setDescripcionUnidad("");

	$procedencia = new procedenciaVehiculo;
	$procedencia->setCodigo($codigoProcedencia);
	$procedencia->setDescripcion("");
	
	$tipoVehiculo = new tipoVehiculo;
	$tipoVehiculo->setCodigo($codigoTipoVehiculo);
	$tipoVehiculo->setDescripcion("");
	
	$marca = new marcaVehiculo;
	$marca->setCodigo($codigoMarca);
	$marca->setDescripcion("");
	
	$modelo = new modeloVehiculo;
	$modelo->setMarca($marca);
	$modelo->setCodigo($codigoModelo);
	$modelo->setDescripcion("");
	
	$estado = new estadoVehiculo;
	$estado->setCodigo($codigoEstado);
	$estado->setDescripcion("");
	
	$lugarDeReparacion = new lugarReparacion;
	$lugarDeReparacion->setCodigo($codigoLugarReparacion);
	$lugarDeReparacion->setDescripcion("");
	
	$estado = new estadoRecurso;
	$estado->setCodigo($codigoEstado);
	$estado->setDescripcion("");
	
	$seccion = new seccion;
	$seccion->setCodigo($sec);
	$seccion->setDescripcion("");
	
	$clasificacionCitacion = new clasificacionCitacion;
	$clasificacionCitacion->setCodigo("NULL");
	$clasificacionCitacion->setDescripcion("");

	$vehiculo = new vehiculo;
	$vehiculo->setPatente($patente);
	$vehiculo->setNumeroInstitucional($numeroInstitucional);
	$vehiculo->setProcedencia($procedencia);
	$vehiculo->setTipoVehiculo($tipoVehiculo);
	$vehiculo->setModeloVehiculo($modelo);
	$vehiculo->setEstadoVehiculo($estado);
	$vehiculo->setUnidad($unidad);
	$vehiculo->setDocumentoEstado($numeroDocumento);
	$vehiculo->setNumeroBCU($numeroBCU);
	$vehiculo->setLugarReparacion($lugarDeReparacion);
	$vehiculo->setUnidadAgregado($unidadAgregado);
	$vehiculo->setSeccion($seccion);
	$vehiculo->setAnnoFabricacion($annoFabricacion);
	$vehiculo->setValidaAnnoFabricacion($validaAnno);
	$vehiculo->setClasificacionCitacion($clasificacionCitacion);
	
	$objDBVehiculos = new dbVehiculos;
	$idNuevo = $objDBVehiculos->nuevoVehiculo($vehiculo);
	$vehiculo->setCodigoVehiculo($idNuevo);
	
	if($fechaNuevoEstado != ""){
		$fechaPaso		= explode("-",$fechaNuevoEstado);
		$fechaIngresar	= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
		$resultado		= $objDBVehiculos->insertEstadoVehiculo($vehiculo, $fechaIngresar);
	}

	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
	echo "<resultado>".$resultado."</resultado>";
	echo "</root>";
?>
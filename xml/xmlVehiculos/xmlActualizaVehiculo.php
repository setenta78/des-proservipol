<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbVehiculos.class.php");
	require("../../objetos/vehiculo.class.php");
	require("../../objetos/tipoVehiculo.class.php");
	require("../../objetos/marcaVehiculo.class.php");
	require("../../objetos/modeloVehiculo.class.php");
	require("../../objetos/procedenciaVehiculo.class.php");
	require("../../objetos/estadoRecurso.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/vehiculoEstadoHistorico.class.php");
	require("../../objetos/lugarReparacion.class.php");
  	require("../../objetos/seccion.class.php");
  	require("../../objetos/fallaVehiculo.class.php");
  	require("../../objetos/clasificacionCitacion.class.php");
	
	session_start();
	$codigoUnidad			= $_SESSION['USUARIO_CODIGOUNIDAD'];
	$codigoUsuario			= $_SESSION['USUARIO_CODIGOFUNCIONARIO'];
	$codigoVehiculo			= $_POST['codigoVehiculo'];
	$patente				= $_POST['patente'];
	$numeroInstitucional	= $_POST['numeroInstitucional'];
	$codigoProcedencia		= $_POST['procedencia'];
	$codigoTipoVehiculo		= $_POST['tipoVehiculo'];
	$codigoMarca			= $_POST['marca'];
	$codigoModelo			= $_POST['modelo'];
	$codigoEstado			= $_POST['estado'];
	$fechaNuevoEstado		= $_POST['fechaNuevoEstado'];
	$numeroDocumento		= $_POST['numeroDocumento'];
	$codigoEquipo			= $_POST['codigoEquipo'];
	$codigoUnidadAgregado	= $_POST['codigoUnidadAgregado'];
	$codigoLugarReparacion	= $_POST['lugarReparacion'];
  	$sec					= $_POST['seccion'];
  	$codClasificacion		= $_POST['clasificacionCitacion'];
  	$codigoTipoFalla		= $_POST['fallaVehiculo'];
  	$annoFabricacion		= $_POST['anno'];
	$validaAnno				= $_POST['valida'];
	$validaOculto			= $_POST['validaOculto'];

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
	
	$estado = new estadoRecurso;
	$estado->setCodigo($codigoEstado);
	$estado->setDescripcion("");
	
	$lugarDeReparacion = new lugarReparacion;
	$lugarDeReparacion->setCodigo($codigoLugarReparacion);
	$lugarDeReparacion->setDescripcion("");
	
	$seccion = new seccion;
	$seccion->setCodigo($sec);
	$seccion->setDescripcion("");
	
	$tipoFalla = new fallaVehiculo;
	$tipoFalla->setCodigo($codigoTipoFalla);
	$tipoFalla->setDescripcion("");
	
	if($codClasificacion==0) $codClasificacion = "NULL";
	
	$clasificacionCitacion = new clasificacionCitacion;
	$clasificacionCitacion->setCodigo($codClasificacion);
	$clasificacionCitacion->setDescripcion("");

	$vehiculo = new vehiculo;
	$vehiculo->setCodigoVehiculo($codigoVehiculo);
	$vehiculo->setPatente($patente);
	$vehiculo->setNumeroInstitucional($numeroInstitucional);
	$vehiculo->setProcedencia($procedencia);
	$vehiculo->setTipoVehiculo($tipoVehiculo);
	$vehiculo->setModeloVehiculo($modelo);
	$vehiculo->setEstadoVehiculo($estado);
	$vehiculo->setUnidad($unidad);
	$vehiculo->setDocumentoEstado($numeroDocumento);
	$vehiculo->setCodigoEquipo($codigoEquipo);
	$vehiculo->setUnidadAgregado($unidadAgregado);
	$vehiculo->setLugarReparacion($lugarDeReparacion);
	$vehiculo->setSeccion($seccion);
	$vehiculo->setTipoFallaVehiculo($tipoFalla);
	$vehiculo->setAnnoFabricacion($annoFabricacion);
	$vehiculo->setValidaAnnoFabricacion($validaAnno);
	$vehiculo->setClasificacionCitacion($clasificacionCitacion);
	
	$objDBVehiculos = new dbVehiculos;
	$resultado = $objDBVehiculos->updateVehiculo($vehiculo);
	
	if ($fechaNuevoEstado != ""){
		$fechaPaso 		= explode("-",$fechaNuevoEstado);
   		$fechaIngresar  = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
		$resultado = $objDBVehiculos->updateEstadoVehiculo($vehiculo, $fechaIngresar);
		$resultado = $objDBVehiculos->insertEstadoVehiculo($vehiculo, $fechaIngresar);
	}elseif($fechaNuevoEstado == "" &&$annoFabricacion != ""  && $validaOculto==0){
		$resultado = $objDBVehiculos->updateVehiculo($vehiculo);
	}
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
?>
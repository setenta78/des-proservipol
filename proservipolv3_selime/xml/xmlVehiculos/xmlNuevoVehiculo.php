<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
	require("../../baseDatos/dbVehiculos.class.php");
	require("../../objetos/vehiculo.class.php");
	require("../../objetos/tipoVehiculo.class.php");
	require("../../objetos/marcaVehiculo.class.php");
	require("../../objetos/modeloVehiculo.class.php");
	require("../../objetos/procedenciaVehiculo.class.php");
	require("../../objetos/estadoVehiculo.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/lugarReparacion.class.php");
			
	$codigoVehiculo			= $_POST['codigoVehiculo'];			
	$patente				= $_POST['patente'];
	$numeroInstitucional	= $_POST['numeroInstitucional'];
	$codigoProcedencia 		= $_POST['procedencia'];
	$codigoTipoVehiculo 	= $_POST['tipoVehiculo'];
	$codigoMarca  			= $_POST['marca'];
	$codigoModelo	  		= $_POST['modelo'];
	$codigoEstado	  		= $_POST['estado'];
	$fechaNuevoEstado		= $_POST['fechaEstado'];
	$numeroDocumento		= $_POST['numeroDocumento'];
	$numeroBCU				= $_POST['numeroBCU'];
	$codigoLugarReparacion	= $_POST['lugarReparacion'];
	$annoFabricacion       = $_POST['anno'];  
	$validaAnno       = $_POST['valida'];  
	
	
	//$codigoUnidad			= "610040000000";
	session_start();                                                 
    $codigoUnidad			= $_SESSION['USUARIO_CODIGOUNIDAD'];   	 
    
	$unidad = new unidad;
	$unidad->setCodigoUnidad($codigoUnidad);
	$unidad->setDescripcionUnidad("");
                        
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
	$vehiculo->setNumeroBCU($numeroBCU);
	$vehiculo->setLugarReparacion($lugarDeReparacion);
	$vehiculo->setAnnoFabricacion($annoFabricacion);
	$vehiculo->setValidaAnnoFabricacion($validaAnno);
	
	$objDBVehiculos = new dbVehiculos;
	$resultado = $objDBVehiculos->nuevoVehiculo($vehiculo);
	
	$vehiculo->setCodigoVehiculo(mysql_insert_id());
	
	
	
	if ($fechaNuevoEstado != ""){
		$fechaPaso 		= explode("-",$fechaNuevoEstado);
   		$fechaIngresar  = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
		$resultado = $objDBVehiculos->updateEstadoVehiculo($vehiculo, $fechaIngresar);
		$resultado = $objDBVehiculos->insertEstadoVehiculo($vehiculo, $fechaIngresar);
	}

	//if ($fechaNuevoEstado != ""){		
	//	$fechaPaso 		= explode("-",$fechaNuevoEstado);
	//	$fechaIngresar  = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	//
	//	$nuevoEstadoHistorico = new vehiculoEstadoHistorico;
	//	$nuevoEstadoHistorico->setVehiculo($vehiculo);
	//	$nuevoEstadoHistorico->setEstado($estado);
	//	$nuevoEstadoHistorico->setUnidad($unidad);
	//	$nuevoEstadoHistorico->setFecha($fechaIngresar);
	//	$nuevoEstadoHistorico->setDocumento($numeroDocumento);
	//		
	//	$resultado = $objDBVehiculos->insertHistoricoEstado($nuevoEstadoHistorico);
	//}
			
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
 ?>
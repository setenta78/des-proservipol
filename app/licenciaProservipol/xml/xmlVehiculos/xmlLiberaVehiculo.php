<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
	require("../../baseDatos/dbVehiculos.class.php");
	require("../../objetos/vehiculo.class.php");
	require("../../objetos/estadoRecurso.class.php");	
	require("../../objetos/unidad.class.php");	
	require("../../objetos/lugarReparacion.class.php");
    require("../../objetos/seccion.class.php"); //Llamada agregada el 05-05-2015

	session_start();
	
	$codigoUnidad	= $_SESSION['USUARIO_CODIGOUNIDAD']; 				
	$codigoVehiculo	= $_POST['codigoVehiculo'];
	//$fechaActual   	= date("Y-m-d"); 
	$fechaActual	= $_POST['fechaMovimiento'];	
	
	$fechaPaso 			= explode("-",$fechaActual);                                    
	$fechaMovimiento  	= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];   	
	
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
    
    //Instancia agregada el 05-05-2015
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
    $vehiculo->setSeccion($seccion); //Variable agregada el 05-05-2015
	
	$objDBVehiculos = new dbVehiculos;
	$resultado = $objDBVehiculos->dejarDisponible($vehiculo, $fechaMovimiento);
	$resultado = $objDBVehiculos->updateEstadoVehiculo($vehiculo, $fechaMovimiento);
	$resultado = $objDBVehiculos->insertEstadoVehiculo($vehiculo, $fechaMovimiento);	
	//$resultado = 1;
			
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
?>
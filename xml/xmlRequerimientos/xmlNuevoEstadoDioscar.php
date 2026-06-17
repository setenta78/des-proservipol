<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbRequerimientos.php");
	require("../../objetos/movimientoSolicitud.class.php");
	
	
	session_start();
  $codigoSolicitud	= $_POST['codigo'];			
	$movimiento		    = $_POST['movimiento'];
  $respuesta   	  	= strtoupper($_POST['respuesta']);
  $fechaMovimiento  = $_POST['fechaMovimiento'];
  $ingeniero  		  = $_POST['ingeniero'];
  $usuario 		      = $_POST['usuario'];
  $secciones 		    = $_POST['secciones'];
  $fechaTermino     = $_POST['fechaTermino'];
  $archivo          = $_POST['archivo'];



 
  $fechaPaso 		= explode("-",$fechaMovimiento);
  $fechaIngresar  = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
    	
	$vehiculo= new movimientoSolicitud;
	$vehiculo->setCodigoSolicitud($codigo);
  $vehiculo->setCodigoTipoMovimiento($movimiento);
  $vehiculo->setTextoMovimiento($respuesta);
  $vehiculo->setFechaMovimiento($fechaIngresar);
  $vehiculo->setFuncionarioDeriba($ingeniero);
  $vehiculo->setUsuarioImplicado($usuario);
  $vehiculo->setSecciones($secciones);
  $vehiculo->setFechaInicio($fechaTermino);
  $vehiculo->setFechaTermino("NULL");
  $vehiculo->setArchivoSolicitud($archivo);

  
  
	$objDBVehiculos= new dbRequerimiento;
	//$resultado = $objDBVehiculos->updateEstadoSolicitud($vehiculo);
	//$resultado = $objDBVehiculos->insertMovimientoSolicitud($vehiculo);
	//$idNuevo = $objDBVehiculos->nuevoDioscar($vehiculo);

	
	//$vehiculo->setCodigoSolicitud($idNuevo);	
	
	//if ($fecha2 != ""){
	//	$fechaPaso 		= explode("-",$fecha2);
  //	$fechaIngresar2  = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	//	$resultado = $objDBVehiculos->insertMovimientoSolicitud($vehiculo, $fechaIngresar2);
	//}
	
	if($fechaTermino != ""){
		//$fechaPaso 		= explode("-",$fechaNuevoEstado);
   	//$fechaIngresar  = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
		$resultado = $objDBVehiculos->updateEstadoSolicitud($vehiculo, $fechaTermino);
		$resultado = $objDBVehiculos->insertMovimientoSolicitud($vehiculo, $fechaIngresar);
	}
					
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
 ?>
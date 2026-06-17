<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
	require("../../baseDatos/dbSim.class.php");
	require("../../objetos/simccar.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/estadoRecurso.class.php");
	
	session_start();
  $codigoVehiculo			= $_POST['codigoVehiculo'];			
	$unidadUsuario		= $_POST['unidadUsuario'];
  $codigoUsuario		= $_POST['codigoUsuario'];
  $mes	= $_POST['mes'];
  $fecha = $_POST['fecha'];
  
  $codigoEstado	  		= $_POST['estado'];
  $fechaNuevoEstado	  	= $_POST['fechaNuevoEstado'];
  $codigoUnidadAgregado	= $_POST['codigoUnidadAgregado'];
  
  //$codigo 	= $_POST['codigo'];
  
  $codigo			= $_POST['codigo'];		
  
  $unidad = new unidad;
	$unidad->setCodigoUnidad($unidadUsuario);
	$unidad->setDescripcionUnidad("");
	
	$unidadAgregado = new unidad;
	$unidadAgregado->setCodigoUnidad($codigoUnidadAgregado);
	$unidadAgregado->setDescripcionUnidad("");
                        
	
	$estado = new estadoRecurso;
	$estado->setCodigo($codigoEstado);
	$estado->setDescripcion("");
 	
	$vehiculo= new dioscar;
	$vehiculo->setCodigoSimccar($codigoVehiculo);
  //$vehiculo->setUnidad($unidadUsuario);
  $vehiculo->setSerieSimccar($codigoUsuario);
  $vehiculo->setTarjetaSimccar($mes);
  $vehiculo->setImei($fecha);
  $vehiculo->setEstadoVehiculo($estado);
	$vehiculo->setUnidad($unidad);
	$vehiculo->setUnidadAgregado($unidadAgregado);
 
  
	$objDBVehiculos= new dbDioscar;
	$idNuevo = $objDBVehiculos->nuevoDioscar($vehiculo);
	//$resultado = $objDBFuncionarios->nuevoDioscar($funcionario);
	
	$vehiculo->setCodigoSimccar($idNuevo);	
	
	if ($fechaNuevoEstado != ""){
		$fechaPaso 		= explode("-",$fechaNuevoEstado);
   	$fechaIngresar  = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
		$resultado = $objDBVehiculos->insertEstadoSimccar($vehiculo, $fechaIngresar);
	}
					
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
 ?>
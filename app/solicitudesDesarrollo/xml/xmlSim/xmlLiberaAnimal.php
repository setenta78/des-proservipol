<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
	require("../../baseDatos/dbSim.class.php");
	require("../../objetos/simccar.class.php");
	require("../../objetos/estadoRecurso.class.php");	
	require("../../objetos/unidad.class.php");	




	session_start();
	
	$codigoUnidad	= $_SESSION['USUARIO_CODIGOUNIDAD']; 				
	$codigoVehiculo	= $_POST['codigoVehiculo'];
	//$fechaActual   	= date("Y-m-d"); 
	$fechaActual	= $_POST['fechaMovimiento'];	
	$reemplazo       = "";
	
	$fechaPaso 			= explode("-",$fechaActual);                                    
	$fechaMovimiento  	= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];   	
	
	$estado = new estadoRecurso;
	$estado->setCodigo(3500);
	$estado->setDescripcion("");
	$estado->setReemplazo($reemplazo);
	
	$unidad = new unidad;
	$unidad->setCodigoUnidad($codigoUnidad);
	$unidad->setDescripcionUnidad("");
	
	$unidadAgregado = new unidad;
	$unidadAgregado->setCodigoUnidad($codigoUnidadAgregado);
	$unidadAgregado->setDescripcionUnidad("");
	

	$vehiculo = new dioscar;
	$vehiculo->setCodigoSimccar($codigoVehiculo);
	$vehiculo->setEstadoVehiculo($estado);
	$vehiculo->setUnidad($unidad);
	$vehiculo->setUnidadAgregado($unidadAgregado);
	$vehiculo->setReemplazoSimccar($estado);
	
		
	$objDBVehiculos = new dbDioscar;
	$resultado = $objDBVehiculos->dejarDisponible($vehiculo, $fechaMovimiento);
	$resultado = $objDBVehiculos->updateEstadoSimmcar($vehiculo, $fechaMovimiento);
	$resultado = $objDBVehiculos->insertEstadoSimccar($vehiculo, $fechaMovimiento);	
	//$resultado = 1;
			
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
?>
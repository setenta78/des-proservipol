<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbVehiculos.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/vehiculo.class.php");
	require("../../objetos/estadoRecurso.class.php");
	session_start();
	
	$codigoUnidad = $_SESSION['USUARIO_CODIGOUNIDAD']; 
	$codigoVehiculo	= $_POST['codigoVehiculo'];
	//$fechaActual    = date("Y-m-d");
	$fechaActual	= $_POST['fechaMovimiento'];	

	$fechaPaso 			= explode("-",$fechaActual);                                    
	$fechaMovimiento  	= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];   	

	$unidad = new unidad;
	$unidad->setCodigoUnidad($codigoUnidad);
	$unidad->setDescripcionUnidad("");
	
	$estado = new estadoRecurso;
	$estado->setCodigo('100');
	$estado->setDescripcion("BAJA");
	
	$vehiculo = new vehiculo;
	$vehiculo->setCodigoVehiculo($codigoVehiculo);
	$vehiculo->setEstadoVehiculo($estado);
	$vehiculo->setUnidad($unidad);
	
	$objDBVehiculos = new dbVehiculos;
	$resultado = $objDBVehiculos->updateEstadoVehiculo($vehiculo, $fechaMovimiento);
	$resultado = $objDBVehiculos->bajaVehiculo($vehiculo, $motivo, $fechaMovimiento);
	//$resultado = 1;
			
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
?>
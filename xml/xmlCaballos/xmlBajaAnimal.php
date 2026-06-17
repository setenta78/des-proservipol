<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
	require("../../baseDatos/dbCaballos.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/caballos.class.php");
	require("../../objetos/estadoAnimal.class.php");
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
	
	$estado = new estadoAnimal;
	$estado->setCodigo('100');
	$estado->setDescripcion("BAJA");
	
	$vehiculo = new caballo;
	$vehiculo->setCodigoCaballo($codigoVehiculo);
	$vehiculo->setEstadoVehiculo($estado);
	$vehiculo->setUnidad($unidad);
	
	$objDBVehiculos = new dbCaballos;
	$resultado = $objDBVehiculos->updateEstadoAnimal($vehiculo, $fechaMovimiento);
	$resultado = $objDBVehiculos->bajaAnimal($vehiculo, $motivo, $fechaMovimiento);
	//$resultado = 1;
			
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
?>
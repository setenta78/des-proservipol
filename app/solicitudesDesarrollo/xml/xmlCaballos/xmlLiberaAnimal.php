<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
	require("../../baseDatos/dbCaballos.class.php");
	require("../../objetos/caballos.class.php");
	require("../../objetos/estadoAnimal.class.php");	
	require("../../objetos/unidad.class.php");	




	session_start();
	
	$codigoUnidad	= $_SESSION['USUARIO_CODIGOUNIDAD']; 				
	$codigoVehiculo	= $_POST['codigoVehiculo'];
	//$fechaActual   	= date("Y-m-d"); 
	$fechaActual	= $_POST['fechaMovimiento'];	
	
	$fechaPaso 			= explode("-",$fechaActual);                                    
	$fechaMovimiento  	= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];   	
	
	$estado = new estadoAnimal;
	$estado->setCodigo(3500);
	$estado->setDescripcion("");
	
	$unidad = new unidad;
	$unidad->setCodigoUnidad($codigoUnidad);
	$unidad->setDescripcionUnidad("");
	
	$unidadAgregado = new unidad;
	$unidadAgregado->setCodigoUnidad($codigoUnidadAgregado);
	$unidadAgregado->setDescripcionUnidad("");
	

	$vehiculo = new caballo;
	$vehiculo->setCodigoCaballo($codigoVehiculo);
	$vehiculo->setEstadoVehiculo($estado);
	$vehiculo->setUnidad($unidad);
	$vehiculo->setUnidadAgregado($unidadAgregado);
	
		
	$objDBVehiculos = new dbCaballos;
	$resultado = $objDBVehiculos->dejarDisponible($vehiculo, $fechaMovimiento);
	$resultado = $objDBVehiculos->updateEstadoAnimal($vehiculo, $fechaMovimiento);
	$resultado = $objDBVehiculos->insertEstadoAnimal($vehiculo, $fechaMovimiento);	
	//$resultado = 1;
			
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
?>
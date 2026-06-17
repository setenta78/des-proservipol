<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbAnimales.class.php");
	require("../../objetos/animal.class.php");
	require("../../objetos/estadoAnimal.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/tipoAnimal.class.php");
  require("../../objetos/seccion.class.php"); //Llamada agregada el 29-04-2015
	session_start();
	
	$codigoUnidad	= $_SESSION['USUARIO_CODIGOUNIDAD']; 				
	$codigoAnimal	= $_POST['codigoAnimal'];
	//$fechaActual  = date("Y-m-d"); 
	$fechaActual	= $_POST['fechaMovimiento'];	
	
	$fechaPaso 			 = explode("-",$fechaActual);                                    
	$fechaMovimiento = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];   	
	
	$estado = new estadoAnimal;
	$estado->setCodigo(3500);
	$estado->setDescripcion("");
	
	$unidad = new unidad;
	$unidad->setCodigoUnidad($codigoUnidad);
	$unidad->setDescripcionUnidad("");
	
	$unidadAgregado = new unidad;
	$unidadAgregado->setCodigoUnidad($codigoUnidadAgregado);
	$unidadAgregado->setDescripcionUnidad("");
	
  $seccion = new seccion;
	$seccion->setCodigo(0);
	$seccion->setDescripcion("");
	
	$animal = new animal;
	$animal->setCodigoAnimal($codigoAnimal);
	$animal->setEstadoAnimal($estado);
	$animal->setUnidad($unidad);
	$animal->setUnidadAgregado($unidadAgregado);
  $animal->setSeccion($seccion);
	
	$objDBAnimales = new dbAnimal;
	$resultado = $objDBAnimales->dejarDisponible($animal, $fechaMovimiento);
	$resultado = $objDBAnimales->updateEstadoAnimal($animal, $fechaMovimiento);
	$resultado = $objDBAnimales->insertEstadoAnimal($animal, $fechaMovimiento);	
	//$resultado = 1;
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
?>
<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbAnimales.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/animal.class.php");
	require("../../objetos/estadoAnimal.class.php");
	session_start();
	
	$codigoUnidad = $_SESSION['USUARIO_CODIGOUNIDAD']; 
	$codigoAnimal	= $_POST['codigoAnimal'];
	//$fechaActual    = date("Y-m-d");
	$fechaActual	= $_POST['fechaMovimiento'];	
	
	$fechaPaso 		= explode("-",$fechaActual);                                    
	$fechaMovimiento = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];   	
	
	$unidad = new unidad;
	$unidad->setCodigoUnidad($codigoUnidad);
	$unidad->setDescripcionUnidad("");
	
	$estado = new estadoAnimal;
	$estado->setCodigo('100');
	$estado->setDescripcion("BAJA");
	
	$animal = new animal;
	$animal->setCodigoAnimal($codigoAnimal);
	$animal->setEstadoAnimal($estado);
	$animal->setUnidad($unidad);
	
	$objDBAnimales = new dbAnimal;
	$resultado = $objDBAnimales->updateEstadoAnimal($animal, $fechaMovimiento);
	$resultado = $objDBAnimales->bajaAnimal($animal, $motivo, $fechaMovimiento);
	//$resultado = 1;
			
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
?>
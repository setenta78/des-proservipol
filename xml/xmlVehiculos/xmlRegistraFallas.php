<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbFallaVehiculo.class.php");
	
	$codigoVehiculo	= $_POST['codVehiculo'];			
	$correlativo	= $_POST['correlativo'];
	$unidad			= $_POST['unidad'];
	$archivo		= $_POST['archivo'];
	
	//$ListaFallas		= unserialize(stripslashes($_POST['fallas']));
	$ListaFallas	= $_POST['fallas'];
	
	$objDBFallas = new dbFallaVehiculo;
	
	//$resultado = $objDBFallas->updateArchivoFalla($correlativo, $codigoVehiculo, $archivo);
	$resultado = $objDBFallas->insertFallas($correlativo, $codigoVehiculo, $unidad, $ListaFallas);
	
	if ($resultado > 0){		
		echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
  }
  else{
  	echo "VACIO";
  }
  
 ?>
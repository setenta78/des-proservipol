<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbRequerimientos.php");
	require("../../objetos/movimientoSolicitud.class.php");


	session_start();                                                 
  $codigoUnidad			= $_SESSION['USUARIO_CODIGOUNIDAD'];   	     	
	$vehiculo = new movimientoSolicitud;
	$vehiculo->setUnidad($codigoUnidad);



	
	$objDBVehiculos = new dbRequerimiento;
	$resultado = $objDBVehiculos->updateTemporizador2();

		
			
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
 ?>
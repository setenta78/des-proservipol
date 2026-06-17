<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbLicenciaMedica.class.php");
	
	$unidad = $_POST['codigoUnidad'];
	$FechaCierre = $_POST['FechaCierre'];
	
	$fechaPaso = explode("-",$FechaCierre);                                         
  $FechaCierre = $fechaPaso[2] ."-". $fechaPaso[1] ."-". $fechaPaso[0];
    
	$objLicencia = new dbLicencia;
	$resultado = $objLicencia->CorrigeLicenciasNew($unidad, $FechaCierre);
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  echo "<root>";
  echo "<resultado>".$resultado."</resultado>";
  echo "</root>";
  
?>
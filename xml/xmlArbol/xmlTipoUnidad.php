<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbArbolUnidades.class.php");
	require("../../objetos/arbolUnidad.class.php");
		/* Determina el tipo de unidad segun la unidad elegida */		
	$codUnidad = $_POST['codUnidad'];

	$objDBUnidad = new dbUnidad;
	$objDBUnidad->TipoUnidad($codUnidad,&$tipo);
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
  	echo "<unidad>";
   	echo "<tipoUnidad>".$tipo."</tipoUnidad>";
   	echo "</unidad>";
 echo "</root>";
 
?>
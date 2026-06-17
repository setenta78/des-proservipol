<?
	header ('content-type: text/xml');
	include("configuracionBD2.php");
	require("../db/dbFechas.class.php");
	require("../objetos/fecha.class.php");
	
	$objFechas = new dbFechas;
	$objFechas->fechaLimite(&$fecha);
  echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  echo "<root>";
	$fechaPaso 		= explode("-",$fecha->getFechaLimite());
 	$fechaLimite  = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	echo "<fechaLimite>".$fechaLimite."</fechaLimite>";
	echo "</root>";
?>
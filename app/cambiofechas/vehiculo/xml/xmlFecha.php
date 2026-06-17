<?
	header ('content-type: text/xml');
	include("configuracionBD2.php");
	require("../db/dbFechas.class.php");
	require("../objetos/fecha.class.php");
		
	$codigo   = $_POST['codigo'];
	$fechaAux	= explode("-",$_POST['fecha']);
	$fecha    = $fechaAux[2] . "-" . $fechaAux[1] . "-" . $fechaAux[0];
	
	$objFechas = new dbFechas;
	$objFechas->Por_FechaDesde($codigo,$fecha,&$fechas);
	$cantidad = count($fechas);
  echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  echo "<root>";
  for ($i=0; $i < $cantidad; $i++){
		$fechaPaso 		= explode("-",$fechas[$i]->getFechaD());
   	$fechaMostrarD   = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
   	$fechaPaso 		= explode("-",$fechas[$i]->getFechaH());
   	$fechaMostrarH   = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
  	echo "<fechas>";
  			
	 		echo "<codigo_fecha>".$fechas[$i]->getCodigoVehiculo()."</codigo_fecha>";
	 		echo "<correlativo>".$fechas[$i]->getCorrelativo()."</correlativo>";
	 		echo "<estado>".$fechas[$i]->getEstado()."</estado>";
	 		echo "<unidad>".$fechas[$i]->getUnidad()."</unidad>";
	 		echo "<fechaD>".$fechaMostrarD."</fechaD>";
	 		echo "<fechaH>".$fechaMostrarH."</fechaH>";
	 		echo "<dias>".$fechas[$i]->getDias()."</dias>";
		 		
		echo "</fechas>";
 	}
	echo "</root>";
?>
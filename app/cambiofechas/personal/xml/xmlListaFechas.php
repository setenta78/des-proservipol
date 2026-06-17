<?
	header ('content-type: text/xml');
	include("configuracionBD2.php");
	require("../db/dbFechas.class.php");
	require("../objetos/fecha.class.php");
	
	$codigo = $_POST['codigo'];
	$objFechas = new dbFechas;
	$objFechas->listaFechas($codigo,&$fechas);
	
	$cantidad = count($fechas);
	$inicio = 0;
	if($cantidad > 20) $inicio = $cantidad - 20;
	
  echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  echo "<root>";
  for ($i=$inicio; $i < $cantidad; $i++){
		$fechaPaso 			= explode("-",$fechas[$i]->getFechaD());
   	$fechaMostrarD  = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
		$fechaPaso 			= explode("-",$fechas[$i]->getFechaH());
   	$fechaMostrarH	= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
		echo "<fechas>";
	 		echo "<codigo_fecha>".$fechas[$i]->getCodigoFuncionario()."</codigo_fecha>";
	 		echo "<correlativo>".$fechas[$i]->getCorrelativo()."</correlativo>";
	 		echo "<cargo>".$fechas[$i]->getCargo()."</cargo>";
	 		echo "<unidad>".$fechas[$i]->getUnidad()."</unidad>";
	 		echo "<fechaD>".$fechaMostrarD."</fechaD>";
	 		echo "<fechaH>".$fechaMostrarH."</fechaH>";
	 		echo "<bloqueado>".$fechas[$i]->getFechaLimite()."</bloqueado>";
	 		echo "<dias>".$fechas[$i]->getDias()."</dias>";
		echo "</fechas>";
 	}
	echo "</root>";
?>
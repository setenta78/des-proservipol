<?
	header ('content-type: text/xml');
	include("configuracionBD2.php");
	require("../db/dbFechas.class.php");
	require("../objetos/fecha.class.php");
		
	$codigo   		= $_POST['codigo'];
	$correlativo 	= $_POST['correlativo'];
	$fechaAux			= explode("-",$_POST['fechaD']);
	$fechaD    		= $fechaAux[2] . "-" . $fechaAux[1] . "-" . $fechaAux[0];
	$fechaAux			= explode("-",$_POST['fechaH']);
	$fechaH    		= $fechaAux[2] . "-" . $fechaAux[1] . "-" . $fechaAux[0];
	
	$fecha = new Fecha;
	$fecha->setCodigoVehiculo($codigo);
	$fecha->setFechaD($fechaD);
	$fecha->setFechaH($fechaH);
	$fecha->setCorrelativo($correlativo);
	$fecha->setEstado("");
	$fecha->setUnidad("");
	$fecha->setDias("");
	
	$objDFechas = new dbFechas;
	
	$resultado = $objDFechas->deleteFecha($fecha);
	
	if($correlativo==0){
		$resultado = $objDFechas->updateUltimo($fecha);
	}
	elseif($correlativo==1){
		$resultado = $objDFechas->updatePrimero($fecha);
	}
	else{
		$resultado = $objDFechas->updateEntre($fecha);	
	}
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  echo "<root>";
  echo "<resultado>".$resultado."</resultado>";
  echo "</root>";

?>
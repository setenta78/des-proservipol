<?
	header ('content-type: text/xml');
	include("configuracionBD2.php");
	require("../db/dbFechas.class.php");
	require("../objetos/fecha.class.php");
	
	$codigo					= $_POST['codigo'];			
	$fechaAux					= explode("-",$_POST['fechaD']);
	$fechaD   = $fechaAux[2] . "-" . $fechaAux[1] . "-" . $fechaAux[0];
	$fechaAux					= explode("-",$_POST['NfechaH']);
	$NfechaH   = $fechaAux[2] . "-" . $fechaAux[1] . "-" . $fechaAux[0];
	$fechaAux				= explode("-",$_POST['NfechaD']);
	$NfechaD  = $fechaAux[2] . "-" . $fechaAux[1] . "-" . $fechaAux[0];
	$fechaAux	= $_POST['fechaH'];
	if($fechaAux=="--"){
		$fechaH = $fechaAux;
		}
	else{
		$fechaAux				= explode("-",$_POST['fechaH']);
		$fechaH   = $fechaAux[2] . "-" . $fechaAux[1] . "-" . $fechaAux[0];
		}
	
	$fecha = new fecha;
	$fecha->setCodigoFuncionario($codigo);
	$fecha->setFechaD($fechaD);
	$fecha->setFechaH($fechaH);
	$fecha->setCorrelativo("");
	$fecha->setCargo("");
	$fecha->setUnidad("");
	$fecha->setDias("");
		
	$objDFechas = new dbFechas;
	$resultado = $objDFechas->updateFecha($fecha,$NfechaD,$NfechaH);

	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
 ?>
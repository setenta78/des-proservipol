<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbSimccar.class.php");
	require("../../objetos/simccar.class.php");
	require("../../objetos/estadoRecurso.class.php");
	
	$unidad 	  	= $_POST['codigoUnidad'];
	$fechaServicio  = $_POST['fechaServicio'];
	$tipoServicio   = $_POST['tipoServicio'];
	$correlativo	= $_POST['correlativo'];
	
	$fechaPaso 		= explode("-",$fechaServicio);
  $fechaBuscar  	= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	
	$objSimccar = new dbSimccar;
	$objSimccar->listaSimccarDisponibles($unidad, $fechaBuscar, $tipoServicio, $correlativo, &$Simccar);
	$cantidad = count($Simccar);
	if ($cantidad > 0){
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<simccar>";
	   		echo "<codigo>".$Simccar[$i]->getCodigoSimccar()."</codigo>";
	   		echo "<serie>".$Simccar[$i]->getSerieSimccar()."</serie>";
   		echo "</simccar>";
	 	}
		echo "</root>";
	} else {
		echo "SIN DATOS";
	}
?>
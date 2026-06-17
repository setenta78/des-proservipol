<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbArmas.class.php");
	require("../../objetos/arma.class.php");
	require("../../objetos/tipoArma.class.php");
	require("../../objetos/marcaArma.class.php");
	require("../../objetos/modeloArma.class.php");
	require("../../objetos/estadoRecurso.class.php");
	
	$unidad 		= $_POST['codigoUnidad'];
	$fechaServicio 	= $_POST['fechaServicio'];
	$tipoServicio 	= $_POST['tipoServicio'];
	$correlativo	= $_POST['correlativo'];
	$horaInicio			= $_POST['horaInicio'];
	$horaTermino		= $_POST['horaTermino'];
	
	$fechaPaso 		= explode("-",$fechaServicio);
	$fechaBuscar  	= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	
	if($horaInicio >= $horaTermino)	$horaTermino = "24:00";
	
	$objArmas = new dbArmas;
	$objArmas->listaArmasDisponibles($unidad, $fechaBuscar, $tipoServicio, $horaInicio, $horaTermino, $correlativo, &$armas);
	$cantidad = count($armas);
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<arma>";
   		echo "<codigo>".$armas[$i]->getCodigo()."</codigo>";
   		echo "<tipo>".$armas[$i]->getTipo()->getDescripcion()."</tipo>";
   		echo "<numeroSerie>".$armas[$i]->getNumeroSerie()."</numeroSerie>";
   		echo "</arma>";
 	}
	echo "</root>";
?>
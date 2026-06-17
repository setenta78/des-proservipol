<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
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
	
	$fechaPaso 		= explode("-",$fechaServicio);
   	$fechaBuscar  	= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	
	//$unidad 		= 460;
	//$fechaBuscar 	= "2010-03-10";
	//$tipoServicio 	= 1150;
	
	$objArmas = new dbArmas;
	$objArmas->listaArmasDisponibles($unidad, $fechaBuscar, $tipoServicio, $correlativo, &$armas);
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
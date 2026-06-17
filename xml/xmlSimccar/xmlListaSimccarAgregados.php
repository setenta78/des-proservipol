<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbSimccar.class.php");
  require("../../objetos/unidad.class.php");
	require("../../objetos/usuario.class.php");
	require("../../objetos/simccar.class.php");
	require("../../objetos/estadoRecurso.class.php");
  require("../../objetos/seccion.class.php");
	
	$unidad 	   = $_POST['codigoUnidad'];
	$nombreBuscar  = utf8_decode($_POST['nombreBuscar']);
	
	$sentidoOrden  = $_POST['sentido'];
	$camporOrden   = $_POST['campo'];
	
	$objSimccar = new dbSimccar;
	$objSimccar->listaSimccarAgregada($unidad, $nombreBuscar, $camporOrden, $sentidoOrden, &$Simccar);
	$cantidad = count($Simccar);
	
  echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  echo "<root>";
 	for ($i=0; $i<$cantidad; $i++){
   	echo "<simccar>";
	  echo "<codigo>".$Simccar[$i]->getCodigoSimccar()."</codigo>";
	  echo "<serie>".$Simccar[$i]->getSeriesimccar()."</serie>";
	  echo "<tarjeta>".$Simccar[$i]->getTarjetaSimccar()."</tarjeta>";
	  Echo "<imei>".$Simccar[$i]->getImei()."</imei>";
	  echo "<estado>".$Simccar[$i]->getEstadoSimccar()->getDescripcion()."</estado>";
  	echo "<codigoUnidad>".$Simccar[$i]->getUnidad()->getCodigoUnidad()."</codigoUnidad>";
 		echo "<desUnidad>".$Simccar[$i]->getUnidad()->getDescripcionUnidad()."</desUnidad>";
  	echo "<codigoUnidadAgregado>".$Simccar[$i]->getUnidadAgregado()->getCodigoUnidad()."</codigoUnidadAgregado>";
 		echo "<desUnidadAgregado>".$Simccar[$i]->getUnidadAgregado()->getDescripcionUnidad()."</desUnidadAgregado>";
		echo "<seccion>".$Simccar[$i]->getSeccion()->getDescripcion()."</seccion>";
	 	echo "</simccar>";
	}
	echo "</root>";
 ?>
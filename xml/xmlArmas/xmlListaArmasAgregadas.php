<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbArmas.class.php");
	require("../../objetos/arma.class.php");
	require("../../objetos/tipoArma.class.php");
	require("../../objetos/marcaArma.class.php");
	require("../../objetos/modeloArma.class.php");
	require("../../objetos/estadoRecurso.class.php");
	require("../../objetos/unidad.class.php");	
    require("../../objetos/seccion.class.php");	//Llamada agregada el 05-05-2015
		
	$unidad 	= $_POST['codigoUnidad'];
	$nombreBuscar  = utf8_decode($_POST['nombreBuscar']);
	
	$sentidoOrden  = $_POST['sentido'];
	$camporOrden   = $_POST['campo'];
	$tipoEstado	= "0,1,4";
	
	//$unidad = "610040000000"; 
	//$unidad = "10"; 
	//$armaBuscar = "53";
	
	$objArmas = new dbArmas;
	$objArmas->listaTotalArmasAgregadas($unidad, $nombreBuscar, $camporOrden, $sentidoOrden, &$armas);
	$cantidad = count($armas);
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<arma>";
   		echo "<codigo>".$armas[$i]->getCodigo()."</codigo>";
   		echo "<tipo>".$armas[$i]->getTipo()->getDescripcion()."</tipo>";
   		echo "<marca>".$armas[$i]->getModelo()->getMarcaArma()->getDescripcion()."</marca>";
   		echo "<modelo>".$armas[$i]->getModelo()->getDescripcion()."</modelo>";
   		echo "<estado>".$armas[$i]->getEstado()->getDescripcion()."</estado>";
   		echo "<numeroSerie>".$armas[$i]->getNumeroSerie()."</numeroSerie>";
   		echo "<codigoUnidadAgregado>".$armas[$i]->getUnidadAgregado()->getCodigoUnidad()."</codigoUnidadAgregado>";
   		echo "<desUnidadAgregado>".$armas[$i]->getUnidadAgregado()->getDescripcionUnidad()."</desUnidadAgregado>";
      echo "<seccion>".$armas[$i]->getSeccion()->getDescripcion()."</seccion>";
      echo "<unidadAgregado>".$armas[$i]->getUnidadAgregado()->getDescripcionUnidad()."</unidadAgregado>";
   		echo "</arma>";
 	}
	echo "</root>";
 ?>
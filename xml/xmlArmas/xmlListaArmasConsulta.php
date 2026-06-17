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
    require("../../objetos/seccion.class.php");
		
	$unidad 	= $_POST['codigoUnidad'];
	$nombreBuscar  = utf8_decode($_POST['nombreBuscar']);
	
	$sentidoOrden  = $_POST['sentido'];
	$camporOrden   = $_POST['campo'];
	$tipoEstado	= "0,1,4";
	
	$objArmas = new dbArmas;
	$objArmas->listaTotalArmas($unidad, $nombreBuscar, $camporOrden, $sentidoOrden, &$armas);
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
   		echo "</arma>";
 	}
    
    $objArmas->listaTotalArmasAgregadas($unidad, $nombreBuscar, $camporOrden, $sentidoOrden, &$armasAgr);
    $cantidad = count($armasAgr);
    for ($i=0; $i<$cantidad; $i++){
        echo "<arma>";
        echo "<codigo>".$armasAgr[$i]->getCodigo()."</codigo>";
        echo "<tipo>".$armasAgr[$i]->getTipo()->getDescripcion()."</tipo>";
        echo "<marca>".$armasAgr[$i]->getModelo()->getMarcaArma()->getDescripcion()."</marca>";
        echo "<modelo>".$armasAgr[$i]->getModelo()->getDescripcion()."</modelo>";
        echo "<estado>".$armasAgr[$i]->getEstado()->getDescripcion()."</estado>";
        echo "<numeroSerie>".$armasAgr[$i]->getNumeroSerie()."</numeroSerie>";
        echo "<codigoUnidadAgregado>".$armasAgr[$i]->getUnidadAgregado()->getCodigoUnidad()."</codigoUnidadAgregado>";
        echo "<desUnidadAgregado>".$armasAgr[$i]->getUnidadAgregado()->getDescripcionUnidad()."</desUnidadAgregado>";
        echo "<unidadAgregado>".$armasAgr[$i]->getUnidadAgregado()->getDescripcionUnidad()."</unidadAgregado>";
        echo "<seccion>".$armasAgr[$i]->getSeccion()->getDescripcion()."</seccion>";
        echo "</arma>";
    }
	echo "</root>";
 ?>
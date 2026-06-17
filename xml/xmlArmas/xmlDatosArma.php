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
    require("../../objetos/seccion.class.php");	//Llamada agregada el 05-04-2015
		
	$codigoArma = $_POST['codigoArma'];
		
	//$codigoArma = "4";
		
	$objArmas = new dbArmas;
	$objArmas->buscaDatosArma($codigoArma, &$arma);
	$cantidad = count($arma);
	if ($cantidad > 0){
		echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
		echo "<root>";
		
		$fechaPaso 		= explode("-",$arma->getEstado()->getFechaDesde());
	   	$fechaMostrar   = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
		
		echo "<arma>";
	   	echo "<codigo>".$arma->getCodigo()."</codigo>";
	   	echo "<tipo>".$arma->getTipo()->getCodigo()."</tipo>";
	   	echo "<marca>".$arma->getModelo()->getMarcaArma()->getCodigo()."</marca>";
	   	echo "<modelo>".$arma->getModelo()->getCodigo()."</modelo>";
	   	echo "<estado>".$arma->getEstado()->getCodigo()."</estado>";
	   	echo "<fechaEstado>".$fechaMostrar."</fechaEstado>";
	   	echo "<numeroSerie>".$arma->getNumeroSerie()."</numeroSerie>";
	   	echo "<numeroBCU>".$arma->getNumeroBCU()."</numeroBCU>";
	   	echo "<unidad>".$arma->getUnidad()->getCodigoUnidad()."</unidad>";
	   	echo "<descUnidad>".$arma->getUnidad()->getDescripcionUnidad()."</descUnidad>";
	   	echo "<codigoUnidadAgregado>".$arma->getUnidadAgregado()->getCodigoUnidad()."</codigoUnidadAgregado>";
   		echo "<desUnidadAgregado>".$arma->getUnidadAgregado()->getDescripcionUnidad()."</desUnidadAgregado>";
        echo "<seccion>".$arma->getSeccion()->getCodigo()."</seccion>"; //Tag agregado el 05-05-2015
        echo "<descSeccion>".$arma->getSeccion()->getDescripcion()."</descSeccion>"; //Tag agregado el 05-05-2015
		echo "</arma>";
		echo "</root>";
	} else {
		echo "VACIO";
	}
 ?>
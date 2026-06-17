<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbArmas.class.php");
	require("../../objetos/arma.class.php");
	require("../../objetos/estadoRecurso.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/seccion.class.php"); //Llamada agregada el 06-05-2015

	session_start();
	$codigoUnidad	= $_SESSION['USUARIO_CODIGOUNIDAD'];				
	$codigoArma		= $_POST['codigoArma'];
	$fechaActual	= $_POST['fechaMovimiento'];
	$sec	= $_POST['seccion'];
	
	$fechaPaso 			= explode("-",$fechaActual);                                    
	$fechaMovimiento  	= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];   	
	
	$estado = new estadoRecurso;
	$estado->setCodigo(3500);
	$estado->setDescripcion("TRASLADO");
	
	$unidad = new unidad;
	$unidad->setCodigoUnidad($codigoUnidad);
	$unidad->setDescripcionUnidad("");
	
	$unidadAgregado = new unidad;
	$unidadAgregado->setCodigoUnidad(0);
	$unidadAgregado->setDescripcionUnidad("");
	
	//Instancia agregada el 05-05-2015
  $seccion = new seccion;
	$seccion->setCodigo($sec);
	$seccion->setDescripcion("");
	
	$arma = new arma;
	$arma->setCodigo($codigoArma);
	$arma->setEstado($estado);
	$arma->setUnidad($unidad);
	$arma->setUnidadAgregado($unidadAgregado);
  $arma->setSeccion($seccion); //Variable agregada el 05-05-2015
	
	$objDBArmas = new dbArmas;
	$resultado = $objDBArmas->dejarDisponible($arma, $fechaMovimiento);
	$resultado = $objDBArmas->updateEstadoArma($arma, $fechaMovimiento);
	$resultado = $objDBArmas->insertEstadoArma($arma, $fechaMovimiento);
	//$resultado = 1;
			
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
?>
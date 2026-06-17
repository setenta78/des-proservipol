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
    require("../../objetos/seccion.class.php"); //Llamada agregada el 06-05-2015
	
	//$codigoArma				= $_POST['codigo'];			
	$numeroSerie			= $_POST['numeroSerie'];
	$codigoTipoArma 		= $_POST['tipoArma'];
	$codigoMarca  			= $_POST['marca'];
	$codigoModelo	  		= $_POST['modelo'];
	$codigoEstado	  		= $_POST['estado'];
	$fechaNuevoEstado	  	= $_POST['fechaNuevoEstado'];
	$codigoUnidad	  		= $_POST['unidad'];
	//$armaBCU	  			= $_POST['armaBCU'];
	$codigoUnidadAgregado	= $_POST['codigoUnidadAgregado'];  
    $sec			        = $_POST['seccion'];   //Variable agregada el 05-05-2015    

	$unidad = new unidad;
	$unidad->setCodigoUnidad($codigoUnidad);
	$unidad->setDescripcionUnidad("");
	
	$unidadAgregado = new unidad;
	$unidadAgregado->setCodigoUnidad($codigoUnidadAgregado);
	$unidadAgregado->setDescripcionUnidad("");
    	
	$tipoArma = new tipoArma;
	$tipoArma->setCodigo($codigoTipoArma);
	$tipoArma->setDescripcion("");
	
	$marca = new marcaArma;
	$marca->setCodigo($codigoMarca);
	$marca->setDescripcion("");
	
	$modelo = new modeloArma;
	$modelo->setMarcaArma($marca);
	$modelo->setCodigo($codigoModelo);
	$modelo->setDescripcion("");
	
	$estado = new estadoRecurso;
	$estado->setCodigo($codigoEstado);
	$estado->setDescripcion("");
    
     //Instancia agregada el 05-05-2015
   	$seccion = new seccion;
	$seccion->setCodigo($sec);
	$seccion->setDescripcion("");
	
	$arma = new arma;
	//$arma->setCodigo($codigoArma);
	$arma->setNumeroSerie($numeroSerie);
	//$arma->setNumeroBCU($armaBCU);
	$arma->setTipo($tipoArma);
	$arma->setModelo($modelo);
	$arma->setEstado($estado);
	$arma->setUnidad($unidad);
	$arma->setUnidadAgregado($unidadAgregado);
    $arma->setSeccion($seccion); //Variable agregada el 05-05-2015
		
	$objDBArmas = new dbArmas;
	$idNuevo = $objDBArmas->nuevaArma($arma);
	//$resultado = 1;
	
	$arma->setCodigo($idNuevo);
	
	if ($fechaNuevoEstado != ""){
		$fechaPaso 		= explode("-",$fechaNuevoEstado);
   		$fechaIngresar  = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
   		//echo "fechaIngresar " . $fechaIngresar;
		$resultado = $objDBArmas->insertEstadoArma($arma, $fechaIngresar);
	}
			
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
 ?>
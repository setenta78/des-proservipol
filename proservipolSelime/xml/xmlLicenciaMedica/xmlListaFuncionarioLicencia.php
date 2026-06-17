<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
	require("../../baseDatos/dbLicenciaMedica.class.php");
	require("../../objetos/licenciaMedica.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/cargo.class.php");
	require("../../objetos/cuadrante.class.php");
	require("../../objetos/unidad.class.php");
		
	$unidad 	   = $_POST['codigoUnidad'];
	$nombreBuscar  = utf8_decode($_POST['nombreBuscar']);
	
	$sentidoOrden  = $_POST['sentido'];
	$camporOrden   = $_POST['campo'];
	/*
	$escalafon    = $_POST['escalafon'];
	$grado   	  = $_POST['grado'];
	*/
	//$unidad = "2495"; 
	//$nombreBuscar = "4";

	$objFuncionarios = new dbLicencia;
	$objFuncionarios->listaTotalFuncionarios($unidad, $nombreBuscar, $escalafon, $grado, $camporOrden, $sentidoOrden, &$funcionarios);
	$cantidad = count($funcionarios);
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		$inicio=1;
   		$termino=1;

   		$fechaPaso 	= explode("-",$funcionarios[$i]->getTipoLicencia()->getFecha2());
	   	$fechaI			= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	   	$fechaPaso 	= explode("-",$funcionarios[$i]->getTipoLicencia()->getFechaInicioReal());
	   	$fechaIR		= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	   	$fechaPaso 	= explode("-",$funcionarios[$i]->getTipoLicencia()->getFechaTermino());
	   	$fechaT			= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	   	$fechaPaso 	= explode("-",$funcionarios[$i]->getTipoLicencia()->getFechaTerminoReal());
	   	$fechaTR		= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	   	
   		if($fechaI==$fechaIR)$inicio=0;
   		if($fechaT==$fechaTR)$termino=0;
   		
   		echo "<funcionario>";
   		echo "<codigo>".$funcionarios[$i]->getCodigoFuncionario()."</codigo>";
   		echo "<apellidoPaterno>".$funcionarios[$i]->getApellidoPaterno()."</apellidoPaterno>";
   		echo "<apellidoMaterno>".$funcionarios[$i]->getApellidoMaterno()."</apellidoMaterno>";
   		echo "<nombre>".$funcionarios[$i]->getPNombre()."</nombre>";
   		echo "<nombre2>".$funcionarios[$i]->getSNombre()."</nombre2>";
   		echo "<tipoLicencia>".$funcionarios[$i]->getTipoLicencia()->getTipoLicencia()."</tipoLicencia>";
   		echo "<licenciaMedica>".$funcionarios[$i]->getDescripcionLicencia()."</licenciaMedica>";
   		echo "<rut>".$funcionarios[$i]->getTipoLicencia()->getRutFuncionario()."</rut>";
   		echo "<color>".$funcionarios[$i]->getTipoLicencia()->getColor()."</color>";
   		echo "<folio>".$funcionarios[$i]->getTipoLicencia()->getFolio()."</folio>";
   		echo "<archivo>".$funcionarios[$i]->getTipoLicencia()->getArchivoLicenciaMedica()."</archivo>";
   		echo "<fecha_inicio>".$fechaI."</fecha_inicio>";
   		echo "<fecha_termino>".$fechaT."</fecha_termino>";
   		echo "<fecha_inicio_real>".$fechaIR."</fecha_inicio_real>";
   		echo "<fecha_termino_real>".$fechaTR."</fecha_termino_real>";
   		echo "<inicio>".$inicio."</inicio>";
   		echo "<termino>".$termino."</termino>";
   		//echo "<codigoCargo>".$funcionarios[$i]->getCargo()->getCodigo()."</codigoCargo>";
   		//echo "<cargo>".$funcionarios[$i]->getCargo()->getDescripcion()."</cargo>";
   		//echo "<cuadrante>".$funcionarios[$i]->getCuadrante()->getAbreviatura()."</cuadrante>";
   		//echo "<unidadAgregado>".$funcionarios[$i]->getUnidadAgregado()->getDescripcionUnidad()."</unidadAgregado>";
	 	echo "</funcionario>";
 	}
	echo "</root>";
 ?>
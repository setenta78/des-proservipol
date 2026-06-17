<?
	header ('content-type: text/xml');
	include("../configuracionBD4Mysqli.php");
	require("../../baseDatos/dbFuncionarios.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/escalafon.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/cargo.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/seccion.class.php");

	session_start();
	$codigoUnidad			= $_SESSION['USUARIO_CODIGOUNIDAD']; 
	$codigoUsuario			= $_SESSION['USUARIO_CODIGOFUNCIONARIO']; 
	
	$codigoFuncionario		= utf8_decode($_POST['codigoFuncionario']);
	$codigoEscalafon		= $_POST['codigoEscalafon'];
	$codigoGrado			= $_POST['codigoGrado'];
	$codigoCargo			= $_POST['codigoCargo'];
	$codigoCuadrante		= $_POST['codigoCuadrante'];
	$codigoUnidadAgregado	= $_POST['codigoUnidadAgregado'];
	$fechaCargo				= $_POST['fechaCargo'];
	$codigoSecccion			= $_POST['seccion']; 
	$dias					= $_POST['dias'];
	
	if ($codigoUnidadAgregado == "") $codigoUnidadAgregadoPaso = "Null";
	else $codigoUnidadAgregadoPaso = $codigoUnidadAgregado;

	if ($codigoCuadrante == 0) $codigoCuadrante = "Null";

	$unidad = new unidad;
	$unidad->setCodigoUnidad($codigoUnidad);
	$unidad->setDescripcionUnidad("");

	$unidadAgregado = new unidad;
	$unidadAgregado->setCodigoUnidad($codigoUnidadAgregadoPaso);
	$unidadAgregado->setDescripcionUnidad("");

	$escalafon = new escalafon;
	$escalafon->setCodigo($codigoEscalafon);
	$escalafon->setDescripcion("");
	
	$grado = new grado;
	$grado->setEscalafon($escalafon);
	$grado->setCodigo($codigoGrado);
	$grado->setDescripcion("");
	
	$cargo = new cargo;
	$cargo->setCodigo($codigoCargo);
	$cargo->setDescripcion("");
	$cargo->setCuadrante($codigoCuadrante);
	$cargo->setDias($dias);
	
	$cargo->setFechaDesde(null);
	if($fechaCargo!=''){
		$fechaPaso		= explode("-",$fechaCargo);
		$fechaIngresar	= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
		$cargo->setFechaDesde($fechaIngresar);
	}

	$seccion = new seccion;
	$seccion->setCodigo($codigoSecccion);
	$seccion->setDescripcion("");
	
	$funcionario = new funcionario;
	$funcionario->setCodigoFuncionario($codigoFuncionario);
	$funcionario->setGrado($grado);
	$funcionario->setCargo($cargo);
	$funcionario->setUnidad($unidad);
	$funcionario->setUnidadAgregado($unidadAgregado);
	$funcionario->setSeccion($seccion);
	
	$objDBFuncionarios = new dbFuncionarios;
	$resultado = $objDBFuncionarios->actualizarCargoFuncionario_mysqli($funcionario);

	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
 	echo "<resultado>".$resultado."</resultado>";
 	echo "</root>";
 ?>
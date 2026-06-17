<?
	header ('content-type: text/xml');
	include("../configuracionBD4Mysqli.php");
	require("../../baseDatos/dbLicenciaMedica.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/escalafon.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/cargo.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/licenciaMedica.class.php");
	require("../../objetos/servicio.class.php");
	require("../../objetos/tipoServicio.class.php");
	require("../../objetos/tipoServicioExtraordinario.class.php");
	
	session_start();
	$codigoUnidad		= $_SESSION['USUARIO_CODIGOUNIDAD'];
	$codigoUsuario		= $_SESSION['USUARIO_CODIGOFUNCIONARIO'];
	$codigoFuncionario	= utf8_decode(strtoupper($_POST['codigoFuncionario']));
	$rut = $_POST['rut'];
	$color = $_POST['color'];
	$folio = $_POST['folio'];
	$fechaO = $_POST['fechaO'];
	$fechaI = $_POST['fechaI'];
	$dias = $_POST['dias'];
	$rutHijo = $_POST['rutHijo'];
	$fecha3 = $_POST['fecha3'];
	$tipoLicencia = $_POST['tipoLicencia'];
	$recuperacion = $_POST['recuperacion'];
	$invalidez = $_POST['invalidez'];
	$tipoReposo = $_POST['tipoReposo'];
	$lugarReposo = $_POST['lugarReposo'];
	$rutProfesional = $_POST['rutProfesional'];
	$especialidad = $_POST['especialidad'];
	$tipoProfesional = $_POST['tipoProfesional'];
	$atencion = $_POST['atencion'];
	$unidadFuncionario = $_POST['unidadFuncionario'];
	$archivo = $_POST['archivo'];
	$fechaReal = $_POST['fechaReal'];
	$ip = $_POST['ip'];
	$fechaTermino = $_POST['fechaTermino'];
	$fechaRegistro = $_POST['fechaRegistro'];
	$fueraPlazo = $_POST['fueraPlazo'];
	
	$fechaPaso			= explode("-",$fechaO);
	$fechaOtorgamiento	= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	
	$fechaPaso2			= explode("-",$fechaI);
	$fechaInicio		= $fechaPaso2[2] . "-" . $fechaPaso2[1] . "-" . $fechaPaso2[0];
	
	$fechaPaso3			= explode("-",$fecha3);
	$fechaIngresar3		= $fechaPaso3[2] . "-" . $fechaPaso3[1] . "-" . $fechaPaso3[0];
	
	$fechaPasoReal		= explode("-",$fechaReal);
	$fechaIngresarReal	= $fechaPasoReal[2] . "-" . $fechaPasoReal[1] . "-" . $fechaPasoReal[0];
	
	$fechaPasoT				= explode("-",$fechaTermino);
	$fechaIngresarTermino	= $fechaPasoT[2] . "-" . $fechaPasoT[1] . "-" . $fechaPasoT[0];
	
	$funcionario = new licenciaMedica;
	$funcionario->setColor($color);
	$funcionario->setFolio($folio);
	$funcionario->setRutFuncionario($rut);
	$funcionario->setFecha1($fechaOtorgamiento);
	$funcionario->setDias($dias);
	$funcionario->setRutHijo($rutHijo);
	$funcionario->setFecha2($fechaInicio);
	$funcionario->setFecha3($fechaIngresar3);
	$funcionario->setRecuperacion($recuperacion);
	$funcionario->setInvalidez($invalidez);
	$funcionario->setTipoReposo($tipoReposo);
	$funcionario->setLugarReposo($lugarReposo);
	$funcionario->setTipoLicencia($tipoLicencia);
	$funcionario->setRutProfesional($rutProfesional);
	$funcionario->setTipoProfesional($tipoProfesional);
	$funcionario->setEspecialidad($especialidad);
	$funcionario->setAtencion($atencion);
	$funcionario->setUnidad($unidadFuncionario);
	$funcionario->setArchivoLicenciaMedica($archivo);
	$funcionario->setUsuarioProservipol($codigoUsuario);
	$funcionario->setFechaInicioReal($fechaIngresarReal);
	$funcionario->setFechaTermino($fechaIngresarTermino);
	$funcionario->setFechaRegistro($fechaRegistro);
	$funcionario->setIp($ip);
	$funcionario->setCodigoFuncionario($codigoFuncionario);
	$funcionario->setFueraPlazo($fueraPlazo);
	
	$objDBFuncionarios	= new dbLicencia;
	//guardar registro de licencia medica
	$resultado	= $objDBFuncionarios->nuevaLicencia_mysqli($funcionario);
	
	/*
		$listaServicio		= $objDBFuncionarios->cargarListaServicio($funcionario);
		$resultado			= $objDBFuncionarios->insertNuevoServicio($listaServicio);
		$listaFunServicio	= $objDBFuncionarios->cargarListaFuncionarioServicio($funcionario);
		$resultado			= $objDBFuncionarios->insertFuncionariosServicio($listaFunServicio);
	*/
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
	echo "<resultado>".$resultado."</resultado>";
	echo "</root>";
?>
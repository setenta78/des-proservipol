<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbActividadFueraCuartel.class.php");
	require("../../objetos/actividadFueraCuartel.class.php");
	
	session_start();
	$codigoUnidad		= $_SESSION['USUARIO_CODIGOUNIDAD']; 
	$codigoUsuario		= $_SESSION['USUARIO_CODIGOFUNCIONARIO'];
	$codigoFuncionario	= strtoupper($_POST['codigoFuncionario']);
	$rut 				= $_POST['rut'];
	$fechaI 			= $_POST['fechaI'];
	$fechaT				= $_POST['fechaT'];
	$tipo        		= $_POST['tipoActividad'];
	$unidadFuncionario 	= $_POST['unidadFuncionario'];
	$ip 				= $_POST['ip'];
	$fechaRegistro		= $_POST['fechaRegistro'];
	$nDocumento 		= $_POST['nDocumento'];
	$dias 				= $_POST['dias'];
	
	$fechaPaso          = explode("-",$fechaI);
	$fechaI 			= $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];
	
	$fechaPaso2         = explode("-",$fechaT);
	$fechaT             = $fechaPaso2[2] . $fechaPaso2[1] . $fechaPaso2[0];
	
    $fechaPaso3 		= explode("-",$fechaRegistro);
	$fechaRegistro	    = $fechaPaso3[0] . $fechaPaso3[1] . $fechaPaso3[2];
	
	$actividad = new actividadFueraCuartel;
	$actividad->setRutFuncionario($rut);
	$actividad->setFechaInicio($fechaI);
	$actividad->setFechaTermino($fechaT);
	$actividad->setFechaRegistro($fechaRegistro);
	$actividad->setTipoActividad($tipo);
	$actividad->setNumDocumento($nDocumento);
	$actividad->setUnidad($unidadFuncionario);
	$actividad->setUsuarioProservipol($codigoUsuario);
	$actividad->setIp($ip);
	$actividad->setCodigoFuncionario($codigoFuncionario);
	$actividad->setDias($dias);
	
	$objDBActividad	= new dbActividadFueraCuartel;
	$resultado			= $objDBActividad->nuevaActividad($actividad);
    $listaServicio 		= $objDBActividad->cargarListaServicio($actividad);
	$resultado			= $objDBActividad->insertNuevoServicio($listaServicio);
	$listaFunServicio	= $objDBActividad->cargarListaFuncionarioServicio($actividad);
	$resultado			= $objDBActividad->insertFuncionariosServicio($listaFunServicio);
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
	echo "<resultado>".$resultado."</resultado>";
	echo "</root>";
?>
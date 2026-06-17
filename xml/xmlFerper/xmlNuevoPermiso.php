<?
	header ('content-type: text/xml');
	include("../configuracionBD4Mysqli.php"); 
	require("../../baseDatos/dbFerper.class.php");
	require("../../objetos/ferper.class.php");
	
	session_start();
	$codigoUnidad		= $_SESSION['USUARIO_CODIGOUNIDAD']; 
	$codigoUsuario		= $_SESSION['USUARIO_CODIGOFUNCIONARIO'];
	$codigoFuncionario	= utf8_decode(strtoupper($_POST['codigoFuncionario']));
	$rut 				= $_POST['rut'];
	$folio 				= $_POST['folio'];
	$fechaI 			= $_POST['fechaI'];
	$fechaT				= $_POST['fechaT'];
	$tipoPermiso 		= $_POST['tipoPermiso'];
	$unidadFuncionario 	= $_POST['unidadFuncionario'];
	$archivo 			= $_POST['archivo'];
	$ip 				= $_POST['ip'];
	$fechaRegistro		= $_POST['fechaRegistro'];
	$dias 				= $_POST['dias'];
	
	$fechaPaso 			= explode("-",$fechaI);
	$fechaI				 = $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];
	
	$fechaPaso2 		= explode("-",$fechaT);
	$fechaT				= $fechaPaso2[2] . $fechaPaso2[1] . $fechaPaso2[0];
	
	$fechaPaso3 		= explode("-",$fechaRegistro);
	$fechaRegistro		= $fechaPaso3[0] . $fechaPaso3[1] . $fechaPaso3[2];
	
	$permiso = new ferper;
	$permiso->setFolio($folio);
	$permiso->setRutFuncionario($rut);
	$permiso->setFechaInicio($fechaI);
	$permiso->setFechaTermino($fechaT);
	$permiso->setFechaRegistro($fechaRegistro);
	$permiso->setTipoPermiso($tipoPermiso);
	$permiso->setUnidad($unidadFuncionario);
	$permiso->setUsuarioProservipol($codigoUsuario);
	$permiso->setIp($ip);
	$permiso->setCodigoFuncionario($codigoFuncionario);
	$permiso->setArchivoPermiso($archivo);
	$permiso->setDias($dias);
	
	$objDBFuncionarios	= new dbFerper;
	$resultado			= $objDBFuncionarios->nuevoPermiso_mysqli($permiso);
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
	echo "<resultado>".$resultado."</resultado>";
	echo "</root>";
?>
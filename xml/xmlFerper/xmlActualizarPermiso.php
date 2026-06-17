<?
	header ('content-type: text/xml');
	include("../configuracionBD4Mysqli.php");
	require("../../baseDatos/dbFerper.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/escalafon.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/cargo.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/ferper.class.php");
	require("../../objetos/servicio.class.php");
	require("../../objetos/tipoServicio.class.php");
	
	session_start();
	$accion				= $_POST['accion'];
	$folio				= $_POST['folio'];
	$estado				= $_POST['estado'];
	$codigoFuncionario	= $_POST['codigoFuncionario'];
	$tipoPermiso		= $_POST['tipoPermiso'];
	$fechaInicio		= $_POST['fechaInicio'];
	$fechaTermino		= $_POST['fechaTermino'];
	$fechaTerminoReal	= $_POST['fechaTerminoReal'];
	$ipModifica			= $_POST['ipModifica'];
	$usuarioProservipol	= $_POST['usuario'];
	
	$fechaPasoT			= explode("-",$fechaInicio);
	$fechaInicio		= $fechaPasoT[2] . "-" . $fechaPasoT[1] . "-" . $fechaPasoT[0];
	
	$fechaPasoT			= explode("-",$fechaTermino);
	$fechaTermino		= $fechaPasoT[2] . "-" . $fechaPasoT[1] . "-" . $fechaPasoT[0];
	
	$fechaPasoT			= explode("-",$fechaTerminoReal);
	$fechaTerminoReal	= $fechaPasoT[2] . "-" . $fechaPasoT[1] . "-" . $fechaPasoT[0];
	
	$permiso = new ferper;
	$permiso->setFolio($folio);
	$permiso->setCodigoFuncionario($codigoFuncionario);
	$permiso->setTipoPermiso($tipoPermiso);
	$permiso->setIp($ipModifica);
	$permiso->setFechaTermino($fechaTermino);
	$permiso->setFechaTerminoReal($fechaTerminoReal);
	$permiso->setUsuarioProservipol($usuarioProservipol);
	$permiso->setEstadoPermiso($estado);
	$permiso->setFechaInicio($fechaInicio);
	$permiso->setFechaRegistro(date("Y-m-d"));
	
	$objDbPermiso	= new dbFerper;
	
	if($accion=="ANULADA"){
		$resultado	= $objDbPermiso->anularPermiso_mysqli($permiso);
	}
	else if($accion=="SUSPENDIDA"){
		$resultado	= $objDbPermiso->suspenderPermiso_mysqli($permiso);
	}
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
	echo "<resultado>".$resultado."</resultado>";
	echo "</root>";
?>
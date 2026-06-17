<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbActividadFueraCuartel.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/escalafon.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/cargo.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/actividadFueraCuartel.class.php");
    require("../../objetos/servicio.class.php");
	require("../../objetos/tipoServicio.class.php");
	
	session_start();
	$accion				= $_POST['accion'];
	$codActividad		= $_POST['codActividad'];
	$codUnidad			= $_POST['codUnidad'];
	$codigoFuncionario	= $_POST['codigoFuncionario'];
	$tipoActividad		= $_POST['tipoActividad'];
	$fechaInicio		= $_POST['fechaInicio'];
	$fechaTermino		= $_POST['fechaTermino'];
	$fechaTerminoReal	= $_POST['fechaTerminoReal'];
	$ipModifica			= $_POST['ipModifica'];
	$usuarioProservipol	= $_POST['usuario'];
	
	$fechaPasoT 		= explode("-",$fechaInicio);
    $fechaInicio		= $fechaPasoT[2] . "-" . $fechaPasoT[1] . "-" . $fechaPasoT[0];

	$fechaPasoT 		= explode("-",$fechaTermino);
    $fechaTermino		= $fechaPasoT[2] . "-" . $fechaPasoT[1] . "-" . $fechaPasoT[0];

	$fechaPasoT 		= explode("-",$fechaTerminoReal);
    $fechaTerminoReal	= $fechaPasoT[2] . "-" . $fechaPasoT[1] . "-" . $fechaPasoT[0];

	$actividad = new actividadFueraCuartel;
	$actividad->setCodActividadFueraCuartel($codActividad);
    $actividad->setUnidad($codUnidad);
	$actividad->setCodigoFuncionario($codigoFuncionario);
	$actividad->setTipoActividad($tipoActividad);
	$actividad->setIp($ipModifica);
	$actividad->setFechaInicio($fechaInicio);
	$actividad->setFechaTermino($fechaTermino);
	$actividad->setFechaTerminoReal($fechaTerminoReal);
	$actividad->setUsuarioProservipol($usuarioProservipol);
	$actividad->setFechaRegistro(date("Y-m-d"));
	
	$objDbActividad	= new dbActividadFueraCuartel;
	
	if($accion=="ANULADA"){
		$resultado	= $objDbActividad->anularActividad($actividad);
	}
	else if($accion=="SUSPENDIDA"){
		$resultado	= $objDbActividad->suspenderActividad($actividad);
		$actividad->setFechaInicio(date("Y-m-d",strtotime($fechaTerminoReal."+ 1 days")));
	}
	
	$listaServicios = $objDbActividad->cargarListaServicios($actividad);
	$resultado 		= $objDbActividad->borrarFuncionariosServicio($listaServicios);
	$resultado 		= $objDbActividad->deleteServicio($listaServicios);
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
 	echo "<resultado>".$resultado."</resultado>";
 	echo "</root>";
?>
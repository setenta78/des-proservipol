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
	
	session_start();
	$accion 			= $_POST['accion'];
	$color 				= $_POST['color'];
	$folio 				= $_POST['folio'];
	$estado 			= $_POST['estado'];
	$codigoFuncionario	= $_POST['codigoFuncionario'];
	$tipoLicencia		= $_POST['tipoLicencia'];
	$fechaInicioReal 	= $_POST['fechaInicioReal'];
	$fechaTerminoReal 	= $_POST['fechaTerminoReal'];
	$fechaTerminoRealI 	= $_POST['fechaTerminoRealI'];
	
	$fechaPasoT 				= explode("-",$fechaInicioReal);
  	$fechaInicioReal  	= $fechaPasoT[2] . "-" . $fechaPasoT[1] . "-" . $fechaPasoT[0];
	
	$fechaPasoT 				= explode("-",$fechaTerminoReal);
  	$fechaTerminoReal  	= $fechaPasoT[2] . "-" . $fechaPasoT[1] . "-" . $fechaPasoT[0];
	
	$fechaPasoT 				= explode("-",$fechaTerminoRealI);
  	$fechaTerminoRealI  = $fechaPasoT[2] . "-" . $fechaPasoT[1] . "-" . $fechaPasoT[0];
	
	$licencia = new licenciaMedica;
	$licencia->setColor($color);
	$licencia->setFolio($folio);
	$licencia->setCodigoFuncionario($codigoFuncionario);
	$licencia->setTipoLicencia($tipoLicencia);
	$licencia->setFechaInicioReal($fechaInicioReal);
	$licencia->setFechaTermino($fechaTerminoReal);
	$licencia->setFechaTerminoReal($fechaTerminoRealI);
	$licencia->setEstadoLicencia($estado);

	$objDbLicencia 	= new dbLicencia;
	
	if($accion=="ANULADA"){
		$resultado	= $objDbLicencia->anularLicencia_mysqli($licencia);
	}
	else if($accion=="RECORTADA"){
		$resultado = $objDbLicencia->recortarLicencia_mysqli($licencia);
	}

	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
 	echo "<resultado>".$resultado."</resultado>";
 	echo "</root>";
?>
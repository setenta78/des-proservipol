<?
	header ('content-type: text/xml');
	include("../configuracionBDSelime.php"); 
	require("../../baseDatos/dbLicenciaMedica.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/licenciaMedica.class.php");
	
	$rut = $_POST['rut'];
	$color = $_POST['color'];
	$folio = $_POST['folio'];
	$fecha1 = $_POST['fecha1'];
	$fecha2 = $_POST['fecha2'];
	$dias = $_POST['dias'];
	$tipoLicencia = $_POST['tipoLicencia'];
	$atencion = $_POST['atencion'];
	$fechaRegistro = $_POST['fechaRegistro'];
	$rutUsuario	= $_POST['rutUsuario'];
	$reparticionCod	= $_POST['reparticionCod'];
	$reparticionDes	= $_POST['reparticionDes'];
	
	$cant = strlen($folio);
	for($i=10;$i > $cant;$i--){
		$folio = "0".$folio;
	}
	
	$rut = str_replace("-", "", $rut);
	$rut = str_replace(".", "", $rut);
	
	$cant = strlen($rut);
	for($i=9;$i > $cant;$i--){
		$rut = "0".$rut;
	}
	
	$fechaPaso 		= explode("-",$fecha2);
  $fecha2Ing  = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
  
  $fechaPaso 		= explode("-",$fecha1);
  $fecha1Ing  = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	
	$fecha2 = str_replace("-", "", $fecha2Ing);
	$fecha1 = str_replace("-", "", $fecha1Ing);
	$fechaRegistro = str_replace("-", "", $fechaRegistro);
	
	$rutUsuario = str_replace("-", "", $rutUsuario);
	$rutUsuario = str_replace(".", "", $rutUsuario);
	
	$cant = strlen($rutUsuario);
	for($i=9;$i > $cant;$i--){
		$rutUsuario = "0".$rutUsuario;
	}
	
	$funcionario = new licenciaMedica;
	$funcionario->setColor($color);
	$funcionario->setFolio($folio);
	$funcionario->setRutFuncionario($rut);
	$funcionario->setDias($dias);
	$funcionario->setFecha2($fecha2);
	$funcionario->setTipoLicencia($tipoLicencia);
	$funcionario->setAtencion($atencion);
	$funcionario->setFecha1($fecha1);
	$funcionario->setFechaRegistro($fechaRegistro);
	$funcionario->setUsuarioProservipol($rutUsuario);
	
	$unidad = new unidad;
	$unidad->setCodigoUnidad($reparticionCod);
	$unidad->setDescripcionUnidad($reparticionDes);
	
	$funcionario->setUnidad($unidad);
	
	$objDBFuncionarios = new dbLicencia;
	$resultado = $objDBFuncionarios->licenciaSelime($funcionario);
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
 ?>
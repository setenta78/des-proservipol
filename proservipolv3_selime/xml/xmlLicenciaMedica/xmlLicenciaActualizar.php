<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
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

	$codigoFuncionario	= utf8_decode(strtoupper($_POST['codigoFuncionario']));
	$rut = $_POST['rut'];
	$color = $_POST['color'];
	$folio = $_POST['folio'];

	$unidad=$_POST['unidadFuncionario'];
	$listaCorrelativo	= $_POST['correlativo'];
	
	$listaTerminoCorrelativo	= $_POST['correlativoTermino'];
	
	$fechaTermino = $_POST['fechaTerminoReal'];
	$fechaPasoT 		= explode("-",$fechaTermino);
  $fechaIngresarTermino  = $fechaPasoT[2] . "-" . $fechaPasoT[1] . "-" . $fechaPasoT[0];
  
  $fechaInicial = $_POST['fechaInicial'];
 //Diferencia fechas
function dias_transcurridos($fecha_i,$fecha_f)
{
	$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
	$dias 	= abs($dias); $dias = floor($dias);		
	return $dias;
	
}
$diasDiferencia=dias_transcurridos($fechaInicial,$fechaTermino);
//Fin diferencias
	
	
	
	if($fechaTermino == ""){
		$estado = 2;
	}else{
		$estado = 1;
		}
			
	$funcionario = new licenciaMedica;
	$funcionario->setColor($color);
	$funcionario->setFolio($folio);
	$funcionario->setRutFuncionario($rut);
	$funcionario->setEstadoLicencia($estado);
	$funcionario->setUnidad($unidad);
	$funcionario->setCodigoFuncionario($codigoFuncionario);
	$funcionario->setCorrelativo($listaTerminoCorrelativo);
	$funcionario->setDias($diasDiferencia);
	
	if($fechaTermino != ""){
	$funcionario->setFechaTerminoInicial($fechaIngresarTermino);
  }else{
	$funcionario->setCorrelativo($listaCorrelativo);
	}
	
	$objDBFuncionarios = new dbLicencia;
	
	if($fechaTermino != ""){
		
		$resultado = $objDBFuncionarios->updateTerminoReal($funcionario);
		$resultado = $objDBFuncionarios->borrarFuncionariosServicioRecorte($funcionario);
	  $resultado = $objDBFuncionarios->deleteServicioRecorte($funcionario);
	  
	}else{
		
		$resultado = $objDBFuncionarios->updateLicencia($funcionario);
	  $resultado = $objDBFuncionarios->borrarFuncionariosServicio($funcionario);
	  $resultado = $objDBFuncionarios->deleteServicio($funcionario);
		}
	
	//$resultado = $objDBFuncionarios->updateLicencia($funcionario);
	//$resultado = $objDBFuncionarios->borrarFuncionariosServicio($funcionario);
	//$resultado = $objDBFuncionarios->deleteServicio($funcionario);

				
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
?>
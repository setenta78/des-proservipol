<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbLicenciaConducir.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/licenciaConducirMunicipal.class.php");
	require("../../objetos/licenciaConducirSemep.class.php");
	require("../../objetos/tipoClasificacionSemep.class.php");
	require("../../objetos/tipoLicenciaConducir.class.php");
	require("../../objetos/tipoRestriccionConducir.class.php");
	require("../../objetos/tipoEvaluacionSemep.class.php");
	
	$existeLicenciaMunicipal 		= $_POST['existeLicenciaMunicipal'];
	$existeLicenciaSemep 			= $_POST['existeLicenciaSemep'];
	
	$codigoFuncionario 				= $_POST['codigoFuncionario'];
	$municipalComuna				= $_POST['municipalComuna'];
	$municipalNumero				= $_POST['municipalNumero'];
	$municipalFechaUltimoControl	= $_POST['municipalFechaUltimoControl'];
	$municipalFechaProximoControl 	= $_POST['municipalFechaProximoControl'];
	$municipalObservaciones			= $_POST['municipalObservaciones'];
	
	$semepFechaHabilitacion			= $_POST['semepFechaHabilitacion'];
	$semepFechaRenovacion			= $_POST['semepFechaRenovacion'];
	$semepTipoEvaluacion			= $_POST['semepTipoEvaluacion'];
	$semepObservaciones				= $_POST['semepObservaciones'];
	
	$arrayMunicipalClase			= unserialize(stripslashes($_POST['arrayMunicipalClase']));
	$arrayMunicipalRestriccion		= unserialize(stripslashes($_POST['arrayMunicipalRestriccion']));
	$arraySemepVehiculoAutorizado	= unserialize(stripslashes($_POST['arraySemepVehiculoAutorizado']));
	$arraySemepRestriccion			= unserialize(stripslashes($_POST['arraySemepRestriccion']));
	
	$arrayFechaPaso					= explode("-",$municipalFechaUltimoControl);
	$municipalFechaUltimoControl 	= $arrayFechaPaso[2]."-".$arrayFechaPaso[1]."-".$arrayFechaPaso[0];
	
	$arrayFechaPaso					= explode("-",$municipalFechaProximoControl);
	$municipalFechaProximoControl 	= $arrayFechaPaso[2]."-".$arrayFechaPaso[1]."-".$arrayFechaPaso[0];
	
	$arrayFechaPaso					= explode("-",$semepFechaHabilitacion);
	$semepFechaHabilitacion 		= $arrayFechaPaso[2]."-".$arrayFechaPaso[1]."-".$arrayFechaPaso[0];
	
	if ($semepFechaRenovacion != ""){
		$arrayFechaPaso					= explode("-",$semepFechaRenovacion);
		$semepFechaRenovacion 			= $arrayFechaPaso[2]."-".$arrayFechaPaso[1]."-".$arrayFechaPaso[0];
	} else {
		$semepFechaRenovacion = "";
	}
	
	$funcionario = new funcionario;
	$funcionario->setCodigoFuncionario($codigoFuncionario);
	
	$evaluacionSemep = new tipoEvaluacionSemep;
	$evaluacionSemep->setCodigo($semepTipoEvaluacion);
	
	$licenciaMunicipal = new licenciaConducirMunicipal;
	$licenciaMunicipal->setFuncionario($funcionario);
	$licenciaMunicipal->setNumero($municipalNumero);
	$licenciaMunicipal->setComuna($municipalComuna);
	$licenciaMunicipal->setFechaUltimoControl($municipalFechaUltimoControl);
	$licenciaMunicipal->setFechaProximoControl($municipalFechaProximoControl);
	$licenciaMunicipal->setObservaciones($municipalObservaciones);
	
	for ($i=0;$i<count($arrayMunicipalClase);$i++){
		$claseLicenciaConducir = new tipoLicenciaConducir;
		$claseLicenciaConducir->setCodigo($arrayMunicipalClase[$i]);
		$licenciaMunicipal->setClases($claseLicenciaConducir);
	}
	
	for ($i=0;$i<count($arrayMunicipalRestriccion);$i++){
		$restriccionLicenciaConducir = new tipoRestriccionConducir;
		$restriccionLicenciaConducir->setCodigo($arrayMunicipalRestriccion[$i]);
		$licenciaMunicipal->setRestricciones($restriccionLicenciaConducir);
	}
	
	$licenciaSemep = new licenciaConducirSemep;
	$licenciaSemep->setFuncionario($funcionario);
	$licenciaSemep->setEvaluacion($evaluacionSemep);
	$licenciaSemep->setFechaHabilitacion($semepFechaHabilitacion);
	$licenciaSemep->setFechaRenovacion($semepFechaRenovacion);
	$licenciaSemep->setObservaciones($semepObservaciones);
	
	for ($i=0;$i<count($arraySemepVehiculoAutorizado);$i++){
		$vehiculoAutorizadoSemep = new tipoClasificacionSemep;
		$vehiculoAutorizadoSemep->setCodigo($arraySemepVehiculoAutorizado[$i]);
		$licenciaSemep->setVehiculosAutorizados($vehiculoAutorizadoSemep);
	}
	
	for ($i=0;$i<count($arraySemepRestriccion);$i++){
		$restriccionLicenciaConducir = new tipoRestriccionConducir;
		$restriccionLicenciaConducir->setCodigo($arraySemepRestriccion[$i]);
		$licenciaSemep->setRestricciones($restriccionLicenciaConducir);
	}
	
	$licenciasDeConducir[0] = $licenciaMunicipal;
	$licenciasDeConducir[1] = $licenciaSemep;
	
	$objDBLicenciasDeConducir = new dbLicenciaConducir;
	
	$resultado = $objDBLicenciasDeConducir->deleteLicenciaConducirMunicipal($funcionario);
	$resultado = $objDBLicenciasDeConducir->deleteLicenciaConducirSemep($funcionario);
	
	$resultado = ($existeLicenciaMunicipal==1) ? $objDBLicenciasDeConducir->insertLicenciaConducirMunicipal($licenciasDeConducir[0]): 0;
	$resultado = ($existeLicenciaSemep==1) ? $objDBLicenciasDeConducir->insertLicenciaConducirSemep($licenciasDeConducir[1]) : 0;
	
	$resultado = 1;
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  echo "<root>";
  echo "<resultado>".$resultado."</resultado>";
  echo "</root>";
?>
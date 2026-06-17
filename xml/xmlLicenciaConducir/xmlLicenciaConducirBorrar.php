<?  
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbLicenciaConducir.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/licenciaConducirMunicipal.class.php");
	require("../../objetos/licenciaConducirSemep.class.php");
	
	$existeLicenciaMunicipal 		= $_POST['existeLicenciaMunicipal'];
	$existeLicenciaSemep 			= $_POST['existeLicenciaSemep'];
	$noTieneLicencia 				= $_POST['noTieneLicencia'];
	
	$codigoFuncionario 				= $_POST['codigoFuncionario'];
	$municipalNumero				= $_POST['municipalNumero'];
	$semepFechaHabilitacion			= $_POST['semepFechaHabilitacion'];
	
	$nombreArchivo					= $_POST['nombreArchivo'];
	
	$arrayFechaPaso					= explode("-",$semepFechaHabilitacion);
	$semepFechaHabilitacion 		= $arrayFechaPaso[2]."-".$arrayFechaPaso[1]."-".$arrayFechaPaso[0];
	
	$funcionario = new funcionario;
	$funcionario->setCodigoFuncionario($codigoFuncionario);
	
	$licenciaMunicipal = new licenciaConducirMunicipal;
	$licenciaMunicipal->setFuncionario($funcionario);
	$licenciaMunicipal->setNumero($municipalNumero);
	
	$licenciaSemep = new licenciaConducirSemep;
	$licenciaSemep->setFuncionario($funcionario);
	$licenciaSemep->setFechaHabilitacion($semepFechaHabilitacion);
	
	$licenciasDeConducir[0] = $licenciaMunicipal;
	$licenciasDeConducir[1] = $licenciaSemep;
	
	$objDBLicenciasDeConducir = new dbLicenciaConducir;
	if ($existeLicenciaMunicipal == 1)	{
		$resultado = $objDBLicenciasDeConducir->deleteLicenciaConducirMunicipal($funcionario);
		if ($nombreArchivo != "") $resultado = $objDBLicenciasDeConducir->deleteArchivoSubido($codigoFuncionario, 'MUNICIPAL', utf8_decode($nombreArchivo));
	}
	
	if ($existeLicenciaSemep == 1) {
		$resultado = $objDBLicenciasDeConducir->deleteLicenciaConducirSemep($funcionario);
		if ($nombreArchivo != "") $resultado = $objDBLicenciasDeConducir->deleteArchivoSubido($codigoFuncionario, 'SEMEP', utf8_decode($nombreArchivo));
	}
	
	if ($noTieneLicencia == 1) 	$resultado = $objDBLicenciasDeConducir->deleteArchivoSubido($codigoFuncionario, 'NO TIENE', utf8_decode($nombreArchivo));
	
	//if ($nombreArchivo != "") unlink("../../archivos/".utf8_decode($nombreArchivo));
	
	$resultado = 1;
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
?>
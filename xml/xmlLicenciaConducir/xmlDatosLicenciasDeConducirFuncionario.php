<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbLicenciaConducir.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/cargo.class.php");
	require("../../objetos/cuadrante.class.php");
	require("../../objetos/comuna.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/tipoEvaluacionSemep.class.php");
	require("../../objetos/licenciaConducirSemep.class.php");
	require("../../objetos/licenciaConducirMunicipal.class.php");
	require("../../objetos/tipoLicenciaConducir.class.php");
	require("../../objetos/tipoRestriccionConducir.class.php");
	require("../../objetos/tipoClasificacionSemep.class.php");
	
		
	$codigoFuncionario  = $_POST['codigoFuncionario'];
	//$codigoFuncionario = "933395M";
	
	$objFuncionariosLicenciasConducir = new dbLicenciaConducir;
	$objFuncionariosLicenciasConducir->buscaLicenciasFuncionario($codigoFuncionario, &$funcionario);
	
	//echo "lll " . $funcionario . " hhh";
	
	if ($funcionario->getLicenciaConducirMunicipal()->getNumero() != ""){
		$objFuncionariosLicenciasConducir->buscaClaseLCMunicipalFuncionario($codigoFuncionario, &$funcionario);
		$objFuncionariosLicenciasConducir->buscaRestriccionLCMunicipalFuncionario($codigoFuncionario, &$funcionario);
	}
	
	if ($funcionario->getLicenciaSemep()->getFechaHabilitacion() != ""){
		$objFuncionariosLicenciasConducir->buscaVehiculosPermitidosSemep($codigoFuncionario, &$funcionario);
		$objFuncionariosLicenciasConducir->buscaRestriccionesSemep($codigoFuncionario, $funcionario);
	}
	$cantidad = count($funcionario);
	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<funcionario>";
   		echo "<codigo>".$funcionario->getCodigoFuncionario()."</codigo>";
   		echo "<apellidoPaterno>".$funcionario->getApellidoPaterno()."</apellidoPaterno>";
   		echo "<apellidoMaterno>".$funcionario->getApellidoMaterno()."</apellidoMaterno>";
   		echo "<nombre>".$funcionario->getPNombre()."</nombre>";
   		echo "<nombre2>".$funcionario->getSNombre()."</nombre2>";
   		echo "<grado>".$funcionario->getGrado()->getDescripcion()."</grado>";
   		echo "<codigoCargo>".$funcionario->getCargo()->getCodigo()."</codigoCargo>";
   		echo "<cargo>".$funcionario->getCargo()->getDescripcion()."</cargo>";
   		
   		echo "<tieneLicencia>".$funcionario->getTieneLicencia()."</tieneLicencia>";
   		echo "<archivoLicencia>".$funcionario->getArchivoLicencia()."</archivoLicencia>";
   		
   		
   		echo "<licenciaConducirMunicipal>";
   		echo "<numeroLCMunicipal>".$funcionario->getLicenciaConducirMunicipal()->getNumero()."</numeroLCMunicipal>";
   		echo "<codigoComuna>".$funcionario->getLicenciaConducirMunicipal()->getComuna()->getCodigoComuna()."</codigoComuna>";
   		echo "<descripcionComuna>".$funcionario->getLicenciaConducirMunicipal()->getComuna()->getDescripcionComuna()."</descripcionComuna>";
   		echo "<fechaUltimoControlLCMunicipal>".$funcionario->getLicenciaConducirMunicipal()->getFechaUltimoControl()."</fechaUltimoControlLCMunicipal>";
   		echo "<fechaControlLCMunicipal>".$funcionario->getLicenciaConducirMunicipal()->getFechaProximoControl()."</fechaControlLCMunicipal>";
   		echo "<observacionesLCMunicipal>".$funcionario->getLicenciaConducirMunicipal()->getObservaciones()."</observacionesLCMunicipal>";
   		
   		echo "<clasesLM>";
   		for ($j=0; $j<$funcionario->getLicenciaConducirMunicipal()->getCantidadDeClases(); $j++){
   			echo "<codigoClase>".$funcionario->getLicenciaConducirMunicipal()->getClases($j)->getCodigo()."</codigoClase>";
   			echo "<descripcionClase>".$funcionario->getLicenciaConducirMunicipal()->getClases($j)->getDescripcion()."</descripcionClase>";  
   		}
   		echo "</clasesLM>";
   		
   		echo "<restriccionLM>";
   		for ($k=0; $k<$funcionario->getLicenciaConducirMunicipal()->getCantidadDeRestricciones(); $k++){
   			echo "<codigoRestriccionLM>".$funcionario->getLicenciaConducirMunicipal()->getRestricciones($k)->getCodigo()."</codigoRestriccionLM>";
   			echo "<descripcionRestriccionLM>".$funcionario->getLicenciaConducirMunicipal()->getRestricciones($k)->getDescripcion()."</descripcionRestriccionLM>";  
   		}
   		echo "</restriccionLM>";
   		
   		echo "</licenciaConducirMunicipal>";
   		
   		
   		
   		
   		echo "<licenciaConducirSemep>";
   		echo "<codigoEvaluacion>".$funcionario->getLicenciaSemep()->getEvaluacion()->getCodigo()."</codigoEvaluacion>";
   		echo "<descripcionEvaluacion>".$funcionario->getLicenciaSemep()->getEvaluacion()->getDescripcion()."</descripcionEvaluacion>";
   		echo "<fechaHabilitacionLCSemep>".$funcionario->getLicenciaSemep()->getFechaHabilitacion()."</fechaHabilitacionLCSemep>";
   		echo "<fechaRenovacionLCSemep>".$funcionario->getLicenciaSemep()->getFechaRenovacion()."</fechaRenovacionLCSemep>";
   		echo "<observacionesLCSemep>".$funcionario->getLicenciaSemep()->getObservaciones()."</observacionesLCSemep>";
   		
   		echo "<vehiculosAutorizadosSemep>";
   		for ($l=0; $l<$funcionario->getLicenciaSemep()->getCantidadDeVehiculosAutorizados(); $l++){
   			echo "<codigoVehiculoAutorizado>".$funcionario->getLicenciaSemep()->getVehiculosAutorizados($l)->getCodigo()."</codigoVehiculoAutorizado>";
   			echo "<descripcionVehiculoAutorizado>".$funcionario->getLicenciaSemep()->getVehiculosAutorizados($l)->getDescripcion()."</descripcionVehiculoAutorizado>";  
   		}
   		echo "</vehiculosAutorizadosSemep>";
   		
   		echo "<restriccionLS>";
   		for ($k=0; $k<$funcionario->getLicenciaSemep()->getCantidadDeRestricciones(); $k++){
   			echo "<codigoRestriccionLS>".$funcionario->getLicenciaSemep()->getRestricciones($k)->getCodigo()."</codigoRestriccionLS>";
   			echo "<descripcionRestriccionLS>".$funcionario->getLicenciaSemep()->getRestricciones($k)->getDescripcion()."</descripcionRestriccionLS>";  
   		}
   		echo "</restriccionLS>";
   		
   		echo "</licenciaConducirSemep>";
	 	echo "</funcionario>";
 	}
	echo "</root>";
 ?>
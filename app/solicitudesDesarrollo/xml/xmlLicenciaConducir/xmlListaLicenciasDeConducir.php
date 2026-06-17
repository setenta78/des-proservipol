<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
	require("../../baseDatos/dbLicenciaConducir.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/cargo.class.php");
	require("../../objetos/comuna.class.php");
	require("../../objetos/cuadrante.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/licenciaConducirSemep.class.php");
	require("../../objetos/licenciaConducirMunicipal.class.php");
		
	$unidad 	   = $_POST['codigoUnidad'];
	$sentidoOrden  = $_POST['sentido'];
	$camporOrden   = $_POST['campo'];
	
	//$unidad = "9560"; 
	//$nombreBuscar = "4";

	$objFuncionariosLicenciasConducir = new dbLicenciaConducir;
	$objFuncionariosLicenciasConducir->listaLicenciasDeConducir($unidad, $camporOrden, $sentidoOrden, &$funcionarios);
	$cantidad = count($funcionarios);
	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<funcionario>";
   		echo "<codigo>".$funcionarios[$i]->getCodigoFuncionario()."</codigo>";
   		echo "<apellidoPaterno>".$funcionarios[$i]->getApellidoPaterno()."</apellidoPaterno>";
   		echo "<apellidoMaterno>".$funcionarios[$i]->getApellidoMaterno()."</apellidoMaterno>";
   		echo "<nombre>".$funcionarios[$i]->getPNombre()."</nombre>";
   		echo "<nombre2>".$funcionarios[$i]->getSNombre()."</nombre2>";
   		echo "<grado>".$funcionarios[$i]->getGrado()->getDescripcion()."</grado>";
   		echo "<codigoCargo>".$funcionarios[$i]->getCargo()->getCodigo()."</codigoCargo>";
   		echo "<cargo>".$funcionarios[$i]->getCargo()->getDescripcion()."</cargo>";
   		echo "<cuadrante>".$funcionarios[$i]->getCuadrante()->getAbreviatura()."</cuadrante>";
   		echo "<fechaControlLCMunicipal>".$funcionarios[$i]->getLicenciaConducirMunicipal()->getFechaProximoControl()."</fechaControlLCMunicipal>";
   		echo "<comuna>".$funcionarios[$i]->getLicenciaConducirMunicipal()->getComuna()->getDescripcionComuna()."</comuna>";
   		echo "<fechaControlLCSemep>".$funcionarios[$i]->getLicenciaSemep()->getFechaRenovacion()."</fechaControlLCSemep>";
   		echo "<tieneLicencia>".$funcionarios[$i]->getTieneLicencia()."</tieneLicencia>";
   		echo "<archivoLicencia>".$funcionarios[$i]->getArchivoLicencia()."</archivoLicencia>";
	 	echo "</funcionario>";
 	}
	echo "</root>";
 ?>
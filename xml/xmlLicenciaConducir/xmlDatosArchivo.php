<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbLicenciaConducir.class.php");
	
	$codigoFuncionario  = $_POST['codigoFuncionario'];
	$tipo  				= $_POST['tipo'];
	$nombreArchivo  	= $_POST['nombreArchivo'];
	
	$objFuncionariosLicenciasConducir = new dbLicenciaConducir;
	$objFuncionariosLicenciasConducir->deleteArchivoSubido($codigoFuncionario);
	$objFuncionariosLicenciasConducir->insertArchivoSubido($codigoFuncionario, $tipo, utf8_decode($nombreArchivo));
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  echo "<root>";
  echo "<resultado>1</resultado>";
  echo "</root>";
?>
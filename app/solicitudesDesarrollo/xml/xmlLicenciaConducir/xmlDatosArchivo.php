<?
	header ('content-type: text/xml');   
	include("../configuracionBD2.php"); 
	require("../../baseDatos/dbLicenciaConducir.class.php");
		
	$codigoFuncionario  = $_POST['codigoFuncionario'];
	$tipo  				= $_POST['tipo'];
	$nombreArchivo  	= $_POST['nombreArchivo'];
	//$codigoFuncionario = "022180L";
	
	
	function normaliza($cadena){
	    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr';
	    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
	    $cadena = utf8_decode($cadena);
	    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
	    $cadena = strtolower($cadena);
	    return utf8_encode($cadena);
	}

	
	
	
	//$nombreArchivo = normaliza($nombreArchivo);
	$objFuncionariosLicenciasConducir = new dbLicenciaConducir;
	$objFuncionariosLicenciasConducir->insertArchivoSubido($codigoFuncionario, $tipo, utf8_decode($nombreArchivo));


	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>1</resultado>";
   	echo "</root>";
?>
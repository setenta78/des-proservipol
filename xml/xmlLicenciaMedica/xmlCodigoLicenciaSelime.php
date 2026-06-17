<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbLicenciaMedica.class.php");
	require("../../objetos/tipoServicio.class.php");
	
	$codigo = $_POST['tipoLicencia'];
	
	//$codigo=633;
		
	$objLicencia = new dbLicencia;
	$objLicencia->codigoLicenciaSelime($codigo, &$tipoLicencia);
	$cantidad = count($tipoLicencia);
  	if ($cantidad > 0){
	  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	  	echo "<root>";
	   	for ($i=0; $i < $cantidad; $i++){	   			   		
	   	echo "<tipoLicencia>";
	   		echo "<codigo>".$tipoLicencia[$i]->getCodigo()."</codigo>";     
		 	echo "</tipoLicencia>";
	 	}
		echo "</root>";
	} else {
		echo "VACIO";
	}
 ?>
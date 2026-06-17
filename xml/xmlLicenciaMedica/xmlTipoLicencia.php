<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbLicenciaMedica2.class.php");
	require("../../objetos/tipoServicio.class.php");
		
	$objLicencia = new dbLicencia;
	$objLicencia->buscaTipoLicencia(&$tipoServicio);
	$cantidad = count($tipoServicio);
  	if ($cantidad > 0){
	  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	  	echo "<root>";
	   	for ($i=0; $i < $cantidad; $i++){
	   			   		
	   	echo "<tipo>";
	   		echo "<codigo>".$tipoServicio[$i]->getCodigo()."</codigo>";
	   		echo "<descripcion>".$tipoServicio[$i]->getDescripcion()."</descripcion>";        
		 	echo "</tipo>";
	 	}
		echo "</root>";
	} else {
		echo "VACIO";
	}
 ?>
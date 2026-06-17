<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbTipoLicenciaConducir.class.php");
	require("../../objetos/tipoLicenciaConducir.class.php");
		
	$objTipoLicenciaConducir = new dbTipoLicenciaConducir;
	$objTipoLicenciaConducir->listaTipoLicenciaConducir(&$tiposDeLicenciaConducir);
	$cantidad = count($tiposDeLicenciaConducir);
	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
  	echo "<tiposDeLicenciaConducir>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<licenciaConducir>";
   		echo "<codigo>".$tiposDeLicenciaConducir[$i]->getCodigo()."</codigo>";
   		echo "<descripcion>".$tiposDeLicenciaConducir[$i]->getDescripcion()."</descripcion>";
	 	echo "</licenciaConducir>";
 	}           
 	echo "</tiposDeLicenciaConducir>";   
	echo "</root>";
 ?>
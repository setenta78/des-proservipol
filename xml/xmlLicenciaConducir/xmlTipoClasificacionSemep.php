<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbTipoClasificacionSemep.class.php");
	require("../../objetos/tipoClasificacionSemep.class.php");
		
	$objTipoClasificacionSemep = new dbTipoClasificacionSemep;
	$objTipoClasificacionSemep->listaTipoClasificacionSemep(&$tiposClasificacionSemep);
	$cantidad = count($tiposClasificacionSemep);
	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
  	echo "<tiposDeClasificacionSemep>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<clasificacionSemep>";
   		echo "<codigo>".$tiposClasificacionSemep[$i]->getCodigo()."</codigo>";
   		echo "<descripcion>".$tiposClasificacionSemep[$i]->getDescripcion()."</descripcion>";
	 	echo "</clasificacionSemep>";
 	}           
 	echo "</tiposDeClasificacionSemep>";   
	echo "</root>";
 ?>
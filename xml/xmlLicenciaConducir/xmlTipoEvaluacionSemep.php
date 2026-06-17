<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbTipoEvaluacionSemep.class.php");
	require("../../objetos/tipoEvaluacionSemep.class.php");
		
	$objTipoEvaluacionSemep = new dbTipoEvaluacionSemep;
	$objTipoEvaluacionSemep->listaTipoEvaluacionSemep(&$tiposEvaluacionSemep);
	$cantidad = count($tiposEvaluacionSemep);
	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<tipoEvaluacionSemep>";
   		echo "<codigo>".$tiposEvaluacionSemep[$i]->getCodigo()."</codigo>";
   		echo "<descripcion>".$tiposEvaluacionSemep[$i]->getDescripcion()."</descripcion>";
	 	echo "</tipoEvaluacionSemep>";
 	}           
	echo "</root>";
 ?>
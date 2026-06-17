<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbSecciones.class.php");
	require("../../objetos/seccion.class.php");

	$objFactorDemanda = new dbSeccion;
	$objFactorDemanda->listaSecciones(&$factoresDemanda);
	$cantidad = count($factoresDemanda);
	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<problema>";
   		echo "<codigo>".$factoresDemanda[$i]->getCodigo()."</codigo>";
   		echo "<descripcion>".$factoresDemanda[$i]->getDescripcion()."</descripcion>";
	 	echo "</problema>";
 	}
	echo "</root>";
 ?>
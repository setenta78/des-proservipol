<?
	header ('content-type: text/xml');
  	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbClasificacionCitacion.class.php");
	require("../../objetos/clasificacionCitacion.class.php");
	
	$objClasificacionCitacion = new dbClasificacionCitacion;
	$objClasificacionCitacion->listaClasificacionCitacion(&$clasificacionCitacion);
	$cantidad = count($clasificacionCitacion);
	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<clasificacionCitacion>";
   		echo "<codigo>".$clasificacionCitacion[$i]->getCodigo()."</codigo>";
   		echo "<descripcion>".$clasificacionCitacion[$i]->getDescripcion()."</descripcion>";
	 	echo "</clasificacionCitacion>";
 	}
	echo "</root>";
?>
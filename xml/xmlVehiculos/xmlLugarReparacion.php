<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbLugarReparacion.class.php");
	require("../../objetos/lugarReparacion.class.php");
		
	$objLugarReparacion = new dbLugarReparacion;
	$objLugarReparacion->listaLugarReparacion(&$lugaresDeReparacion);
	$cantidad = count($lugaresDeReparacion);
	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<lugarReparacion>";
   		echo "<codigo>".$lugaresDeReparacion[$i]->getCodigo()."</codigo>";
   		echo "<descripcion>".$lugaresDeReparacion[$i]->getDescripcion()."</descripcion>";
	 	echo "</lugarReparacion>";
 	}
	echo "</root>";
 ?>
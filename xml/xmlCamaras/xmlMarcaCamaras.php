<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbMarcaCamaras.class.php");
	require("../../objetos/marcaCamara.class.php");

	$objMarca = new dbMarcaCamaras;
	$objMarca->listaMarcasCamaras(&$marcas);
	$cantidad = count($marcas);
	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<marca>";
   		echo "<codigo>".$marcas[$i]->getCodigo()."</codigo>";
   		echo "<descripcion>".$marcas[$i]->getDescripcion()."</descripcion>";
	 	echo "</marca>";
 	}
	echo "</root>";
 ?>
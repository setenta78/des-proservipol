<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbTipoAccesorio.class.php");
	require("../../objetos/tipoAccesorio.class.php");

	$objTipo = new dbTipoAccesorio;
	$objTipo->listaTipoAccesorio(&$tipoAccesorios);
	$cantidad = count($tipoAccesorios);
	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<tipoAccesorio>";
   		echo "<codigo>".$tipoAccesorios[$i]->getCodigo()."</codigo>";
   		echo "<descripcion>".$tipoAccesorios[$i]->getDescripcion()."</descripcion>";
	 	echo "</tipoAccesorio>";
 	}
	echo "</root>";
 ?>
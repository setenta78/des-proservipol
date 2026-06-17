<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbTipoAnimal.class.php");
	require("../../objetos/tipoAnimal.class.php");

	$objTipo = new dbTipoAnimal;
	$objTipo->listaTipoAnimal(&$tipoAnimales);
	$cantidad = count($tipoAnimales);
	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<tipoAnimal>";
   		echo "<codigo>".$tipoAnimales[$i]->getCodigo()."</codigo>";
   		echo "<descripcion>".$tipoAnimales[$i]->getDescripcion()."</descripcion>";
	 	echo "</tipoAnimal>";
 	}
	echo "</root>";
 ?>
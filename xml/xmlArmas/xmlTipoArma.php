<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbTipoArma.class.php");
	require("../../objetos/tipoArma.class.php");
		
	$objTipo = new dbTipoArma;
	$objTipo->listaTipoArma(&$tipoArmas);
	$cantidad = count($tipoArmas);
	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<tipoArma>";
   		echo "<codigo>".$tipoArmas[$i]->getCodigo()."</codigo>";
   		echo "<descripcion>".$tipoArmas[$i]->getDescripcion()."</descripcion>";
	 	echo "</tipoArma>";
 	}
	echo "</root>";
 ?>
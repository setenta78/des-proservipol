<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbModeloArma.class.php");
	require("../../objetos/modeloArma.class.php");
	require("../../objetos/marcaArma.class.php");

	$marca = $_POST["marca"];
	
	//$marca = "10";
		
	$objModelo = new dbModeloArma;
	$objModelo->listaModelosArmas($marca, &$modelos);
	$cantidad = count($modelos);
	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<modelo>";
   		echo "<codigoMarca>".$modelos[$i]->getMarcaArma()->getCodigo()."</codigoMarca>";
   		echo "<descripcionMarca>".$modelos[$i]->getMarcaArma()->getDescripcion()."</descripcionMarca>";
   		echo "<codigoModelo>".$modelos[$i]->getCodigo()."</codigoModelo>";
   		echo "<descripcionModelo>".$modelos[$i]->getDescripcion()."</descripcionModelo>";
	 	echo "</modelo>";
 	}
	echo "</root>";
 ?>
<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbSubproblema.class.php");
	require("../../objetos/problema.class.php");
	require("../../objetos/subproblema.class.php");

	$marca = $_POST["marca"];
	
	//$marca = "003";
		
	$objModelo = new dbSubproblema;
	$objModelo->listaSubproblemas($marca, &$modelos);
	$cantidad = count($modelos);
	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<subproblema>";
   		echo "<codigoMarca>".$modelos[$i]->getProblemaSolicitud()->getCodigo()."</codigoMarca>";
   		echo "<codigoModelo>".$modelos[$i]->getCodigo()."</codigoModelo>";
   		echo "<descripcionModelo>".$modelos[$i]->getDescripcion()."</descripcionModelo>";
	 	echo "</subproblema>";
 	}
	echo "</root>";
 ?>
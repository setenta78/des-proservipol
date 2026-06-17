<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbFactorDemanda.class.php");
	require("../../objetos/factor.class.php");

	$objFactorDemanda = new dbFactorDemanda;
	$objFactorDemanda->listaFactorDemanda(&$factoresDemanda);
	$cantidad = count($factoresDemanda);
	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<factor>";
   		echo "<codigo>".$factoresDemanda[$i]->getCodigo()."</codigo>";
   		echo "<descripcion>".$factoresDemanda[$i]->getDescripcion()."</descripcion>";
   		echo "<abreviatura>".$factoresDemanda[$i]->getAbreviatura()."</abreviatura>";
	 	echo "</factor>";
 	}
	echo "</root>";
 ?>
<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbMovimiento.class.php");
	require("../../objetos/movimiento.class.php");

  $tipo = $_POST['tipo'];

	$objFactorDemanda = new dbMovimiento;
	$objFactorDemanda->listaMovimiento(&$factoresDemanda, $tipo);
	$cantidad = count($factoresDemanda);
	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<movimiento>";
   		echo "<codigo>".$factoresDemanda[$i]->getCodigo()."</codigo>";
   		echo "<descripcion>".$factoresDemanda[$i]->getDescripcion()."</descripcion>";
	 	echo "</movimiento>";
 	}
	echo "</root>";
 ?>
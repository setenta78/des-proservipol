<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); ;
	require("../../baseDatos/dbGrados.class.php");
	require("../../objetos/escalafon.class.php");
		
	//$unidad = $_POST['codigoUnidad'];
	//$fecha1 = $_POST['fecha1'];
	//$fecha2	= $_POST['fecha2'];
	
	$objEscalafon = new dbGrados;
	$objEscalafon->listaEscalafones(&$escalafones);
	$cantidad = count($escalafones);
	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<escalafon>";
   		echo "<codigo>".$escalafones[$i]->getCodigo()."</codigo>";
   		echo "<descripcion>".$escalafones[$i]->getDescripcion()."</descripcion>";
	 	echo "</escalafon>";
 	}
	echo "</root>";
 ?>
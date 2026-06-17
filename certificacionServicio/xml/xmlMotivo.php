<?
	header ('content-type: text/xml');
	include("../../inc/configV4.inc.php");
	include("../../baseDatos/Conexion.class.php");
	require("../baseDatos/dbMotivos.class.php");
	require("../../objetos/motivo.class.php");
	
	$objMotivos = new dbMotivo;
	$objMotivos->listaMotivos(&$motivos);
	$cantidad = count($motivos);
	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<motivo>";
   		    echo "<codigo>".$motivos[$i]->getCodigo()."</codigo>";
   		    echo "<descripcion>".$motivos[$i]->getDescripcion()."</descripcion>";
	 	echo "</motivo>";
 	}
	echo "</root>";

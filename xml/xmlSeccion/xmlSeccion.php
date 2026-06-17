<?
	header ('content-type: text/xml');
  	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbSeccion.class.php");
	require("../../objetos/seccion.class.php");
	
	$unidad = $_POST['unidadUsuario'];

	$objSeccion = new dbSeccion;
	$objSeccion->listaSeccion($unidad,&$secciones);
	$cantidad = count($secciones);
	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<seccion>";
   		echo "<codigo>".$secciones[$i]->getCodigo()."</codigo>";
   		echo "<descripcion>".$secciones[$i]->getDescripcion()."</descripcion>";
	 	echo "</seccion>";
 	}
	echo "</root>";
?>
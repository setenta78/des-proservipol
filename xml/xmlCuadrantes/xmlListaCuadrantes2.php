<?//Lista cuadrantes sin el cuadrante OTROS y con demanda
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbCuadrantes2.class.php");
	require("../../objetos/cuadrante2.class.php");
	require("../../objetos/unidad.class.php");

	$codigoUnidad = $_POST['codigoUnidad'];
	//$codigoUnidad = 10;

	$objCuadrante = new dbCuadrantes;
	$objCuadrante->listaCuadrantesUnidad($codigoUnidad, &$unidad);
	$cantidad = $unidad->getCantidadCuadrantes();
	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<cuadrante>";
   		echo "<codigo>".$unidad->getCuadrantes($i)->getCodigo()."</codigo>";
   		echo "<descripcion>".$unidad->getCuadrantes($i)->getDescripcion()."</descripcion>";
   		echo "<abreviatura>".$unidad->getCuadrantes($i)->getAbreviatura()."</abreviatura>";
   		echo "<demanda>".$unidad->getCuadrantes($i)->getDemanda()."</demanda>";
	 	echo "</cuadrante>";
 	}
	echo "</root>";
 ?>
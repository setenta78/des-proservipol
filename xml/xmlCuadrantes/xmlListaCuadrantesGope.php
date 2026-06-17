<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbCuadrantes.class.php");
	require("../../objetos/cuadrante.class.php");
	require("../../objetos/unidad.class.php");

	$codigoUnidad = $_POST['codigoUnidad'];
	$tipoUnidad = $_POST['tipoUnidad']; //Añadido recien 
	$unidadUsuario			= $_POST['unidadUsuario']; 
	$correlativo 			= $_POST['correlativo'];
	//echo $contieneHijos;
	
	//$codigoUnidad = 10;

	$objCuadrante = new dbCuadrantes;
	$objCuadrante->listaCuadrantesUnidad($codigoUnidad, &$unidad);
	$cantidad = $unidad->getCantidadCuadrantes();
	//If añadido
	if ($cantidad>0) {
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<cuadrante>";
		echo "<unidadPadre>".$unidad->getPadreUnidad()."</unidadPadre>";
		echo "<unidadCuadrantes>".$unidad->getCodigoUnidad()."</unidadCuadrantes>";
		echo "<unidadDescripcion>".$unidad->getDescripcionUnidad()."</unidadDescripcion>";
   	echo "<codigo>".$unidad->getCuadrantes($i)->getCodigo()."</codigo>";
   	echo "<descripcion>".$unidad->getCuadrantes($i)->getDescripcion()."</descripcion>";
   	echo "<abreviatura>".$unidad->getCuadrantes($i)->getAbreviatura()."</abreviatura>";
		echo "<descUni>".$unidad->getCuadrantes($i)->getDescUni()."</descUni>";
	 	echo "</cuadrante>";
 	}
	echo "</root>";
	}else {
		echo "VACIO";
	}
 ?>
<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbCargos.class.php");
	require("../../objetos/categoriaCargo.class.php");
	
	$tipoUnidad = $_POST['tipoUnidad'];
	$unidadTipo = $_POST['UnidadTipo'];
	$escalafon	= $_POST['escalafon'];
	$grado		= $_POST['grado'];
	
	$tipoUnidadNew = $_POST['tipoUnidadNew'];
	$especialidadUnidadNew = $_POST['especialidadUnidadNew'];
	
	if (($unidadEspecialidad <> 30 || ($unidadEspecialidad == 30 and $tipoUnidad == 60)) and $tipoUnidad <> 20 and $tipoUnidad <> 30 and $tipoUnidad <> 120 and $tipoUnidad <> 135 and $tipoUnidad <> 140 and $tipoUnidad <> 160 and $tipoUnidad <> 90 and $tipoUnidad <> 150 and $tipoUnidad <> 180 and $tipoUnidad <> 170 and $tipoUnidad <> 200) $tipoUnidad = 33;
	
	$objCargo = new dbCargos;
	$objCargo->listaCategoriaCargos($tipoUnidad,$unidadTipo,$escalafon,$grado,$tipoUnidadNew,$especialidadUnidadNew,&$categorias);
	$cantidad = count($categorias);
	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<categoriaCargo>";
   		echo "<descripcion>".$categorias[$i]->getDescripcion()."</descripcion>";
	 	echo "</categoriaCargo>";
 	}
	echo "</root>";
 ?>
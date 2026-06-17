<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
	require("../../baseDatos/dbCargos.class.php");
	require("../../objetos/cargo.class.php");
    
    $tipoUnidad= $_POST['tipoUnidad']; //Variable agregada el 30-04-2015
    
    //Condicion agregada el 30-04-2015
    if ($tipoUnidad <> 30 and $tipoUnidad <> 120 and $tipoUnidad <> 130 and $tipoUnidad <> 135 and $tipoUnidad <> 140 and $tipoUnidad <> 150) $tipoUnidad = 33;
		
	$objCargo = new dbCargos;
	$objCargo->listaCargos($tipoUnidad, &$cargos);
	$cantidad = count($cargos);
	
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<cargo>";
   		echo "<codigo>".$cargos[$i]->getCodigo()."</codigo>";
   		echo "<descripcion>".$cargos[$i]->getDescripcion()."</descripcion>";
	 	echo "</cargo>";
 	}
	echo "</root>";
 ?>
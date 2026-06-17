<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbAnimales.class.php");
	require("../../objetos/animal.class.php");
	require("../../objetos/tipoAnimal.class.php");
	require("../../objetos/estadoVehiculo.class.php");
	require("../../objetos/estadoAnimal.class.php");
	
	$unidad 	  	 = $_POST['codigoUnidad'];
	$fechaServicio = $_POST['fechaServicio'];
	$tipoServicio  = $_POST['tipoServicio'];
	$correlativo	 = $_POST['correlativo'];
	
	$fechaPaso 		 = explode("-",$fechaServicio);
  $fechaBuscar   = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
  
  //$unidad 	  	  = 825;
	//$fechaBuscar    = "2012-02-28";
	//$tipoServicio   = 10;
	
	$objDBAnimales = new dbAnimal;
	$objDBAnimales->listaPerrosDisponibles($unidad, $fechaBuscar, $tipoServicio, $correlativo, &$animales);
	$cantidad = count($animales);
	if ($cantidad > 0){
	  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	  	echo "<root>";
	   	for ($i=0; $i<$cantidad; $i++){
	   		echo "<animal>";
		   		echo "<codigo>".$animales[$i]->getCodigoAnimal()."</codigo>";
		   		echo "<tipo>".$animales[$i]->getTipoAnimal()->getDescripcion()."</tipo>";
		   		echo "<bcu>".$animales[$i]->getNumeroBCU()."</bcu>";
		   		echo "<nombre>".$animales[$i]->getNombreAnimal()."</nombre>";
	   		echo "</animal>";
	 	}
		echo "</root>";
	} else {
		echo "SIN DATOS";
	}
 ?>
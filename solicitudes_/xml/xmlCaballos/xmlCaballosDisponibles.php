<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
	require("../../baseDatos/dbCaballos.class.php");
	require("../../objetos/caballos.class.php");
	require("../../objetos/tipoAnimal.class.php");
	require("../../objetos/estadoVehiculo.class.php");
	require("../../objetos/estadoAnimal.class.php");

		
	$unidad 	  	= $_POST['codigoUnidad'];
	$fechaServicio  = $_POST['fechaServicio'];
	$tipoServicio   = $_POST['tipoServicio'];
	$correlativo	= $_POST['correlativo'];
	
	
	$fechaPaso 		= explode("-",$fechaServicio);
   	$fechaBuscar  	= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
   	
   	//$unidad 	  	  = 825;
	//$fechaBuscar    = "2012-02-28";
	//$tipoServicio   = 10;
	
	$objVehiculos = new dbCaballos;
	$objVehiculos->listaAnimalesDisponibles($unidad, $fechaBuscar, $tipoServicio, $correlativo, &$vehiculos);
	$cantidad = count($vehiculos);
	if ($cantidad > 0){
	  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	  	echo "<root>";
	   	for ($i=0; $i<$cantidad; $i++){
	   		echo "<vehiculo>";
	   		echo "<codigo>".$vehiculos[$i]->getCodigoCaballo()."</codigo>";
	   		echo "<tipo>".$vehiculos[$i]->getTipoAnimal()->getDescripcion()."</tipo>";
	   		echo "<bcu>".$vehiculos[$i]->getNumeroBCU()."</bcu>";
	   		echo "<nombre>".$vehiculos[$i]->getNombreCaballo()."</nombre>";
	   		echo "</vehiculo>";
	 	}
		echo "</root>";
	} else {
		echo "SIN DATOS";
	}
 ?>
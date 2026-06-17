<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
	require("../../baseDatos/dbSim.class.php");
	require("../../objetos/simccar.class.php");
	require("../../objetos/estadoRecurso.class.php");


		
	$unidad 	  	= $_POST['codigoUnidad'];
	$fechaServicio  = $_POST['fechaServicio'];
	$tipoServicio   = $_POST['tipoServicio'];
	$correlativo	= $_POST['correlativo'];
	
	
	$fechaPaso 		= explode("-",$fechaServicio);
   	$fechaBuscar  	= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
   	
   	//$unidad 	  	  = 825;
	//$fechaBuscar    = "2012-02-28";
	//$tipoServicio   = 10;
	
	$objVehiculos = new dbDioscar;
	$objVehiculos->listaSimccarDisponibles($unidad, $fechaBuscar, $tipoServicio, $correlativo, &$vehiculos);
	$cantidad = count($vehiculos);
	if ($cantidad > 0){
	  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	  	echo "<root>";
	   	for ($i=0; $i<$cantidad; $i++){
	   		echo "<vehiculo>";
	   		echo "<codigo>".$vehiculos[$i]->getCodigoSimccar()."</codigo>";
	   		echo "<serie>".$vehiculos[$i]->getSerieSimccar()."</serie>";
	   		echo "</vehiculo>";
	 	}
		echo "</root>";
	} else {
		echo "SIN DATOS";
	}
 ?>
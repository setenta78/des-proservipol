<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbServicios.class.php");
	require("../../objetos/serviciosUnidad.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/tipoServicio.class.php");
			
	$unidad 		= $_POST['codigoUnidad'];
	$fecha1 		= $_POST['fecha1'];
	$tipoServicio 	= $_POST['codigoServicio'];
	$tipoUnidad 	= $_POST['tipoUnidad'];
	$inicio 		= $_POST['inicio'];  

	//$unidad 			= 20;
	//$fecha1 			= "25-03-2013";
	////$tipoServicio 		= "10";
	//$tipoUnidad 		= "nacionasl";
	//$inicio 			= "0";
		
	$fechaPaso 		= explode("-",$fecha1);
   	$fechaBuscar1   = $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];
	
	$objServicios = new dbServicios;
	$objServicios->listaServiciosAcumulado($unidad, $tipoUnidad, $tipoServicio, $fechaBuscar1, $inicio, &$serviciosIngresados);
	$cantidad = count($serviciosIngresados);
	if ($serviciosIngresados != ""){		
	  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	  	echo "<root>";
	   	for ($i=0; $i<$cantidad; $i++){
	   		$fechaPaso 		= explode("-",$serviciosIngresados[$i]->getFecha());
	   		$fechaMostrar   = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	   		
	   		echo "<servicioIngresado>";
	   		echo "<codUnidad>".$serviciosIngresados[$i]->getUnidad()->getCodigoUnidad()."</codUnidad>";
	   		echo "<desUnidad>".$serviciosIngresados[$i]->getUnidad()->getDescripcionUnidad()."</desUnidad>";
	   		echo "<codServicio>".$serviciosIngresados[$i]->getTipoServicio()->getCodigo()."</codServicio>";
	   		echo "<desServicio>".$serviciosIngresados[$i]->getTipoServicio()->getDescripcion()."</desServicio>";
	   		echo "<correlativo>".$serviciosIngresados[$i]->getCorrelativo()."</correlativo>";
	   		echo "<fecha>".$fechaMostrar."</fecha>";
	   		echo "<cantidadFuncionarios>".$serviciosIngresados[$i]->getCantidadFuncionarios()."</cantidadFuncionarios>";
	   		echo "<cantidadVehiculos>".$serviciosIngresados[$i]->getCantidadVehiculos()."</cantidadVehiculos>";
	   		echo "</servicioIngresado>";
	 	}
		echo "</root>";
	} else {
		echo "VACIO";
	}
?>
<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbLicenciaMedica.class.php");
	require("../../objetos/servicio.class.php");
	
	$codigoFuncionario	= $_POST['codigoFuncionario'];
	$fecha1 						= $_POST['fecha1'];
	$fecha2							= $_POST['fecha2'];
	
	$fechaPaso 		= explode("-",$fecha1);
	$fechaBuscar1   = $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];
	
	$fechaPaso 		= explode("-",$fecha2);
	$fechaBuscar2   = $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];
	
	$objServicios = new dbLicencia;
	$objServicios->listaServiciosValidados($fechaBuscar1, $fechaBuscar2, $codigoFuncionario, &$servicios);
	$cantidad = count($servicios);
	if ($servicios != ""){		
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		$fechaPaso 		= explode("-",$servicios[$i]->getFecha());
   		$fechaMostrar   = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
   		
   		echo "<servicio>";
   		echo "<fecha>".$fechaMostrar."</fecha>";
   		echo "<unidad>".$servicios[$i]->getUnidad()."</unidad>";
   		echo "</servicio>";
 		}
		echo "</root>";
	} else {
		echo "VACIO";
	}
?>
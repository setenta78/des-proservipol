<?

	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbServicios.class.php");
	require("../../objetos/servicio.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/tipoServicio.class.php");
	require("../../objetos/tipoServicioExtraordinario.class.php");
		
	$funcionario	= $_POST['codigoFuncionario'];
	$fechaI 			= $_POST['fechaI'];
	$fechaT				= $_POST['fechaT'];
	$permiso			= $_POST['permiso'];
			
	$fechaPaso 		= explode("-",$fechaI);
  $fechaI			  = $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];
   	
  $fechaPaso 		= explode("-",$fechaT);
  $fechaT   		= $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];
	
	$objServicios = new dbServicios;
	$objServicios->listaServiciosPorFuncionario2($funcionario, $fechaI, $fechaT, $permiso, &$servicios);
	
	$cantidad = count($servicios);
	
	if ($servicios != ""){		
	  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	  	echo "<root>";
	   	for ($i=0; $i<$cantidad; $i++){
	   		$fechaPaso 		= explode("-",$servicios[$i]->getFecha());
	   		$fechaMostrar   = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	   		
	   		echo "<servicio>";
	   		echo "<correlativoServicio>".$servicios[$i]->getCorrelativo()."</correlativoServicio>";
	   		echo "</servicio>";
	 	}
		echo "</root>";
	} else {
		echo "VACIO";
	}
	
?>
<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbLicenciaMedica.class.php");
	require("../../objetos/licenciaMedica.class.php");
	require("../../objetos/servicio.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/tipoServicio.class.php");
	require("../../objetos/tipoServicioExtraordinario.class.php");
		
	$fecha1 		= $_POST['fecha1'];
	$fecha2			= $_POST['fecha2'];
	$funcionario = $_POST['funcionario'];
	
	//$unidad = 10;
	//$fecha1 = "11-01-2010";
	//$fecha2 = "11-01-2010";
	
	if ($fecha2 == "") $fecha2 = $fecha1;
	
	$fechaPaso 		= explode("-",$fecha1);
   	$fechaBuscar1   = $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];
   	
   	$fechaPaso 		= explode("-",$fecha2);
   	$fechaBuscar2   = $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];
   	
	$objServicios = new dbLicencia;
	$objServicios->listaServiciosPorFuncionario($funcionario, $fechaBuscar1, $fechaBuscar2, &$servicios);
	$cantidad = count($servicios);
	//echo "cantidad = ". $cantidad;
	
	//echo "objeto " . $servicios;
	
	//if (is_object($servicios)) $cantidad = servicios
	//else $cantidad = 0;
	
	//if ($cantidad > 0){
	
	if ($servicios != ""){		
	  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	  	echo "<root>";
	   	for ($i=0; $i<$cantidad; $i++){
	   		$fechaPaso 		= explode("-",$servicios[$i]->getFecha());
	   		$fechaMostrar   = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	   		
	   		echo "<servicio>";
	   		echo "<codUnidad>".$servicios[$i]->getUnidad()->getCodigoUnidad()."</codUnidad>";
	   		echo "<desUnidad>".$servicios[$i]->getUnidad()->getDescripcionUnidad()."</desUnidad>";
	   		echo "<correlativoServicio>".$servicios[$i]->getCorrelativo()."</correlativoServicio>";
	   		echo "<fecha>".$fechaMostrar."</fecha>";
	   		echo "<codServicio>".$servicios[$i]->getTipoServicio()->getCodigo()."</codServicio>";
	   		echo "<desServicio>".$servicios[$i]->getTipoServicio()->getDescripcion()."</desServicio>";
	   		echo "<claseServicio>".$servicios[$i]->getTipoServicio()->getTipo()."</claseServicio>";
	   		echo "<codServicioExtraordinario>".$servicios[$i]->getServicioExtraordinario()->getCodigo()."</codServicioExtraordinario>";
	   		echo "<desServicioExtraordinario>".$servicios[$i]->getServicioExtraordinario()->getDescripcion()."</desServicioExtraordinario>";
	   		echo "<horaInicio>".$servicios[$i]->getHoraInicio()."</horaInicio>";
	   		echo "<horaTermino>".$servicios[$i]->getHoraTermino()."</horaTermino>";
	   		echo "<fechaValidacion>".$servicios[$i]->getFechaValidacion()."</fechaValidacion>";
	   		echo "</servicio>";
	 		}
		echo "</root>";
	} else {
		echo "VACIO";
	}
	
 ?>

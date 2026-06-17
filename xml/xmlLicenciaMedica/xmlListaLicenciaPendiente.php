<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbLicenciaMedica.class.php");
	require("../../objetos/licenciaMedica.class.php");
	require("../../objetos/servicio.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/tipoServicio.class.php");
	
	$fechaIR 			= $_POST['fechaIR'];
	$fechaTR			= $_POST['fechaTR'];
	$funcionario	= $_POST['funcionario'];
	
	if ($fechaTR == "") $fechaTR = $fechaIR;
	
	$fechaPaso 			= explode("-",$fechaIR);
 	$fechaBuscarIR	= $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];
 	
 	$fechaPaso 			= explode("-",$fechaTR);
 	$fechaBuscarTR	= $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];
  
	$objServicios = new dbLicencia;
	$objServicios->listaServiciosLicenciaPendiente($funcionario, $fechaBuscarIR, $fechaBuscarTR, &$servicios);
	$cantidad = count($servicios);
	
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
	   	echo "</servicio>";
	 	}
		echo "</root>";
	} else {
		echo "VACIO";
	}
?>
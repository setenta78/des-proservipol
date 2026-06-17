<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbActividadFueraCuartel.class.php");
	require("../../objetos/actividadFueraCuartel.class.php");
	require("../../objetos/servicio.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/tipoServicio.class.php");
	require("../../objetos/tipoServicioExtraordinario.class.php");
		
	$fecha1 		= $_POST['fecha1'];
	$fecha2			= $_POST['fecha2'];
	$funcionario = $_POST['funcionario'];
	
	$fechaPaso 		= explode("-",$fecha1);
  	$fechaBuscar1   = $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];
   	
  	$fechaPaso 		= explode("-",$fecha2);
  	$fechaBuscar2   = $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];
	
	$objServicios = new dbActividadFueraCuartel;
	$objServicios->listaServiciosPorFuncionario($funcionario, $fechaBuscar1, $fechaBuscar2, &$servicios);
	$cantidad = count($servicios);
	
	if ($servicios != ""){		
		echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	  echo "<root>";
	  for ($i=0; $i<$cantidad; $i++){
	  	$fechaPaso 		= explode("-",$servicios[$i]->getFecha());
	  	$fechaMostrar   = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	   		
	  	echo "<servicio>";
	  	echo "<desUnidad>".$servicios[$i]->getUnidad()->getDescripcionUnidad()."</desUnidad>";
	  	echo "<fecha>".$fechaMostrar."</fecha>";
	  	echo "<desServicio>".$servicios[$i]->getTipoServicio()->getDescripcion()."</desServicio>";
	  	echo "</servicio>";
	 	}
		echo "</root>";
	} else {
		echo "VACIO";
	}
	
 ?>
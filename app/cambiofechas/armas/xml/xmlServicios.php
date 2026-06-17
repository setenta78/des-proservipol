<?
	header ('content-type: text/xml');
	include("configuracionBD2.php");
	require("../db/dbServicios.class.php");
	require("../objetos/servicio.class.php");
	
	$arma		= $_POST['codigoArma'];
	$fechaDesde = $_POST['fechaDesde'];
	
	$fechaPaso 		= explode("-",$fechaDesde);
	$fechaBuscar  = $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];
	
	$objServicios = new dbServicios;
	$objServicios->RevisaServicios($arma, $fechaBuscar, &$servicios);
	$cantidad = count($servicios);
	if($cantidad>0){
		echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
		echo "<root>";
		for ($i=0; $i <= $cantidad; $i++){
			$fechaPaso 		= explode("-",$servicios[$i]->getFecha());
			$fechaMostrar	= $fechaPaso[2]."-".$fechaPaso[1]."-".$fechaPaso[0];
			echo "<servicio>";
			echo "<unidad>".$servicios[$i]->getUnidad()."</unidad>";
			echo "<correlativoServicio>".$servicios[$i]->getCorrelativo()."</correlativoServicio>";
			echo "<fecha>".$fechaMostrar."</fecha>";
			echo "<servicio>".$servicios[$i]->getTipoServicio()."</servicio>";
			echo "<horaInicio>".$servicios[$i]->getHoraInicio()."</horaInicio>";
			echo "<horaTermino>".$servicios[$i]->getHoraTermino()."</horaTermino>";
			echo "</servicio>";
		}
		echo "</root>";
	} else {
		echo "VACIO";
	}
?>
<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbServicios.class.php");
	require("../../baseDatos/dbLicenciaMedica.class.php");
	require("../../objetos/servicio.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/tipoServicio.class.php");
	require("../../objetos/tipoServicioExtraordinario.class.php");
	require("../../objetos/licenciaMedica.class.php");
	
	$color	= $_POST['color'];
	$folio 		= $_POST['folio'];
	
	$objServicios = new dbLicencia;
	$objServicios->LicenciaMedicaAnulada($color, $folio, &$servicios);
	$cantidad = count($servicios);
	if ($servicios != ""){		
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<licencia>";
   		echo "<color>".$servicios[$i]->getColor()."</color>";
   		echo "<folio>".$servicios[$i]->getFolio()."</folio>";
	   	echo "<estado>".$servicios[$i]->getEstadoLicencia()."</estado>";
   		echo "</licencia>";
	 	}
		echo "</root>";
	} else {
		echo "VACIO";
	}
?>
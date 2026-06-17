<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbServicios.class.php");
	require("../../baseDatos/dbFerper.class.php");
	require("../../objetos/servicio.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/tipoServicio.class.php");
	require("../../objetos/tipoServicioExtraordinario.class.php");
	require("../../objetos/ferper.class.php");
		
	$folio 		= $_POST['folio'];
		
	$objServicios = new dbFerper;
	$objServicios->listaPermiso($folio, &$servicios);
	$cantidad = count($servicios);
	if ($servicios != ""){		
	  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	  	echo "<root>";
	   	for ($i=0; $i<$cantidad; $i++){
	   		echo "<licencia>";
	   		echo "<folio>".$servicios[$i]->getFolio()."</folio>";
	   		echo "</licencia>";
	 	}
		echo "</root>";
	} else {
		echo "VACIO";
	}
	
 ?>
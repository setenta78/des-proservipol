<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbFerper.class.php");
	require("../../objetos/ferper.class.php");
	
	$folio 		= $_POST['folio'];
		
	$objServicios = new dbFerper;
	$objServicios->PermisoAnulado($folio, &$servicios);
	$cantidad = count($servicios);
	
	if ($servicios != ""){		
	  echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	  echo "<root>";
	  for ($i=0; $i<$cantidad; $i++){
	  	echo "<permiso>";
	   		echo "<folio>".$servicios[$i]->getFolio()."</folio>";
	   		echo "<estado>".$servicios[$i]->getEstadoPermiso()."</estado>";
	  	echo "</permiso>";
	 	}
		echo "</root>";
	} else {
		echo "VACIO";
	}	
?>
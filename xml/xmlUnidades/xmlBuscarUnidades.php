<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbUnidades.class.php");
	require("../../objetos/unidad.class.php");
	
	$codigoUnidad = $_POST['codigoUnidad'];
	$descUnidad = $_POST['descUnidad'];

	$objDBUnidades = new dbUnidad;

	if($descUnidad){
		$unidades = $objDBUnidades->buscarUnidadNombre($descUnidad);
	}
	else{
		$unidades = $objDBUnidades->buscarUnidadCodigo($codigoUnidad);
	}

	$cantidad = count($unidades);
	if ($cantidad>0) {
		echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
		echo "<root>";
		 for ($i=0; $i<$cantidad; $i++){
			echo "<codigoUnidad>".$unidades[$i]->getCodigoUnidad()."</codigoUnidad>";
			echo "<descripcionUnidad>".$unidades[$i]->getDescripcionUnidad()."</descripcionUnidad>";
			echo "<captura>".$unidades[$i]->getCaptura()."</captura>";
			echo "<conHijos>".$unidades[$i]->getContieneHijos()."</conHijos>";
			echo "<codigoAbuelo>".$unidades[$i]->getPadreUnidad()->getPadreUnidad()->getCodigoUnidad()."</codigoAbuelo>";
			echo "<codigoPadre>".$unidades[$i]->getPadreUnidad()->getCodigoUnidad()."</codigoPadre>";
		}
		echo "</root>";
	} else {
		echo "VACIO";
	}
?>
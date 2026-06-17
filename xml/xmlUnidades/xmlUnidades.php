<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbUnidades.class.php");
	require("../../objetos/unidad.class.php");
		
	$codigoPadre = $_POST['codigoUnidad'];
	//$codigoPadre = 450;
	
	$objDBUnidades = new dbUnidad;
	$unidades = $objDBUnidades->listaUnidades($codigoPadre);
	//echo "CANTIDAD " . count($unidades);
	if (count($unidades)>0) {
		echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
		echo "<root>";
		echo "<codigoAbuelo>" . $unidades[0]->getPadreUnidad()->getPadreUnidad()->getCodigoUnidad() . "</codigoAbuelo>";
		echo "<codigoPadre>" . $codigoPadre . "</codigoPadre>";
		for ($i=0;$i<count($unidades);$i++){
			echo "<codigoUnidad>" . $unidades[$i]->getCodigoUnidad() . "</codigoUnidad>";
			echo "<descripcionUnidad>" . $unidades[$i]->getDescripcionUnidad() . "</descripcionUnidad>";
				echo "<planCuadrante>" . $unidades[$i]->getTienePlanCuadrante() . "</planCuadrante>";
			echo "<seleccionable>" . $unidades[$i]->getSeleccionable() . "</seleccionable>";
			
			if ($unidades[$i]->getTipoUnidad() == 15) $descripcionTipoUnidad = "superZona";
			if ($unidades[$i]->getTipoUnidad() == 20) $descripcionTipoUnidad = "zona";
			if ($unidades[$i]->getTipoUnidad() == 30) $descripcionTipoUnidad = "prefectura";
			if ($unidades[$i]->getTipoUnidad() == 40) $descripcionTipoUnidad = "comisaria";
			if ($unidades[$i]->getTipoUnidad() == 50 || $unidades[$i]->getTipoUnidad() == "") $descripcionTipoUnidad = "destacamento";
			
			echo "<tipo>" . $unidades[$i]->getTipoUnidad() . "</tipo>";
			echo "<descripcionTipoUnidad>" . $descripcionTipoUnidad . "</descripcionTipoUnidad>";
		}
		echo "</root>";
	} else {
		echo "VACIO";
	}
?>
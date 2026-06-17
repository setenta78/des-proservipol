<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbVehiculos.class.php");
	require("../../objetos/vehiculo.class.php");
	require("../../objetos/tipoVehiculo.class.php");
	require("../../objetos/marcaVehiculo.class.php");
	require("../../objetos/modeloVehiculo.class.php");
	require("../../objetos/procedenciaVehiculo.class.php");
	require("../../objetos/estadoRecurso.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/lugarReparacion.class.php");
	require("../../objetos/seccion.class.php");
	require("../../objetos/fallaVehiculo.class.php");
	require("../../objetos/clasificacionCitacion.class.php");
	
	$codigoVehiculo		= $_POST['codigoVehiculo'];
	$codigoEquipo		= $_POST['codigoEquipo'];
	$patenteVehiculo	= $_POST['patenteVehiculo'];
	$sapVehiculo		= $_POST['sapVehiculo'];
	$tipoBusqueda		= $_POST['tipoBusqueda'];
	
	$objVehiculos = new dbVehiculos;
	$objVehiculos->buscaDatosVehiculo($codigoVehiculo, $codigoEquipo, &$vehiculo);
	$cantidad = count($vehiculo);
	$i = 0;
	if($cantidad > 0){
		echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
		echo "<root>";
		
		for($i=0; $i<$cantidad; $i++){
			$fechaPaso		= explode("-",$vehiculo[$i]->getEstadoVehiculo()->getFechaDesde());
			$fechaMostrar	= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
			
			echo "<vehiculo>";
				echo "<codigo>".$vehiculo[$i]->getCodigoVehiculo()."</codigo>";
				echo "<tipo>".$vehiculo[$i]->getTipoVehiculo()->getCodigo()."</tipo>";
				echo "<tipoDescripcion>".$vehiculo[$i]->getTipoVehiculo()->getDescripcion()."</tipoDescripcion>";
				echo "<marca>".$vehiculo[$i]->getModeloVehiculo()->getMarca()->getCodigo()."</marca>";
				echo "<marcaDescripcion>".$vehiculo[$i]->getModeloVehiculo()->getMarca()->getDescripcion()."</marcaDescripcion>";
				echo "<modelo>".$vehiculo[$i]->getModeloVehiculo()->getCodigo()."</modelo>";
				echo "<modeloDescripcion>".$vehiculo[$i]->getModeloVehiculo()->getDescripcion()."</modeloDescripcion>";
				echo "<estado>".$vehiculo[$i]->getEstadoVehiculo()->getCodigo()."</estado>";
				echo "<estadoDescripcion>".$vehiculo[$i]->getEstadoVehiculo()->getDescripcion()."</estadoDescripcion>";
				echo "<fechaEstado>".$fechaMostrar."</fechaEstado>";
				echo "<patente>".$vehiculo[$i]->getPatente()."</patente>";
				echo "<numeroInstitucional>".$vehiculo[$i]->getNumeroInstitucional()."</numeroInstitucional>";
				echo "<codigoEquipo>".$vehiculo[$i]->getCodigoEquipo()."</codigoEquipo>";
				echo "<procedencia>".$vehiculo[$i]->getProcedencia()->getCodigo()."</procedencia>";
				echo "<procedenciaDescripcion>".$vehiculo[$i]->getProcedencia()->getDescripcion()."</procedenciaDescripcion>";
				echo "<unidad>".$vehiculo[$i]->getUnidad()->getCodigoUnidad()."</unidad>";
				echo "<descUnidad>".$vehiculo[$i]->getUnidad()->getDescripcionUnidad()."</descUnidad>";
				echo "<codigoUnidadAgregado>".$vehiculo[$i]->getUnidadAgregado()->getCodigoUnidad()."</codigoUnidadAgregado>";
				echo "<desUnidadAgregado>".$vehiculo[$i]->getUnidadAgregado()->getDescripcionUnidad()."</desUnidadAgregado>";
				echo "<codigoLugarReparacion>".$vehiculo[$i]->getLugarReparacion()->getCodigo()."</codigoLugarReparacion>";
				echo "<desLugarReparacion>".$vehiculo[$i]->getLugarReparacion()->getDescripcion()."</desLugarReparacion>";
				echo "<seccion>".$vehiculo[$i]->getSeccion()->getCodigo()."</seccion>";
				echo "<descSeccion>".$vehiculo[$i]->getSeccion()->getDescripcion()."</descSeccion>";
				echo "<clasificacionCitacion>".$vehiculo[$i]->getClasificacionCitacion()->getCodigo()."</clasificacionCitacion>";
				echo "<codigoFallaVehiculo>".$vehiculo[$i]->getTipoFallaVehiculo()->getCodigo()."</codigoFallaVehiculo>";
				echo "<desFallaVehiculo>".$vehiculo[$i]->getTipoFallaVehiculo()->getDescripcion()."</desFallaVehiculo>";
				echo "<annoFabricacion>".$vehiculo[$i]->getAnnoFabricacion()."</annoFabricacion>";
				echo "<validaAnno>".$vehiculo[$i]->getValidaAnnoFabricacion()."</validaAnno>";
				echo "<archivo>".$vehiculo[$i]->getEstadoVehiculo()->getArchivo()."</archivo>";
				echo "<numeroSAP>".$vehiculo[$i]->getNumeroSAP()."</numeroSAP>";
				echo "<tarjetaCombustible>".$vehiculo[$i]->getTarjetaCombustible()."</tarjetaCombustible>";
			echo "</vehiculo>";
		}
		echo "</root>";
	} else {
		echo "VACIO";
	}
 ?>
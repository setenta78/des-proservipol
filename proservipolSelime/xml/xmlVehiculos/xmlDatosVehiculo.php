<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
	require("../../baseDatos/dbVehiculos.class.php");
	require("../../objetos/vehiculo.class.php");
	require("../../objetos/tipoVehiculo.class.php");
	require("../../objetos/marcaVehiculo.class.php");
	require("../../objetos/modeloVehiculo.class.php");
	require("../../objetos/procedenciaVehiculo.class.php");
	require("../../objetos/estadoRecurso.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/lugarReparacion.class.php");
	require("../../objetos/fallaVehiculo.class.php");
		
	$codigoVehiculo = $_POST['codigoVehiculo'];
	$bcuVehiculo 	= $_POST['bcuVehiculo'];
	
	//$codigoVehiculo = "8678";
	//$bcuVehiculo = "04020229476";
		
	$objVehiculos = new dbVehiculos;
	$objVehiculos->buscaDatosVehiculo($codigoVehiculo, $bcuVehiculo, &$vehiculo);
	$cantidad = count($vehiculo);
	if ($cantidad > 0){
		echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
		echo "<root>";
		
		$fechaPaso 		= explode("-",$vehiculo->getEstadoVehiculo()->getFechaDesde());
	   	$fechaMostrar   = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
		
		
		echo "<vehiculo>";
	   	echo "<codigo>".$vehiculo->getCodigoVehiculo()."</codigo>";
	   	echo "<tipo>".$vehiculo->getTipoVehiculo()->getCodigo()."</tipo>";
	   	echo "<marca>".$vehiculo->getModeloVehiculo()->getMarca()->getCodigo()."</marca>";
	   	echo "<modelo>".$vehiculo->getModeloVehiculo()->getCodigo()."</modelo>";
	   	echo "<estado>".$vehiculo->getEstadoVehiculo()->getCodigo()."</estado>";
	   	echo "<fechaEstado>".$fechaMostrar."</fechaEstado>";
	   	echo "<patente>".$vehiculo->getPatente()."</patente>";
	   	echo "<numeroInstitucional>".$vehiculo->getNumeroInstitucional()."</numeroInstitucional>";
	   	echo "<numeroBCU>".$vehiculo->getNumeroBCU()."</numeroBCU>";
	   	echo "<procedencia>".$vehiculo->getProcedencia()->getCodigo()."</procedencia>";
	   	echo "<unidad>".$vehiculo->getUnidad()->getCodigoUnidad()."</unidad>";
	    echo "<descUnidad>".$vehiculo->getUnidad()->getDescripcionUnidad()."</descUnidad>";
	    echo "<codigoUnidadAgregado>".$vehiculo->getUnidadAgregado()->getCodigoUnidad()."</codigoUnidadAgregado>";
   		echo "<desUnidadAgregado>".$vehiculo->getUnidadAgregado()->getDescripcionUnidad()."</desUnidadAgregado>";
   		echo "<codigoLugarReparacion>".$vehiculo->getLugarReparacion()->getCodigo()."</codigoLugarReparacion>";
   		echo "<desLugarReparacion>".$vehiculo->getLugarReparacion()->getDescripcion()."</desLugarReparacion>";
   		echo "<codigoFallaVehiculo>".$vehiculo->getTipoFallaVehiculo()->getCodigo()."</codigoFallaVehiculo>";
      echo "<desFallaVehiculo>".$vehiculo->getTipoFallaVehiculo()->getDescripcion()."</desFallaVehiculo>";
      echo "<annoFabricacion>".$vehiculo->getAnnoFabricacion()."</annoFabricacion>";
      echo "<validaAnno>".$vehiculo->getValidaAnnoFabricacion()."</validaAnno>";
		echo "</vehiculo>";
		echo "</root>";
	} else {
		echo "VACIO";
	}
 ?>
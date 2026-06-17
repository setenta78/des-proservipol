<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbVehiculos.class.php");
	require("../../objetos/vehiculo.class.php");
	require("../../objetos/tipoVehiculo.class.php");
	require("../../objetos/marcaVehiculo.class.php");
	require("../../objetos/modeloVehiculo.class.php");
	require("../../objetos/procedenciaVehiculo.class.php");
	require("../../objetos/estadoVehiculo.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/seccion.class.php");
	
	$unidad 	  	= $_POST['codigoUnidad'];
	$tipoVehiculo 	= $_POST['tipoVehiculo'];
	$nombreBuscar  = utf8_decode($_POST['nombreBuscar']);
	
	$sentidoOrden  = $_POST['sentido'];
	$camporOrden   = $_POST['campo'];
	
	$tipoEstado	  	= "0,1,4";
	
	$objVehiculos = new dbVehiculos;
	$objVehiculos->listaTotalVehiculos($unidad, $nombreBuscar, $tipoVehiculo, $camporOrden, $sentidoOrden, $tipoEstado, &$vehiculos);
	$cantidad = count($vehiculos);
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<vehiculo>";
   		echo "<codigo>".$vehiculos[$i]->getCodigoVehiculo()."</codigo>";
   		echo "<tipo>".$vehiculos[$i]->getTipoVehiculo()->getDescripcion()."</tipo>";
   		echo "<marca>".$vehiculos[$i]->getModeloVehiculo()->getMarca()->getDescripcion()."</marca>";
   		echo "<modelo>".$vehiculos[$i]->getModeloVehiculo()->getDescripcion()."</modelo>";
   		echo "<estado>".$vehiculos[$i]->getEstadoVehiculo()->getDescripcion()."</estado>";
   		echo "<patente>".$vehiculos[$i]->getPatente()."</patente>";
   		echo "<numeroInstitucional>".$vehiculos[$i]->getNumeroInstitucional()."</numeroInstitucional>";
   		echo "<bcu>".$vehiculos[$i]->getNumeroBCU()."</bcu>";
   		echo "<sap>".$vehiculos[$i]->getNumeroSAP()."</sap>";
   		echo "<procedencia>".$vehiculos[$i]->getProcedencia()->getDescripcion()."</procedencia>";
   		echo "<codigoUnidadAgregado>".$vehiculos[$i]->getUnidadAgregado()->getCodigoUnidad()."</codigoUnidadAgregado>";
   		echo "<desUnidadAgregado>".$vehiculos[$i]->getUnidadAgregado()->getDescripcionUnidad()."</desUnidadAgregado>";
      	echo "<seccion>".$vehiculos[$i]->getSeccion()->getDescripcion()."</seccion>";
	 	echo "</vehiculo>";
 	}
    
    $objVehiculos->listaTotalVehiculosAgregados($unidad, $nombreBuscar, $tipoVehiculo, $camporOrden, $sentidoOrden, $tipoEstado, &$vehiculosAgr);
    $cantidad = count($vehiculosAgr);
    for ($i=0; $i<$cantidad; $i++){
        echo "<vehiculo>";
        echo "<codigo>".$vehiculosAgr[$i]->getCodigoVehiculo()."</codigo>";
        echo "<tipo>".$vehiculosAgr[$i]->getTipoVehiculo()->getDescripcion()."</tipo>";
        echo "<marca>".$vehiculosAgr[$i]->getModeloVehiculo()->getMarca()->getDescripcion()."</marca>";
        echo "<modelo>".$vehiculosAgr[$i]->getModeloVehiculo()->getDescripcion()."</modelo>";
        echo "<estado>".$vehiculosAgr[$i]->getEstadoVehiculo()->getDescripcion()."</estado>";
        echo "<patente>".$vehiculosAgr[$i]->getPatente()."</patente>";
        echo "<numeroInstitucional>".$vehiculosAgr[$i]->getNumeroInstitucional()."</numeroInstitucional>";
        echo "<bcu>".$vehiculosAgr[$i]->getNumeroBCU()."</bcu>";
        echo "<sap>".$vehiculosAgr[$i]->getNumeroSAP()."</sap>";
        echo "<procedencia>".$vehiculosAgr[$i]->getProcedencia()->getDescripcion()."</procedencia>";
        echo "<codigoUnidadAgregado>".$vehiculosAgr[$i]->getUnidadAgregado()->getCodigoUnidad()."</codigoUnidadAgregado>";
        echo "<desUnidadAgregado>".$vehiculosAgr[$i]->getUnidadAgregado()->getDescripcionUnidad()."</desUnidadAgregado>";
        echo "<seccion>".$vehiculosAgr[$i]->getSeccion()->getDescripcion()."</seccion>";
        echo "</vehiculo>";
    }
	echo "</root>";
 ?>
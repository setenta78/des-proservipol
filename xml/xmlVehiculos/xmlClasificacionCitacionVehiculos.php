<?
	header ('content-type: text/xml');
    include("../configuracionBD4.php");
	require("../../baseDatos/dbClasificacionCitacion.class.php");
	require("../../objetos/vehiculo.class.php");
	require("../../objetos/tipoVehiculo.class.php");
	require("../../objetos/estadoRecurso.class.php");
	
	session_start();
    $codigoUnidad   = $_SESSION['USUARIO_CODIGOUNIDAD'];
    
	$objClasificacionCitacion = new dbClasificacionCitacion;
	$objClasificacionCitacion->listaVehiculosSinClasificar($codigoUnidad, &$vehiculos);
	$cantidad = count($vehiculos);
	
    echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
    echo "<root>";
    for ($i=0; $i<$cantidad; $i++){
        echo "<vehiculo>";
            echo "<codigo>".$vehiculos[$i]->getCodigoVehiculo()."</codigo>";
            echo "<tipo>".$vehiculos[$i]->getTipoVehiculo()->getDescripcion()."</tipo>";
            echo "<estado>".$vehiculos[$i]->getEstadoVehiculo()->getDescripcion()."</estado>";
            echo "<patente>".$vehiculos[$i]->getPatente()."</patente>";
        echo "</vehiculo>";
    }
    echo "</root>";
?>
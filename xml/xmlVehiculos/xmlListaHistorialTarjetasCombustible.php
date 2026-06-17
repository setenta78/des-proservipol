<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbVehiculos.class.php");
	require("../../objetos/tarjetaCombustible.class.php");
	
	$codigoVehiculo	= $_POST['codigoVehiculo'];

	$objDBVehiculos = new dbVehiculos;
	$resultado = $objDBVehiculos->listaHistorialTarjetasCombustible($codigoVehiculo, &$tarjetas);
	$cantidad = count($tarjetas);
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<tarjetaCombustible>";
			echo "<nTarjetaCombustible>".$tarjetas[$i]->getNroTarjeta()."</nTarjetaCombustible>";
			echo "<nTarjetaCombustibleDV>".$tarjetas[$i]->getNroTarjetaDV()."</nTarjetaCombustibleDV>";
			echo "<fechaDesde>".$tarjetas[$i]->getFechaDesde()."</fechaDesde>";
			echo "<fechaHasta>".$tarjetas[$i]->getFechaHasta()."</fechaHasta>";
			echo "<funcionarioIngresa>".$tarjetas[$i]->getCodFuncionarioRegistra()."</funcionarioIngresa>";
			echo "<fechaIngreso>".$tarjetas[$i]->getFechaDesde()."</fechaIngreso>";
			echo "<archivo>".$tarjetas[$i]->getArchivo()."</archivo>";
	 	echo "</tarjetaCombustible>";
 	}
	echo "</root>";
?>
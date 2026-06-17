<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbVehiculos.class.php");
	require("../../objetos/vehiculo.class.php");
	
	$codigoVehiculo = $_POST['codigoVehiculo'];
	
	//$codigoVehiculo = 4;
	
	$objVehiculo = new dbVehiculos;
	$objVehiculo->buscaUltimoKilometraje($codigoVehiculo, &$vehiculo);
	
	if ($vehiculo != ""){
	  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	  	echo "<root>";
	 		echo "<vehiculo>";
	   		echo "<codigo>".$codigoVehiculo."</codigo>";
	   		echo "<ultimoKilometraje>".$vehiculo->getUltimoKilometraje()."</ultimoKilometraje>";
		 	echo "</vehiculo>";
		echo "</root>";
	} else {
		echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	  	echo "<root>";
	 		echo "<vehiculo>";
	   		echo "<codigo>".$codigoVehiculo."</codigo>";
	   		echo "<ultimoKilometraje>0</ultimoKilometraje>";
		 	echo "</vehiculo>";
		echo "</root>";
	}
 ?>
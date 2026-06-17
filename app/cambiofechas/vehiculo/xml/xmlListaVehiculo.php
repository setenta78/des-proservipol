<?
	header ('content-type: text/xml');
	include("configuracionBD2.php"); 
	require("../db/dbVehiculos.class.php");
	require("../objetos/vehiculo.class.php");
		
	$patente = $_POST['patente'];

	$objVehiculos = new dbVehiculos;
	$objVehiculos->listaTotalVehiculos($patente,&$vehiculos);
	
	$cantidad = count($vehiculos);
  echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  echo "<root>";
  for ($i=0; $i < $cantidad; $i++){
  	echo "<vehiculo>";
  		
		 		echo "<codigo>".$vehiculos[$i]->getCodigoVehiculo()."</codigo>";
		 		echo "<patente>".$vehiculos[$i]->getPatente()."</patente>";
		 		echo "<bcu>".$vehiculos[$i]->getBcu()."</bcu>";
		 		echo "<tipo>".$vehiculos[$i]->getTipo()."</tipo>";
		 		echo "<modelo>".$vehiculos[$i]->getModelo()."</modelo>";
		 		echo "<unidad>".$vehiculos[$i]->getUnidad()."</unidad>";	 		
 
		echo "</vehiculo>";
 	}
	echo "</root>";
?>
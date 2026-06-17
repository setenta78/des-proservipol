<?php
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbArbolUnidades.class.php");
	require("../../objetos/arbolUnidad.class.php");

	$nombre = $_POST['nombre'];

	$objUnidades = new dbUnidad;
	$objUnidades->unidadesPorNombre($nombre,&$unidades);

	$cantidad = count($unidades);
	error_log("Búsqueda unidad: " . $nombre . ", Results: " . $cantidad); // Debug log
	if($unidades!=""){
		echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	  	echo "<root>";
	  	for ($i=0; $i < $cantidad; $i++){
			echo "<unidad>";
				echo "<codigo>".$unidades[$i]->getCodigoUnidad()."</codigo>";
				echo "<nombre>".$unidades[$i]->getNombreUnidad()."</nombre>";
			echo "</unidad>";
	 	}
		echo "</root>";
	}
	else{
		echo "VACIO";
	}
?>
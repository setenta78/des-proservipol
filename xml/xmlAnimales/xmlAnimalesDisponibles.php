<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbAnimales.class.php");
	require("../../objetos/animal.class.php");
	require("../../objetos/tipoAnimal.class.php");
	require("../../objetos/estadoVehiculo.class.php");
	require("../../objetos/estadoAnimal.class.php");
	
	$unidad 	  	= $_POST['codigoUnidad'];
	$fechaServicio	= $_POST['fechaServicio'];
	$tipoServicio  	= $_POST['tipoServicio'];
	$correlativo	= $_POST['correlativo'];
	$horaInicio		= $_POST['horaInicio'];
	$horaTermino	= $_POST['horaTermino'];
	
	$fechaPaso 		= explode("-",$fechaServicio);
	$fechaBuscar 	= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	
	if($horaInicio >= $horaTermino)	$horaTermino = "24:00";
	
	$objDBAnimales 	= new dbAnimal;
	$objDBAnimales->listaAnimalesDisponibles($unidad, $fechaBuscar, $tipoServicio, $horaInicio, $horaTermino, $correlativo, &$animales);
	$cantidad = count($animales);
	if ($cantidad > 0){
		echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
		echo "<root>";
		for ($i=0; $i<$cantidad; $i++){
			echo "<animal>";
				echo "<codigo>".$animales[$i]->getCodigoAnimal()."</codigo>";
				echo "<tipoCodigo>".$animales[$i]->getTipoAnimal()->getCodigo()."</tipoCodigo>";
				echo "<tipoDescripcion>".$animales[$i]->getTipoAnimal()->getDescripcion()."</tipoDescripcion>";
				echo "<bcu>".$animales[$i]->getNumeroBCU()."</bcu>";
				echo "<nombre>".$animales[$i]->getNombreAnimal()."</nombre>";
			echo "</animal>";
	 	}
		echo "</root>";
	} else {
		echo "SIN DATOS";
	}
?>
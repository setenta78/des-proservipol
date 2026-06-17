<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbAnimales.class.php");
	require("../../objetos/animal.class.php");
	require("../../objetos/estadoAnimal.class.php");
	require("../../objetos/estadoVehiculo.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/tipoAnimal.class.php");
	require("../../objetos/seccion.class.php");	//Llamada a objeto agregada el 24-04-2015
	session_start();
	
	$codigoUnidad	= $_SESSION['USUARIO_CODIGOUNIDAD']; 
	$codigoAnimal	= $_POST['codigoAnimal'];
	$nombreBuscar  = utf8_decode($_POST['nombreBuscar']);
	
	$sentidoOrden  = $_POST['sentido'];
	$camporOrden   = $_POST['campo'];
	
	$unidad 	  	= $_POST['codigoUnidad'];
	$tipoAnimal	 	= $_POST['tipoAnimal'];
	
	//$unidad = "735";
	$objAnimales = new dbAnimal;
	$objAnimales->listaTotalPerros($unidad, $nombreBuscar, $camporOrden, $sentidoOrden, &$animales);
	$cantidad = count($animales);
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  echo "<root>";
  for ($i=0; $i<$cantidad; $i++){ 		  	
		echo "<animal>";
			echo "<codigo>".$animales[$i]->getCodigoAnimal()."</codigo>";
			echo "<nombre>".$animales[$i]->getNombreAnimal()."</nombre>";
			echo "<unidad>".$animales[$i]->getUnidad()."</unidad>";
			echo "<bcu>".$animales[$i]->getNumeroBCU()."</bcu>";
			echo "<fecha>".$animales[$i]->getFechaNacimiento()."</fecha>";
			echo "<raza>".$animales[$i]->getRaza()."</raza>";
			echo "<color>".$animales[$i]->getColor()."</color>";
			echo "<pelaje>".$animales[$i]->getPelaje()."</pelaje>";
			echo "<sexo>".$animales[$i]->getSexo()."</sexo>";
			echo "<estado>".$animales[$i]->getEstadoAnimal()->getDescripcion()."</estado>";
			echo "<codigoUnidadAgregado>".$animales[$i]->getUnidadAgregado()->getCodigoUnidad()."</codigoUnidadAgregado>";
			echo "<desUnidadAgregado>".$animales[$i]->getUnidadAgregado()->getDescripcionUnidad()."</desUnidadAgregado>";
			echo "<tipoAnimal>".$animales[$i]->getTipoAnimal()->getDescripcion()."</tipoAnimal>";
    	echo "<seccion>".$animales[$i]->getSeccion()->getDescripcion()."</seccion>"; //Tag agregado el 28-04-2015
		echo "</animal>";
 	}
	echo "</root>";
 ?>
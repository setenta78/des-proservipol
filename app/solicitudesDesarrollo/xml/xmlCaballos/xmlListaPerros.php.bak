<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
	require("../../baseDatos/dbCaballos.class.php");
	require("../../objetos/caballos.class.php");
	require("../../objetos/estadoAnimal.class.php");
	require("../../objetos/estadoVehiculo.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/tipoAnimal.class.php");
	session_start();
	
	$codigoUnidad		= $_SESSION['USUARIO_CODIGOUNIDAD']; 
	$codigoVehiculo			= $_POST['codigoVehiculo'];

		
	$unidad 	  	= $_POST['codigoUnidad'];
	$vehiculoBuscar = $_POST['vehiculoBuscar'];
	$tipoVehiculo 	= $_POST['tipoVehiculo'];
	


	
	//$unidad = "735";

		
	$objVehiculos = new dbCaballos;
	$objVehiculos->listaTotalCaballos($unidad, &$caballos);
	$cantidad = count($caballos);
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		  	
   	echo "<caballo>";
   	 echo "<codigo>".$caballos[$i]->getCodigoCaballo()."</codigo>";
   	 echo "<nombre>".$caballos[$i]->getNombreCaballo()."</nombre>";
     echo "<unidad>".$caballos[$i]->getUnidad()."</unidad>";
     echo "<bcu>".$caballos[$i]->getNumeroBCU()."</bcu>";
     echo "<fecha>".$caballos[$i]->getFechaNacimiento()."</fecha>";
     echo "<raza>".$caballos[$i]->getRaza()."</raza>";
     echo "<color>".$caballos[$i]->getColor()."</color>";
     echo "<pelaje>".$caballos[$i]->getPelaje()."</pelaje>";
     echo "<sexo>".$caballos[$i]->getSexo()."</sexo>";
     echo "<estado>".$caballos[$i]->getEstadoVehiculo()->getDescripcion()."</estado>";
     echo "<codigoUnidadAgregado>".$caballos[$i]->getUnidadAgregado()->getCodigoUnidad()."</codigoUnidadAgregado>";
   	echo "<desUnidadAgregado>".$caballos[$i]->getUnidadAgregado()->getDescripcionUnidad()."</desUnidadAgregado>";
   	echo "<tipoAnimal>".$caballos[$i]->getTipoAnimal()->getDescripcion()."</tipoAnimal>";
	 	echo "</caballo>";
 	}
	echo "</root>";
 ?>
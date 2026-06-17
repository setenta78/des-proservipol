<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
	require("../../baseDatos/dbCaballos.class.php");
	require("../../objetos/caballos.class.php");
	require("../../objetos/estadoAnimal.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/tipoAnimal.class.php");

	//session_start();
	$codigoVehiculo = $_POST['codigoVehiculo'];
	$bcuVehiculo 	= $_POST['bcuVehiculo'];
	


	
	//$unidad = "735";

		
	$objVehiculos = new dbCaballos;
	$objVehiculos->buscaDatosCaballos($codigoVehiculo, $bcuVehiculo, &$caballos);
	$cantidad = count($caballos);
		if ($cantidad > 0){
	  echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	
   	$fechaPaso 		= explode("-",$caballos->getEstadoVehiculo()->getFechaDesde());
	  $fechaMostrar   = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
   	
   	 echo "<caballo>";
   	 echo "<codigo>".$caballos->getCodigoCaballo()."</codigo>";
   	 echo "<nombre>".$caballos->getNombreCaballo()."</nombre>";
     echo "<bcu>".$caballos->getNumeroBCU()."</bcu>";
     echo "<fecha>".$caballos->getFechaNacimiento()."</fecha>";
     echo "<raza>".$caballos->getRaza()."</raza>";
     echo "<color>".$caballos->getColor()."</color>";
     echo "<pelaje>".$caballos->getPelaje()."</pelaje>";
     echo "<sexo>".$caballos->getSexo()."</sexo>";
     echo "<codigoUnidadAgregado>".$caballos->getUnidadAgregado()->getCodigoUnidad()."</codigoUnidadAgregado>";
   	 echo "<desUnidadAgregado>".$caballos->getUnidadAgregado()->getDescripcionUnidad()."</desUnidadAgregado>";
   	 echo "<unidad>".$caballos->getUnidad()->getCodigoUnidad()."</unidad>";
	   echo "<descUnidad>".$caballos->getUnidad()->getDescripcionUnidad()."</descUnidad>";
	   echo "<estado>".$caballos->getEstadoVehiculo()->getCodigo()."</estado>";
	   echo "<tipoAnimal>".$caballos->getTipoAnimal()->getCodigo()."</tipoAnimal>";
	   echo "<tipoAnimalDescripcion>".$caballos->getTipoAnimal()->getDescripcion()."</tipoAnimalDescripcion>";
	   echo "<fechaEstado>".$fechaMostrar."</fechaEstado>";
	   echo "<verifica>".$caballos->getVerifica()."</verifica>";
	 	 echo "</caballo>";
	   echo "</root>";   
	   }else {
		echo "VACIO";
	}
 ?>
<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbAnimales.class.php");
	require("../../objetos/animal.class.php");
	require("../../objetos/estadoAnimal.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/tipoAnimal.class.php");
	require("../../objetos/seccion.class.php"); //Llamada agregada el 28-04-2015	
	
	//session_start();
	$codigoAnimal = $_POST['codigoAnimal'];
	$bcuAnimal 	= $_POST['bcuAnimal'];
	//$unidad = "735";
	
	$objDBAnimales = new dbAnimal;
	$objDBAnimales->buscaDatosAnimal($codigoAnimal, $bcuAnimal, &$animales);
	$cantidad = count($animales);
		if ($cantidad > 0){
	  echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	
   	$fechaPaso 		= explode("-",$animales->getEstadoAnimal()->getFechaDesde());
	  $fechaMostrar   = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
   	
   	 echo "<animal>";
	   	 echo "<codigo>".$animales->getCodigoAnimal()."</codigo>";
	   	 echo "<nombre>".$animales->getNombreAnimal()."</nombre>";
	     echo "<bcu>".$animales->getNumeroBCU()."</bcu>";
	     echo "<fecha>".$animales->getFechaNacimiento()."</fecha>";
	     echo "<raza>".$animales->getRaza()."</raza>";
	     echo "<color>".$animales->getColor()."</color>";
	     echo "<pelaje>".$animales->getPelaje()."</pelaje>";
	     echo "<sexo>".$animales->getSexo()."</sexo>";
	     echo "<codigoUnidadAgregado>".$animales->getUnidadAgregado()->getCodigoUnidad()."</codigoUnidadAgregado>";
	   	 echo "<desUnidadAgregado>".$animales->getUnidadAgregado()->getDescripcionUnidad()."</desUnidadAgregado>";
	   	 echo "<unidad>".$animales->getUnidad()->getCodigoUnidad()."</unidad>";
		   echo "<descUnidad>".$animales->getUnidad()->getDescripcionUnidad()."</descUnidad>";
		   echo "<estado>".$animales->getEstadoAnimal()->getCodigo()."</estado>";
		   echo "<tipoAnimal>".$animales->getTipoAnimal()->getCodigo()."</tipoAnimal>";
		   echo "<tipoAnimalDescripcion>".$animales->getTipoAnimal()->getDescripcion()."</tipoAnimalDescripcion>";
		   echo "<fechaEstado>".$fechaMostrar."</fechaEstado>";
		   echo "<verifica>".$animales->getVerifica()."</verifica>";
     	 echo "<codigoSeccion>".$animales->getSeccion()->getCodigo()."</codigoSeccion>"; //Tag agregado el 28-04-2015
			 echo "<seccion>".$animales->getSeccion()->getDescripcion()."</seccion>"; //Tag agregado el 28-04-2015
	 	 echo "</animal>";
	   echo "</root>";   
	   }else {
		echo "VACIO";
	}
 ?>
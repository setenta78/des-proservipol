<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbAnimales.class.php");
	require("../../objetos/animal.class.php");
	require("../../objetos/estadoAnimal.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/tipoAnimal.class.php");
	
	$codigoAnimal					= $_POST['codigoAnimal'];			
	//$codigoTipoAnimal 	= $_POST['tipoAnimal'];
	
	$codigoEstado	  			= $_POST['estado'];
  $fechaNuevoEstado	  	= $_POST['fechaNuevoEstado'];
	$numeroBCU						= $_POST['numeroBCU'];
	$codigoUnidadAgregado	= $_POST['codigoUnidadAgregado'];
	
	$nombre			= $_POST['nombre'];
	$raza				= $_POST['raza'];
	$color			= $_POST['color'];
	$pelaje			= $_POST['pelaje'];
	$nacimiento = $_POST['nacimiento'];
	$sexo       = $_POST['sexo'];
	$tipoAnimal = $_POST['tipoAnimal'];
	$verificar  = $_POST['verificar'];
	
	//$codigoUnidad		= "610040000000";
	session_start();                       
  $codigoUnidad			= $_SESSION['USUARIO_CODIGOUNIDAD'];   	 
  
	$unidad = new unidad;
	$unidad->setCodigoUnidad($codigoUnidad);
	$unidad->setDescripcionUnidad("");
	
	$unidadAgregado = new unidad;
	$unidadAgregado->setCodigoUnidad($codigoUnidadAgregado);
	$unidadAgregado->setDescripcionUnidad("");
  
	$estado = new estadoAnimal;
	$estado->setCodigo($codigoEstado);
	$estado->setDescripcion("");
	
	$animal = new animal;
	//$animal->setCodigoAnimal($codigoVehiculo);
	$animal->setEstadoAnimal($estado);
	$animal->setUnidad($unidad);
	$animal->setUnidadAgregado($unidadAgregado);
	$animal->setNumeroBCU($numeroBCU);
  $animal->setNombreAnimal($nombre);
  $animal->setRaza($raza);
  $animal->setColor($color);
  $animal->setPelaje($pelaje);
  $animal->setFechaNacimiento($nacimiento);
  $animal->setSexo($sexo);
  $animal->setTipoAnimal($tipoAnimal);
  $animal->setVerifica($verificar);
	
	$objDBAnimales = new dbAnimal;
	$idNuevo = $objDBAnimales->nuevoAnimal($animal);
	//$animal->setCodigoAnimal(mysql_insert_id());
	$animal->setCodigoAnimal($idNuevo);
	
	if ($fechaNuevoEstado != ""){
		$fechaPaso 			= explode("-",$fechaNuevoEstado);
   	$fechaIngresar  = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
		$resultado 			= $objDBAnimales->insertEstadoAnimal($animal, $fechaIngresar);
	}
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  echo "<root>";
  	echo "<resultado>".$resultado."</resultado>";
  echo "</root>";
 ?>
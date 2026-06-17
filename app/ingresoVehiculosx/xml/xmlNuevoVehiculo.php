<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
	require("../db/dbVehiculos.class.php");
	require("../objetos/vehiculo.class.php");
	
	$numeroBCU						= $_POST['numeroBCU'];
	$patente							= $_POST['patente'];
	$numeroInstitucional	= $_POST['numeroInstitucional'];
	$procedencia 					= $_POST['procedencia'];
	$tipoVehiculo 				= $_POST['tipoVehiculo'];
	$marca			  				= $_POST['marca'];
	$modelo	  						= $_POST['modelo'];
	$annoFabricacion      = $_POST['anno'];
	$estado				  			= $_POST['estado'];
	$fechaEstado					= $_POST['fechaEstado'];
	$unidad					      = $_POST['unidad'];
	
	if($modelo==1) $modelo = 'null';
	
	$vehiculo = new vehiculo;
	$vehiculo->setPatente($patente);
	$vehiculo->setNumeroInstitucional($numeroInstitucional);
	$vehiculo->setProcedencia($procedencia);
	$vehiculo->setTipo($tipoVehiculo);
	$vehiculo->setMarca($marca);
	$vehiculo->setModelo($modelo);
	$vehiculo->setEstado($estado);
	$vehiculo->setUnidad($unidad);
	$vehiculo->setBCU($numeroBCU);
	$vehiculo->setAnnoFabricacion($annoFabricacion);
	
	$objDBVehiculos = new dbVehiculos;
	$resultado = $objDBVehiculos->nuevoVehiculo($vehiculo);
	
	$fechaPaso 			= explode("-",$fechaEstado);
  $fechaIngresar  = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
  $resultado 			= $objDBVehiculos->insertEstadoVehiculo($vehiculo, $fechaIngresar);
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
 ?>
 

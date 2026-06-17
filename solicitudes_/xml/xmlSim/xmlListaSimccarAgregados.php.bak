<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
	require("../../baseDatos/dbSim.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/cargo.class.php");
  require("../../objetos/unidad.class.php");
	require("../../objetos/usuario.class.php");
	require("../../objetos/simccar.class.php");
	require("../../objetos/estadoRecurso.class.php");
		
	$unidad 	   = $_POST['codigoUnidad'];
	$nombreBuscar  = utf8_decode($_POST['nombreBuscar']);
	
	$sentidoOrden  = $_POST['sentido'];
	$camporOrden   = $_POST['campo'];
	
	$escalafon    = $_POST['escalafon'];
	$grado   	  = $_POST['grado'];
	
	//$unidad = "2495"; 
	//$nombreBuscar = "4";

	$objFuncionarios = new dbDioscar;
	$objFuncionarios->listaCaptura($unidad, $nombreBuscar, $escalafon, $grado, $camporOrden, $sentidoOrden, &$funcionarios);
	$cantidad = count($funcionarios);
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<funcionario>";
   		//echo "<codigo>".$funcionarios[$i]->getCodigoFuncionario()."</codigo>";
   		//echo "<apellidoPaterno>".$funcionarios[$i]->getApellidoPaterno()."</apellidoPaterno>";
   		//echo "<apellidoMaterno>".$funcionarios[$i]->getApellidoMaterno()."</apellidoMaterno>";
   		//echo "<nombre>".$funcionarios[$i]->getPNombre()."</nombre>";
   		//echo "<nombre2>".$funcionarios[$i]->getSNombre()."</nombre2>";
   		echo "<codigo>".$funcionarios[$i]->getCodigoSimccar()."</codigo>";
   		echo "<serie>".$funcionarios[$i]->getSeriesimccar()."</serie>";
   		echo "<tarjeta>".$funcionarios[$i]->getTarjetaSimccar()."</tarjeta>";
   		echo "<imei>".$funcionarios[$i]->getImei()."</imei>";
   		 echo "<estado>".$funcionarios[$i]->getEstadoVehiculo()->getDescripcion()."</estado>";
     echo "<codigoUnidadAgregado>".$funcionarios[$i]->getUnidadAgregado()->getCodigoUnidad()."</codigoUnidadAgregado>";
   	echo "<desUnidadAgregado>".$funcionarios[$i]->getUnidadAgregado()->getDescripcionUnidad()."</desUnidadAgregado>";
   		//echo "<mesCodigo>".$funcionarios[$i]->getCapturaDioscar()->getMes()."</mesCodigo>";
	 	echo "</funcionario>";
 	}
	echo "</root>";
 ?>
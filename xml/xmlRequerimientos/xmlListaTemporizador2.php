<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbRequerimientos.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/cargo.class.php");
  require("../../objetos/unidad.class.php");
	require("../../objetos/usuario.class.php");
	require("../../objetos/movimientoSolicitud.class.php");

		
	$unidad 	   = $_POST['codigoUnidad'];
	$nombreBuscar  = utf8_decode($_POST['nombreBuscar']);
	
	$sentidoOrden  = $_POST['sentido'];
	$camporOrden   = $_POST['campo'];
	
	$escalafon    = $_POST['escalafon'];
	$grado   	  = $_POST['grado'];
	
	//$unidad = "2495"; 
	//$nombreBuscar = "4";

	$objFuncionarios = new dbRequerimiento;
	$objFuncionarios->listaTemporizador2($unidad, $nombreBuscar, $escalafon, $grado, $camporOrden, $sentidoOrden, &$funcionarios);
	$cantidad = count($funcionarios);
	if ($funcionarios != ""){
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<temporizador>";
   		echo "<codigo>".$funcionarios[$i]->getCodigoSolicitud()."</codigo>";
   		echo "<unidad>".$funcionarios[$i]->getUnidad()."</unidad>";
   		echo "<movimiento>".$funcionarios[$i]->getCodigoMovimiento()."</movimiento>";
   		echo "<tipoMovimiento>".$funcionarios[$i]->getCodigoTipoMovimiento()."</tipoMovimiento>";
   		echo "<fechaInicio>".$funcionarios[$i]->getFechaInicio()."</fechaInicio>";
   		echo "<subproblema>".$funcionarios[$i]->getSubproblema()."</subproblema>";
	 	  echo "</temporizador>";
 	}
	echo "</root>";
	}else {
		echo "VACIO";
	}
 ?>
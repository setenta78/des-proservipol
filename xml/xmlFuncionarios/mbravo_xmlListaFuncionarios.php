<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbFuncionarios.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/cargo.class.php");
		
	$unidad 	   = $_POST['codigoUnidad'];
	$nombreBuscar  = utf8_decode($_POST['nombreBuscar']);
	
	$sentidoOrden  = $_POST['sentido'];
	$camporOrden   = $_POST['campo'];
	
	$escalafon    = $_POST['escalafon'];
	$grado   	  = $_POST['grado'];
	
	$unidad = "10"; 
	//$nombreBuscar = "4";

	$objFuncionarios = new dbFuncionarios;
	$objFuncionarios->listaTotalFuncionarios($unidad, $nombreBuscar, $escalafon, $grado, $camporOrden, $sentidoOrden, &$funcionarios);
	$cantidad = count($funcionarios);
  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<funcionario>";
   		echo "<codigo>".$funcionarios[$i]->getCodigoFuncionario()."</codigo>";
   		echo "<apellidoPaterno>".$funcionarios[$i]->getApellidoPaterno()."</apellidoPaterno>";
   		echo "<apellidoMaterno>".$funcionarios[$i]->getApellidoMaterno()."</apellidoMaterno>";
   		echo "<nombre>".$funcionarios[$i]->getPNombre()."</nombre>";
   		echo "<nombre2>".$funcionarios[$i]->getSNombre()."</nombre2>";
   		echo "<grado>".$funcionarios[$i]->getGrado()->getDescripcion()."</grado>";
   		echo "<cargo>".$funcionarios[$i]->getCargo()->getDescripcion()."</cargo>";
	 	echo "</funcionario>";
 	}
	echo "</root>";
 ?>
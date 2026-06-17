<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbFuncionarios.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/cargo.class.php");
	require("../../objetos/categoriaCargo.class.php");
	require("../../objetos/cuadrante.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/seccion.class.php");
	
	$unidad 	   = $_POST['codigoUnidad'];
	$nombreBuscar  = utf8_decode($_POST['nombreBuscar']);
	
	$sentidoOrden  = $_POST['sentido'];
	$camporOrden   = $_POST['campo'];
	
	$escalafon    = $_POST['escalafon'];
	$grado   	  = $_POST['grado'];

	$tipoUnidadNew	= $_POST['tipoUnidadNew'];
	$especialidadUnidadNew	= $_POST['especialidadUnidadNew'];

	$objFuncionarios = new dbFuncionarios;
	$objFuncionarios->listaTotalFuncionarios($unidad, $tipoUnidadNew, $especialidadUnidadNew, $nombreBuscar, $escalafon, $grado, $camporOrden, $sentidoOrden, &$funcionarios);
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
   		echo "<codigoCargo>".$funcionarios[$i]->getCargo()->getCodigo()."</codigoCargo>";
   		echo "<cargo>".$funcionarios[$i]->getCargo()->getDescripcion()."</cargo>";
   		echo "<grupoCargo>".$funcionarios[$i]->getCategoriaCargo()->getDescripcion()."</grupoCargo>";
   		echo "<cuadrante>".$funcionarios[$i]->getCuadrante()->getAbreviatura()."</cuadrante>";
   		echo "<unidadAgregado>".$funcionarios[$i]->getUnidadAgregado()->getDescripcionUnidad()."</unidadAgregado>";
    	echo "<seccion>".$funcionarios[$i]->getSeccion()->getDescripcion()."</seccion>";
	 	echo "</funcionario>";
 	}
	echo "</root>";
 ?>
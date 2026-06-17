<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbFuncionarios.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/funcionariosUnidad.class.php");
				
	$unidad 		= $_POST['codigoUnidad'];
	$fecha1 		= $_POST['fecha1'];
	$escalafon 		= $_POST['escalafon'];
	$grado 			= $_POST['grado'];
	$tipoUnidad 	= $_POST['tipoUnidad'];
	$desGrado 		= $_POST['desGrado']; 
	$inicio 		= $_POST['inicio'];
	
	$fechaPaso 		= explode("-",$fecha1);
  $fechaBuscar1   = $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];
	
	$objFuncionarios = new dbFuncionarios;
	$objFuncionarios->listaCantidadFuncionarios($unidad, $tipoUnidad, $escalafon, $grado, $desGrado, $fechaBuscar1, $inicio, &$funcionariosUnidad);
	$cantidad = count($funcionariosUnidad);
	if ($funcionariosUnidad != ""){
		echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
		echo "<root>";
	 	for ($i=0; $i<$cantidad; $i++){
	 		echo "<funcionarios>";
	 		echo "<codUnidad>".$funcionariosUnidad[$i]->getUnidad()->getCodigoUnidad()."</codUnidad>";
	 		echo "<desUnidad>".$funcionariosUnidad[$i]->getUnidad()->getDescripcionUnidad()."</desUnidad>";
	 		echo "<codEscalafon>".$funcionariosUnidad[$i]->getGrado()->getEscalafon()."</codEscalafon>";
	 		echo "<codGrado>".$funcionariosUnidad[$i]->getGrado()->getCodigo()."</codGrado>";
	 		echo "<desGrado>".$funcionariosUnidad[$i]->getGrado()->getDescripcion()."</desGrado>";
	 		echo "<cantidadFuncionarios>".$funcionariosUnidad[$i]->getCantidadFuncionarios()."</cantidadFuncionarios>";
	 		echo "</funcionarios>";
	 	}
		echo "</root>";
	} else {
		echo "VACIO";
	}
?>
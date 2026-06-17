<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbCapacitados.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/grado.class.php");
	
	$unidad 	   	 = $_POST['codigoUnidad'];
		
	$objFuncionarios = new dbCapacitados;
	$objFuncionarios->listaFuncionariosConCargoPorDefinir($unidad, &$funcionarios);
	$cantidad = count($funcionarios);
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		echo "<funcionario>";
   		echo "<codigo>".$funcionarios[$i]->getCodigoFuncionario()."</codigo>";
   		echo "<nombre>".$funcionarios[$i]->getApellidoPaterno()." ".$funcionarios[$i]->getApellidoMaterno().", ".$funcionarios[$i]->getPNombre()."</nombre>";
   		echo "<grado>".$funcionarios[$i]->getGrado()->getDescripcion()."</grado>";
	 		echo "</funcionario>";
 		}
	echo "</root>";
?>
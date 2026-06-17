<?
	header ('content-type: text/xml');
	include("configuracionBD2.php"); 
	require("../db/dbFuncionarios.class.php");
	require("../objetos/funcionario.class.php");
		
	$codigo = $_POST['codigo'];

	$objFuncionarios = new dbFuncionarios;
	$objFuncionarios->listaTotalFuncionarios($codigo,&$funcionarios);
	
	$cantidad = count($funcionarios);
  echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  echo "<root>";
  for ($i=0; $i < $cantidad; $i++){
  		echo "<funcionario>";
  		
		 		echo "<codigo>".$funcionarios[$i]->getCodigoFuncionario()."</codigo>";
		 		echo "<nombre>".$funcionarios[$i]->getNombreCompleto()."</nombre>";
		 		echo "<grado>".$funcionarios[$i]->getGrado()."</grado>";
		 		echo "<unidad>".$funcionarios[$i]->getUnidad()."</unidad>";	 		
 
		echo "</funcionario>";
 	}
	echo "</root>";
?>
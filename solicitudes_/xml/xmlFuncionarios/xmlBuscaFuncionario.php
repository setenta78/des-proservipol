<?
	header ('content-type: text/xml');
	include("../configuracionBDPersonalFicha.php"); 
	require("../../baseDatos/dbFuncionarios.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/escalafon.class.php");
	require("../../objetos/grado.class.php");
		
	$codigoFuncionario = strtoupper($_POST['codigoFuncionario']);
	
	//$codigoFuncionario = "007174T";
		
	$objFuncionarios = new dbFuncionarios;
	$objFuncionarios->buscarFuncionarioPersonal($codigoFuncionario, &$funcionarios);
	$cantidad = count($funcionarios);
  	if ($cantidad > 0){
	  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	  	echo "<root>";
	   	for ($i=0; $i<$cantidad; $i++){
	   			   		
	   		echo "<funcionario>";
	   		echo "<rut>".$funcionarios[$i]->getRutFuncionario()."</rut>";
	   		echo "<codigo>".$funcionarios[$i]->getCodigoFuncionario()."</codigo>";
	   		echo "<apellidoPaterno>".$funcionarios[$i]->getApellidoPaterno()."</apellidoPaterno>";
	   		echo "<apellidoMaterno>".$funcionarios[$i]->getApellidoMaterno()."</apellidoMaterno>";
	   		echo "<nombre>".$funcionarios[$i]->getPNombre()."</nombre>";
	   		echo "<nombre2>".$funcionarios[$i]->getSNombre()."</nombre2>";
	   		echo "<codigoEscalafon>".$funcionarios[$i]->getGrado()->getEscalafon()->getCodigo()."</codigoEscalafon>";
	   		echo "<codigoGrado>".$funcionarios[$i]->getGrado()->getCodigo()."</codigoGrado>";
		 	echo "</funcionario>";
	 	}
		echo "</root>";
	} else {
		echo "VACIO";
	}
 ?>
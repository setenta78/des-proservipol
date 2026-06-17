<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbActividadFueraCuartel.class.php");
	require("../../objetos/funcionario.class.php");
	
	session_start();
	$codigoUsuario  = $_SESSION['USUARIO_CODIGOFUNCIONARIO'];
	
	$objFuncionario = new dbActividadFueraCuartel;
	$objFuncionario->rutUsuario($codigoUsuario, &$funcionarios);
	$cantidad = count($funcionarios);
  	if ($cantidad > 0){
	  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	  	echo "<root>";
	   	for ($i=0; $i < $cantidad; $i++){
	   			   		
	   	echo "<funcionario>";
	   		echo "<rut>".$funcionarios[$i]->getRutFuncionario()."</rut>";     
		 	echo "</funcionario>";
	 	}
		echo "</root>";
	} else {
		echo "VACIO";
	}
 ?>
<?
	header ('content-type: text/xml');
	include("../baseDatos/config1.inc.php"); 
	include("../baseDatos/config2.inc.php"); 
	require("../baseDatos/dbUsuarios.class.php");
	require("../objetos/usuario.class.php");
		
	$codigoUnidad = strtoupper($_POST['unidad']);
	$codigoPadre  = strtoupper($_POST['padre']);
	$modulo       = strtoupper($_POST['modulo']);
	
	//$codigoFuncionario = "982216K";
	//$codigoFuncionario = "652570N";
		
	$objFuncionarios = new dbUsuarios;
	$objFuncionarios->buscaFuncionarios($codigoUnidad, &$funcionarios, $codigoPadre, $modulo);
	$cantidad = count($funcionarios);

  	if ($cantidad > 0){
	  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	  	echo "<root>";
	   	for ($i=0; $i<$cantidad; $i++){

	   		echo "<funcionario>";
	   		echo "<codigo>".$funcionarios[$i]->getCodigoFuncionario()."</codigo>";
	   		echo "<apellidoPaterno>".$funcionarios[$i]->getApellidoPaterno()."</apellidoPaterno>";
	   		echo "<apellidoMaterno>".$funcionarios[$i]->getApellidoMaterno()."</apellidoMaterno>";
	   		echo "<nombre>".$funcionarios[$i]->getPNombre()."</nombre>";

	   		echo "<descGrado>".$funcionarios[$i]->getGradoDescripcion()."</descGrado>";
	   		echo "<usuarioModulo>".$funcionarios[$i]->getUsuarioModulo()."</usuarioModulo>";

	   		echo "<usuarioFechaDesde1>".$funcionarios[$i]->getUsuarioFechaDesde1()."</usuarioFechaDesde1>";
	   		echo "<usuarioTipo1>".$funcionarios[$i]->getUsuarioTipo1()."</usuarioTipo1>";

		 	echo "</funcionario>";
	 	}
		echo "</root>";
	} else {
		echo "VACIO";
	}
 ?>
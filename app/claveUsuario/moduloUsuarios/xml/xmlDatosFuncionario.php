<?
	header ('content-type: text/xml');
	include("../baseDatos/config1.inc.php"); 
	include("../baseDatos/config2.inc.php"); 
	require("../baseDatos/dbFuncionarios.class.php");
	require("../objetos/funcionario.class.php");
		
	$codigoFuncionario = strtoupper($_POST['codigoFuncionario']);
	
	//$codigoFuncionario = "982216K";
	//$codigoFuncionario = "652570N";
		
	$objFuncionarios = new dbFuncionarios;
	$objFuncionarios->buscaFuncionarios($codigoFuncionario, &$funcionarios);
	$cantidad = count($funcionarios);

  	if ($cantidad > 0){
	  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	  	echo "<root>";
	   	for ($i=0; $i<$cantidad; $i++){

/*
	   		$fechaPaso 		= explode("-",$funcionarios[$i]->getCargo()->getFechaDesde());
	   		$fechaMostrar   = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
*/
	   		echo "<funcionario>";
	   		echo "<codigo>".$funcionarios[$i]->getCodigoFuncionario()."</codigo>";
	   		echo "<apellidoPaterno>".$funcionarios[$i]->getApellidoPaterno()."</apellidoPaterno>";
	   		echo "<apellidoMaterno>".$funcionarios[$i]->getApellidoMaterno()."</apellidoMaterno>";
	   		echo "<nombre>".$funcionarios[$i]->getPNombre()."</nombre>";
	   		echo "<nombre2>".$funcionarios[$i]->getSNombre()."</nombre2>";

	   		echo "<descGrado>".$funcionarios[$i]->getGradoDescripcion()."</descGrado>";

	   		echo "<codUnidadFuncionario>".$funcionarios[$i]->getCodUnidadFuncionario()."</codUnidadFuncionario>";
	   		echo "<tipoUnidadFuncionario>".$funcionarios[$i]->getTipoUnidadFuncionario()."</tipoUnidadFuncionario>";
	   		echo "<descUnidadFuncionario>".$funcionarios[$i]->getDescUnidadFuncionario()."</descUnidadFuncionario>";
	   		echo "<especialidadUnidadFuncionario>".$funcionarios[$i]->getEspecialidadUnidadFuncionario()."</especialidadUnidadFuncionario>";

	   		echo "<codUnidadPadreFuncionario>".$funcionarios[$i]->getCodUnidadPadreFuncionario()."</codUnidadPadreFuncionario>";

	   		echo "<codUnidadUsuario>".$funcionarios[$i]->getCodUnidadUsuario()."</codUnidadUsuario>";
	   		echo "<tipoUnidadUsuario>".$funcionarios[$i]->getTipoUnidadUsuario()."</tipoUnidadUsuario>";
	   		echo "<descUnidadUsuario>".$funcionarios[$i]->getDescUnidadUsuario()."</descUnidadUsuario>";

	   		echo "<usuarioFechaDesde1>".$funcionarios[$i]->getUsuarioFechaDesde1()."</usuarioFechaDesde1>";
	   		echo "<usuarioTipo1>".$funcionarios[$i]->getUsuarioTipo1()."</usuarioTipo1>";

	   		//echo "<usuarioFechaDesde2>".$funcionarios[$i]->getUsuarioFechaDesde2()."</usuarioFechaDesde2>";
	   		//echo "<usuarioTipo2>".$funcionarios[$i]->getUsuarioTipo2()."</usuarioTipo2>";



		 	echo "</funcionario>";
	 	}
		echo "</root>";
	} else {
		echo "VACIO";
	}
 ?>
<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbFuncionarios.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/escalafon.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/cargo.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/seccion.class.php");
	
	$codigoFuncionario = strtoupper($_POST['codigoFuncionario']);
	$objFuncionarios = new dbFuncionarios;
	$objFuncionarios->buscaFuncionarios($codigoFuncionario, &$funcionarios);
	$cantidad = count($funcionarios);
  	if ($cantidad > 0){
	  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	  	echo "<root>";
	   	for ($i=0; $i<$cantidad; $i++){
	   		$fechaPaso 		= explode("-",$funcionarios[$i]->getCargo()->getFechaDesde());
	   		$fechaMostrar = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	   		
	   		echo "<funcionario>";
		   		echo "<codigo>".$funcionarios[$i]->getCodigoFuncionario()."</codigo>";
		   		echo "<apellidoPaterno>".$funcionarios[$i]->getApellidoPaterno()."</apellidoPaterno>";
		   		echo "<apellidoMaterno>".$funcionarios[$i]->getApellidoMaterno()."</apellidoMaterno>";
		   		echo "<nombre>".$funcionarios[$i]->getPNombre()."</nombre>";
		   		echo "<nombre2>".$funcionarios[$i]->getSNombre()."</nombre2>";
		   		echo "<codigoEscalafon>".$funcionarios[$i]->getGrado()->getEscalafon()->getCodigo()."</codigoEscalafon>";
		   		echo "<codigoGrado>".$funcionarios[$i]->getGrado()->getCodigo()."</codigoGrado>";
		   		echo "<grado>".$funcionarios[$i]->getGrado()->getDescripcion()."</grado>";
		   		echo "<codigoCargo>".$funcionarios[$i]->getCargo()->getCodigo()."</codigoCargo>";
		   		echo "<cargo>".$funcionarios[$i]->getCargo()->getDescripcion()."</cargo>";
		   		echo "<categoriaCargo>".$funcionarios[$i]->getCategoriaCargo()."</categoriaCargo>";
		   		echo "<fechaCargo>".$fechaMostrar."</fechaCargo>";
		   		echo "<codigoCuadranteCargo>".$funcionarios[$i]->getCargo()->getCuadrante()."</codigoCuadranteCargo>";
		   		echo "<codigoUnidad>".$funcionarios[$i]->getUnidad()->getCodigoUnidad()."</codigoUnidad>";
		   		echo "<unidad>".$funcionarios[$i]->getUnidad()->getDescripcionUnidad()."</unidad>";
		   		echo "<codigoUnidadAgregado>".$funcionarios[$i]->getUnidadAgregado()->getCodigoUnidad()."</codigoUnidadAgregado>";
		   		echo "<unidadAgregado>".$funcionarios[$i]->getUnidadAgregado()->getDescripcionUnidad()."</unidadAgregado>";
		   		echo "<dia>".$funcionarios[$i]->GetCargo()->getDias()."</dia>";
				echo "<codigoSeccion>".$funcionarios[$i]->getSeccion()->getCodigo()."</codigoSeccion>";
				echo "<seccion>".$funcionarios[$i]->getSeccion()->getDescripcion()."</seccion>";
				echo "<rut>".$funcionarios[$i]->getRutFuncionario()."</rut>";
		 	echo "</funcionario>";
	 	}
		echo "</root>";
	} else {
		echo "VACIO";
	}
 ?>
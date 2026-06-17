<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbFerper.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/ferper.class.php");
	
	$codFuncionario = strtoupper($_POST['codFuncionario']);
	$folio					= strtoupper($_POST['folio']);
	
	$objFuncionarios = new dbFerper;
	$objFuncionarios->buscaFichaPermiso($codFuncionario, $folio, &$funcionarios);
	$cantidad = count($funcionarios);
  if ($cantidad > 0){
	 	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	 	echo "<root>";
	 	for ($i=0; $i<$cantidad; $i++){
	 		
	 		$fechaPaso 	= explode("-",$funcionarios[$i]->getTipoPermiso()->getFechaInicio());
	 		$fechaI			= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
			$fechaPaso 	= explode("-",$funcionarios[$i]->getTipoPermiso()->getFechaTermino());
	 		$fechaT			= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	 		$fechaPaso 	= explode("-",$funcionarios[$i]->getTipoPermiso()->getFechaTerminoReal());
	 		$fechaTR		= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	 		$fechaPaso 	= explode("-",$funcionarios[$i]->getTipoPermiso()->getFechaRegistro());
	 		$fechaR			= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	   		
	 		$rutPaso		= $funcionarios[$i]->getRutFuncionario();
	 		$rutDig			= substr($rutPaso, -1);
	 		$rutNum			= substr ($rutPaso, 0, strlen($rutPaso) - 1);
	 		$rut				= number_format($rutNum,0,'','.')."-".$rutDig;
			
	  	echo "<funcionario>";
	   		echo "<codigo>".$funcionarios[$i]->getCodigoFuncionario()."</codigo>";
	   		echo "<rut>".$rut."</rut>";
	   		echo "<apellidoPaterno>".$funcionarios[$i]->getApellidoPaterno()."</apellidoPaterno>";
	   		echo "<apellidoMaterno>".$funcionarios[$i]->getApellidoMaterno()."</apellidoMaterno>";
	   		echo "<nombre>".$funcionarios[$i]->getPNombre()."</nombre>";
	   		echo "<nombre2>".$funcionarios[$i]->getSNombre()."</nombre2>";
	   		echo "<unidad>".$funcionarios[$i]->getUnidad()."</unidad>";
	   		echo "<folio>".$funcionarios[$i]->getTipoPermiso()->getFolio()."</folio>";
	   		echo "<fechaI>".$fechaI."</fechaI>";
	   		echo "<fechaT>".$fechaT."</fechaT>";
	   		echo "<fechaTR>".$fechaTR."</fechaTR>";
	   		echo "<fechaR>".$fechaR."</fechaR>";
	   		echo "<tipoPermiso>".$funcionarios[$i]->getTipoPermiso()->getTipoPermiso()."</tipoPermiso>";
	   		echo "<archivo>".$funcionarios[$i]->getTipoPermiso()->getArchivoPermiso()."</archivo>";
		 	echo "</funcionario>";
	 	}
		echo "</root>";
	} else {
		echo "VACIO";
	}
 ?>
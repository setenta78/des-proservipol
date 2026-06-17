<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbActividadFueraCuartel.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/actividadFueraCuartel.class.php");
	
	$codActividad   = $_POST['codActividad'];
    $codUnidad      = $_POST['codUnidad'];
	$objActividad = new dbActividadFueraCuartel;
	$objActividad->buscaFichaActividad($codActividad, $codUnidad, &$funcionario);
	$cantidad = count($funcionario);
    if ($cantidad > 0){
	 	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	 	echo "<root>";
	 	for ($i=0; $i<$cantidad; $i++){
	 		
	 		$fechaPaso 		= explode("-",$funcionario[$i]->getActividadFueraCuartel()->getFechaInicio());
	 		$fechaI			= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
			$fechaPaso 		= explode("-",$funcionario[$i]->getActividadFueraCuartel()->getFechaTermino());
	 		$fechaT			= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	 		$fechaPaso 		= explode("-",$funcionario[$i]->getActividadFueraCuartel()->getFechaTerminoReal());
	 		$fechaTR		= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
			$rutPaso		= $funcionario[$i]->getRutFuncionario();
	 		$rutDig			= substr($rutPaso, -1);
	 		$rutNum			= substr ($rutPaso, 0, strlen($rutPaso) - 1);
	 		$rut			= number_format($rutNum,0,'','.')."-".$rutDig;
			
	  	    echo "<funcionario>";
			  	echo "<codigo>".$funcionario[$i]->getActividadFueraCuartel()->getCodActividadFueraCuartel()."</codigo>";
                echo "<codigoFuncionario>".$funcionario[$i]->getCodigoFuncionario()."</codigoFuncionario>";
                echo "<rut>".$rut."</rut>";
                echo "<primerApellido>".$funcionario[$i]->getApellidoPaterno()."</primerApellido>";
                echo "<segundoApellido>".$funcionario[$i]->getApellidoMaterno()."</segundoApellido>";
                echo "<nombre>".$funcionario[$i]->getPNombre()."</nombre>";
                echo "<nombre2>".$funcionario[$i]->getSNombre()."</nombre2>";
                echo "<unidad>".$funcionario[$i]->getUnidad()."</unidad>";
                echo "<fechaI>".$fechaI."</fechaI>";
                echo "<fechaT>".$fechaT."</fechaT>";
                echo "<fechaTR>".$fechaTR."</fechaTR>";
                echo "<tipo>".$funcionario[$i]->getActividadFueraCuartel()->getTipoActividad()."</tipo>";
                echo "<numDocumento>".$funcionario[$i]->getActividadFueraCuartel()->getNumDocumento()."</numDocumento>";
		 	echo "</funcionario>";
	 	}
		echo "</root>";
	} else {
		echo "VACIO";
	}
 ?>
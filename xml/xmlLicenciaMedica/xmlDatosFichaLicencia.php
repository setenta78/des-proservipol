<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbLicenciaMedica.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/escalafon.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/cargo.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/licenciaMedica.class.php");
	
	$codFuncionario = strtoupper($_POST['codFuncionario']);
	$color 					= strtoupper($_POST['color']);
	$folio					= strtoupper($_POST['folio']);
	
	$objFuncionarios = new dbLicencia;
	$objFuncionarios->buscaFichaLicencia($codFuncionario, $color, $folio, &$funcionarios);
	$cantidad = count($funcionarios);
  	if ($cantidad > 0){
	  	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	  	echo "<root>";
	   	for ($i=0; $i<$cantidad; $i++){
	   		$fechaPaso 	= explode("-",$funcionarios[$i]->getTipoLicencia()->getFecha1());
	   		$fecha1			= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	   		$fechaPaso 	= explode("-",$funcionarios[$i]->getTipoLicencia()->getFecha2());
	   		$fecha2			= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	   		$fechaPaso 	= explode("-",$funcionarios[$i]->getTipoLicencia()->getFecha3());
	   		$fecha3			= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	   		$fechaPaso 	= explode("-",$funcionarios[$i]->getTipoLicencia()->getFechaInicioReal());
	   		$fechaIR		= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	   		$fechaPaso 	= explode("-",$funcionarios[$i]->getTipoLicencia()->getFechaTerminoReal());
	   		$fechaTR		= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	   		$fechaPaso 	= explode("-",$funcionarios[$i]->getTipoLicencia()->getFechaTerminoInicial());
	   		$fechaT			= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	   		
	   		$rutPaso		= $funcionarios[$i]->getRutFuncionario();
	   		$rutDig			= substr($rutPaso, -1);
	   		$rutNum			= substr ($rutPaso, 0, strlen($rutPaso) - 1);
	   		$rut				= number_format($rutNum,0,'','.')."-".$rutDig;
	   		$rutPaso		= $funcionarios[$i]->getTipoLicencia()->getRutProfesional();
	   		$rutDig			= substr($rutPaso, -1);
	   		$rutNum			= substr ($rutPaso, 0, strlen($rutPaso) - 1);
	   		$rutProf		= number_format($rutNum,0,'','.')."-".$rutDig;
	   		$rutPaso		= $funcionarios[$i]->getTipoLicencia()->getRutHijo();
	   		$rutDig			= substr($rutPaso, -1);
	   		$rutNum			= substr ($rutPaso, 0, strlen($rutPaso) - 1);
	   		$rutHijo		= number_format($rutNum,0,'','.')."-".$rutDig;
	   	
	   	echo "<funcionario>";
	   		echo "<codigo>".$funcionarios[$i]->getCodigoFuncionario()."</codigo>";
	   		echo "<rut>".$rut."</rut>";
	   		echo "<apellidoPaterno>".$funcionarios[$i]->getApellidoPaterno()."</apellidoPaterno>";
	   		echo "<apellidoMaterno>".$funcionarios[$i]->getApellidoMaterno()."</apellidoMaterno>";
	   		echo "<nombre>".$funcionarios[$i]->getPNombre()."</nombre>";
	   		echo "<nombre2>".$funcionarios[$i]->getSNombre()."</nombre2>";
	   		echo "<unidad>".$funcionarios[$i]->getUnidad()."</unidad>";
	   		echo "<color>".$funcionarios[$i]->getTipoLicencia()->getColor()."</color>";
	   		echo "<folio>".$funcionarios[$i]->getTipoLicencia()->getFolio()."</folio>";
	   		echo "<fechaO>".$fecha1."</fechaO>";
	   		echo "<fechaI>".$fecha2."</fechaI>";
	   		echo "<dias>".$funcionarios[$i]->getTipoLicencia()->getDias()."</dias>";
	   		echo "<fechaIR>".$fechaIR."</fechaIR>";
	   		echo "<fechaTR>".$fechaTR."</fechaTR>";
	   		echo "<tipoLicencia>".$funcionarios[$i]->getTipoLicencia()->getTipoLicencia()."</tipoLicencia>";
	   		echo "<recuperacion>".$funcionarios[$i]->getTipoLicencia()->getRecuperacion()."</recuperacion>";
	   		echo "<invalidez>".$funcionarios[$i]->getTipoLicencia()->getInvalidez()."</invalidez>";
	   		echo "<tipoReposo>".$funcionarios[$i]->getTipoLicencia()->getTipoReposo()."</tipoReposo>";
	   		echo "<lugarReposo>".$funcionarios[$i]->getTipoLicencia()->getLugarReposo()."</lugarReposo>";
	   		echo "<rutProfesional>".$rutProf."</rutProfesional>";
	   		echo "<tipoProfesional>".$funcionarios[$i]->getTipoLicencia()->getTipoProfesional()."</tipoProfesional>";
	   		echo "<especialidad>".$funcionarios[$i]->getTipoLicencia()->getEspecialidad()."</especialidad>";
	   		echo "<tipoAtencion>".$funcionarios[$i]->getTipoLicencia()->getAtencion()."</tipoAtencion>";
	   		echo "<rutHijo>".$rutHijo."</rutHijo>";
	   		echo "<fechaHijo>".$fecha3."</fechaHijo>";
	   		echo "<archivo>".$funcionarios[$i]->getTipoLicencia()->getArchivoLicenciaMedica()."</archivo>";
	   		echo "<fechaTerminoInicial>".$fechaT."</fechaTerminoInicial>";
		 	echo "</funcionario>";
	 	}
		echo "</root>";
	} else {
		echo "VACIO";
	}
?>
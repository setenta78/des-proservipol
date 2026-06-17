<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbCapacitados.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/capacitacion.class.php");
	
	$codigoVerificacion = $_POST['codigoVerificacion'];
	$codigoFuncionario  = $_POST['codigoFuncionario'];
	
	$objCapacitacion = new dbCapacitados;
	$objCapacitacion->buscarCertificado($codigoVerificacion, $codigoFuncionario, &$certificado);
	$cantidad = count($certificado);
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
   	for ($i=0; $i<$cantidad; $i++){
   		
   		$fechaPaso 	= explode("-",$certificado[$i]->getCapacitacion()->getFechaCapacitacion());
	   	$fechaCapacitacion = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	   	$fechaValidez = "Abril " . ($fechaPaso[0]+1);
	   	
   		echo "<certificado>";
			echo "<codigo>".$certificado[$i]->getCodigoFuncionario()."</codigo>";
			echo "<apellidoPaterno>".$certificado[$i]->getApellidoPaterno()."</apellidoPaterno>";
			echo "<apellidoMaterno>".$certificado[$i]->getApellidoMaterno()."</apellidoMaterno>";
			echo "<nombre>".$certificado[$i]->getPNombre()."</nombre>";
			echo "<nombre2>".$certificado[$i]->getSNombre()."</nombre2>";
			echo "<grado>".$certificado[$i]->getGrado()->getDescripcion()."</grado>";
			echo "<fechaCapacitacion>".$fechaCapacitacion."</fechaCapacitacion>";
			echo "<fechaValidez>".$fechaValidez."</fechaValidez>";
			echo "<versionProservipol>".$certificado[$i]->getCapacitacion()->getVersionProservipol()."</versionProservipol>";
			echo "<tipoCapacitacion>".$certificado[$i]->getCapacitacion()->getTipoCapacitacion()."</tipoCapacitacion>";
			echo "<codVerificacion>".$certificado[$i]->getCapacitacion()->getCodigoVerificacion()."</codVerificacion>";
	 	echo "</certificado>";
 		}
	echo "</root>";
?>
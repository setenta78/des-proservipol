<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbFuncionarios.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/cargo.class.php");
	
	$unidad				= $_POST['codigoUnidad'];
	$fechaServicio		= $_POST['fechaServicio'];
	$tipoServicio		= $_POST['tipoServicio'];
	$correlativo		= $_POST['correlativo'];
	$servicio			= $_POST['servicio'];
	$horaInicio			= $_POST['horaInicio'];
	$horaTermino		= $_POST['horaTermino'];
	$unidadTipo			= $_POST['unidadTipo'];
	$especialidadUnidad	= $_POST['especialidadUnidad'];
	
	$fechaPaso			= explode("-",$fechaServicio);
	$fechaBuscar		= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	
	$nextDay = false;
	if($horaInicio >= $horaTermino && $horaTermino!='00:00') $nextDay = true;
	
	$objFuncionarios = new dbFuncionarios;
	$objFuncionarios->listaFuncionariosDisponibles($unidad, $unidadTipo, $especialidadUnidad, $fechaBuscar, $tipoServicio, $horaInicio, $horaTermino, $correlativo, $servicio, $nextDay, &$funcionarios);
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
			echo "<grado>".$funcionarios[$i]->getGrado()->getDescripcion()."</grado>";
			echo "</funcionario>";
		}
		echo "</root>";
	} else {
		echo "VACIO";
	}
?>
<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
	require("../../baseDatos/dbFuncionarios.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/escalafon.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/cargo.class.php");
	require("../../objetos/unidad.class.php");

	//$fechaActual = date("Y-m-d");     

	$codigoFuncionario	= strtoupper($_POST['codigoFuncionario']);
	$codigoUnidad	 	= $_POST['codigoUnidad'];
	$fechaActual		= $_POST['fechaMovimiento'];          

	$fechaPaso 			= explode("-",$fechaActual);                                    
	$fechaMovimiento  	= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];  


	$cargo = new cargo;
	$cargo->setCodigo('1000');
	$cargo->setDescripcion("RETIRO");
	
	$unidad = new unidad;
	$unidad->setCodigoUnidad($codigoUnidad);
	$unidad->setDescripcionUnidad("");
                       
	$funcionario = new funcionario;
	$funcionario->setCodigoFuncionario($codigoFuncionario);
	$funcionario->setCargo($cargo);
	$funcionario->setUnidad($unidad);
		
	$objDBFuncionarios = new dbFuncionarios;
	$resultadoRetiro = $objDBFuncionarios->updateCargoFuncionario($funcionario, $fechaMovimiento);
	$resultadoRetiro = $objDBFuncionarios->bajaRetiroFuncionario($funcionario, $motivo, $fechaMovimiento);
				
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultadoRetiro."</resultado>";
   	echo "</root>";
?>
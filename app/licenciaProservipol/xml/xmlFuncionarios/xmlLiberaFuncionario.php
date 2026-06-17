<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
	require("../../baseDatos/dbFuncionarios.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/cargo.class.php");
	require("../../objetos/unidad.class.php");
    require("../../objetos/seccion.class.php"); //Llamada agregada el 05-05-2015
		
	session_start();
				
	$codigoFuncionario			= strtoupper($_POST['codigoFuncionario']);
	$codigoUnidad				= $_SESSION['USUARIO_CODIGOUNIDAD']; 
	//$fechaActual    			= date("Y-m-d",$_POST['fechaMovimiento']);   
	$fechaActual				= $_POST['fechaMovimiento'];
	$codigoCuadrantePaso 		= "Null";
	$codigoUnidadAgregadoPaso   = "Null";
	
	$fechaPaso 			= explode("-",$fechaActual);                                    
	$fechaMovimiento  	= $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];   
		
	$cargo = new cargo;
	$cargo->setCodigo(3500);
	$cargo->setDescripcion("");
	$cargo->setCuadrante($codigoCuadrantePaso);
	
	$unidad = new unidad;
	$unidad->setCodigoUnidad($codigoUnidad);
	$unidad->setDescripcionUnidad("");

	$unidadAgregado = new unidad;
	$unidadAgregado->setCodigoUnidad($codigoUnidadAgregadoPaso);
	$unidadAgregado->setDescripcionUnidad("");
    
    //Instancia agregada el 05-05-2015
   	$seccion = new seccion;
	$seccion->setCodigo("0");
	$seccion->setDescripcion("");

	
	$funcionario = new funcionario;
	$funcionario->setCodigoFuncionario($codigoFuncionario);
	$funcionario->setCargo($cargo);
	$funcionario->setUnidad($unidad);
	$funcionario->setUnidadAgregado($unidadAgregado);
    $funcionario->setSeccion($seccion); //Variable agregada el 05-05-2015
	
	$objDBFuncionarios = new dbFuncionarios;
	$resultado = $objDBFuncionarios->dejarDisponible($funcionario, $fechaMovimiento);
	$resultado = $objDBFuncionarios->updateCargoFuncionario($funcionario, $fechaMovimiento);
	$resultado = $objDBFuncionarios->insertCargoFuncionario($funcionario, $fechaMovimiento);
			
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
?>
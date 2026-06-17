<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbFuncionarios.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/escalafon.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/cargo.class.php");
	require("../../objetos/unidad.class.php");
  require("../../objetos/seccion.class.php"); //Llamada agregada el 29-04-2015

	session_start();
		
	$codigoUnidad		  = $_SESSION['USUARIO_CODIGOUNIDAD']; 
	$codigoUsuario		  = $_SESSION['USUARIO_CODIGOFUNCIONARIO']; 
			
	$codigoFuncionario	  = utf8_decode($_POST['codigoFuncionario']);
	$codigoEscalafon 	  = $_POST['codigoEscalafon'];
	$codigoGrado 		  = $_POST['codigoGrado'];
	$apellidoPaterno  	  = utf8_decode($_POST['apellidoPaterno']);
	$apellidoMaterno  	  = utf8_decode($_POST['apellidoMaterno']);
	$primerNombre	  	  = utf8_decode($_POST['primerNombre']);
	$segundoNombre	  	  = utf8_decode($_POST['segundoNombre']);
	$codigoCargo	 	  = $_POST['codigoCargo'];
	$codigoCuadrante 	  = $_POST['codigoCuadrante'];
	$codigoUnidadAgregado = $_POST['codigoUnidadAgregado'];
	$fechaCargo	 		  = $_POST['fechaCargo'];
  $codigoSecccion		  = $_POST['seccion'];  //Variable agregada el 28-04-2015
  $dias		          = $_POST['dias'];  //Variable agregada el 28-04-2015

	if ($codigoCuadrante == 0) $codigoCuadrantePaso = "Null";
	else $codigoCuadrantePaso = $codigoCuadrante;

	if ($codigoUnidadAgregado == "") $codigoUnidadAgregadoPaso = "Null";
	else $codigoUnidadAgregadoPaso = $codigoUnidadAgregado;

	$unidad = new unidad;
	$unidad->setCodigoUnidad($codigoUnidad);
	$unidad->setDescripcionUnidad("");

	$unidadAgregado = new unidad;
	$unidadAgregado->setCodigoUnidad($codigoUnidadAgregadoPaso);
	$unidadAgregado->setDescripcionUnidad("");
	                        
	$escalafon = new escalafon;
	$escalafon->setCodigo($codigoEscalafon);
	$escalafon->setDescripcion("");
	
	$grado = new grado;
	$grado->setEscalafon($escalafon);
	$grado->setCodigo($codigoGrado);
	$grado->setDescripcion("");
	
	$cargo = new cargo;
	$cargo->setCodigo($codigoCargo);
	$cargo->setDescripcion("");
	$cargo->setCuadrante($codigoCuadrantePaso);
    
  //Instancia agregada el 29-04-2015
  $seccion = new seccion;
	$seccion->setCodigo($codigoSecccion);
	$seccion->setDescripcion("");
	
	$funcionario = new funcionario;
	$funcionario->setCodigoFuncionario($codigoFuncionario);
	$funcionario->setApellidoPaterno($apellidoPaterno);
	$funcionario->setApellidoMaterno($apellidoMaterno);
	$funcionario->setPNombre($primerNombre);
	$funcionario->setSNombre($segundoNombre);
	$funcionario->setGrado($grado);
	$funcionario->setCargo($cargo);
	$funcionario->setUnidad($unidad);
	$funcionario->setUnidadAgregado($unidadAgregado);
  $funcionario->setSeccion($seccion); //Instancia agregada a 29-04-2015
		
	$objDBFuncionarios = new dbFuncionarios;
	$resultado = $objDBFuncionarios->updateFuncionario($funcionario);
	
	if ($codigoCuadrante != 0 && $fechaCargo == "") $objDBFuncionarios->updateCuadranteFuncionario($funcionario);
	
	if ($fechaCargo != ""){
		$fechaPaso 		= explode("-",$fechaCargo);
   		$fechaIngresar  = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
   		
		$resultado = $objDBFuncionarios->updateCargoFuncionarioPaso($funcionario, $fechaIngresar);
		$resultado = $objDBFuncionarios->insertCargoFuncionarioPaso($funcionario, $fechaIngresar);
	}
			
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
 ?>
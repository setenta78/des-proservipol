<?
	header ('content-type: text/xml');
	include("../configuracionBD2.php"); 
	require("../../baseDatos/dbLicenciaMedica.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/escalafon.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/cargo.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/licenciaMedica.class.php");
  require("../../objetos/servicio.class.php");
	require("../../objetos/tipoServicio.class.php");
	require("../../objetos/tipoServicioExtraordinario.class.php");
	

	session_start();
	$codigoUnidad		= $_SESSION['USUARIO_CODIGOUNIDAD']; 
	$codigoUsuario		= $_SESSION['USUARIO_CODIGOFUNCIONARIO']; 
			
	$codigoFuncionario	= utf8_decode(strtoupper($_POST['codigoFuncionario']));
	
	$rut = $_POST['rut'];
	$color = $_POST['color'];
	$folio = $_POST['folio'];
	$fecha1 = $_POST['fecha1'];
	$fecha2 = $_POST['fecha2'];
	$dias = $_POST['dias'];
	$rutHijo = $_POST['rutHijo'];
	$fecha3 = $_POST['fecha3'];
	$tipoLicencia = $_POST['tipoLicencia'];
	$recuperacion = $_POST['recuperacion'];
	$invalidez = $_POST['invalidez'];
	$tipoReposo = $_POST['tipoReposo'];
	$lugarReposo = $_POST['lugarReposo'];
	$rutProfesional = $_POST['rutProfesional'];
	$especialidad = $_POST['especialidad'];
	$tipoProfesional = $_POST['tipoProfesional'];
	$atencion = $_POST['atencion'];
	$unidadFuncionario = $_POST['unidadFuncionario'];
	$archivo = $_POST['archivo'];
	$fechaReal = $_POST['fechaReal'];
	$ip = $_POST['ip'];
	$correlativo = $_POST['correlativo'];
	$fechaTermino = $_POST['fechaTermino'];
	$fechaRegistro = $_POST['fechaRegistro'];
	
	 //$unidad=7800;
	//$tipoLicencia=628;
	//$fechaGuardar="20160918";	
	//$horaInicio="";
	//$horaTermino="";	
	
	//$diasFinal=$dias-1;
	
	//Generar fecha de termino
	//$fecha_inicial = $fecha2; // fecha en la que el paciente se presenta 
  //$suma_dias = $diasFinal; // dias para la proxima cita 
  //$partesfi = explode ( "-", $fecha_inicial ); // separamos el día, mes y año de la fecha inicial 
  // sumamos los días indicados en la variable $suma_dias a la $fecha_inicial 
  //$fecha_termino = mktime ( 0, 0, 0, date ("$partesfi[1]"), date ("$partesfi[0]") + $suma_dias, date ("$partesfi[2]") ); 
  //$terminoLicencia = date("Ymd", $fecha_termino);
  //Fin generar fecha 
		
	//$codigoEscalafon 	= $_POST['codigoEscalafon'];
	//$codigoGrado 		= $_POST['codigoGrado'];
	//$apellidoPaterno  	= utf8_decode($_POST['apellidoPaterno']);
	//$apellidoMaterno  	= utf8_decode($_POST['apellidoMaterno']);
	//$primerNombre	  	= utf8_decode($_POST['primerNombre']);
	//$segundoNombre	  	= utf8_decode($_POST['segundoNombre']);
	//$codigoCargo	 	= $_POST['codigoCargo'];
	//$codigoCuadrante 	= $_POST['codigoCuadrante'];
	//$codigoUnidadAgregado = $_POST['codigoUnidadAgregado'];
	//$codigoUnidad	 	= $_POST['codigoUnidad'];
	//$fechaCargo	 		= $_POST['fechaCargo'];

	//if ($codigoCuadrante == 0) $codigoCuadrantePaso = "Null";
	//else $codigoCuadrantePaso = $codigoCuadrante;
	
	//if ($codigoUnidadAgregado == "") $codigoUnidadAgregadoPaso = "Null";
	//else $codigoUnidadAgregadoPaso = $codigoUnidadAgregado;
                        
	//$escalafon = new escalafon;
	//$escalafon->setCodigo($codigoEscalafon);
	//$escalafon->setDescripcion("");
	
	//$grado = new grado;
	//$grado->setEscalafon($escalafon);
	//$grado->setCodigo($codigoGrado);
	//$grado->setDescripcion("");
	
	//$cargo = new cargo;
	//$cargo->setCodigo($codigoCargo);
	//$cargo->setDescripcion("");
	//$cargo->setCuadrante($codigoCuadrantePaso);
	
	//$unidad = new unidad;
	//$unidad->setCodigoUnidad($codigoUnidad);
	//$unidad->setDescripcionUnidad("");
	
	//$unidadAgregado = new unidad;
	//$unidadAgregado->setCodigoUnidad($codigoUnidadAgregadoPaso);
	//$unidadAgregado->setDescripcionUnidad("");
	
	//$funcionario = new funcionario;
	//$funcionario->setCodigoFuncionario($codigoFuncionario);
	//$funcionario->setApellidoPaterno($apellidoPaterno);
	//$funcionario->setApellidoMaterno($apellidoMaterno);
	//$funcionario->setPNombre($primerNombre);
	//$funcionario->setSNombre($segundoNombre);
	//$funcionario->setGrado($grado);
	//$funcionario->setCargo($cargo);
	//$funcionario->setUnidad($unidad);
	//$funcionario->setUnidadAgregado($unidadAgregado);
	//$funcionario->setRut($rut);
	
	$fechaPaso 		= explode("-",$fecha1);
  $fechaIngresar  = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
		
  //$fechaPaso2 		= explode("-",$fecha2);
  //$fechaIngresar2  = $fechaPaso2[2] . "-" . $fechaPaso2[1] . "-" . $fechaPaso2[0];
		
	$fechaPaso3 		= explode("-",$fecha3);
  $fechaIngresar3  = $fechaPaso3[2] . "-" . $fechaPaso3[1] . "-" . $fechaPaso3[0];
  
  $fechaPasoReal 		= explode("-",$fechaReal);
  $fechaIngresarReal  = $fechaPasoReal[2] . "-" . $fechaPasoReal[1] . "-" . $fechaPasoReal[0];
  
  $fechaPasoT 		= explode("-",$fechaTermino);
  $fechaIngresarTermino  = $fechaPasoT[2] . "-" . $fechaPasoT[1] . "-" . $fechaPasoT[0];
  
  //$servicio = new servicio;

	
	//$objDBServicios = new dbLicencia;
	
			
	$funcionario = new licenciaMedica;
	$funcionario->setColor($color);
	$funcionario->setFolio($folio);
	$funcionario->setRutFuncionario($rut);
	$funcionario->setFecha1($fechaIngresar);
	$funcionario->setDias($dias);
	$funcionario->setRutHijo($rutHijo);
	$funcionario->setFecha2($fechaIngresar2);
	
	$funcionario->setFechaTerminoInicial($fechaIngresarTermino);
	
	
	$funcionario->setFecha3($fechaIngresar3);
	$funcionario->setTipoLicencia($tipoLicencia);
	$funcionario->setRecuperacion($recuperacion);
	$funcionario->setInvalidez($invalidez);
	$funcionario->setTipoReposo($tipoReposo);
	$funcionario->setLugarReposo($lugarReposo);
	$funcionario->setRutProfesional($rutProfesional);
	$funcionario->setTipoProfesional($tipoProfesional);
	$funcionario->setEspecialidad($especialidad);
	$funcionario->setAtencion($atencion);
	$funcionario->setUnidad($unidadFuncionario);
	$funcionario->setArchivoLicenciaMedica($archivo);
	$funcionario->setUsuarioProservipol($codigoUsuario);
	$funcionario->setFechaInicioReal($fechaIngresarReal);
	$funcionario->setFechaTermino($fechaIngresarTermino);
	$funcionario->setFechaRegistro($fechaRegistro);
	$funcionario->setIp($ip);
	

	$funcionario->setCodigoFuncionario($codigoFuncionario);
	$funcionario->setCorrelativo($correlativo);

		
	$objDBFuncionarios = new dbLicencia;
	$resultado = $objDBFuncionarios->nuevaLicencia($funcionario);
	$resultado = $objDBFuncionarios->insertNuevoServicio($funcionario);
	//$resultado = $objDBFuncionarios->insertFuncionariosServicio($funcionario);
				
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";
 ?>
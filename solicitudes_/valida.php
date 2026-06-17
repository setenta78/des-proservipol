<?
	//include("./inc/config.inc.php");
	include("./inc/configV3.inc.php");
	include("./baseDatos/Conexion.class.php");      
	require("./baseDatos/dbUsuarios.class.php");
	require("./objetos/usuario.class.php");
	require("./objetos/perfil.class.php");
	require("./objetos/funcionario.class.php");
	require("./objetos/unidad.class.php");
	require("./objetos/escalafon.class.php");
	require("./objetos/grado.class.php");
	
	//echo "CARGANDO APLICACIÓN, ESPERE UN MOMENTO ... ";	
	
	$userName 	 = $_POST['textUsuario'];
	$clave 		 = $_POST['textClave'];    
	$aplicacion	 = 10;
	$ip         = $_SERVER['REMOTE_ADDR'];
	$fecha_hra_inicio=date("Y/m/d H:i:s");
	
	
	if ($userName == "")   {
		$userName = "583485A";
		$clave = "5834";
	}
	
	
	////OBTENCION DE FECHA LIMITE DE ACTUALIZACION
	//
	//$fechaHoy = date();
	//
	//
	////--------------------------------

	
	//$userName	 = "935024E";
	//$clave	     = "redo";
	
	$msjAUsuarios = "";
	
	//$msjAUsuarios .= "ATENCION :\\n\\n";
	//$msjAUsuarios .= "CONFORME A RECIENTES INSTRUCCIONES SE INFORMA A UDS. QUE YA SE ENCUENTRA DISPONIBLE LA MODIFICACION PARA LA DIGITACION DE LICENCIAS DE CONDUCIR.\\n\\n";
	//$msjAUsuarios .= "EL NOMBRE, TRATAMIENTO DE ARCHIVOS Y REGISTRO DE DATOS APARECE DETALLADO EN EL MANUAL DE OPERACION DISPONIBLE EN ESTA PLATAFORMA.\\n\\n";
	//$msjAUsuarios .= "PARA ACCEDER AL MANUAL DEBE IR AL ENLACE INSTRUCCIONES Y MANUALES SISTEMA PROSERVIPOL UBICADO AL COSTADO INFERIOR IZQUIERDO DE LA PAGINA DE INICIO DEL SISTEMA.\\n\\n";
	//$msjAUsuarios .= "DESPUES DE HABER ACCEDIDO AL LISTADO DE MANUALES E INSTRUCTIVOS, USTED DEBE HACER CLIC EN EL ULTIMO MANUAL DEL LISTADO EL CUAL CORRESPONDE AL MANUAL DE OPERACION DEL NUEVO MODULO.\\n\\n";
	//$msjAUsuarios .= "ADEMAS SE ENCUENTRA DISPONIBLE UN FORMATO TIPO DE UNA DECLARACION SIMPLE CON EL FIN DE QUE SEA UTILIZADA PARA EL CORRECTO INGRESO DE LA INFORMACION.\\n\\n";
    //$msjAUsuarios .= "CONSULTAS REALIZARLAS A CALL CENTER O AL CORREO: correo.proservipol@carabineros.cl.";

	
	//$msjAUsuarios2 .= "ATENCION :\\n\\n";
	//$msjAUsuarios2 .= "RESPECTO A LA NOTIFICACION ENVIADA VIA MAIL, SE ACLARA A LOS CUARTELES QUE APARECEN CON UN VALOR EN LA CASILLA ";
	//$msjAUsuarios2 .= "(1) \"AGREGADOS A REPARTICIONES SIN PROSERVIPOL\", QUE DEBEN REVISAR SI LA CLASIFICACION UTILIZADA ES CORRECTA. ";
	//$msjAUsuarios2 .= "EL DATO ENVIADO CORRESPONDE AL TOTAL DE REGISTROS Y ES SOLO REFERENCIAL Y NO INDICA LA NECESARIA EXISTENCIA DE UN ERROR.";
	//$msjAUsuarios2 .= "\\n";
	//$msjAUsuarios2 .= "\\n";
	//$msjAUsuarios2 .= "CONSULTAS REALIZARLAS A : correo.proservipol@carabineros.cl.";
	
	//$msjAUsuarios .= "ATENCION :\\n\\n";
	//$msjAUsuarios .= "RESPECTO A LOS SERVICIOS PREVENTIVOS FOCALIZADOS, A FIN DE EVITAR ATENTADOS Y DETENER AUTORES, ";
	//$msjAUsuarios .= "EN EL SECTOR JURISDICCIONAL DE ESA JEFATURA DE ZONA METROPOLITANA, YA SEA PARA PERSONAL ";
	//$msjAUsuarios .= "DE UNIFORME O PERSONAL DE CIVIL, SERAN INGRESADOS ";
	//$msjAUsuarios .= "EN LA SIGUIENTE FORMA EN EL SISTEMA PROSERVIPOL: ";
	//$msjAUsuarios .= "\\n";
	//$msjAUsuarios .= "\\n";
	//$msjAUsuarios .= "TIPO DE SERVICIO: SERVICIOS Y TRAMITES FUERA DE CUARTEL";
	//$msjAUsuarios .= "\\n";
	//$msjAUsuarios .= "\\n";
	//$msjAUsuarios .= "SERVICIO: SERVICIO POBLACION REALIZADO EN EL SECTOR DE OTRO CUARTEL, INFERIOR A 24 HORAS";
	//$msjAUsuarios .= "\\n";
	//$msjAUsuarios .= "\\n";
	//$msjAUsuarios .= "ADEMAS DEBE AGREGAR EN EL CAMPO DE OBSERVACIONES QUE ESTE SERVICIO ESTA RELACIONADO CON EVITAR ATENTADOS Y DETENER AUTORES";
	//$msjAUsuarios .= "\\n";
	//$msjAUsuarios .= "\\n";
	//$msjAUsuarios .= "CONSULTAS REALIZARLAS A : correo.proservipol@carabineros.cl.";
	
	$msjAUsuarios .= "ATENCION!! \\n\\n";
	$msjAUsuarios .= "AL MOMENTO DE SOLICITAR ALGUN REQUERIMIENTO VIA CORREO ELECTRÓNICO ";
	$msjAUsuarios .= "PARA LA SOLUCIÓN DE PROBLEMAS CON EL SISTEMA PROSERVIPOL V3, USTED ";
	$msjAUsuarios .= "DEBERÁ INCLUIR LOS SIGUIENTES DATOS: \\n\\n";
	$msjAUsuarios .= "1.- PARA SOLICITUD DE DESVALIDACIONES: DEBE INDICAR LA UNIDAD Y LAS FECHAS DE LOS DIAS A DESVALIDAR. \\n\\n";
	$msjAUsuarios .= "2.- PARA HABILITAR FUNCIONARIOS REINTEGRADOS: DEBE INDICAR EL CÓDIGO DEL FUNCIONARIO.\\n\\n";
	$msjAUsuarios .= "3.- PARA HABILITACIÓN DE VEHICULOS: DEBE INDICAR CÓDIGO B.C.U.\\n\\n";
	$msjAUsuarios .= "4.- PARA HABILITACIÓN DE ARMAS: DEBE INDICAR NÚMERO DE SERIE DEL ARMAMENTO.";
	
		


	$objDBUsuarios = new dbUsuarios;
	$objDBUsuarios->validaUsuario($userName, $clave, $aplicacion, &$usuario);
	
	if (is_object($usuario)){
	   
	    $gradoUsuario 						  	= $usuario->getFuncionario()->getGrado()->getDescripcion();
	   	$nombreUsuario 						  	= $usuario->getFuncionario()->getNombreCompleto();
	   	$codigoFuncionario 					  	= $usuario->getFuncionario()->getCodigoFuncionario();
	   	$codigoUnidadUsuario 					= $usuario->getUnidad()->getCodigoUnidad();
	   	$descUnidadUsuario 					  	= $usuario->getUnidad()->getDescripcionUnidad();
	   	$tienePlanCuadrante						= $usuario->getUnidad()->getTienePlanCuadrante();
	   	$userName 							  	= $usuario->getUserName();
	   	$clave 								  	= $usuario->getClave();
	   	$codigoPerfil 							= $usuario->getPerfil()->getCodigoPerfil();
	   	$perfil 							  	= $usuario->getPerfil()->getDescripcionPerfil();
	   	$codigoUnidadPadre 						= $usuario->getUnidad()->getPadreUnidad()->getCodigoUnidad();
	   	$unidadBloqueo							= $usuario->getUnidad()->getBloqueada();
	   	$unidadEspecialidad						= $usuario->getUnidad()->getEspecialidad();
	   	//$perfil 								= serialize($usuario->getPerfil()->getDescripcionPerfil());
	   	$tipoUnidad						        = $usuario->getUnidad()->getTipoUnidad(); //Variable añadida 14-09-2015
	   	$contieneHijos						    = $usuario->getUnidad()->getContieneHijos(); //Variable añadida 16-04-2015

		//echo "nombreUsuario  	:  " . $nombreUsuario . "<BR>";
		//echo "unidad  		:  " . $descUnidadUsuario . "<BR>";
	   
	   $arr1 = array('CF1','CF2', 'CF3');
	   $arr2 = array('CUAD1', 'CUAD2');
	   $arr3 = array('DF1', 'DF2', 'DF3');
	   $array1 =array('1','VEH', 'KM_INICIAL', 'KM_FINAL',$arr1,$arr2, $arr3);
	   $array2 =array('1','VEH', 'KM_INICIAL', 'KM_FINAL',$arr1,$arr2, $arr3);
	   $arrFinla = array($array1, $array1);
	   
	   	session_start();
	   	//$_SESSION['OBJETO']					 = SERIALIZE($arrFinla);
	   	$_SESSION['USUARIO_GRADO'] 				 = $gradoUsuario;
	   	$_SESSION['USUARIO_NOMBRE'] 			 = $nombreUsuario;
	   	$_SESSION['USUARIO_CODIGOFUNCIONARIO']	 = $codigoFuncionario;
	   	$_SESSION['USUARIO_CODIGOUNIDAD'] 		 = $codigoUnidadUsuario;
	   	$_SESSION['USUARIO_DESCRIPCIONUNIDAD'] 	 = $descUnidadUsuario;
	   	$_SESSION['USUARIO_UNIDADPLANCUADRANTE'] = $tienePlanCuadrante;
	   	$_SESSION['USUARIO_USERNAME'] 		  	 = $userName;
	   	$_SESSION['USUARIO_CLAVE'] 		  	  	 = $clave;
	   	$_SESSION['USUARIO_PERFIL'] 		  	 = $perfil;
	   	$_SESSION['USUARIO_CODIGOPERFIL'] 		 = $codigoPerfil;
	   	$_SESSION['USUARIO_CODIGOPADREUNIDAD'] 	 = $codigoUnidadPadre ;
	   	$_SESSION['USUARIO_FECHALIMITE'] 	 	 = $fechaHoy ;
	   	$_SESSION['USUARIO_UNIDADBLOQUEO'] 	 	 = $unidadBloqueo;
	   	$_SESSION['USUARIO_UNIDADESPECIALIDAD']  = $unidadEspecialidad;
	   	$_SESSION['USUARIO_TIPOUNIDAD']          = $tipoUnidad; //Variable de sesion añadida el 14-09-2015
	   	$_SESSION['HORA_INICIO']=$fecha_hra_inicio;  
		  $_SESSION['DIRECCION_IP']=$ip; 
		  $_SESSION['USUARIO_CONTIENEHIJOS']       = $contieneHijos; //Variable de sesion añadida el 06-04-2015
		  
		    //BITACORA USUARIOS
        //$objDBUsuarios = new dbUsuarios;
        //$objDBUsuarios->insertBitacoraUsuario($codigoFuncionario,$codigoUnidadUsuario,$fecha_hra_inicio,$ip,$codigoPerfil);
        //FIN BITACORA
      	
      if($codigoFuncionario=="940114W" || $codigoFuncionario=="002603D" || $codigoFuncionario=="997398Z" || $codigoFuncionario=="993113F")$codigoPerfil=180;
      if($codigoFuncionario=="995762T" || $codigoFuncionario=="007174T" || $codigoFuncionario=="010907Z")$codigoPerfil=190;
   	
	   	if ($codigoPerfil == 10 || $codigoPerfil == 20 || $codigoPerfil == 80) $paginaInicio = "servicios.php";
	   	if ($codigoPerfil == 30 ||$codigoPerfil == 40 || $codigoPerfil == 50 || $codigoPerfil == 55 || $codigoPerfil == 60 || $codigoPerfil == 70) $paginaInicio = "serviciosUnidadesHijos.php";
	   	if ($codigoPerfil == 180) $paginaInicio = "solicitudesProceso.php";
	   	if ($codigoPerfil == 190) $paginaInicio = "solicitudesIngenieros.php";
	   	if ($codigoPerfil == 200) $paginaInicio = "solicitudesOpu.php";
	   		
		echo "<script>";
			//if ($codigoUnidadUsuario != 1385 && $codigoUnidadUsuario != 1380) echo "alert('".$msjAUsuarios."');";
			echo "alert('".$msjAUsuarios."');";
			//echo "alert('".$msjAUsuarios2."');";
			//echo "alert(".$usuario->getPerfil()->cantidadPermisosPerfil().");";
			echo "self.location.href='".$paginaInicio."';";
		echo "</script>";
	} else {
		echo "<script>";
			echo "self.location.href='index.php?ctrl=1';";
		echo "</script>";
	}
 ?>
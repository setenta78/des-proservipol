<?
	include("./inc/configV3.inc.php");
	include("./baseDatos/Conexion.class.php");      
	require("./baseDatos/dbUsuarios.class.php");
	require("./objetos/usuario.class.php");
	require("./objetos/perfil.class.php");
	require("./objetos/funcionario.class.php");
	require("./objetos/unidad.class.php");
	require("./objetos/escalafon.class.php");
	require("./objetos/grado.class.php");
	
	//echo "CARGANDO APLICACI�N, ESPERE UN MOMENTO ... ";	
	
	$userName 	 = $_POST['textUsuario'];
	$clave 		 = $_POST['textClave'];    
	$aplicacion	 = 10;
	$ip         = $_SERVER['REMOTE_ADDR'];
	$fecha_hra_inicio=date("Y/m/d H:i:s");
	
	
	if ($userName == "")   {
		$userName = "583485A";
		$clave = "5834";
	}
	
	
	$msjAUsuarios = "";
	
	$msjAUsuarios .= "ATENCION!! \\n\\n";
	$msjAUsuarios .= "AL MOMENTO DE SOLICITAR ALGUN REQUERIMIENTO VIA CORREO ELECTR�NICO ";
	$msjAUsuarios .= "PARA LA SOLUCI�N DE PROBLEMAS CON EL SISTEMA PROSERVIPOL V3, USTED ";
	$msjAUsuarios .= "DEBER� INCLUIR LOS SIGUIENTES DATOS: \\n\\n";
	$msjAUsuarios .= "1.- PARA SOLICITUD DE DESVALIDACIONES: DEBE INDICAR LA UNIDAD Y LAS FECHAS DE LOS DIAS A DESVALIDAR. \\n\\n";
	$msjAUsuarios .= "2.- PARA HABILITAR FUNCIONARIOS REINTEGRADOS: DEBE INDICAR EL C�DIGO DEL FUNCIONARIO.\\n\\n";
	$msjAUsuarios .= "3.- PARA HABILITACI�N DE VEHICULOS: DEBE INDICAR C�DIGO B.C.U.\\n\\n";
	$msjAUsuarios .= "4.- PARA HABILITACI�N DE ARMAS: DEBE INDICAR N�MERO DE SERIE DEL ARMAMENTO.";
	
		


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
	   	$tipoUnidad						        = $usuario->getUnidad()->getTipoUnidad(); //Variable a�adida 14-09-2015
	   	$contieneHijos						    = $usuario->getUnidad()->getContieneHijos(); //Variable a�adida 16-04-2015
	   
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
	   	$_SESSION['USUARIO_TIPOUNIDAD']          = $tipoUnidad; //Variable de sesion a�adida el 14-09-2015
	   	$_SESSION['HORA_INICIO']=$fecha_hra_inicio;  
		$_SESSION['DIRECCION_IP']=$ip; 
		$_SESSION['USUARIO_CONTIENEHIJOS']       = $contieneHijos; //Variable de sesion a�adida el 06-04-2015
		  
		//BITACORA USUARIOS
        //$objDBUsuarios = new dbUsuarios;
        //$objDBUsuarios->insertBitacoraUsuario($codigoFuncionario,$codigoUnidadUsuario,$fecha_hra_inicio,$ip,$codigoPerfil);
        //FIN BITACORA
      	
      if($codigoFuncionario=="992264V" || $codigoFuncionario=="994926F" || $codigoFuncionario=="940114W" || $codigoFuncionario=="007065Z" || $codigoFuncionario=="009252K" ||  $codigoFuncionario=="036001N" ||  $codigoFuncionario=="036005J" || $codigoFuncionario=="035957P" || $codigoFuncionario=="010948H") $codigoPerfil=180;
      if($codigoFuncionario=="007173S" || $codigoFuncionario=="007174T" || $codigoFuncionario=="953162X" || $codigoFuncionario=="981445Q")$codigoPerfil=190;
   	
	   	if ($codigoPerfil == 10 || $codigoPerfil == 20 || $codigoPerfil == 80) $paginaInicio = "servicios.php";
	   	if ($codigoPerfil == 30 ||$codigoPerfil == 40 || $codigoPerfil == 50 || $codigoPerfil == 55 || $codigoPerfil == 60 || $codigoPerfil == 70) $paginaInicio = "serviciosUnidadesHijos.php";
	   	if ($codigoPerfil == 180) $paginaInicio = "solicitudesProceso.php";
	   	if ($codigoPerfil == 190) $paginaInicio = "solicitudesIngenieros.php";
	   	if ($codigoPerfil == 200) $paginaInicio = "solicitudesOpu.php";
	   		
		echo "<script>";
			//if ($codigoUnidadUsuario != 1385 && $codigoUnidadUsuario != 1380) echo "alert('".$msjAUsuarios."');";
			//echo "alert('".$msjAUsuarios."');";
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
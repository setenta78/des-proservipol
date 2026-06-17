<?
	//include("./inc/config.inc.php");
	include("./inc/configV4.inc.php");
	include("./baseDatos/Conexion.class.php");      
	require("./baseDatos/dbUsuarios.class.php");
	require("./objetos/usuario.class.php");
	require("./objetos/perfil.class.php");
	require("./objetos/funcionario.class.php");
	require("./objetos/unidad.class.php");
	require("./objetos/escalafon.class.php");
	require("./objetos/grado.class.php");
	
	
	$userName 	      	= $_POST['userName'];
	$codigoValidacion 	= $_POST['codigoValidacion'];   
	$aplicacion	 	  	= 10;
	

	if ($codigoValidacion == "X216RTS"){
		
		$objDBUsuarios = new dbUsuarios;
		$objDBUsuarios->validaUsuarioExterior($userName, $aplicacion, &$usuario);
		
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
	      	
	   	
		   	if ($codigoPerfil == 10 || $codigoPerfil == 20) $paginaInicio = "servicios.php";
		   	if ($codigoPerfil == 30 ||$codigoPerfil == 40 || $codigoPerfil == 50 || $codigoPerfil == 60 || $codigoPerfil == 70 || $codigoPerfil == 80) $paginaInicio = "serviciosUnidadesHijos.php";
		   		
			echo "<script>";
				echo "self.location.href='".$paginaInicio."';";
			echo "</script>";
		} else {
				echo "NO TIENE PERMISO DE ACCESO AL SISTEMA PROSERVIPOL.<br>";                                                 
				echo "DEBE SOLICTARLO AL DEPARTAMENTO DE CONTROL DE GESTION DE LA INSPECTORIA GENERAL VIA DOCUMENTACION ELECTRONICA.";   
		}
	
	} else {
		echo "NO TIENE PERMISO DE ACCESO AL SISTEMA PROSERVIPOL.<br>";                                                 
		echo "DEBE SOLICTARLO AL DEPARTAMENTO DE CONTROL DE GESTION DE LA INSPECTORIA GENERAL VIA DOCUMENTACION ELECTRONICA.";   
	}
 ?>
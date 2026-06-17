<?
include("./inc/configV4.inc.php");
include("./baseDatos/Conexion.class.php");
require("./baseDatos/dbUsuarios.class.php");
require("./objetos/usuario.class.php");
require("./objetos/perfil.class.php");
require("./objetos/funcionario.class.php");
require("./objetos/unidad.class.php");
require("./objetos/escalafon.class.php");
require("./objetos/grado.class.php");
include("session.php");

$NewUsuario = $_GET['codigoUsuario'];
$objDBUsuarios = new dbUsuarios;
$objDBUsuarios->cambioUsuario($NewUsuario, &$usuario);

if (is_object($usuario)){
	
	$gradoUsuario 		 = $usuario->getFuncionario()->getGrado()->getDescripcion();
	$nombreUsuario 		 = $usuario->getFuncionario()->getNombreCompleto();
	$codigoFuncionario 	 = $usuario->getFuncionario()->getCodigoFuncionario();
	$codigoUnidadUsuario = $usuario->getUnidad()->getCodigoUnidad();
	$descUnidadUsuario 	 = $usuario->getUnidad()->getDescripcionUnidad();
	$tienePlanCuadrante	 = $usuario->getUnidad()->getTienePlanCuadrante();
	$codigoUnidadPadre 	 = $usuario->getUnidad()->getPadreUnidad()->getCodigoUnidad();
	$unidadBloqueo		 = $usuario->getUnidad()->getBloqueada();
	$unidadEspecialidad	 = $usuario->getUnidad()->getEspecialidad();
	$unidadEspecialidadO = $usuario->getUnidad()->getEspecialidadOld();
	$tipoUnidad			 = $usuario->getUnidad()->getTipoUnidad();
	$contieneHijos		 = $usuario->getUnidad()->getContieneHijos();
	$UnidadTipo			 = $usuario->getUnidad()->getUnidadTipo();
	$tipoUnidadPadre	 = $usuario->getUnidad()->getTipoUnidadPadre()->getTipoUnidad();
	$codigoPerfil 		 = $usuario->getPerfil()->getCodigoPerfil();
	$perfil 			 = $usuario->getPerfil()->getDescripcionPerfil();

	$permisoValidar			= $usuario->getPerfil()->getPermisoValidar();
	$permisoRegistrar		= $usuario->getPerfil()->getPermisoRegistrar();
	$permisoConsultarUnidad	= $usuario->getPerfil()->getPermisoConsultarUnidad();
	$permisoConsultarPerfil	= $usuario->getPerfil()->getPermisoConsultarPerfil();
	
	session_start();
	$_SESSION['USUARIO_GRADO'] 				 		= $gradoUsuario;
	$_SESSION['USUARIO_NOMBRE'] 			 		= $nombreUsuario;
	$_SESSION['USUARIO_CODIGOFUNCIONARIO']	 		= $codigoFuncionario;
	$_SESSION['USUARIO_CODIGOUNIDAD'] 		 	 	= $codigoUnidadUsuario;
	$_SESSION['USUARIO_DESCRIPCIONUNIDAD'] 	 		= $descUnidadUsuario;
	$_SESSION['USUARIO_UNIDADPLANCUADRANTE'] 		= $tienePlanCuadrante;
	$_SESSION['USUARIO_CODIGOPADREUNIDAD'] 	 		= $codigoUnidadPadre;
	$_SESSION['USUARIO_DESCRIPCIONUNIDAD_PADRE']	= $descUnidadUsuario;
	$_SESSION['USUARIO_UNIDADBLOQUEO'] 	 	 	 	= $unidadBloqueo;
	$_SESSION['USUARIO_UNIDADESPECIALIDAD']  		= $unidadEspecialidad;
	$_SESSION['USUARIO_UNIDADESPECIALIDAD_OLD']  	= $unidadEspecialidadO;
	$_SESSION['USUARIO_TIPOUNIDAD']          		= $tipoUnidad;
	$_SESSION['USUARIO_CONTIENEHIJOS']       		= $contieneHijos;
	$_SESSION['USUARIO_UNIDADTIPO']					= $UnidadTipo;
	$_SESSION['USUARIO_TIPOUNIDAD_PADRE']			= $tipoUnidadPadre;
	$_SESSION['USUARIO_CODIGOPERFIL'] 		 	 	= $codigoPerfil;
	$_SESSION['USUARIO_PERFIL'] 		  	 		= $perfil;

	$_SESSION['PERMISO_VALIDAR']					= $permisoValidar;
	$_SESSION['PERMISO_REGISTRAR']					= $permisoRegistrar;
}

switch($tipoUnidad){
	//ZONA
	case 20:
		header ("Location: serviciosUnidadesHijos.php");
	break;
	//PREFECTURAS
 	case 30:
		header ("Location: serviciosUnidadesEspecializadas.php");
	break;
	//COMISARIA
	case 50:
		header ("Location: servicios.php");
	break;
		//TEMPORALES
	case 110:
		header ("Location: servicios.php");
	break;
	//SUBCOMISARIA
	case 60:
		header ("Location: servicios.php");
	break;	
		//TENENCIA
	case 70:
		header ("Location: servicios.php");
	break;	
	//RETEN
	case 80:
		header ("Location: servicios.php");
	break;	
	//SUBPREFECTURA
	case 120:
		header ("Location: serviciosUnidadesEspecializadas.php");
	break;
		//ESCUCAR PM
	case 130:    
		header ("Location: serviciosUnidadesEspecializadas.php");
	break;
		//ESCUCAR ESCUADRONES
	case 135:
		header ("Location: servicios.php");
	break;
		//OREDENES JUDICIALES
	case 140:
		header ("Location: servicios.php");
	break;	
	 //CENCO
	case 150:
		header ("Location: servicios.php");
	break;	
	//GOPE
	case 160:
		header ("Location: servicios.php");
	break;	
	//TRANSITO (S.I.A.T.)
	case 90:
		header ("Location: servicios.php");
	break;	
	//CONTRALORIA
	case 170:
		header ("Location: servicios.php");
	break;
	//AEROPOLICIAL
	case 180:
		header ("Location: servicios.php");
	break;	
	//CENTRO PENITENCIARIO
	case 190:
		header ("Location: servicios.php");
	break;	
	default:
		header ("Location: unidades.php");
	break;
}

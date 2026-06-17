<?php
include("./inc/configV4.inc.php");
include("./baseDatos/Conexion.class.php");
require("./baseDatos/dbUsuarios.class.php");
require("./objetos/usuario.class.php");
require("./objetos/unidad.class.php");
require("./objetos/perfil.class.php");
require("./objetos/funcionario.class.php");
require("./objetos/escalafon.class.php");
require("./objetos/grado.class.php");
include("session.php");

// Debug: Verificar si sesión está seteada
if (!isset($_SESSION['USUARIO_CODIGOFUNCIONARIO_ORIGEN'])) {
    error_log("cambioUnidad: USUARIO_CODIGOFUNCIONARIO_ORIGEN no definido en sesión");
    header("Location: unidades.php?error=2"); // Error 2: Sesión inválida
    exit;
}

$NewUnidad = $_GET['unidad'];
$codigoFuncionario = $_SESSION['USUARIO_CODIGOFUNCIONARIO_ORIGEN'];
error_log("cambioUnidad: Intentando cambio a unidad $NewUnidad para funcionario $codigoFuncionario");

$objDBUsuarios = new dbUsuarios;
$objDBUsuarios->cambioUnidad($NewUnidad, &$usuario);

if (is_object($usuario)){
    $codigoUnidadUsuario = $usuario->getUnidad()->getCodigoUnidad();
    $descUnidadUsuario   = $usuario->getUnidad()->getDescripcionUnidad();
    $tienePlanCuadrante  = $usuario->getUnidad()->getTienePlanCuadrante();
    $codigoUnidadPadre   = $usuario->getUnidad()->getPadreUnidad()->getCodigoUnidad();
    $unidadBloqueo       = $usuario->getUnidad()->getBloqueada();
    $unidadEspecialidad  = $usuario->getUnidad()->getEspecialidad();
    $unidadEspecialidadO = $usuario->getUnidad()->getEspecialidadOld();
    $tipoUnidad          = $usuario->getUnidad()->getTipoUnidad();
    $contieneHijos       = $usuario->getUnidad()->getContieneHijos();
    $UnidadTipo          = $usuario->getUnidad()->getUnidadTipo();
    $tipoUnidadPadre     = $usuario->getUnidad()->getTipoUnidadPadre()->getTipoUnidad();
    
    $tipoUnidadNew       = $usuario->getUnidad()->getTipoUnidadNew();
    $especialidadUnidadNew = $usuario->getUnidad()->getEspecialidadUnidadNew();
    
    session_start();
    $_SESSION['USUARIO_GRADO']             = $_SESSION['USUARIO_GRADO_ORIGEN'];
    $_SESSION['USUARIO_NOMBRE']            = $_SESSION['USUARIO_NOMBRE_ORIGEN'];
    $_SESSION['USUARIO_CODIGOFUNCIONARIO'] = $codigoFuncionario;
    $_SESSION['USUARIO_CODIGOUNIDAD']      = $codigoUnidadUsuario;
    $_SESSION['USUARIO_DESCRIPCIONUNIDAD'] = $descUnidadUsuario;
    $_SESSION['USUARIO_UNIDADPLANCUADRANTE'] = $tienePlanCuadrante;
    $_SESSION['USUARIO_CODIGOPADREUNIDAD'] = $codigoUnidadPadre;
    $_SESSION['USUARIO_DESCRIPCIONUNIDAD_PADRE'] = $descUnidadUsuario;
    $_SESSION['USUARIO_UNIDADBLOQUEO']     = $unidadBloqueo;
    $_SESSION['USUARIO_UNIDADESPECIALIDAD'] = $unidadEspecialidad;
    $_SESSION['USUARIO_UNIDADESPECIALIDAD_OLD'] = $unidadEspecialidadO;
    $_SESSION['USUARIO_TIPOUNIDAD']        = $tipoUnidad;
    $_SESSION['USUARIO_CONTIENEHIJOS']     = $contieneHijos;
    $_SESSION['USUARIO_UNIDADTIPO']        = $UnidadTipo;
    $_SESSION['USUARIO_TIPOUNIDAD_PADRE']  = $tipoUnidadPadre;
    
    $_SESSION['USUARIO_TIPO_UNIDAD']       = $tipoUnidadNew;
    $_SESSION['USUARIO_ESPECIALIDAD_UNIDAD'] = $especialidadUnidadNew;
    
    // Debug: Log tipoUnidad para diagnosticar redirect
    error_log("cambioUnidad: tipoUnidad = " . $tipoUnidad . " para unidad " . $NewUnidad);
} else {
    // No unidad encontrada: Log y redirige a servicios.php en modo read-only
    error_log("cambioUnidad: No usuario/unidad para unidad " . $NewUnidad . ", funcionario " . $codigoFuncionario);
    header("Location: servicios.php?unidad=" . $NewUnidad); // Modo fiscalización
    exit;
}

if($_SESSION['PERMISO_CONSULTAR_PERFIL']){
    $objDBUsuarios = new dbUsuarios;
    $objDBUsuarios->cambioUsuario($codigoFuncionario, &$perfil);
    if (is_object($perfil)){
        $_SESSION['PERMISO_VALIDAR']   = $perfil->getPerfil()->getPermisoValidar();
        $_SESSION['PERMISO_REGISTRAR'] = $perfil->getPerfil()->getPermisoRegistrar();
    } else {
        error_log("cambioUnidad: No perfil encontrado para funcionario " . $codigoFuncionario);
    }
}

switch($tipoUnidad){
    //ZONA
    case 20:
        header("Location: servicios.php");
    break;
    //PREFECTURAS
    case 30:
        header("Location: serviciosUnidadesEspecializadas.php");
    break;
    //COMISARIA
    case 50:
        header("Location: servicios.php");
    break;
    //TEMPORALES
    case 110:
        header("Location: servicios.php");
    break;
    //SUBCOMISARIA
    case 60:
        header("Location: servicios.php");
    break;
    //TENENCIA
    case 70:
        header("Location: servicios.php");
    break;
    //RETEN
    case 80:
        header("Location: servicios.php");
    break;
    //SUBPREFECTURA
    case 120:
        header("Location: serviciosUnidadesEspecializadas.php");
    break;
    //ESCUCAR PM
    case 130:    
        header("Location: serviciosUnidadesEspecializadas.php");
    break;
    //ESCUCAR ESCUADRONES
    case 135:
        header("Location: servicios.php");
    break;
    //ORDENES JUDICIALES
    case 140:
        header("Location: servicios.php");
    break;
    //CENCO
    case 150:
        header("Location: servicios.php");
    break;
    //GOPE
    case 160:
        header("Location: servicios.php");
    break;
    //TRANSITO (S.I.A.T.)
    case 90:
        header("Location: servicios.php");
    break;
    //CONTRALORIA
    case 170:
        header("Location: servicios.php");
    break;
    //AEROPOLICIAL
    case 180:
        header("Location: servicios.php");
    break;
    //CENTRO PENITENCIARIO
    case 190:
        header("Location: servicios.php");
    break;
    //CENCICAR
    case 200:
        header("Location: servicios.php");
    break;
    default:
        // Debug: Si default, log y redirige a servicios.php con unidad para fiscalización
        error_log("cambioUnidad: Default redirect for tipoUnidad " . $tipoUnidad . " unidad " . $NewUnidad);
        header("Location: servicios.php?unidad=" . $NewUnidad);
    break;
}
?>
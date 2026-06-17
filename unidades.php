<?php
/**
 * SISTEMA DE APLICACIONES DE PROSERVIPOL
 * Selección de Unidades - Versión 4.1
 * @author Denis Quezada Lemus - Departamento Control de Gestión y Sistemas de Información
 * @compatibility PHP 5.1.2
 * @date 2025
 */

//  ORDEN CORRECTO DE INCLUDES
include("version.php");

//  VALIDAR AUTENTICACIÓN ANTES DE CARGAR OTROS ARCHIVOS
session_start();

//  Verificar que existe access_token y no ha expirado
if (!isset($_SESSION['access_token']) || !isset($_SESSION['expires_at'])) {
    error_log("Acceso denegado a unidades.php - Sin token de acceso");
    header("Location: login.php?error=1");
    exit;
}

//  Verificar expiración del token
if (time() > strtotime($_SESSION['expires_at'])) {
    error_log("Token expirado en unidades.php");
    session_unset();
    session_destroy();
    header("Location: login.php?error=2");
    exit;
}

//  Verificar que existe código de funcionario
if (!isset($_SESSION['USUARIO_CODIGOFUNCIONARIO']) || empty($_SESSION['USUARIO_CODIGOFUNCIONARIO'])) {
    error_log("Acceso denegado a unidades.php - Sin código de funcionario");
    session_unset();
    session_destroy();
    header("Location: login.php?error=3");
    exit;
}

//  Ahora cargar el resto de archivos
include("tiempo.php");
include("middleware_auth.php");

//  Obtener datos de sesión
$perfil = isset($_SESSION['USUARIO_PERFIL']) ? $_SESSION['USUARIO_PERFIL'] : 'Usuario';
$nombreUsuario = isset($_SESSION['USUARIO_NOMBRE']) ? $_SESSION['USUARIO_NOMBRE'] : '';
$gradoUsuario = isset($_SESSION['USUARIO_GRADO']) ? $_SESSION['USUARIO_GRADO'] : '';
$codigoFuncionario = $_SESSION['USUARIO_CODIGOFUNCIONARIO'];

//  Log de acceso exitoso
error_log("Acceso exitoso a unidades.php - Usuario: $codigoFuncionario");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" dir="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link href="./css/arbolUnidad.css?v=<?php echo version; ?>" rel="stylesheet" type="text/css" />
    <link href="./css/aplicacion.css?v=<?php echo version; ?>" rel="stylesheet" type="text/css">
    <link href="./css/menuPrincipal.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="./js/crearArbolFiscalizador.js?v=<?php echo version; ?>"></script>
    <script type="text/javascript" src="./js/creaObjeto.js?v=<?php echo version; ?>"></script>
    <script type="text/javascript" src="./js/aplicacion.js?v=<?php echo version; ?>"></script>
    <script type="text/javascript" src="./js/usuario.js?v=<?php echo version; ?>"></script>
    <script type="text/javascript" src="./ventana/js/prototype.js"></script>
    <script type="text/javascript" src="./ventana/js/window.js"></script>
    <script type="text/javascript" src="./ventana/js/effects.js"></script>
    <script type="text/javascript" src="./ventana/js/window_effects.js"></script>
    <script type="text/javascript" src="./ventana/js/debug.js"></script>
    <link href="./ventana/css/default.css" rel="stylesheet" type="text/css" />
    <link href="./ventana/css/debug.css" rel="stylesheet" type="text/css" />
    <link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css" />
    <title>PROSERVIPOL - Programación de Servicios Policiales</title>
    <?php include("header.php"); ?>
    
    <?php
    // Mostrar mensaje de bienvenida si viene del login
    if (isset($_GET['login']) && $_GET['login'] == 'true') {
        echo "<script>console.log(' Autenticación exitosa - Bienvenido: $codigoFuncionario');</script>";
    }
    
    // Mostrar mensaje de error si existe
    if (isset($_GET['error'])) {
        $errorMsg = '';
        switch($_GET['error']) {
            case '1':
                $errorMsg = 'Sesión inválida. Por favor, inicie sesión nuevamente.';
                break;
            case '2':
                $errorMsg = 'No se pudo cambiar a la unidad seleccionada - usuario no asociado.';
                break;
            case '3':
                $errorMsg = 'Usuario inactivo o sin permisos.';
                break;
            default:
                $errorMsg = 'Error desconocido.';
        }
        echo "<script>alert('$errorMsg');</script>";
    }
    ?>
</head>
<body onload="actualizarTamanoLista('listado');" onresize="actualizarTamanoLista('listado');">
    <div id="cubreFondo" style="display:none;"></div>
    
    <input id="unidadOrigen" type="hidden" readonly="yes" value="<?php echo isset($codOrigen) ? $codOrigen : ''; ?>">
    <input id="codigoPerfilOrigen" type="hidden" readonly="yes" value="<?php echo isset($codigoPerfilOrigen) ? $codigoPerfilOrigen : ''; ?>">
    
    <?php if(isset($permisoConsultarPerfil) && $permisoConsultarPerfil){ ?>
    <div style="margin-left:10px; margin-right:10px; margin-top:10px;">
        <div style="height:10px"></div>
        <table><tr>
            <td width="120px"><div id="titulo">Entrar como:</div></td>
            <td width="150px"><input id="codFuncionario" type="text" maxlength="7" value="" /></td>
            <td width="150px"><input type="button" value="Entrar" onclick="cambiarUsuario(document.getElementById('codFuncionario').value)" /></td>
        </tr></table>
        <div style="height:10px"></div>
        <table width="100%"><tr class="linea"><td></td></tr></table>
    </div>
    <?php } ?>
    
    <?php if(isset($permisoConsultarUnidad) && $permisoConsultarUnidad){ ?>
    <div style="margin-left:10px; margin-right:10px; margin-top:10px;">
        <div style="height:10px"></div>
        <table><tr>
            <td width="120px"><div id="titulo">Buscar Unidad:</div></td>
            <td width="150px"><input id="textUnidad" type="text" style="text-transform:uppercase" onKeyup="buscarUnidad(this.value)" /></td>
        </tr></table>
        <div style="height:10px"></div>
        <table width="100%"><tr class="linea"><td></td></tr></table>
    </div>
    <?php } ?>
    
    <div style="margin-left:10px; margin-right:10px; margin-top:10px;">
        <div style="height:2px"></div>
        <div id="listado">
            <div class="arbol" id="arbol">
                <div id="TipoBase" onclick="cambiar('<?php echo isset($codOrigen) ? $codOrigen : ''; ?>')" 
                     onmouseover="cambiarClase(this,'resaltar')" 
                     OnMouseOut="cambiarClase(this,'arbol')">
                    <img src='img/base.gif' />
                    <a><?php 
                        if(isset($codOrigen) && $codOrigen == 20) {
                            echo "NIVEL NACIONAL";
                        } else {
                            echo isset($desOrigen) ? $desOrigen : '';
                        }
                    ?></a>
                </div>
                <div id="NodosBase"></div>
            </div>
            <div style="height:2px"></div>
        </div>
    </div>
    
    <table width="100%"><tr class="linea"><td></td></tr></table>
    <?php include("modal-popup.php"); ?>
</body>
</html>

<script type="text/javascript">
    <?php 
    if(isset($tipoCuartelOrigen) && $tipoCuartelOrigen == 120) {
        echo "CrearPrimerArbol('" . (isset($codigoUnidadPadre) ? $codigoUnidadPadre : '') . "','" . (isset($codigoPerfilOrigen) ? $codigoPerfilOrigen : '') . "');";
    } else {
        echo "CrearPrimerArbol('" . (isset($codOrigen) ? $codOrigen : '') . "','" . (isset($codigoPerfilOrigen) ? $codigoPerfilOrigen : '') . "');";
    }
    ?>
</script>
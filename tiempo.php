<?php
/**
 * SISTEMA PROSERVIPOL
 * Control de Timeout de Sesión - Versión 5.1
 * @author Denis Quezada Lemus 
 * @compatibility PHP 5.1.2
 * @date 2025
 * 
 */

include("session.php");
include("./inc/configV4.inc.php");
include("./baseDatos/Conexion.class.php");
require("./baseDatos/dbUsuarios.class.php");
require("./objetos/usuario.class.php");
require("./objetos/perfil.class.php");
require("./objetos/funcionario.class.php");
require("./objetos/unidad.class.php");

// ========== VALIDACIÓN 1: TOKEN JWT NO EXPIRADO ==========
// Validar que el token de AutentificaticAPI no haya expirado
if (isset($_SESSION['expires_at'])) {
    $token_expira = strtotime($_SESSION['expires_at']);
    $ahora = time();
    
    if ($ahora > $token_expira) {
        // Token JWT expirado (típicamente 24 horas)
        error_log("Token JWT expirado - Usuario: " . $_SESSION['USUARIO_CODIGOFUNCIONARIO']);
        
        // Registrar en bitácora si es posible
        if (isset($_SESSION['USUARIO_CODIGOFUNCIONARIO'])) {
            $objDBUsuarios = new dbUsuarios;
            $objDBUsuarios->modificaBitacoraUsuario(
                $_SESSION['USUARIO_CODIGOFUNCIONARIO'],
                $_SESSION['USUARIO_CODIGOUNIDAD'],
                $_SESSION['HORA_INICIO'],
                date("Y/m/d H:i:s"),
                $_SESSION['USUARIO_CODIGOPERFIL_ORIGEN'],
                "CIERRE DE SESION: TOKEN EXPIRADO"
            );
        }
        
        session_start();
        session_unset();
        session_destroy();
        
        echo '<script type="text/javascript">
            alert("Su sesión ha expirado. Por favor, inicie sesión nuevamente.");
            window.location.href="login.php?error=2";
        </script>';
        exit;
    }
}

// ========== VALIDACIÓN 2: TIMEOUT DE INACTIVIDAD (15 MINUTOS) ==========

// Obtener datos de sesión
$codigoFuncionarioUsuarioT = isset($_SESSION['USUARIO_CODIGOFUNCIONARIO']) ? $_SESSION['USUARIO_CODIGOFUNCIONARIO'] : '';
$unidadUsuarioT = isset($_SESSION['USUARIO_CODIGOUNIDAD']) ? $_SESSION['USUARIO_CODIGOUNIDAD'] : '';
$fecha_hra_inicioT = isset($_SESSION['HORA_INICIO']) ? $_SESSION['HORA_INICIO'] : date("Y/m/d H:i:s");
$hora_actualT = date("Y/m/d H:i:s");
$codigoPerfilT = isset($_SESSION['USUARIO_CODIGOPERFIL_ORIGEN']) ? $_SESSION['USUARIO_CODIGOPERFIL_ORIGEN'] : 0;

// Calcular tiempo transcurrido desde la última actividad
$tiempo_transcurridoT = ceil((strtotime($hora_actualT) - strtotime($fecha_hra_inicioT)));

// DEFINIR TIMEOUT EN SEGUNDOS
define('TIMEOUT_INACTIVIDAD', 900); // 15 minutos = 900 segundos

// PERFILES EXENTOS DE TIMEOUT (pueden estar conectados indefinidamente)
$perfiles_sin_timeout = array(90, 100, 180, 310);
// 90  = Mesa de Ayuda (DCGSI)
// 100 = Contraloría
// 180 = Supervisor Nacional
// 310 = Administrador de Sistema

$esta_exento = in_array($codigoPerfilT, $perfiles_sin_timeout);

// LOG DE DEBUG (comentar en producción)
// error_log("DEBUG tiempo.php - Usuario: $codigoFuncionarioUsuarioT | Perfil: $codigoPerfilT | Tiempo transcurrido: {$tiempo_transcurridoT}s | Exento: " . ($esta_exento ? 'SI' : 'NO'));

// Verificar si se superó el timeout
if ($tiempo_transcurridoT >= TIMEOUT_INACTIVIDAD && !$esta_exento) {
    
    // SESIÓN EXPIRADA POR INACTIVIDAD
    error_log("Sesión expirada por inactividad - Usuario: $codigoFuncionarioUsuarioT | Tiempo: {$tiempo_transcurridoT}s");
    
    // Registrar cierre en bitácora
    $objDBUsuarios = new dbUsuarios;
    $objDBUsuarios->modificaBitacoraUsuario(
        $codigoFuncionarioUsuarioT,
        $unidadUsuarioT,
        $fecha_hra_inicioT,
        $hora_actualT,
        $codigoPerfilT,
        "CIERRE DE SESION: INACTIVIDAD"
    );
    
    // Destruir sesión
    session_start();
    session_unset();
    session_destroy();
    
    // Redirigir a login con mensaje
    echo '<script type="text/javascript">
        alert("SU SESIÓN HA EXPIRADO POR INACTIVIDAD (' . $codigoFuncionarioUsuarioT . '). Para continuar debe iniciar sesión nuevamente.");
        window.location.href="login.php?error=timeout";
    </script>';
    exit;
    
} else {
    
    // SESIÓN VÁLIDA - ACTUALIZAR HORA_INICIO
    // CORRECCIÓN CRÍTICA: Actualizar a la hora actual para resetear el contador
    $_SESSION['HORA_INICIO'] = $hora_actualT;
    
    // Log de actividad (opcional, comentar en producción)
    // error_log("Sesión actualizada - Usuario: $codigoFuncionarioUsuarioT | Nueva HORA_INICIO: $hora_actualT");
}
?>
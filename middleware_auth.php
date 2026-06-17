<?php
/**
 * SISTEMA DE APLICACIONES DE PROSERVIPOL
 * Middleware de Autenticación - Versión 4.1
 * @author Denis Quezada Lemus - Departamento Control de Gestión y Sistemas de Información
 * @compatibility PHP 5.1.2
 * @date 2025
 */

// No llamar a session_start() aquí si ya se llamó en unidades.php
if (session_id() == '') {
    session_start();
}

// Verificar token de acceso
if (!isset($_SESSION['access_token'])) {
    error_log("Middleware: Token no encontrado");
    header("Location: login.php?error=1");
    exit;
}

// Verificar expiración
if (isset($_SESSION['expires_at']) && time() > strtotime($_SESSION['expires_at'])) {
    error_log("Middleware: Token expirado");
    session_unset();
    session_destroy();
    header("Location: login.php?error=2");
    exit;
}

// Obtener código de funcionario
$codigoFuncionario = isset($_SESSION['USUARIO_CODIGOFUNCIONARIO']) ? $_SESSION['USUARIO_CODIGOFUNCIONARIO'] : '';

if (empty($codigoFuncionario)) {
    error_log("Middleware: Código de funcionario vacío");
    session_unset();
    session_destroy();
    header("Location: login.php?error=1");
    exit;
}

// Conectar a la base de datos
require_once 'queries/config.php';

// Validar que el usuario esté activo (sin restricción de perfil aquí)
$sql = "SELECT US_ACTIVO, TUS_CODIGO, FUN_CODIGO 
        FROM USUARIO 
        WHERE FUN_CODIGO = '$codigoFuncionario' 
        AND US_LOGIN = '$codigoFuncionario'
        LIMIT 1";

$result = mysql_query($sql, $link);

if (!$result) {
    error_log("Middleware: Error en consulta - " . mysql_error($link));
    session_unset();
    session_destroy();
    header("Location: login.php?error=3");
    exit;
}

$row = mysql_fetch_array($result);

if (!$row || $row['US_ACTIVO'] != 1) {
    error_log("Middleware: Usuario inactivo o no existe - " . $codigoFuncionario);
    session_unset();
    session_destroy();
    header("Location: login.php?error=3");
    exit;
}

// Usuario válido, continúa
error_log("Middleware: Usuario validado correctamente - $codigoFuncionario");
?>
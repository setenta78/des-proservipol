<?php
/**
 * PROSERVIPOL
 * Validación de Sesión - Versión 4.1 (Compatible con Autentificatic)
 * @author Denis Quezada Lemus - Departamento Control de Gestión y Sistemas de Información
 * @compatibility PHP 5.1.2
 * @date 2025
 */

if (session_id() == '') {
    session_start();
}

// Verificar autenticación con token de Autentificatic
if (!isset($_SESSION['access_token']) || empty($_SESSION['access_token'])) {
    // Para compatibilidad con código antiguo
    if (!isset($_SESSION['USUARIO_USERNAME']) || empty($_SESSION['USUARIO_USERNAME'])) {
        header("Location: login.php?error=1");
        exit;
    }
}

// Verificar expiración del token
if (isset($_SESSION['expires_at']) && time() > strtotime($_SESSION['expires_at'])) {
    session_unset();
    session_destroy();
    header("Location: login.php?error=2");
    exit;
}

// Log de sesión activa
if (isset($_SESSION['USUARIO_CODIGOFUNCIONARIO'])) {
    error_log("Sesión activa - Usuario: " . $_SESSION['USUARIO_CODIGOFUNCIONARIO']);
}
?>
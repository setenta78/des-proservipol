<?php
/**
 * SISTEMA DE APLICACIONES DE PROSERVIPOL
 * Cierre de Sesión
 * 
 * @compatibility PHP 5.1.2
 * @date 2025
 */

session_start();
session_destroy();

// ✅ RUTA CORREGIDA (sin el prefijo /des-proservipol/)
header("Location: login.php");
exit;
?>
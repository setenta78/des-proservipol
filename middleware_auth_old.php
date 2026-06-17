<?php
session_start();

// Verificar si existe el access token
if (!isset($_SESSION['access_token'])) {
    header("Location: login.php");
    exit;
}

// Obtener código de funcionario
$codigoFuncionario = isset($_SESSION['USUARIO_CODIGOFUNCIONARIO']) ? $_SESSION['USUARIO_CODIGOFUNCIONARIO'] : '';

if (!$codigoFuncionario) {
    session_destroy();
    header("Location: login.php?error=1");
    exit;
}

// Conectar a la base de datos
require_once 'queries/config.php';

// ✅ Validar solo que el usuario esté activo (SIN restricción de perfil)
$sql = "SELECT US_ACTIVO FROM USUARIO WHERE FUN_CODIGO = '$codigoFuncionario'";
$result = mysql_query($sql, $link);
$row = mysql_fetch_array($result);

if (!$row || $row['US_ACTIVO'] != 1) {
    // ❌ Usuario inactivo o no existe
    session_destroy();
    header("Location: login.php?error=3");
    exit;
}

// ✅ Usuario válido, continúa
?>
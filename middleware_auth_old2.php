<?php
session_start();

if (!isset($_SESSION['access_token'])) {
    header("Location: login.php");
    exit;
}

$codigoFuncionario = isset($_SESSION['USUARIO_CODIGOFUNCIONARIO']) ? 
    $_SESSION['USUARIO_CODIGOFUNCIONARIO'] : '';

if (!$codigoFuncionario) {
    session_destroy();
    header("Location: login.php?error=1");
    exit;
}

require_once 'queries/config.php';

// ✅ CORREGIDO: validar contra US_LOGIN, no FUN_CODIGO
$codigoFuncionario = mysql_real_escape_string($codigoFuncionario, $link);
$sql = "SELECT US_ACTIVO FROM USUARIO WHERE US_LOGIN = '$codigoFuncionario'";
$result = mysql_query($sql, $link);
$row = mysql_fetch_array($result);

if (!$row || $row['US_ACTIVO'] != 1) {
    session_destroy();
    header("Location: login.php?error=3");
    exit;
}
?>
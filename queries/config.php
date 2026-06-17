<?php
// Mostrar errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configuración BD para PROSERVIPOL_TEST - CONEXIÓN DIRECTA
$db_server = '172.21.111.67';
$db_username = 'cgonzalez';
$db_password = 'cgonzalez2016';
$db_name = 'proservipol_test';

// 🔴 PHP 4.3.9 - SOLO mysql_* (mysqli no existe en PHP 4)
$link = mysql_connect($db_server, $db_username, $db_password);
if (!$link) {
    die("ERROR: No se pudo conectar al servidor MySQL. " . mysql_error());
}

if (!mysql_select_db($db_name, $link)) {
    die("ERROR: No se pudo seleccionar la base de datos 'proservipol_test'. " . mysql_error());
}

// ⚡ Configurar charset para caracteres especiales (ñ, tildes)
mysql_query("SET NAMES 'utf8'", $link);
mysql_query("SET CHARACTER SET utf8", $link);

// Funciones mysql_* para PHP 4
function ejecutar($query)
{
    return mysql_query($query);
}

function obtener_array($result)
{
    return $result ? mysql_fetch_assoc($result) : null;
}

function escape($valor)
{
    return mysql_real_escape_string($valor);
}

function filas($result)
{
    return $result ? mysql_num_rows($result) : 0;
}

function cerrar_conexion()
{
    global $link;
    if ($link) mysql_close($link);
}
?>
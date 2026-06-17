<?php
session_start();
include("./inc/configV4.inc.php");
include("./baseDatos/Conexion.class.php");
require("./baseDatos/dbUsuarios.class.php");
$userName = $_POST['textUsuario'];
$clave = 'dummy';
$aplicacion = 10;
$ip = $_SERVER['REMOTE_ADDR'];
$fecha_hra_inicio = date("Y/m/d H:i:s");
$objDBUsuarios = new dbUsuarios;
$usuario = new usuario();
$usuario->setUserName($userName);
$usuario->setClave($clave);
$objDBUsuarios->validaUsuario($userName, $usuario);
if (is_object($usuario)) {
    $userName = $usuario->getUserName();
    if ($userName != $_POST['textUsuario']) {
        error_log("Usuario no coincide: Esperado " . $_POST['textUsuario'] . ", Obtenido " . $userName);
        echo "<script>self.location.href='http://proservipol.carabineros.cl/unidades.php?login=true';</script>";
        exit;
    }
    // Obtener el token y el código de funcionario desde la sesión
    $token = $_SESSION['access_token'] ?? '';
    $codigoFuncionario = $_SESSION['USUARIO_CODIGOFUNCIONARIO'] ?? '';
    if (!$token || !$codigoFuncionario) {
        session_destroy();
        header("Location: login.php?error=1");
        exit;
    }
    // Validar US_ACTIVO y perfil en DB local
    $link = $this->Conecta();
    $sql = "SELECT US_ACTIVO, TUS_CODIGO FROM USUARIO WHERE FUN_CODIGO = '$codigoFuncionario'";
    $result = mysql_query($sql, $link);
    $row = mysql_fetch_array($result);
    if (!$row || $row['US_ACTIVO'] != 1 || !in_array($row['TUS_CODIGO'], [10, 20, 30, 40, 45, 50, 55, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150, 160, 300, 310 ])) {
        session_destroy();
        header("Location: login.php?error=3");
        exit;
    }
    // Iniciar sesión
    $_SESSION['access_token'] = $token;
    $_SESSION['USUARIO_CODIGOFUNCIONARIO'] = $codigoFuncionario;
    $_SESSION['USUARIO_CODIGOPERFIL'] = $row['TUS_CODIGO'];
    // Redirigir según el perfil
    $paginaInicio = "gestor_usuarios.php";
    header("Location: " . $paginaInicio);
    exit;
} else {
    echo "<script>alert('Usuario no encontrado'); window.location.href='login.php';</script>";
    exit;
}
?>
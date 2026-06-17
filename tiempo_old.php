<?php 
include("session.php");
include("./inc/configV4.inc.php");
include("./baseDatos/Conexion.class.php");
require("./baseDatos/dbUsuarios.class.php");
require("./objetos/usuario.class.php");
require("./objetos/perfil.class.php");
require("./objetos/funcionario.class.php");
require("./objetos/unidad.class.php");

$codigoFuncionarioUsuarioT = $_SESSION['USUARIO_CODIGOFUNCIONARIO'];
$unidadUsuarioT = $_SESSION['USUARIO_CODIGOUNIDAD'];
$fecha_hra_inicioT = $_SESSION['HORA_INICIO'];
$hora_actualT = date("Y/m/d H:i:s");
$codigoPerfilT = $_SESSION['USUARIO_CODIGOPERFIL_ORIGEN'];

$tiempo_transcurridoT = ceil((strtotime($hora_actualT) - strtotime($fecha_hra_inicioT))); // Calculamos el tiempo transcurrido
$eventoT = "CIERRE DE SESION: INACTIVIDAD";

// Comparamos el tiempo transcurrido, si pasaron 15 minutos o más (900 segundos)
if ($tiempo_transcurridoT >= 900 && $codigoPerfilT != 90 && $codigoPerfilT != 100 && $codigoPerfilT != 180) {
    // MODIFICA BITACORA USUARIOS
    $objDBUsuarios = new dbUsuarios;
    $objDBUsuarios->modificaBitacoraUsuario($codigoFuncionarioUsuarioT, $unidadUsuarioT, $fecha_hra_inicioT, $hora_actualT, $codigoPerfilT, $eventoT);
    // FIN
    session_start();
    session_unset();
    session_destroy(); // Destruyo la sesión
    echo '<script type="text/javascript">alert("SU SESION HA EXPIRADO POR INACTIVIDAD ' . $codigoFuncionarioUsuarioT . ', PARA CONTINUAR DEBE INICIAR SESION NUEVAMENTE.");window.location.href="index.php";</script>';
} else {
    // Sino, actualizo la fecha y hora de la sesión
    $_SESSION['HORA_INICIO'] = $fecha_hra_inicioT;
}
?>
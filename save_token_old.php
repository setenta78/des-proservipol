<?php
session_start();
header('Content-Type: application/json; charset=UTF-8');

// Incluir Services_JSON (ya existe en tu proyecto)
require_once 'inc/Services_JSON.php';
$json = new Services_JSON();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Usar operador ternario en lugar de ?? para compatibilidad con PHP 5.1.2
    $access_token = isset($_POST['access_token']) ? $_POST['access_token'] : '';
    $expires_at   = isset($_POST['expires_at'])   ? $_POST['expires_at']   : '';
    $token_type   = isset($_POST['token_type'])   ? $_POST['token_type']   : '';
    $codigo_funcionario = isset($_POST['codigo_funcionario']) ? $_POST['codigo_funcionario'] : '';

    if ($access_token && $expires_at && $token_type && $codigo_funcionario) {
        // Conectar a la base de datos local
        require_once 'queries/config.php';

        // Consultar si el usuario está activo y tiene perfil permitido
        $sql = "SELECT US_ACTIVO, TUS_CODIGO FROM USUARIO WHERE FUN_CODIGO = '$codigo_funcionario'";
        $result = mysql_query($sql, $link);
        $row = mysql_fetch_array($result);

        if ($row && $row['US_ACTIVO'] == 1) {
            $tus_codigo = (int)$row['TUS_CODIGO']; // Convertir a entero para comparación

            if (in_array($tus_codigo, array(90, 310))) {
                // Guardar en sesión
                $_SESSION['access_token'] = $access_token;
                $_SESSION['USUARIO_CODIGOFUNCIONARIO'] = $codigo_funcionario;
                $_SESSION['USUARIO_CODIGOPERFIL'] = $tus_codigo;

                echo $json->encode(array('success' => true));
            } else {
                echo $json->encode(array('success' => false, 'message' => 'Perfil no autorizado'));
            }
        } else {
            echo $json->encode(array('success' => false, 'message' => 'Usuario inactivo'));
        }
    } else {
        echo $json->encode(array('success' => false, 'message' => 'Datos incompletos'));
    }
} else {
    echo $json->encode(array('success' => false, 'message' => 'Método no permitido'));
}
?>
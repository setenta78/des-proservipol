<?php
session_start();

if (!isset($_SESSION['access_token']) || time() > strtotime($_SESSION['expires_at'])) {
    error_log("Sesión inválida o expirada en " . date('Y-m-d H:i:s') . ": " . print_r($_SESSION, true));
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}

function validarToken($token) {
    $url = "http://autentificaticapi.carabineros.cl/api/auth/validate-token";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer ' . $token,
        'Accept: application/json'
    ));

    $response = curl_exec($ch);
    if ($response === false) {
        error_log("Error en cURL para validar token: " . curl_error($ch));
    }
    curl_close($ch);

    require_once './inc/Services_JSON.php';
    $json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
    $result = $json->decode($response);

    if (is_object($result) && !isset($result->success)) {
        error_log("Token inválido: " . $response);
        return false;
    }
    return true;
}

$token = $_SESSION['access_token'];
if (!validarToken($token)) {
    error_log("Validación de token falló para usuario: " . (isset($_SESSION['codigo_funcionario']) ? $_SESSION['codigo_funcionario'] : 'Desconocido'));
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}
?>
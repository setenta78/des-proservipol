<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Datos de prueba
$rut = "123456789"; // Rut sin guion ni puntos
$password = "tucontraseña";

// URL de Autentificatic API
$url = "http://autentificaticapi.carabineros.cl/api/auth/login";

// Configurar cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'rut' => $rut,
    'password' => $password
]));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/x-www-form-urlencoded',
    'Accept: application/json'
]);

// Ejecutar solicitud
$response = curl_exec($ch);
curl_close($ch);

// Mostrar resultado
echo "<h2>Respuesta de Autentificatic API</h2><pre>";

if ($response === false) {
    echo "❌ Error en la conexión\n";
} else {
    $result = json_decode($response, true);
    if (isset($result['success'])) {
        echo "✅ Autenticación exitosa\n";
        print_r($result['success']);
    } elseif (isset($result['errors'])) {
        echo "❌ Error de autenticación\n";
        print_r($result['errors']);
    } else {
        echo "⚠️ Respuesta desconocida:\n";
        print_r($result);
    }
}

echo "</pre>";
?>
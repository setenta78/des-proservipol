<?php
session_start();
$token = $_SESSION['jwtToken'];

if ($token) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://des-proservipol.carabineros.cl/api/auth/logout');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
    curl_exec($ch); // No verificamos respuesta, solo intentamos logout
    curl_close($ch);
}

session_destroy();
header('Location: login.php');
?>
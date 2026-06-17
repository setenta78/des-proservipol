<?php
require 'auth_middleware.php';
session_start();
$token = $_SESSION['jwtToken'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://des-proservipol.carabineros.cl/api/auth/user-full');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token, 'Accept: application/json'));
$userResponse = curl_exec($ch);
$userHttpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$userData = ($userHttpCode === 200) ? json_decode($userResponse, true) : array();
?>
<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
    <h2>Bienvenido, <?php echo $_SESSION['user']['FUN_CODIGO']; ?></h2>
    <p>Permisos: Validar=<?php echo $_SESSION['user']['VALIDAR'] ? 'Sí' : 'No'; ?></p>
    <?php if ($userHttpCode === 200 && isset($userData{'success'}{'user'})) { ?>
        <p>Nombre: <?php echo $userData{'success'}{'user'}{'primer_nombre'} . ' ' . $userData{'success'}{'user'}{'apellido_paterno'}; ?></p>
        <p>RUT: <?php echo $userData{'success'}{'user'}{'rut'}; ?></p>
    <?php } else { ?>
        <p>No se pudieron cargar los datos del usuario.</p>
    <?php } ?>
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>
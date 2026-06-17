<?php
// Depuración: Mostrar IP del cliente
echo "Tu IP: " . $_SERVER['REMOTE_ADDR'] . "<br>";

// Seguridad: Restringir acceso por IP
$allowed_ips = array('127.0.0.1', '172.21.200.0/24', '172.21.111.0/24', '10.113.62.0/24'); // Añadida tu subred
$client_ip = $_SERVER['REMOTE_ADDR'];
$access_allowed = false;
foreach ($allowed_ips as $allowed) {
    if ($allowed == '127.0.0.1' && $client_ip == '127.0.0.1') {
        $access_allowed = true;
    } elseif (strpos($allowed, '/24') !== false) {
        $subnet = substr($allowed, 0, strrpos($allowed, '.'));
        $client_subnet = substr($client_ip, 0, strrpos($client_ip, '.'));
        if ($subnet == $client_subnet) {
            $access_allowed = true;
        }
    }
}
if (!$access_allowed) {
    header('HTTP/1.0 403 Forbidden');
    die('Acceso denegado');
}

// Obtener conexiones activas a Apache (puerto 80)
$apache_connections = 0;
exec('netstat -an | grep :80 | grep ESTABLISHED | wc -l', $output);
$apache_connections = isset($output[0]) ? (int)$output[0] : 'No disponible';

// Obtener procesos Apache/PHP
$php_processes = 0;
exec('ps aux | grep httpd | grep -v grep | wc -l', $output);
$php_processes = isset($output[0]) ? (int)$output[0] : 'No disponible';

// Obtener conexiones a MySQL
$db_host = '172.21.111.67';
$db_user = 'desproservi';
$db_pass = 'Despros3rv1&2025';
$db_name = 'proservipol_test';
$mysql_active = 0;
$conn = @mysql_connect($db_host, $db_user, $db_pass);
if ($conn) {
    mysql_select_db($db_name);
    $result = mysql_query("SHOW STATUS WHERE Variable_name = 'Threads_connected'");
    if ($result) {
        $row = mysql_fetch_assoc($result);
        $mysql_active = $row['Value'];
    } else {
        $mysql_active = 'Error en la consulta: ' . mysql_error();
    }
    mysql_close($conn);
} else {
    $mysql_active = 'Error: No se pudo conectar a MySQL: ' . mysql_error();
}

// Mostrar resultados
?>
<!DOCTYPE html>
<html>
<head>
    <title>Monitor de Concurrencia</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { border-collapse: collapse; width: 50%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #eee; }
        .timestamp { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="timestamp">
        <strong>Fecha y hora:</strong> <?php echo date('Y-m-d H:i:s'); ?>
    </div>
    <h2>Monitor de Concurrencia Simultanea</h2>
    <table>
        <tr>
            <th>Metrica</th>
            <th>Valor</th>
        </tr>
        <tr>
            <td>Conexiones Activas (Apache, puerto 80)</td>
            <td><?php echo $apache_connections; ?></td>
        </tr>
        <tr>
            <td>Procesos Activos (Apache/PHP)</td>
            <td><?php echo $php_processes; ?></td>
        </tr>
        <tr>
            <td>Conexiones Activas (MySQL)</td>
            <td><?php echo $mysql_active; ?></td>
        </tr>
    </table>
</body>
</html>
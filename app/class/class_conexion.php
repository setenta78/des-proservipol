<?php
// Iniciar sesión si no está iniciada (compatible con PHP < 5.4)
if (session_id() == '') {
    session_start(); // Iniciar sesión solo si no está iniciada
}

// Configurar zona horaria
date_default_timezone_set("America/Santiago");

class Conectar {
    public static function con() {
        // Credenciales de conexión a la base de datos
        $host = "172.21.111.67"; // IP del servidor de MySQL
        $user = "cgonzalez";     // Usuario de la base de datos
        $pass = "cgonzalez2016"; // Contraseña del usuario
        $db   = "proservipol_test"; // Nombre de la base de datos

        // Intentar conectar a MySQL usando mysqli
        $con = new mysqli($host, $user, $pass, $db);

        // Verificar errores de conexión
        if ($con->connect_error) {
            die("Error de conexión: " . $con->connect_error);
        }

        // Establecer codificación UTF-8
        $con->set_charset("utf8");

        return $con;
    }
}
?>
